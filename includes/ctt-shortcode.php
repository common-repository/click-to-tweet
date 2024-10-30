<?php
/*
Shortcode handler for: ctt
*/
class CTTshortcode extends ctt{
	private $box_option;
	private $img_option;
	private $hint_option;
	private $tweet_length;
	private $mb_enabled;
	private $tw_handler;

	public function __construct(){
		parent::__construct();
		$this->box_option 		= get_option('ctt_box_setting');
		$this->img_option 		= get_option('ctt_image_setting');
		$this->hint_option 		= get_option('ctt_hint_box');
		$this->tw_handler		= get_option('ctt_settings');
		$this->tweet_length		= 280;
		$this->mb_enabled = function_exists( 'mb_internal_encoding' );
		add_shortcode( 'ctt', array( $this, 'ctt_shortcode_handler' ) );
		add_shortcode( 'ctt_author', array( $this, 'ctt_author_handler' ) );
		add_shortcode( 'ctt_ibox', array( $this, 'ctt_ibox_handler' ) );
		add_shortcode( 'ctt_hbox', array( $this, 'ctt_hbox_handler' ) );
		$this->register_global_hooks();
		if ( is_admin() ) {
			$this->register_admin_hooks();
		}
	}

	private function go_tweet_text($text){
		if ( $this->mb_enabled && (mb_strlen($text, 'UTF-8') > $this->tweet_length - 1) ) {
                    $text = mb_substr($text, 0, $this->tweet_length-3, 'UTF-8');
                    $lastSpace = mb_strrpos($text, ' ', 'UTF-8');
                    if (false !== $lastSpace) {
                        $text = mb_substr($text, 0 , $lastSpace, 'UTF-8');
                    }
                    $text .= (mb_substr($text, -1, null, 'UTF-8') == '.') ? '..' : '...';
                }
                else if ( !$this->mb_enabled && (strlen($text) > $this->tweet_length - 1) ) {

                    $text = substr($text, 0, $this->tweet_length-3);
                    $lastSpace = strrpos($text, ' ');
                    if (false !== $lastSpace) {
                        $text = substr($text, 0 , $lastSpace);
                    }
                    $text .= (substr($text, -1, null) == '.') ? '..' : '...';
                }
                return stripslashes($text);
	}

	private function cta_txt($box_id){
		if(isset($this->box_option['box_'.$box_id])){
			$txt = $this->box_option['box_'.$box_id]['callforaction'];
			return $txt;
		}else{
			return;
		}
	}

	private function ctt_box_color($box_id){
		if(isset($this->box_option['box_'.$box_id]) && !empty($this->box_option['box_'.$box_id]['color_number'])){
				$color = " ctt-color-".$this->box_option['box_'.$box_id]['color_number'];
				return $color;
		}else{
			return;
		}
	}

	private function ctt_box_font($box_id){
		if(isset($this->box_option['box_'.$box_id]) && !empty($this->box_option['box_'.$box_id]['font_size'])){
			$font = "ctt-font-".$this->box_option['box_'.$box_id]['font_size'];
			return $font;
		}else{
			return;
		}

	}

	private function ctt_img_position($bid){
		if(isset($this->img_option['template_'.$bid]) && !empty($this->img_option['template_'.$bid]['position'])){
			$position = " position_".$this->img_option['template_'.$bid]['position'];
			return $position;
		}else{
			return;
		}

	}

	private function ctt_img_size($bid){
		if(isset($this->img_option['template_'.$bid]) && !empty($this->img_option['template_'.$bid]['button_size'])){
			$size = " btn_".$this->img_option['template_'.$bid]['button_size'];
			return $size;
		}else{
			return;
		}
	}

	private function ctt_img_text($bid){
		$text = $this->img_option['template_'.$bid]['callforaction'];
		$get_text = "";
		if(isset($text) && !empty($text)){
			$get_text = $text;
		}else{
			$get_text = "Tweet";
		}
		return $get_text;
	}

	private function ctt_img_hover($bid){
		if(isset($this->img_option['template_'.$bid]) && !empty($this->img_option['template_'.$bid]['hover_action'])){
			$onhover = " ctt_hover_".$this->img_option['template_'.$bid]['hover_action'];
			return $onhover;
		}else{
			return;
		}

	}

	private function atr_cta_txt($tpl){
		$text = $this->box_option['atr_'.($tpl+12)]['callforaction'];
		$get_text = "";
		if(isset($text) && !empty($text)){
			$get_text = $text;
		}else{
			$get_text = "Tweet";
		}
		return $get_text;
	}

	private function box_author($tpl){
		$author = $this->box_option['atr_'.($tpl+12)]['author'];
		$get_text = "";
		if(isset($author) && !empty($author)){
			$get_text = $author;
		}
		return $get_text;
	}

