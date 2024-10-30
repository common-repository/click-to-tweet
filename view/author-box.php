<div class="dis-hint">
<div class="set-output">
<h3>Preview</h3>
<div id="col-pe-13" class="col-preview" style="display: block;">
<div class="author-first-inner">
<div class="thumb">
<img src="<?php echo $plug_url; ?>/images/timface.jpeg" alt="">
</div>
<div class="tweet-text">
<p class="ctt-font-<?php echo $bopt['atr_13']['font_size']; ?>">This is a test of CTT - cool Wordpress plugin for creating tweetable quotes </p>
<div class="lower-btn">
<label class="auth-lbl"><?php echo $bopt['atr_13']['author']; ?></label>
<a href="#"><span class="cta-pr" data-cta="<?php echo $bopt['atr_13']['callforaction']; ?>"><?php echo $bopt['atr_13']['callforaction']; ?></span></a>
</div>
</div>
<div class="clearfix"></div>
</div>
</div>

<div id="col-pe-14" class="col-preview">
<div class="author-second-inner">
<div class="thumb">
<img src="<?php echo $plug_url; ?>/images/timface.jpeg" alt="">
</div>
<div class="tweet-text">
<p class="ctt-font-<?php echo $bopt['atr_13']['font_size']; ?>">This is a test of CTT - cool Wordpress plugin for creating tweetable quotes </p>
<div class="lower-btn">
<label class="auth-lbl"><?php echo $bopt['atr_14']['author']; ?></label>
<a href="#"><span class="cta-pr" data-cta="<?php echo $bopt['atr_14']['callforaction']; ?>"><?php echo $bopt['atr_14']['callforaction']; ?></span></a>
</div>
</div>
<div class="clearfix"></div>
</div>
</div>

<div id="col-pe-15" class="col-preview">
<div class="author-third-inner">
<div class="thumb">
<img src="<?php echo $plug_url; ?>/images/timface.jpeg" alt="">
</div>
<div class="tweet-text">
<blockquote class="style1"><p class="ctt-font-<?php echo $bopt['atr_13']['font_size']; ?>">This is a test of CTT - cool Wordpress plugin for creating tweetable quotes <span class="tw-ico"> </span></p></blockquote>
<div class="lower-btn">
<label class="auth-lbl"><?php echo $bopt['atr_15']['author'] ?></label>
</div>
</div>
<div class="clearfix"></div>
</div>
</div>
</div><!--set-output-->
<div class="set-settings">
<div class="ctt-loader"></div>
<form method="post" onsubmit="return save_auth_box_setting(this);" data-ajxurl="<?php bloginfo('url'); ?>/wp-admin/admin-ajax.php">
<h3><?php _e('Settings', 'click-to-tweet'); ?></h3>
<div class="row">
<label><?php _e('Design Template:', 'click-to-tweet'); ?></label>
<select id="author-select" name="template">
<?php
$j = 0;
for ($i=13; $i <= 15; $i++) { ?>
<option value="<?php echo $i; ?>">
<?php
$j++;
echo "Author box $j";
?>
</option>
<?php } ?>
</select>
</div>
<div class="row ctoa">
<label><?php _e('Call to action:', 'click-to-tweet'); ?></label>
<input type="text" name="cta-txt" value="<?php echo $bopt['atr_13']['callforaction']; ?>" placeholder="Enter Button Text">
</div>
<div class="row ctsize">
<label><?php _e('Font Size:', 'click-to-tweet'); ?></label>
<select name="auth-ctt-font">
<option value="original">Original</option>
<option value="small">Small</option>
<option value="large">Large</option>
</select>
</div>
<div class="row author-nm">
<label><?php _e('Author:', 'click-to-tweet'); ?></label>
<input type="text" name="cta-author" value="Nick" placeholder="Enter Name">
</div>
<div class="row">
<input type="submit" name="save-suthor" value="<?php _e('Save', 'click-to-tweet'); ?>">
</div>
<div class="row" id="auth_resp_ajx">
</div>
</form>
</div><!--set-settings-->
</div><!--dis-hint-->