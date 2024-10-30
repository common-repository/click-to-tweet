<?php
if ( !class_exists( 'ctt' ) ) {
	class ctt{
		public function __construct() {
			$this->glob_translate();
		}

		public function glob_translate(){
			load_plugin_textdomain( 'click-to-tweet', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );
		}

		public function debug( $array ) {
			echo '<pre>';
			var_dump( $array );
			echo '</pre>';
		}
		public function deactivation(){

		}

		/**
		 * Handles uninstallation tasks, such as deleting plugin options.
		 */
		public function uninstall() {
			delete_option( 'twitter-handle' );
		}

		/**
		 * Registers global hooks, these are added to both the admin and front-end.
		 */
		public function register_global_hooks() {
			add_action( 'wp_enqueue_scripts', array( $this, 'add_css' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'ctt_admin_style' ) );
			add_filter( 'the_content', array( $this, 'replace_tags' ) );
		}

		/**
		 * Registers admin only hooks.
		 */
		public function register_admin_hooks() {
			// Cache bust tinymce
			add_filter( 'tiny_mce_version', array( $this, 'refresh_mce' ) );

			// Add Settings Link
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );

			// Add settings link to plugins listing page
			add_filter( 'plugin_action_links', array( $this, 'plugin_settings_link' ), 2, 2 );

			// Add button plugin to TinyMCE
			add_action( 'init', array( $this, 'tinymce_button' ) );

			// AJAX dialog form
			add_action( 'wp_ajax_ctt_show_dialog', array( $this, 'ctt_show_dialog_callback' ) );

			// AJAX post form data
			add_action( 'wp_ajax_ctt_api_post', array( $this, 'ctt_api_post_callback' ) );
		}

		public function ctt_show_dialog_callback() {
			$ajax_nonce = wp_create_nonce( 'ctt_nonce_string' );
			$token = get_option( 'ctt-token' );
			$res = wp_remote_get( 'https://ctt.ec/Wp/listCTTs?token=' . $token );
			if ( is_wp_error( $res ) ) {
				$content = 'Error: ' . $res->get_error_message();
			} else {
				$content = $res['body'];
			}
			include( plugin_dir_path(dirname( __FILE__ )) . '/ctt-dialog.php' );
			exit;
		}

		/*Function for upload function on twitter APP*/
		private function send_image_to_twitter($image_path, $image_url) {
			
			$wptoken = get_option( 'ctt-token' );
			$image_name  = basename($image_path);
			$url = "https://ctt.ec/twitter/pluginPostImage?image=".$image_url."&wptoken=".$wptoken;
			$request = wp_remote_get($url);
			$response = wp_remote_retrieve_body( $request );
							
            if ($response != '') {
                return $response;
            }
            else {
                return $image_url;
            }
        }
        public function ctt_counter(){
        	$ctt_pub_counter = get_option('ctt-pcounter');
        	if($ctt_pub_counter){
        		update_option('ctt-pcounter', ($ctt_pub_counter+1));
        	}else{
        		update_option('ctt-pcounter', 1);
        	}
        }
		/*Post data via ctt.ec API*/
		public function ctt_api_post_callback() {
			check_ajax_referer( 'ctt_nonce_string', 'security' );
			$ctt_pub_counter = get_option('ctt-pcounter');
			$token = get_option( 'ctt-token' );
			$theme = explode("|",$_POST['theme_data']);
			$theme = array('tab'=>$theme[0],'box'=>$theme[1]);
			$chk_tab = $theme['tab'];
			if(($chk_tab == 3) && (isset($_POST['tweet_id']))){
				$url = wp_get_attachment_image_src($_POST['tweet_id'], 'large');
				$thumb = $url[0];
				$thumb_meta = get_post_meta($_POST['tweet_id'], '_ctt_twitter_url', true);
				if($thumb_meta){
					$send_tweet = stripslashes($_POST['tweet_text'])." ".$thumb_meta;
					parse_str($_POST['data'], $return_arg);
					$post_array = array('thumb_id'=>$_POST['tweet_id'], 'tweet'=>$send_tweet, 'tab'=>$return_arg['tab-upbox'], 'tab_box'=>$return_arg['designBOX3']);
					$post_array= json_encode($post_array);
					print_r($post_array);
				}else{
					$image_path = "";
					if (function_exists('get_home_path')) {
	                	$image_path = str_replace(home_url( '/' ), get_home_path().'/', $thumb);
	                }
					$tweet_src = $this->send_image_to_twitter($image_path, $thumb);
					update_post_meta($_POST['tweet_id'], '_ctt_twitter_url', $tweet_src);
					parse_str($_POST['data'], $return_arg);
					$tw_with_img = $return_arg['tweet']." ".$tweet_src;
					$post_array = array('thumb_id'=>$_POST['tweet_id'], 'tweet'=>stripslashes($tw_with_img), 'tab'=>$return_arg['tab-upbox'], 'tab_box'=>$return_arg['designBOX3']);
					$post_array= json_encode($post_array);
					print_r($post_array);
				}
				die;
				return;
			}else{
			if(isset($theme) && (($theme['tab'] !="") && ($theme['box'] !=0))){
				$check_theme = get_option('ctt-used-theme');
				$var = "";
				if($theme['tab'] == 1){
					$in_ary = "box-".$theme['box'];
					$var 	= array("box-".$theme['box']);
				}elseif($theme['tab'] == 2){
					$in_ary = "hint-box";
					$var = array("hint-box");
				}
				if($check_theme && $var){
					if((count($check_theme) < 6) && (!in_array($in_ary,$check_theme))){
						$mrg_ary = array_merge($check_theme,$var);
						update_option('ctt-used-theme', $mrg_ary);
					}
				}elseif(!empty($var)){
						update_option('ctt-used-theme', $var);
				}
			}
			$td = array();
			parse_str($_POST['data'], $td);
			$post_tweet = "";
			if(isset($td['send-via'])){
				$setting 	= get_option('ctt_settings');
				$handler 	=  ($setting['ctt-handler']) ? $setting['ctt-handler'] : "";
				$post_tweet = $td['tweet'] ." ".$handler;
			}else{
				$post_tweet = $td['tweet'];
			}
			if(isset($td['inc-ref'])){
//				$post_tweet = $post_tweet . ' !ref';
				$post_tweet = $post_tweet . ' ' . $td['inc-ref-url'];
				$post_tweet = stripslashes($post_tweet);
			}

			// encode hashtags
			$post_tweet = str_replace('#', '%23', $post_tweet);

			$rec_theme 	= isset($td['rec-theme']) ? "&rec-theme={$td['rec-theme']}" : "";
			$gmdata 	= "links=".$td['links']."&token=".$token."&tweet=".($post_tweet)."&tab-upbox=".$td['tab-upbox'].$rec_theme;
			$gourl 		= 'https://ctt.ec/Wp/createSubmit?'.$gmdata;
			$res 		= wp_remote_get($gourl);

			if ( is_wp_error( $res ) ) {
				$temp 		= 'Error: ' . $res->get_error_message();

			} else {
				$temp 		= json_decode($res['body'], true);
			}
			
			if(isset($td['author-thumb-id'])){
				$temp['author'] = $td['author-thumb-id'];
			}else{
				$temp['author'] = 9999;
			}
			
			$temp['title'] = $_POST['title'];
			$send_data = json_encode($temp);
			print_r($send_data);
			$this->ctt_counter();
			exit;
			}
		}

		public function tinymce_button() {
			if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
				return;
			}

			if ( get_user_option( 'rich_editing' ) == 'true' ) {
				add_filter( 'mce_external_plugins', array( $this, 'tinymce_register_plugin' ) );
				add_filter( 'mce_buttons', array( $this, 'tinymce_register_button' ) );
			}
		}

		public function tinymce_register_button( $buttons ) {
			array_push( $buttons, "|", "ctt" );

			return $buttons;
		}

		public function tinymce_register_plugin( $plugin_array ) {
			$plugin_array['ctt'] = plugins_url( 'js/ctt.js', dirname(__FILE__ ));

			return $plugin_array;
		}

		/**
		 * Admin: Add settings link to plugin management page
		 */
		public function plugin_settings_link( $actions, $file ) {
			if ( false !== strpos( $file, 'ctt' ) ) {
				$actions['settings'] = '<a href="options-general.php?page=ctt">'.__('Settings', 'click-to-tweet').'</a>';
			}

			return $actions;
		}

		/**
		 * Admin: Add Link to sidebar admin menu
		 */
		public function admin_menu() {
			add_action( 'admin_init', array( $this, 'register_settings' ) );
			add_options_page( 'Click To Tweet Options', 'Click To Tweet', 'manage_options', 'ctt', array($this,'settings_page') );
		}

		public function get_ibox_data($ary, $index, $data){
			return $ary['template_'.$index][$data];
		}
		/**Admin Options*/
		public function settings_page() {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'ctt-admin-options.php';
		}

		/**
		 * Admin: Whitelist the settings used on the settings page
		 */
		public function register_settings() {
			register_setting( 'ctt-options', 'twitter-handle', array( $this, 'validate_settings' ) );
			register_setting( 'ctt-options', 'ctt-token', array( $this, 'validate_settings' ) );
		}

		/**
		 * Admin: Validate settings
		 */
		public function validate_settings( $input ) {
			return str_replace( '@', '', strip_tags( stripslashes( $input ) ) );
		}

		/**
		 * Add CSS needed for styling the plugin
		 */
		public function add_css() {
			wp_register_style( 'ctt', plugins_url( '/css/ctt-module-design.css', dirname( __FILE__ ) ) ); /*for fronend design we use style.css in css folder*/
			wp_enqueue_style( 'ctt' );

			wp_register_script( 'ctt_plug_script', plugins_url( '/js/ctt-script.js', dirname( __FILE__ ) ), '', '1.0.0', true);
			wp_enqueue_script('ctt_plug_script');
		}

		public function ctt_admin_style(){
			if( is_admin() ) {
			wp_register_style( 'ctt_admin_style', plugins_url( '/css/ctt-admin-style.css', dirname( __FILE__ ) ) );
			wp_enqueue_style( 'ctt_admin_style' );

			wp_enqueue_script( 'custom-script-handle', plugins_url( 'js/ctt-script.js', dirname( __FILE__ ) ), '', false, true );
			}
		}

		/* Shorten text length to 100 characters. */
		public function shorten( $input, $length, $ellipses = true, $strip_html = true ) {
			if ( $strip_html ) {
				$input = strip_tags( $input );
			}
			if ( strlen( $input ) <= $length ) {
				return $input;
			}
			$last_space = strrpos( substr( $input, 0, $length ), ' ' );
			$trimmed_text = substr( $input, 0, $last_space );
			if ( $ellipses ) {
				$trimmed_text .= '...';
			}

			return $trimmed_text;
		}

		/**
		 * Replacement of Tweet tags with the correct HTML
		 */
		public function tweet( $matches ) {
			$handle = get_option( 'twitter-handle' );
			if ( !empty( $handle ) ) {
				$handle_code = "&via=" . $handle;
			} else {
				$handle_code = '';
			}
			$text = $matches[1];
			$short = $this->shorten( $text, 100 );

			return "<div style='clear:both'></div><div class='click-to-tweet'><div class='ctt-text'><a href='https://twitter.com/share?text=" . urlencode( $short ) . $handle_code . "&url=" . get_permalink() . "' target='_blank'>" . $short . "</a></div><a href='https://twitter.com/share?text=" . urlencode( $short ) . "" . $handle_code . "&url=" . get_permalink() . "' target='_blank' class='ctt-btn'>Click To Tweet</a><div class='ctt-tip'></div></div>";
		}

		/*
		*Replacement of Tweet tags with the correct HTML for a rss feed
		*/
		public function tweet_feed( $matches ) {
			$handle = get_option( 'twitter-handle' );
			if ( !empty( $handle ) ) {
				$handle_code = "&via=" . $handle;
			} else {
				$handle_code = '';
			}
			$text = $matches[1];
			$short = $this->shorten( $text, 100 );
			return "<hr /><p><em>" . $short . "</em><br /><a href='https://twitter.com/share?text=" . urlencode( $short ) . $handle_code . "&url=" . get_permalink() . "' target='_blank'>Click To Tweet</a></p><hr />";
		}

		/**
		 * Regular expression to locate tweet tags
		 */
		public function replace_tags( $content ) {
			if ( !is_feed() ) {
				$content = preg_replace_callback( "/\[tweet \"(.*?)\"]/i", array( $this, 'tweet' ), $content );
			} else {
				$content = preg_replace_callback( "/\[tweet \"(.*?)\"]/i", array( $this, 'tweet_feed' ), $content );
			}

			return $content;
		}
		/**
		 * Cache bust tinymce
		 */
		public function refresh_mce( $ver ) {
			$ver += 3;
			return $ver;
		}
	}
}
?>