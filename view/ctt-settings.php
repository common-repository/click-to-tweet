<div class="sctt-twt-integration">
<?php
$token = ( isset( $_GET['token'] ) ) ? $_GET['token'] : get_option( 'ctt-token' );
if ( $token ) {
$screen_name = explode( '-', $token );
$screen_name = $screen_name[0];
update_option('ctt-token', $token);
}else{
$screen_name = '';
}
$ref = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
<h3><?php _e('ClickToTweet.com Integration', 'click-to-tweet'); ?></h3>
<hr />
<strong><?php _e('You are connected to your @', 'click-to-tweet'); ?><?php echo $screen_name; ?> ClickToTweet.com account</strong>
<p><a href="http://ctt.ec/user/login?source=wp&ref=<?=$ref?>" class="button button-primary"><?php _e('Connect to different account', 'click-to-tweet'); ?></a></p>
</div>
<div class="ctt-col-setting">
<h3><?php _e('ClickToTweet.com Settings', 'click-to-tweet'); ?></h3>
<hr />
<form method="post" onsubmit="return ctt_tweet_settings(this);" data-ajxurl="<?php bloginfo('url'); ?>/wp-admin/admin-ajax.php">
<?php $setting = get_option('ctt_settings'); ?>
<div class="row">
<label for="twt-handler"><?php _e('Twitter Username', 'click-to-tweet'); ?></label>
<input id="twt-handler" type="text" name="twt-handler" placeholder="@via Your Twitter Username" value="<?php echo $setting['ctt-handler']; ?>">
</div>
<input type="submit" value="<?php _e('submit', 'click-to-tweet'); ?>" name="set_ctt_color" class="button button-primary">
<div class="row hbox-response"></div>
</form>
</div>