	private function author_txt_size($tpl){
		if(isset($this->box_option['atr_'.($tpl+12)]) && !empty($this->box_option['atr_'.($tpl+12)]['font_size'])){
			$size = $this->box_option['atr_'.($tpl+12)]['font_size'];
			return $size;
		}else{
			return $size;
		}

	}
	/*Box Design shortcode function*/
	public function ctt_shortcode_handler( $atts, $content = null ) {

		// Backwards support for old plugin
		if ($atts['template'] == ''){
			$atts['template'] = 1;
			$atts['link'] = $atts['coverup'];
			$atts['via'] = 'no';
			$content = stripslashes($atts['tweet']);
		}

			extract( shortcode_atts( array('link' => '#','template'=> '','via'=> '','twthumb'=>0, 'nofollow'=>''), $atts ) );
			$via_text 	= (isset($via) && ($via ==  "yes")) ?  " ".$this->tw_handler['ctt-handler'] : "";
			$is_follow	= (isset($nofollow) && ($nofollow == "yes")) ? " rel=\"nofollow\"" : "";
			$short_link = ( 1 == get_option( 'ctt-short-url' ) ) ? " ".get_permalink()." " : "";
				$dis_icon = "<i></i>";
				if($template > 10){
					$dis_icon = "";
				}
				return '<div class="tweet-box ctt-box-design-'.$template. $this->ctt_box_color($template).' ">
				<a href="http://ctt.ec/'.$link.'" target="_blank" '.$is_follow.'>
				<p class="'.$this->ctt_box_font($template).'">'.$content.'</p>
				<div class="click-to-tweet">'.$dis_icon.'<span class="cta-pr">'.$this->cta_txt($template).'</span></div>
				</a>
				</div>';
		}

		public function ctt_author_handler( $atts, $content = null ){
			extract( shortcode_atts( array('link' => 'default-coverup','template'=> '','via'=> '','author'=>0, 'name'=>'', 'nofollow'=>''), $atts ) );
			$via_text 	= (isset($via) && ($via ==  "yes")) ?  " ".$this->tw_handler['ctt-handler'] : "";
			$is_follow	= (isset($nofollow) && ($nofollow == "yes")) ? " rel=\"nofollow\"" : "";

			$thumb = wp_get_attachment_url($author);
				$tpl = "";
				$anc = '<a href="http://ctt.ec/'.$link.'"><span class="cta-pr" '.$is_follow.'>'.$this->atr_cta_txt($template).'</span></a>';
				$block = '<p class="ctt-font-'.$this->author_txt_size($template).'">'.$content.'</p>';
				if($template == 1){
					$tpl = "author-first-inner";
				}elseif($template == 2){
					$tpl = "author-second-inner";
				}else{
					$tpl = "author-third-inner";
					$block = '<blockquote class="style1"><p class="ctt-font-'.$this->author_txt_size($template).'">'.$content.'<a href="http://ctt.ec/'.$link.'"><span class="tw-ico"></span></a></p></blockquote>';
					$anc = "";
				}
				$aut_name = (isset($name) && !empty($name) ) ? $name : $this->box_author($template);
				return '<div class="'.$tpl.'">
				<div class="thumb"><img alt="" src="'.$thumb.'"></div>
				<div class="tweet-text">'.$block.'
				<div class="lower-btn">
				<label class="auth-lbl">'.$aut_name.'</label>'.$anc.'</div></div><div class="clearfix"></div></div>';
		}

		public function ctt_ibox_handler($atts, $content = null){
			extract( shortcode_atts( array('tweet'=>'', 'template'=> '','via'=> '','thumb'=>0, 'nofollow'=>''), $atts ) );
			$via_text 	= (isset($via) && ($via ==  "yes")) ? " ".$this->tw_handler['ctt-handler'] : "";
			$is_follow	= (isset($nofollow) && ($nofollow == "yes")) ? " rel=\"nofollow\"" : "";

			$thumb 	= wp_get_attachment_image($thumb, 'large');
			$tweet_intent = "https://twitter.com/intent/tweet?text=".$this->go_tweet_text($content)." ".$via_text;
			$tpl 	= " click_image_template_".$template;
			$arw 	= "";
			if(($template == 3) || ($template == 4)){
				$arw = '<span class="ctt_action">Tweet</span>';
			}
			return '<figure class="click_image click_image_template_'.$template.'">
            <div class="ctt_img_container '.$tpl.$this->ctt_img_hover($template).'">'.$thumb.'</div>
            <div class="click_click_to_tweet twitter_standard '.$this->ctt_img_position($template).'">
            <a href="#" class="click_image_link'.$this->ctt_img_size($template).'" onclick="window.open(\''.$tweet_intent.'\', \'_blank\', \'width=500,height=500\'); return false;" '.$is_follow.'> <i></i>
            <span class="click_action">'.$this->ctt_img_text($template).'</span></a>'.$arw.'
            </div>
            </figure>';
		}

		public function ctt_hbox_handler($atts, $content = null){
			extract( shortcode_atts( array('link'=>'#',  'nofollow'=>''), $atts ) );
			$is_follow	= (isset($nofollow) && ($nofollow == "yes")) ? " rel=\"nofollow\"" : "";
			ob_start();
			return '<span class="click_hint"><a href="http://ctt.ec/'.$link.'" class="'.$this->hint_option['background'].'-type color_'.$this->hint_option['color'].'" '.$is_follow.'><span class="click-text_hint">'.$content.'<i></i></span><span class="tweetdis_hint_icon"></span></a></span>';
		}
}
?>
