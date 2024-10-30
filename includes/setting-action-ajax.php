<?php
class ctt_load_ajax extends ctt{

	public function __construct(){
		parent::__construct();
		add_action( 'wp_ajax_ctt_tpl_settings', array( $this, 'ctt_box_settings' ) );
		add_action( 'wp_ajax_ctt_auth_settings', array( $this, 'ctt_auth_box_settings' ) );
		add_action( 'wp_ajax_ctt_image_settings', array( $this, 'ctt_image_settings' ) );
		add_action( 'wp_ajax_ctt_hint_box_settings', array( $this, 'ctt_hint_box_settings' ) );
		add_action( 'wp_ajax_ctt_tweet_settings', array( $this, 'ctt_tweet_settings' ) );
	}
	public function ctt_box_settings(){
		$data = $_POST['data'];
		$dary = array();
		parse_str($data, $dary);
		$_box = get_option('ctt_box_setting');
		$tpl = $dary['template'];
		if($tpl <=12){
			if($tpl < 6){
			$_box["box_".$tpl] = array('callforaction'=>$dary['cta-txt'],
			'font_size'=>$dary['ctt-font'],
			'colors'=> $_box["box_".$tpl]['colors'],
			'color_number'=>$dary['cta-txt-color']
			);
		}else{
			$_box["box_".$tpl] = array('callforaction'=>$dary['cta-txt'],'font_size'=>$dary['ctt-font']);
		}
		}
		update_option('ctt_box_setting', $_box);
		die;
	}
	public function ctt_auth_box_settings(){
		$dary = $_POST['data'];
		$data = array();
		parse_str($dary, $data);
		$tpl = $data['template'];
		$auth_meta = get_option('ctt_box_setting');
		$auth_meta["atr_".$tpl] = array( 'callforaction'=>$data['cta-txt'],'font_size'=>$data['auth-ctt-font'],'author'=>$data['cta-author']);
		update_option('ctt_box_setting', $auth_meta);
		echo "Settings Saved";
		wp_die();
	}

	public function ctt_image_settings(){
	$data = $_POST['data'];
	$val = array();
	parse_str($data, $val);
	$option = get_option('ctt_image_setting');
	$tpl = "template_".$val['ibox-tpl'];
	$option[$tpl] = array(
						'hover_action'=>$val['ibox-hover'],
						'position'=>$val['ibox-position'],
						'button_size'=>$val['ibox-button'],
						'callforaction'=>$val['ibox-cta']
						);
	update_option('ctt_image_setting', $option);
	echo "Setting Saved";
	wp_die();
	}

	public function ctt_hint_box_settings(){
		$data = $_POST['data'];
		$val = array();
		parse_str($data, $val);
		$set_option = array('background'=>$val['hbox-type'], 'color'=>$val['hbox-color']);
		update_option('ctt_hint_box', $set_option);
		$option = get_option('ctt_hint_box');
		echo "Setting Saved";
		wp_die();
	}

	public function ctt_tweet_settings(){
		$data = $_POST['data'];
		$val = array();
		parse_str($data, $val);
		$ctt_settings = get_option('ctt_settings');
		$short_url		= isset($val['short-url']) ? $val['short-url'] : 0;
		$set_option 	= array('url'=>$short_url, 'ctt-handler'=>$val['twt-handler']);
		update_option('ctt_settings', $set_option);
		echo "Setting Saved";
		wp_die();
	}
}
?>