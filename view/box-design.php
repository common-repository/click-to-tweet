<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
	die ;
}
$plug_url = plugins_url()."/clicktotweetcom/";
$bopt = get_option('ctt_box_setting');
?>
<div class="dis-hint">
<div class="set-output">
<h3><?php _e('Preview', 'click-to-tweet'); ?></h3>
<div class="box-design">
	<p> Don't read this text. It is here just to represent an example of any article on your blog. So this is kinda the paragraph of usual text in your article and what you see below is the "tweet box" created by CTT plugin. </p>
	<div id="col-pe-1" class="col-preview" data-fsize="<?php echo $bopt['box_1']['font_size']; ?>">
	<div class="tweet-box ctt-box-design-1 <?php echo " ctt-color-".$bopt['box_1']['color_number']; ?>">
		<a href="#_">
			<p class="ctt-font-<?php echo $bopt['box_1']['font_size']; ?>"><?php _e('Sample Dummy Text for ClickToTweet plugin - A Wordpress plugin for creating Customize tweetable quotes', 'click-to-tweet'); ?></p>
			<div class="click-to-tweet"> <i></i><span class="cta-pr" data-cta="<?php echo $bopt['box_1']['callforaction']; ?>"><?php echo $bopt['box_1']['callforaction']; ?></span></div>
		</a>
	</div>
	</div>

	<div id="col-pe-2" class="col-preview" data-fsize="<?php echo $bopt['box_2']['font_size']; ?>">
	<div class="tweet-box ctt-box-design-2 <?php echo " ctt-color-".$bopt['box_2']['color_number']; ?>">
		<a href="#_">
			<p class="ctt-font-<?php echo $bopt['box_2']['font_size']; ?>">
				"<?php _e('This is a test of CTT - cool Wordpress plugin for creating tweetable quotes', 'click-to-tweet'); ?>"
			</p>
			<div class="click-to-tweet"> <i></i><span class="cta-pr" data-cta="<?php echo $bopt['box_2']['callforaction']; ?>"><?php echo $bopt['box_2']['callforaction']; ?></span></div>
		</a>
	</div>
	</div>

	<div id="col-pe-3" class="col-preview" data-fsize="<?php echo $bopt['box_3']['font_size']; ?>">
	<div class="tweet-box ctt-box-design-3 <?php echo " ctt-color-".$bopt['box_3']['color_number']; ?>">
		<a href="#_">
			<p class="ctt-font-<?php echo $bopt['box_3']['font_size']; ?>">
			<?php _e('This is a test of CTT - cool Wordpress plugin for creating tweetable quotes', 'click-to-tweet'); ?></p>
			<div class="click-to-tweet"> <i></i><span class="cta-pr" data-cta="<?php echo $bopt['box_3']['callforaction']; ?>"><?php echo $bopt['box_3']['callforaction']; ?></span></div>
		</a>
	</div>
	</div>

	<div id="col-pe-4" class="col-preview" data-fsize="<?php echo $bopt['box_4']['font_size']; ?>">
	<div class="tweet-box ctt-box-design-4 <?php echo " ctt-color-".$bopt['box_4']['color_number']; ?>">
		<a href="#_">
			<p class="ctt-font-<?php echo $bopt['box_4']['font_size']; ?>"><?php _e('This is a test of CTT - cool Wordpress plugin for creating tweetable quotes', 'click-to-tweet'); ?></p>
			<div class="click-to-tweet"> <i></i><span class="cta-pr" data-cta="<?php echo $bopt['box_4']['callforaction']; ?>"><?php echo $bopt['box_4']['callforaction']; ?></span></div>
		</a>
	</div>
	</div>

	<div id="col-pe-5" class="col-preview" data-fsize="<?php echo $bopt['box_5']['font_size']; ?>">
	<div class="tweet-box ctt-box-design-5 <?php echo " ctt-color-".$bopt['box_5']['color_number']; ?>">
		<a href="#_">
			<p class="ctt-font-<?php echo $bopt['box_5']['font_size']; ?>"><?php _e('This is a test of CTT - cool Wordpress plugin for creating tweetable quotes', 'click-to-tweet'); ?></p>
			<div class="click-to-tweet"> <i></i><span class="cta-pr" data-cta="<?php echo $bopt['box_5']['callforaction']; ?>"><?php echo $bopt['box_5']['callforaction']; ?></span></div>
		</a>
	</div>
	</div>

	<div id="col-pe-6" class="col-preview" data-fsize="<?php echo $bopt['box_6']['font_size']; ?>">
	<div class="tweet-box ctt-box-design-6">
		<a href="#_">
		<p class="ctt-font-<?php echo $bopt['box_6']['font_size']; ?>"><?php _e('This is a test of CTT - cool Wordpress plugin for creating tweetable quotes', 'click-to-tweet'); ?></p>
		<div class="click-to-tweet"> <i></i><span class="cta-pr" data-cta="<?php echo $bopt['box_6']['callforaction']; ?>"><?php echo $bopt['box_6']['callforaction']; ?></span></div>
		</a>
	</div>
	</div>


	<div id="col-pe-7" class="col-preview" data-fsize="<?php echo $bopt['box_7']['font_size']; ?>">
	<div class="tweet-box ctt-box-design-7">
		<a href="#_">
		<p class="ctt-font-<?php echo $bopt['box_7']['font_size']; ?>">
			<span class="quote">"</span><?php _e('This is a test of CTT - cool Wordpress plugin for creating tweetable quotes', 'click-to-tweet'); ?>
		</p>
		<div class="click-to-tweet"> <i></i><span class="cta-pr" data-cta="<?php echo $bopt['box_7']['callforaction']; ?>"><?php echo $bopt['box_7']['callforaction']; ?></span></div>
		</a>
	</div>
	</div>

	<div id="col-pe-8" class="col-preview" data-fsize="<?php echo $bopt['box_8']['font_size']; ?>">
	<div class="tweet-box ctt-box-design-8">
		<a href="#_">
			<p class="ctt-font-<?php echo $bopt['box_8']['font_size']; ?>">
			<?php _e('This is a test of CTT - cool Wordpress plugin for creating tweetable quotes', 'click-to-tweet'); ?>
			</p>
			<div class="click-to-tweet"> <i></i><span class="cta-pr" data-cta="<?php echo $bopt['box_8']['callforaction']; ?>"><?php echo $bopt['box_8']['callforaction']; ?></span></div>
		</a>
	</div>
	</div>

	<div id="col-pe-9" class="col-preview" data-fsize="<?php echo $bopt['box_9']['font_size']; ?>">
	<div class="tweet-box ctt-box-design-9">
		<a href="#_">
			<p class="ctt-font-<?php echo $bopt['box_9']['font_size']; ?>">
			<?php _e('This is a test of CTT - cool Wordpress plugin for creating tweetable quotes', 'click-to-tweet'); ?>
			</p>
			<div class="click-to-tweet"> <i></i><span class="cta-pr" data-cta="<?php echo $bopt['box_9']['callforaction']; ?>"><?php echo $bopt['box_9']['callforaction']; ?></span></div>
		</a>
	</div>
	</div>

	<div id="col-pe-10" class="col-preview" data-fsize="<?php echo $bopt['box_10']['font_size']; ?>">
	<div class="tweet-box ctt-box-design-10">
		<a href="#_">
			<p class="ctt-font-<?php echo $bopt['box_10']['font_size']; ?>">
			<?php _e('This is a test of CTT - cool Wordpress plugin for creating tweetable quotes', 'click-to-tweet'); ?>
			</p>
			<div class="click-to-tweet"> <i></i><span class="cta-pr" data-cta="<?php echo $bopt['box_10']['callforaction']; ?>"><?php echo $bopt['box_10']['callforaction']; ?></span></div>
		</a>
	</div>
	</div>

	<div id="col-pe-11" class="col-preview" data-fsize="<?php echo $bopt['box_11']['font_size']; ?>">
	<div class="tweet-box ctt-box-design-11">
		<a href="#_">
			<p class="ctt-font-<?php echo $bopt['box_11']['font_size']; ?>">
			<?php _e('This is a test of CTT - cool Wordpress plugin for creating tweetable quotes', 'click-to-tweet'); ?>
			</p>
			<div class="click-to-tweet"><span class="cta-pr" data-cta="<?php echo $bopt['box_11']['callforaction']; ?>"> <i></i><?php echo $bopt['box_11']['callforaction']; ?></span></div>
		</a>
	</div>
	</div>

	<div id="col-pe-12" class="col-preview" data-fsize="<?php echo $bopt['box_12']['font_size']; ?>">
	<div class="tweet-box ctt-box-design-12">
		<a href="#_">
			<p class="ctt-font-<?php echo $bopt['box_12']['font_size']; ?>">
			<?php _e('This is a test of CTT - cool Wordpress plugin for creating tweetable quotes', 'click-to-tweet'); ?>
			</p>
			<div class="click-to-tweet"> <span class="cta-pr" data-cta="<?php echo $bopt['box_12']['callforaction']; ?>"><?php echo $bopt['box_12']['callforaction']; ?></span></div>
		</a>
	</div>
	</div>
