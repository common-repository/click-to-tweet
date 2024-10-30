<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}
$check_token = get_option('ctt-token');
if(empty($check_token)){
	echo "<p class=\"check-token\" style=\"background:#ffffff; height: 100%; margin-top: 50px; padding: 10px; text-align: center;width: 100%;\">You must have to Sign-in with Twitter to connect to ClickToTweet.com.
	<a href=\"".get_admin_url()."options-general.php?page=ctt\" target=\"_parent\">Click here</a> for sign-in.";
	return;
}
$plug_url 	= plugins_url()."/clicktotweetcom/";
$setting 	= get_option('ctt_settings');
$permalink = $_REQUEST['permalink'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
		<title>Click To Tweet WordPress Plugin</title>
		<link rel="stylesheet"  href="<?php echo plugin_dir_url(__FILE__) . "css/design-box-style.css"; ?>" type='text/css' media='all' />
		<script language="javascript" type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_site_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
		<script>
			function ctt_count_char(val) {
		        var len = val.value.length;
		        if (len >= 280) {
		          val.value = val.value.substring(0, 280);
		        }else{
		          $('#charNum').text(280 - len);
		        }
		      }
			$(document).ready(function() {
				var pre_text = $("#twtext").val().length;
				$('#charNum').text(280 - pre_text);
				$(".tabs-menu a").click(function(event) {
					event.preventDefault();
					$(this).parent().addClass("current");
					$(this).parent().siblings().removeClass("current");
					var tab = $(this).attr("href");
					$(".tab-content").not(tab).css("display", "none");
					$(tab).fadeIn();
				});
				$("#snd-via").on( "click", function(){
					var thandler = $(this).attr("data-handler");
					if(thandler == ""){
						$("span.empty-handler").show();
					}else{
						$("span.empty-handler").hide();
					}
				});
			});

		</script>
		<?php
			if(function_exists('wp_enqueue_media')){
				do_action('admin_print_styles');
				do_action('admin_print_scripts');
				do_action('admin_head');
				wp_enqueue_media();
			}else{
				wp_enqueue_style('thickbox');
				wp_enqueue_script('media-upload');
				wp_enqueue_script('thickbox');
			}
		?>
<script language="javascript" type="text/javascript">
function arc_tpl(e){
	var txt 	= $("#set-hideen-tweet").attr("data-tweet");
	var title 	= $("#set-hideen-tweet").attr("data-title");
	var link 	= $("#set-hideen-tweet").attr("data-cover");
	var tag 	= '[ctt link="'+link+'" template="'+e+'"]'+title+'[/ctt]';
	if (window.tinyMCE) {
		window.tinyMCE.execCommand('mceInsertContent', false, tag);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
}


function ctt_submit(e){
var coverup = e.id.replace('insert_', '');
var tweetEl = document.getElementById('tweet_' + coverup);
var tweet = tweetEl.innerHTML;
$(".ask-template-option").show();
$("#set-hideen-tweet").attr("data-tweet", tweet);
$("#set-hideen-tweet").attr("data-cover", coverup);
}

function tw_image_uploader(obj){
var custom_uploader = wp.media({title: 'Select Image for Tweet',button: {text: 'Insert Image'},
multiple: false
}).on('select', function() {
var attachment = custom_uploader.state().get('selection').first().toJSON();
$("#tweet-thumb-id").val(attachment.id);
$("#tab-3 img.twd-image").each(function(){
	$(this).attr('src', attachment.url);
});
}).open();
}

function author_image_uploader(obj){
var custom_uploader = wp.media({title: 'Select Image for Author',button: {text: 'Insert Author Image'},
multiple: false
}).on('select', function() {
var attachment = custom_uploader.state().get('selection').first().toJSON();
$("#author-thumb-id").val(attachment.id);
$("#tab-4 img.auth-src").each(function(){
	$(this).attr('src', attachment.url);
});
}).open();
}

jQuery(function ($) {
$("a#cancel-ctt-theme").on('click', function(){
	$("#tab-lbl").show();
	$("a#cnew-ctt").trigger("click");
	$(".on-browse-click").hide();
});

var tcount = "";
$("ul#tab-lbl li a").on("click", function(){
	$('.designBOX').hide();
	$("ul#tab-lbl li").each(function(){
		$(this).removeClass("active");
	});
	$(this).parent().addClass("active");
	tcount = $(this).attr("dataval");
	$('#Design_'+tcount).show();
	if(tcount == 3){
		$("#row-insert-btn").hide();
	}else{
		$("#row-insert-btn").show();
	}
})

var idCount = "1";
$("ul#theme-selectup li a").on("click", function(){
$(this).parent().addClass("active");
idCount		= $(this).attr("dataval");
$("#tab-upbox").val(idCount);
});

rec_selected = "";
$("#recomnded-theme .tweet-box").on("click", function(){
	rec_selected = $(this).attr("data-tpl");
	idCount = "";
});

$("a#myTheme, a#lets-browse-theme").on("click", function(){
	idCount = $("ul#theme-selectup li.current a").attr("dataval");
});

$('#ctt-insert-button').on('click', function (e) {
var valselected = 0;
if(idCount!=""){
	valselected = $("#tab-"+idCount+" input[type='radio']:checked").val();
}

var twtext 		= $("#twtext").val();
var title 	= $("#title").val();
var auth_id 	= $("#author-thumb-id").val();
var auth_name 	= $("#ctt-author-name").val();
var ibox_id 	= $("#tweet-thumb-id").val();

if((idCount == 4) && (auth_id == "")){
	alert("Upload Author Image.");
	return false;
}

if((idCount == 3) && (ibox_id == "")){
	alert("Upload Image For tweet.");
	return false;
}


e.preventDefault();
if(twtext.length != 0){
		if((valselected > 0) || (rec_selected != "")){
		$(".ctt_dialog .ctt-loader").show();
		var data = {
			action: 'ctt_api_post',
			security: '<?php echo $ajax_nonce; ?>',
			data: $("#ctt_new").serialize(),
			theme_data: idCount+"|"+valselected,
			tweet_id: $("#tweet-thumb-id").val(),
			author_thumb: $("#author-thumb-id").val(),
			tweet_text: twtext,
			title: title
		};
		$.post('<?php bloginfo('url'); ?>/wp-admin/admin-ajax.php', data, function (response) {
		ctt = jQuery.parseJSON(response);
		via_text = "";
		ctt_flow = "";

		if(($("#snd-via").is(':checked'))){
			via_text = "via=\"yes\"";

		}else{
			via_text = "via=\"no\"";
		}

		if(($("#ctt-nofollow").is(':checked'))){
			ctt_flow = "nofollow=\"yes\"";
		}

		ctt.title = stripslashes(ctt.title);

		if(idCount == 1){
			res = '[ctt template="'+ valselected +'" link="'+ctt.coverup+'" '+via_text+' '+ctt_flow+']'+ctt.title+'[/ctt]';
		}else if(idCount == 2){
			res = '[ctt_hbox link="'+ctt.coverup+'" '+via_text+' '+ctt_flow+']'+ctt.tweet+'[/ctt_hbox]';
		}else if((idCount == 3) && (typeof(ctt.thumb_id) !="undefined")){
			res = '[ctt_ibox thumb="' + ctt.thumb_id + '" template="'+ valselected +'" '+via_text+' '+ctt_flow+']'+ctt.title+'[/ctt_ibox]';
		}else if((idCount == 4) && (typeof(ctt.author) !="undefined")){
			res = '[ctt_author author="' + ctt.author + '" name="'+auth_name+'" template="'+ valselected +'" link="'+ctt.coverup+'" '+via_text+' '+ctt_flow+']'+ctt.title+'[/ctt_author]';
		}

		if(rec_selected !=""){
			rec_type = rec_selected.split("-");
			if(rec_type[0] == "box"){
				res = '[ctt template="'+ rec_type[1] +'" link="'+ctt.coverup+'" '+via_text+' '+ctt_flow+']'+ctt.title+'[/ctt]';
			}else{
				res = '[ctt_hbox link="'+ctt.coverup+'" '+ctt_flow+']'+ctt.title+'[/ctt_hbox]';
			}
		}

		if (window.tinyMCE) {
		window.tinyMCE.execCommand('mceInsertContent', false, res);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
		$("#ctt-dialogxt").removeClass("ctt-freez");
		}
		});
		}else{
			alert("Please select theme for the text you want to Tweet.");
		}
	}else{
		alert("Please insert text in Tweet Box.");
		$("#twtext").focus();
		$("a#cnew-ctt").trigger("click");
	}
	});/*insert Shortcode click*/
}); /*jQuery Function*/

function stripslashes (str) {
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Ates Goral (http://magnetiq.com)
  // +      fixed by: Mick@el
  // +   improved by: marrtins
  // +   bugfixed by: Onno Marsman
  // +   improved by: rezna
  // +   input by: Rick Waldron
  // +   reimplemented by: Brett Zamir (http://brett-zamir.me)
  // +   input by: Brant Messenger (http://www.brantmessenger.com/)
  // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
  // *     example 1: stripslashes('Kevin\'s code');
  // *     returns 1: "Kevin's code"
  // *     example 2: stripslashes('Kevin\\\'s code');
  // *     returns 2: "Kevin\'s code"
  return (str + '').replace(/\\(.?)/g, function (s, n1) {
    switch (n1) {
    case '\\':
      return '\\';
    case '0':
      return '\u0000';
    case '':
      return '';
    default:
      return n1;
    }
  });
}
</script>
	</head>
	<body>
	<?php
	$pretxt = "";
	if(isset($_GET['pretext'])){
	$pretxt = stripslashes($_GET['pretext']);
	}
	?>
		<div class="ctt_dialog">
			<div class="ctt-loader"></div>
			<div id="ctt-dialogxt" class="ctt_new postbox" style="display: block">
				<div class="inside">
					<form name="ctt_new" id="ctt_new" method="post">
						<ul id="tab-lbl">
							<li class="active"><a href="javascript:void(0);" dataval="1" id="cnew-ctt">Create a new CTT</a></li>
							<li><a href="javascript:void(0);" dataval="2" id="myTheme">Select A Theme</a></li>
							<li><a href="javascript:void(0);" dataval="3">Insert Existing CTT</a></li>
						</ul>
						<div id="Design_1" class="designBOX" style="display:blobk">
							<input type="hidden" name="token" value="<?php echo $token; ?>">
							<div class="textarea-container">
								<label for="tweet" title="Enter text which you want to Tweet">Message you would like tweeted <a href="#_"> <i class="fa fa-info-circle" aria-hidden="true"></i></a> </label>
								<div class="char-left"> <span id="charNum"></span>&nbsp; characters remaining </div>
								<textarea name="tweet" type="text" class="ctt-tarea" id="twtext" rows="2" cols="50" onkeyup="ctt_count_char(this)" title="Enter text which you want to Tweet"><?php echo $pretxt; ?></textarea>
								<label for="title">Message you would like displayed in blog post</label><br />
								<textarea type="text" name="title" id="title" rows="2" cols="50"></textarea>
							</div>
							<div>
							<input type="checkbox" name="send-via" id="snd-via" value="1" data-handler="<?php echo ($setting['ctt-handler']) ? $setting['ctt-handler'] : ""; ?>" title="Select to append Twitter Username into your tweet">
							<label for="snd-via" title="Select to append Twitter Username into your tweet">Include Twitter Username
							<span class="empty-handler">
							(Oops, Username not found. <a href="<?php echo admin_url(); ?>/options-general.php?page=ctt" target="_parent">Click here</a> to manage your Twitter Username)
							</span>
							</label>
							</div>

							<div>
							<input type="checkbox" name="inc-ref" id="inc-ref" value="1" data-handler="<?php echo ($setting['ctt-handler']) ? $setting['ctt-handler'] : ""; ?>" title="Include link back to blog post">
							<label for="inc-ref" title="Select to append Twitter Username into your tweet">Include link back to blog post
							</label>
							<input style="width:310px" type="text" name="inc-ref-url" id="inc-ref-url" value="<?php print $permalink; ?>" data-handler="<?php echo ($setting['ctt-handler']) ? $setting['ctt-handler'] : ""; ?>">
							</div>

							<div>
							<input type="checkbox" name="ctt-nofollow" id="ctt-nofollow" value="1" title="Select in order to make links nofollow and not to count some of their links to other pages">
							<label for="ctt-nofollow" title="Select in order to make links nofollow and not to count some of their links to other pages">Make Links Nofollow</label>
							<input style="margin-left:20px" value="1" checked="checked" name="links" id="links" class="hidden-field" type="checkbox">
							<label for="links">Shorten Links</label>
							<span class="mf-settings">
								<span>Need to switch accounts or edit settings?</span><a href="<?php echo admin_url(); ?>/options-general.php?page=ctt" target="_parent">MODIFY SETTINGS</a>
							</span>
							</div>
							<p><span class="reqfld-label">Fill all above Fields.</span>
							</p>
						<?php
						$themes = get_option('ctt-used-theme');
						if($themes){
							echo '<div id="recomnded-theme"><h3>Select a recently used theme</h3>';
							for($i = 0; $i< count($themes); $i++){
								$tpl = explode("-", $themes[$i]);
								$iclass = "";
								if($tpl[0] == "box"){
									$ival = $tpl[1];
									if($ival == 1){
										$iclass = "first";
									}elseif($ival == 3){
										$iclass = "second";
									}elseif($ival == 2){
										$iclass = "third";
									}elseif($ival == 6){
										$iclass = "fourth";
									}elseif($ival == 5){
										$iclass = "forteenth";
									}elseif($ival == 4){
										$iclass = "sixth";
									}elseif($ival == 7){
										$iclass = "fifth";
									}elseif($ival == 8){
										$iclass = "fifteenth";
									}elseif($ival == 9){
										$iclass = "seventh";
									}elseif($ival == 10){
										$iclass = "eighth";
									}elseif($ival == 11){
										$iclass = "ninth";
									}elseif($ival == 12){
										$iclass = "twelth";
									}
								}else{
									$iclass = "hint-box";
								}
								if($iclass !="hint-box"){
									echo '<div class="tweet-box '.$iclass.'" data-tpl="'.$themes[$i].'">
									<label>
									<p class="td_">Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
									<span class="click-to-tweet"> <span><i></i>CLICK TO TWEET</span></span>
									<input type="radio" value="" name="rec-theme"><span class="select"></span></label></div>';
								}else{
									echo '<div class="tweet-box rhint-ctt" data-tpl="'.$themes[$i].'"><div class="hint-box-container"><label>
									<p>Don\'t read this text. It is here just to represent <span class="click_hint"><a href="#" class="background-type color_1">
									<span class="click-text_hint">Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes
									<i></i></span><span class="tweetdis_hint_icon"></span> </a></span></p><input type="radio" value="" name="rec-theme"><span class="select"></span></label></div></div>';
								}
						}
						echo "</div>";
						} ?>
						</div>
						<div id="Design_2" class="designBOX" style="display:none;">
							<input type="hidden" name="tab-upbox" id="tab-upbox" value="1">
							<h3 class="on-browse-click">Select Theme</h3>
							<div id="tabs-container">
								<ul id="theme-selectup" class="tabs-menu">
									<li class="current"><a href="#tab-1" dataval="1">Select Box Design</a></li>
									<li><a href="#tab-3" dataval="3">Select Image Design</a></li>
									<li><a href="#tab-2" dataval="2">Select Hint Design</a></li>
									<li><a href="#tab-4" dataval="4">Select Author Box Design</a></li>
								</ul>
								<div class="tab">
									<div id="tab-1" class="tab-content">
										<div class="tweet-box first">
											<label>
												<p class="td_">Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
												<span class="click-to-tweet"> <span><i></i>CLICK TO TWEET</span> </span>
												<input type="radio" name="designBOX1" value="1">
												<span class="select"> </span></label>
										</div>

										<div class="tweet-box third">
											<label>
												<p class="td_">"Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
												<span class="click-to-tweet"> <span><i></i>CLICK TO TWEET</span> </span>
												<input type="radio" name="designBOX1" value="2">
												<span class="select"> </span></label>
										</div>

										<div class="tweet-box second">
											<label>
												<p class="td_">"Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes"
													<div class="click-to-tweet"> <i></i><span class="cta-pr" data-cta="Click To Tweet 3">CLICK TO TWEET</span></div>
												</p>
												<input type="radio" name="designBOX1" value="3">
												<span class="select"> </span></label>
										</div>


										<div class="clear"></div>

										<div class="tweet-box sixth">
											<label>
												<p class="td_">Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
												<span class="click-to-tweet"> <span><i></i>CLICK TO TWEET</span> </span>
												<input type="radio" name="designBOX1" value="4">
												<span class="select"> </span></label>
										</div>

										<div class="tweet-box forteenth">
											<label>
												<p class="td_">Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
												<span class="click-to-tweet"> <span><i></i>CLICK TO TWEET</span> </span>
												<input type="radio" name="designBOX1" value="5">
												<span class="select"> </span></label>
										</div>


										<div class="tweet-box fourth">
											<label>
												<p class="td_">Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
												<span class="click-to-tweet"> <span><i></i>CLICK TO TWEET</span> </span>
												<input type="radio" name="designBOX1" value="6">
												<span class="select"> </span></label>
										</div>

										<div class="clear"></div>

										<div class="tweet-box fifth">
											<label>
												<p class="td_">Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
												<span class="click-to-tweet"> <span><i></i>CLICK TO TWEET</span> </span>
												<input type="radio" name="designBOX1" value="7">
												<span class="select"> </span></label>
										</div>


										<div class="tweet-box fifteenth">
											<label>
												<p class="td_">Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
												<span class="click-to-tweet"> <span><i></i>CLICK TO TWEET</span> </span>
												<input type="radio" name="designBOX1" value="8">
												<span class="select"> </span></label>
										</div>


										<div class="tweet-box seventh">
											<label>
												<p class="td_">Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
												<span class="click-to-tweet"> <span><i></i>CLICK TO TWEET</span> </span>
												<input type="radio" name="designBOX1" value="9">
												<span class="select"> </span></label>
										</div>

										<div class="clear"></div>

										<div class="tweet-box eighth">
											<label>
												<p class="td_">Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
												<span class="click-to-tweet"> <span><i></i>CLICK TO TWEET</span> </span>
												<input type="radio" name="designBOX1" value="10">
												<span class="select"> </span></label>
										</div>

										<div class="tweet-box ninth">
											<label>
												<p class="td_">Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
												<span class="click-to-tweet"> <span><i></i>CLICK TO TWEET</span> </span>
												<input type="radio" name="designBOX1" value="11">
												<span class="select"> </span></label>
										</div>


										<div class="tweet-box twelth">
											<label>
												<p class="td_">Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
												<span class="click-to-tweet"> <span><i></i>CLICK TO TWEET</span> </span>
												<input type="radio" name="designBOX1" value="12">
												<span class="select"></span></label>
										</div>
										<div class="clear"></div>
									</div>
									<div id="tab-2" class="tab-content">
										<?php $hb_opt = get_option('ctt_hint_box'); ?>
										<div class="box-design hint-box">
										<div class="hint-box-container">
										<label>
										<p>Don't read this text. It is here just to represent
										<span class="click_hint inpop-up"><a href="#" class="<?php echo $hb_opt['background']. "-type color_".$hb_opt['color']; ?>">
										<span class="click-text_hint">an example of any article on your blog. So this is kinda the paragraph of usual text in your article and what you see below is the "tweet box" created by CTT plugin.  <i> </i> </span><span class="tweetdis_hint_icon"></span> </a></span>
										</p><input type="radio" name="designBOX2" value="1"><span class="select"></span>
										</label>
										</div>
										</div>
									</div>
									<div id="tab-3" class="tab-content">
										<input type=hidden id="tweet-thumb-id" name="tweet-thumb-id" value="">
										<a class="browse-theme" href="javascript:void(0)" onclick="return tw_image_uploader(this);">Upload Image First</a>
										<br />

										<div id="testerup"></div>
										<div class="tweet-box image-box first-image">
											<label> <img src="<?php echo plugin_dir_url(__FILE__) . "images/sample-image.jpg"; ?>" alt="" class="twd-image" />
												<input type="radio" name="designBOX3" value="1">
												<span class="select"> </span> </label>
											<span class="click-to-tweet"> <a href="#" class="click_image_link"> <i></i><span class="click_action">Tweet</span></a> </span>
										</div>

										<div class="tweet-box image-box second-image">
											<label> <img src="<?php echo plugin_dir_url(__FILE__) . "images/sample-image.jpg"; ?>" alt="" class="twd-image" />
												<input type="radio" name="designBOX3" value="2">
												<span class="select"> </span> </label>
											<span class="click-to-tweet"> <a href="#" class="click_image_link"> <i></i><span class="click_action">Tweet</span></a> </span>
										</div>

										<div class="tweet-box image-box third-image">
											<label> <img src="<?php echo plugin_dir_url(__FILE__) . "images/sample-image.jpg"; ?>" alt="" class="twd-image" />
												<input type="radio" name="designBOX3" value="3">
												<span class="select"> </span> </label>
											<span class="click-to-tweet"> <a href="#" class="click_image_link"> <i></i><span class="click_action">Tweet</span></a> <span class="ctt_action">Tweet</span> </span>
										</div>

										<div class="clear"></div>
										<div class="tweet-box image-box fourth-image">
											<label> <img src="<?php echo plugin_dir_url(__FILE__) . "images/sample-image.jpg"; ?>" alt="" class="twd-image" />
												<input type="radio" name="designBOX3" value="4">
												<span class="select"> </span> </label>
											<span class="click-to-tweet"> <a href="#" class="click_image_link"> <i></i><span class="click_action">Tweet</span></a> <span class="ctt_action">Tweet</span> </span>
										</div>

										<div class="tweet-box image-box fifth-image">
											<label> <img src="<?php echo plugin_dir_url(__FILE__) . "images/sample-image.jpg"; ?>" alt="" class="twd-image" />
												<input type="radio" name="designBOX3" value="5">
												<span class="select"> </span> </label>
											<span class="click-to-tweet"> <a href="#" class="click_image_link btn_original"> <i></i><span class="click_action">Click To Tweet</span></a> </span>
										</div>

										<div class="tweet-box image-box sixth-image">
											<label> <img src="<?php echo plugin_dir_url(__FILE__) . "images/sample-image.jpg"; ?>" alt="" class="twd-image" />
												<input type="radio" name="designBOX3" value="6">
												<span class="select"> </span> </label>
											<span class="click-to-tweet"> <a href="#" class="click_image_link btn_original"> <i></i><span class="click_action">Click To Tweet</span></a> </span>
										</div>
									</div>
									<div id="tab-4" class="tab-content">
									<input type=hidden id="author-thumb-id" name="author-thumb-id" value="">
									<div class="row">
									<label>Author Name</label>
									<input type="text" name="ctt-author-name" id="ctt-author-name" value="" placeholder="Enter Author Name">
									</div>
									<a class="browse-theme" href="javascript:void(0)" onclick="return author_image_uploader(this);">Upload Author Image</a>
									<br />
									<div class="auth-box-one">
										<div id="col-pe-13" class="col-preview">
										<label>
										<input type="radio" name="author-box" value="1">
										<div class="author-first-inner">
										<div class="thumb"><img src="<?php echo $plug_url; ?>/images/timface.jpeg" alt="" class="auth-src"></div>
										<div class="tweet-text">
										<p>Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
										<div class="lower-btn"><label>Nick</label><a href="#">CLICK TO TWEET</a></div>
										<span class="select"> </span>
										</div>
										<div class="clearfix"></div>
										</div>
										</label>
										</div>

										<div style="display: block;" id="col-pe-14" class="col-preview">
										<label>
										<input type="radio" name="author-box" value="2">
										<div class="author-second-inner">
										<div class="thumb"><img src="<?php echo $plug_url; ?>/images/timface.jpeg" alt="" class="auth-src"></div>
										<div class="tweet-text">
										<p>Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p>
										<div class="lower-btn">
										<label class="auth-lbl">Nick</label>
										<a href="#"><span class="cta-pr">CLICK TO TWEET</span></a>
										</div>
										</div>
										<div class="clearfix"></div>
										</div>
										</label>
										</div>

										<div style="display: block;" id="col-pe-15" class="col-preview">
										<label>
										<input type="radio" name="author-box" value="3">
										<div class="author-third-inner">
										<div class="thumb"><img src="<?php echo $plug_url; ?>/images/timface.jpeg" alt="" class="auth-src"></div>
										<div class="tweet-text">
										<blockquote class="style1"><p>Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes</p></blockquote>
										<div class="lower-btn">
										<label class="auth-lbl">Nick</label>
										</div>
										</div>
										<div class="clearfix"></div>
										</div>
										</label>
										</div>
									</div>
									</div>
								</div>
							</div>

						</div><!--#Design_3-->

						<div id="Design_3" class="designBOX" style="display:none;">
							<div class="ctt_insert postbox">
								<div class="ask-template-option">
									<div class="col-templs">
										<input id="set-hideen-tweet" type="hidden" data-tweet="" data-cover="" data-title="">
										<h3>Select Box Template</h3>
										<?php
										for($i = 1; $i<=12; $i++){
											echo '<a href="javascript:void(0);" data-tpl="'.$i.'" onclick="return arc_tpl('.$i.');">Box Template '.$i.'</a>';
										}
										?>
									</div>
								</div>
								<h3>Existing CTT</h3>
								<div class="inside list">
									<?php echo $content; ?>
								</div>
							</div>
						</div>
						<div id="row-insert-btn" class="buttons">
							<input id="ctt-insert-button" type="submit" value="Insert New CTT" name="submit" class="button button-primary button-large">
							<a href="javascript:void(0);" id="cancel-ctt-theme" class="button on-browse-click">Cancel Theme</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php
		do_action('admin_print_footer_scripts');
		do_action('admin_footer');
		?>
	</body>
</html>
