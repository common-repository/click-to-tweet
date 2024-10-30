<?php
if(!current_user_can('manage_options')){
	wp_die( __( 'You do not have sufficient permissions to access this page.','click-to-tweet' ) );
}
?>
<script>
jQuery(document).ready(function($) {
	$(".tabs-menu a").click(function(event) {
		event.preventDefault();
		$(this).parent().addClass("current");
		$(this).parent().siblings().removeClass("current");
		var tab = $(this).attr("href");
		$(".tab-content").not(tab).css("display", "none");
		$(tab).fadeIn();
	});
});
window.onload = function() {
  document.getElementById("twt-handler").focus();
};
</script>
	<div class="ctt-wrap">
	<?php
	$token = ( isset( $_GET['token'] ) ) ? $_GET['token'] : get_option( 'ctt-token' );
	if($token) :
	?>
		<div class="ctt__settings">
			<div class="clear"></div>
			<div class="ctt-mrsetting">
			<ul id="ctt-tabmenu" class="tabs-menu">
			<li class="current"><a href="#tab-1" dataval="1"><?php _e('General Settings', 'click-to-tweet'); ?></a></li>
			<li><a href="#tab-2" dataval="2"><?php _e('Box Design', 'click-to-tweet'); ?></a></li>
			<li><a href="#tab-3" dataval="3"><?php _e('Image Design', 'click-to-tweet'); ?></a></li>
			<li><a href="#tab-4" dataval="2"><?php _e('Hint Box', 'click-to-tweet'); ?></a></li>
			<li><a href="#tab-5" dataval="2"><?php _e('Author Box', 'click-to-tweet'); ?></a></li>
			</ul>
			<div class="tab">
				<div id="tab-1" class="tab-content"  style="display:block">
					<?php require_once(dirname( __FILE__ ) . '/view/ctt-settings.php');	?>
				</div>
				<div id="tab-2" class="tab-content">
					<?php require_once(dirname( __FILE__ ) . '/view/box-design.php'); ?>
				</div>
				<div id="tab-3" class="tab-content">
					<?php require_once(dirname( __FILE__ ) . '/view/image-box.php'); ?>
				</div>
				<div id="tab-4" class="tab-content">
					<?php require_once(dirname( __FILE__ ) . '/view/hint-box.php'); ?>
				</div>
				<div id="tab-5" class="tab-content">
					<?php require_once(dirname( __FILE__ ) . '/view/author-box.php'); ?>
				</div>
			</div><!--.tab Ends Here-->
			</div> <!--.ctt-mrsetting-->
		</div><!--.ctt__settings-->
	<?php else:
		$ref = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		?>
		<h3><?php _e('ClickToTweet.com Integration', 'click-to-tweet'); ?></h3>
		<a href="https://ctt.ec/user/login?source=wp&ref=<?=$ref?>" class="button button-primary"><?php _e('Sign-in with Twitter to connect to ClickToTweet.com', 'click-to-tweet'); ?></a>
	<?php endif; ?>