</div>
<!-- / box-design -->
</div>
<div class="set-settings">
<div class="ctt-loader"></div>
<form method="post" onsubmit="return save_template_setting(this);" data-ajxurl="<?php bloginfo('url'); ?>/wp-admin/admin-ajax.php">
<h3><?php _e('Settings', 'click-to-tweet'); ?></h3>
<div class="row">
<label><?php _e('Design Template:', 'click-to-tweet'); ?></label>
<select id="templ-select" name="template">
<?php
$j = 0;
for ($i=1; $i <= 12; $i++) { ?>
<option value="<?php echo $i; ?>">
<?php
if($i <= 12){
echo "Template $i";
}else{
$j++;
echo "Author box $j";
}
?>
</option>
<?php } ?>
</select>
</div>

<div class="row ctoa">
<label><?php _e('Call to action:', 'click-to-tweet'); ?></label>
<input type="text" name="cta-txt" value="<?php echo $bopt['box_1']['callforaction']; ?>" placeholder="Enter Button Text">
</div>
<div class="row txt-color-opt">
<label><?php _e('Color:', 'click-to-tweet'); ?></label>
<div class="ctt-color-group">
<?php
	$act_color = "";
	for($i=1; $i <=5; $i++){
	$act_color = $bopt['box_'.$i]['color_number'];
?>
<div id="colo-group-<?php echo $i; ?>" class="color-variation">
	<a href="javascript:void(0)" class="col-color one <?php echo ($act_color == 0) ? "active" : ""; ?>" data-val="0"></a>
	<a href="javascript:void(0)" class="col-color two <?php echo ($act_color == 1) ? "active" : ""; ?>" data-val="1"></a>
	<a href="javascript:void(0)" class="col-color three <?php echo ($act_color == 2) ? "active" : ""; ?>" data-val="2"></a>
</div>
<?php } ?>
</div>
<input type="hidden" name="cta-txt-color" value="">
</div>
<div class="row ctsize">
<label><?php _e('Font Size:', 'click-to-tweet'); ?></label>
<select name="ctt-font">
<option value="original">Original</option>
<option value="small">Small</option>
<option value="large">Large</option>
</select>
</div>
<!-- <div class="row author-nm">
<label><?php _e('Author', 'click-to-tweet'); ?></label>
<input type="text" name="cta-author" value="Nick">
</div> -->
<div class="row">
<input type="submit" name="save" value="<?php _e('Save', 'click-to-tweet'); ?>">
</div>
<div class="row" id="resp_ajx">
</div>
</form>
</div>
</div>
<div class="dis-box"></div>
<div class="dis-image"></div>
<style type="text/css">
.ctt-color-group .color-variation{display: none;}
.ctt-color-group #colo-group-1.color-variation{display: block;}
.ctt-color-group #colo-group-1.color-variation a.col-color.one{ background: #e5e5e5;}
.ctt-color-group #colo-group-1.color-variation a.col-color.two{ background: #eff1e5;}
.ctt-color-group #colo-group-1.color-variation a.col-color.three{ background: #9cccec;}

