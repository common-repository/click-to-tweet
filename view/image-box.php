<?php
$plug_url = plugins_url()."/clicktotweetcom/";
$ic_data = get_option('ctt_image_setting');
?>
<div class="ctt-setting-container dis-hint">
    <div class="ctt-left set-output tab-img-prev">
            <h3>Preview:</h3>
            <div class="box_preview box-design">
	            <div id="ctt-itpl-con" class="click_clearfix aligncenter">
                    <div id="ctt-pre-img-1" class="image-preview" data-cta="<?php echo $ic_data['template_1']['callforaction']; ?>" data-btnsize="<?php echo $ic_data['template_1']['button_size']; ?>"
                    data-position="<?php echo $ic_data['template_1']['position']; ?>" data-onhover="<?php echo $ic_data['template_1']['hover_action']; ?>">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <figure class="click_image click_image_template_1">
                    <div class="ctt_img_container<?php echo " ctt_hover_".$this->get_ibox_data($ic_data, 1,'hover_action'); ?>"><img src="<?php echo $plug_url."images/sample-thumb.jpg"; ?>">
                    </div>
                    <div class="click_click_to_tweet twitter_standard <?php echo "position_".$this->get_ibox_data($ic_data, 1,'position'); ?>">
                    <a href="#" class="click_image_link <?php echo "btn_".$this->get_ibox_data($ic_data, 1,'button_size'); ?>"> <i></i>
                    <span class="click_action">
                        <?php echo $this->get_ibox_data($ic_data, 1,'callforaction'); ?>
                    </span></a>
                    </div>
                    </figure>
                    </div>

                    <div id="ctt-pre-img-2" class="image-preview" data-cta="<?php echo $ic_data['template_2']['callforaction']; ?>" data-btnsize="<?php echo $ic_data['template_2']['button_size']; ?>"
                    data-position="<?php echo $ic_data['template_2']['position']; ?>" data-onhover="<?php echo $ic_data['template_2']['hover_action']; ?>">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		            <figure class="click_image click_image_template_2">
						<div class="ctt_img_container <?php echo " ctt_hover_".$this->get_ibox_data($ic_data, 2,'hover_action'); ?>"><img src="<?php echo $plug_url."images/sample-thumb.jpg"; ?>">
						</div>
						<div class="click_click_to_tweet twitter_standard <?php echo "position_".$this->get_ibox_data($ic_data, 2,'position'); ?>">
							<a href="#" class="click_image_link <?php echo "btn_".$this->get_ibox_data($ic_data, 2,'button_size'); ?>"> <i></i>
                            <span class="click_action"><?php echo $this->get_ibox_data($ic_data, 2,'callforaction'); ?></span></a>
						</div>
					</figure>
                    </div>

                    <div id="ctt-pre-img-3" class="image-preview" data-cta="<?php echo $ic_data['template_3']['callforaction']; ?>" data-btnsize="<?php echo $ic_data['template_3']['button_size']; ?>"
                    data-position="<?php echo $ic_data['template_3']['position']; ?>" data-onhover="<?php echo $ic_data['template_3']['hover_action']; ?>">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		            <figure class="click_image click_image_template_3">
						<div class="ctt_img_container  <?php echo "ctt_hover_".$this->get_ibox_data($ic_data, 3,'hover_action'); ?>"><img src="<?php echo $plug_url."images/sample-thumb.jpg"; ?>">
						</div>
						<div class="click_click_to_tweet twitter_standard <?php echo "position_".$this->get_ibox_data($ic_data, 3,'position'); ?>">
							<a href="#" class="click_image_link <?php echo "btn_".$this->get_ibox_data($ic_data, 3,'button_size'); ?>">
                            <i></i><span class="click_action"><?php echo $this->get_ibox_data($ic_data, 3,'callforaction'); ?></span></a>
							<span class="ctt_action">Tweet</span>
						</div>
					</figure>
                    </div>

                    <div id="ctt-pre-img-4" class="image-preview" data-cta="<?php echo $ic_data['template_4']['callforaction']; ?>" data-btnsize="<?php echo $ic_data['template_4']['button_size']; ?>"
                    data-position="<?php echo $ic_data['template_4']['position']; ?>" data-onhover="<?php echo $ic_data['template_4']['hover_action']; ?>">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		            <figure class="click_image click_image_template_4">
						<div class="ctt_img_container <?php echo " ctt_hover_".$this->get_ibox_data($ic_data, 4,'hover_action'); ?>"><img src="<?php echo $plug_url."images/sample-thumb.jpg"; ?>">
						</div>
						<div class="click_click_to_tweet twitter_standard <?php echo "position_".$this->get_ibox_data($ic_data, 4,'position'); ?>">
							<a href="#" class="click_image_link <?php echo "btn_".$this->get_ibox_data($ic_data, 4,'button_size'); ?>"> <i></i><span class="click_action"><?php echo $this->get_ibox_data($ic_data, 4,'callforaction'); ?></span></a>
							<span class="ctt_action">Tweet</span>
						</div>
					</figure>
                    </div>

                    <div id="ctt-pre-img-5" class="image-preview" data-cta="<?php echo $ic_data['template_5']['callforaction']; ?>" data-btnsize="<?php echo $ic_data['template_5']['button_size']; ?>"
                    data-position="<?php echo $ic_data['template_5']['position']; ?>" data-onhover="<?php echo $ic_data['template_5']['hover_action']; ?>">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		            <figure class="click_image click_image_template_5">
						<div class="ctt_img_container <?php echo " ctt_hover_".$this->get_ibox_data($ic_data, 5,'hover_action'); ?>"><img src="<?php echo $plug_url."images/sample-thumb.jpg"; ?>">
						</div>
						<div class="click_click_to_tweet twitter_standard <?php echo "position_".$this->get_ibox_data($ic_data, 5,'position'); ?>">
							<a href="#" class="click_image_link <?php echo "btn_".$this->get_ibox_data($ic_data, 5,'button_size'); ?>"> <i></i><span class="click_action"><?php echo $this->get_ibox_data($ic_data, 5,'callforaction'); ?></span></a>
						</div>
					</figure>
                    </div>

                    <div id="ctt-pre-img-6" class="image-preview" data-cta="<?php echo $ic_data['template_6']['callforaction']; ?>" data-btnsize="<?php echo $ic_data['template_6']['button_size']; ?>"
                    data-position="<?php echo $ic_data['template_6']['position']; ?>" data-onhover="<?php echo $ic_data['template_6']['hover_action']; ?>">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
		            <figure class="click_image click_image_template_6">
						<div class="ctt_img_container <?php echo "ctt_hover_".$this->get_ibox_data($ic_data, 6,'hover_action'); ?>"><img src="<?php echo $plug_url."images/sample-thumb.jpg"; ?>">
						</div>
						<div class="click_click_to_tweet twitter_standard <?php echo "position_".$this->get_ibox_data($ic_data, 6,'position'); ?>">
							<a href="#" class="click_image_link <?php echo "btn_".$this->get_ibox_data($ic_data, 6,'button_size'); ?>">
                            <i></i><span class="click_action"><?php echo $this->get_ibox_data($ic_data, 6,'callforaction'); ?></span></a>
						</div>
					</figure>
                    </div>
	            </div>
            </div>
    </div>

    <div class="ctt-right form_settings set-settings">
            <div class="ctt-loader"></div>
            <h3>Settings:</h3>
            <form method="post" onsubmit="return save_image_box_setting(this);" data-ajxurl="<?php bloginfo('url'); ?>/wp-admin/admin-ajax.php">
            <div class="ctt_form_row">
                <label for="image_design">Design template:</label>
                    <div class="select">
                        <select name="ibox-tpl" id="ibox-tpl">
                            <option selected="" value="1">Template 1</option>
                            <option value="2">Template 2</option>
                            <option value="3">Template 3</option>
                            <option value="4">Template 4</option>
                            <option value="5">Template 5</option>
                            <option value="6">Template 6</option>
                        </select>
                    </div>
            </div>

            <div class="ctt_form_row">
            <label for="button_size">Button Size:</label>
            <div class="select">
            <select name="ibox-button">
                <option value="original" <?php echo ($this->get_ibox_data($ic_data, 1,'button_size') == "original") ? "selected" : ""; ?>>Original</option>
                <option value="large" <?php echo ($this->get_ibox_data($ic_data, 1,'button_size') == "large") ? "selected" : ""; ?>>Large</option>
            </select>
            </div>
            </div>

            <div class="ctt_form_row">
                <label for="position">Position:</label>
                <div class="select">
                    <select name="ibox-position">
                        <option value="center" <?php echo ($this->get_ibox_data($ic_data, 1,'position') == "center") ? "selected" : ""; ?>>Center</option>
                        <option value="bottom_right" <?php echo ($this->get_ibox_data($ic_data, 1,'position') == "bottom_right") ? "selected" : ""; ?>>Bottom right</option>
                        <option value="top_right" <?php echo ($this->get_ibox_data($ic_data, 1,'position') == "top_right") ? "selected" : ""; ?>>Top right</option>
                    </select>
                </div>
            </div>

            <div class="ctt_form_row">
                <label for="hover_action">Hover action:</label>
                    <div class="select">
                        <select name="ibox-hover">
                            <option value="no_hover_action" <?php echo ($this->get_ibox_data($ic_data, 1,'hover_action') == "no_hover_action") ? "selected" : ""; ?>>No hover action</option>
                            <option value="light" <?php echo ($this->get_ibox_data($ic_data, 1,'hover_action') == "light") ? "selected" : ""; ?>>Light</option>
                            <option value="dark" <?php echo ($this->get_ibox_data($ic_data, 1,'hover_action') == "dark") ? "selected" : ""; ?>>Dark</option>
                            <option value="pattern" <?php echo ($this->get_ibox_data($ic_data, 1,'hover_action') == "pattern") ? "selected" : ""; ?>>Pattern</option>
                            <option value="zoom" <?php echo ($this->get_ibox_data($ic_data, 1,'hover_action') == "zoom") ? "selected" : ""; ?>>Zoom</option>
                        </select>
                    </div>
            </div>
            <div class="ctt_form_row">
                <label for="action">Call to action:</label>
                <div class="input_wrap">
                    <input type="text" value="<?php echo ($this->get_ibox_data($ic_data, 1,'callforaction')) ? $this->get_ibox_data($ic_data, 1,'callforaction') : "Tweet"; ?>" id="action" name="ibox-cta"
                    placeholder="Enter Button Text">
                    <p class="input_comment">We recommend you to use short phrases</p>
                </div>

            </div>
            <div class="ctt_form_row">
                <button id="save_settings">Save All Changes</button>
                <p class="input_comment saved"></p>
            </div>
            </form>
            <div class="resp_ajx"></div>
    </div>
</div>