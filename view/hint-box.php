<?php $hb_opt = get_option('ctt_hint_box'); ?>
<div class="dis-hint">
<div class="set-output">
<h3><?php _e('Preview', 'click-to-tweet'); ?></h3>
<div id="ctt-prev-hintbox" class="box-design hint-box" data-design="<?php echo $hb_opt['background']; ?>">
<div class="hint-box-container">
<p>Don't read this text. It is here just to represent <span class="click_hint"><a href="#" class="<?php echo $hb_opt['background']. "-type color_".$hb_opt['color']; ?>"><span class="click-text_hint">an example of any article on your blog. So this is kinda the paragraph of usual text in your article and what you see below is the "tweet box" created by CTT plugin.  <i> </i> </span><span class="tweetdis_hint_icon"></span> </a></span>
</p>
</div>
</div>
</div>

<div class="set-settings">
<div class="ctt-loader"></div>
<form method="post" onsubmit="return save_hind_box_setting(this);" data-ajxurl="<?php bloginfo('url'); ?>/wp-admin/admin-ajax.php">
<h3><?php _e('Settings', 'click-to-tweet'); ?></h3>
<div class="row">
<label><?php _e('Design Type:', 'click-to-tweet'); ?></label>
<select name="hbox-type">
<option value="background"<?php echo ($hb_opt['background'] == "background") ? " selected" : ""; ?>>Background</option>
<option value="underline"<?php echo ($hb_opt['background'] == "underline") ? " selected" : ""; ?>>Underline</option>
<option value="highlighted"<?php echo ($hb_opt['background'] == "highlighted") ? " selected" : ""; ?>>Highlight</option>
</select>
</div>
<div class="row hbox-colvar">
<label><?php _e('Color:', 'click-to-tweet'); ?></label>
<div class="ctt-color-group color-variation">
<a href="javascript:void(0)" class="col-color one <?php echo ($hb_opt['color'] == 0) ? "active" : ""; ?>" data-val="0"></a>
<a href="javascript:void(0)" class="col-color two <?php echo ($hb_opt['color'] == 1) ? "active" : ""; ?>" data-val="1"></a>
<a href="javascript:void(0)" class="col-color three <?php echo ($hb_opt['color'] == 2) ? "active" : ""; ?>" data-val="2"></a>
</div>
<input type="hidden" name="hbox-color" value="<?php echo $hb_opt['color']; ?>">
</div>
<div class="row">
<input type="submit" name="save" value="<?php _e('Save', 'click-to-tweet'); ?>">
</div>
<div class="row hbox-response"></div>
</form>
</div>
</div>