.ctt-color-group #colo-group-2.color-variation a.col-color.one{ background: #ffffff;}
.ctt-color-group #colo-group-2.color-variation a.col-color.two{ background: #eff1e5;}
.ctt-color-group #colo-group-2.color-variation a.col-color.three{ background: #f7f7f7;}

.ctt-color-group #colo-group-3.color-variation a.col-color.one{ background: #f7f7f7;}
.ctt-color-group #colo-group-3.color-variation a.col-color.two{ background: #e9e0d6;}
.ctt-color-group #colo-group-3.color-variation a.col-color.three{ background: #efefef;}

.ctt-color-group #colo-group-4.color-variation a.col-color.one{ background: #aed4ee;}
.ctt-color-group #colo-group-4.color-variation a.col-color.two{ background: #fcc4af;}
.ctt-color-group #colo-group-4.color-variation a.col-color.three{ background: #fde7ac;}

.ctt-color-group #colo-group-5.color-variation a.col-color.one{ background: #4ac5e6;}
.ctt-color-group #colo-group-5.color-variation a.col-color.two{ background: #c3d7df;}
.ctt-color-group #colo-group-5.color-variation a.col-color.three{ background: #e2d893;}

.tab-img-prev .image-preview{display: none;}
.tab-img-prev .image-preview p{ text-align: left;}
.tab-img-prev #ctt-pre-img-1.image-preview{display: block;}
</style>