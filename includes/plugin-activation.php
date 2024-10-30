<?php
/* RUN during plugin activation */
class ctt_activation {
        public static function activate() {
                self::check_options();
        }
        private static function check_options() {
                if (!get_option('ctt_box_setting')) {
                    $box_styles = self::set_box_styles();
                    add_option('ctt_box_setting', $box_styles);
                }
                if (!get_option('ctt_image_setting')) {
                    $image_styles = self::set_image_styles();
                    add_option('ctt_image_setting', $image_styles);
                }
                if (!get_option('ctt_hint_box')) {
                    add_option('ctt_hint_box', array('style' => 'background','color' => 1));
                }
        }

        private static function set_box_styles() {
                $styles = array();
                $default_callforaction = 'Click To Tweet';
                $color_settings = array (
                        array('#e5e5e5', '#eff1e5', '#9cccec'),
                        array('#ffffff', '#eff1e5', '#f7f7f7'),
                        array('#f7f7f7', '#e9e0d6', '#efefef'),
                        array('#aed4ee', '#fcc4af', '#fde7ac'),
                        array('#4ac5e6', '#c3d7df', '#e2d893')
                );
                for ($i = 1; $i < 16; $i++) {
                    $ref_key = ($i < 13)? 'box_' : 'atr_';
                    $key = $ref_key.$i;
                    $colors = array();
                    if ($i < 6) {
                        $colors = $color_settings[$i-1];
                    }
                    $value = self::get_box_settings_array($default_callforaction, $colors, 0);
                    $styles[$key] = $value;
                }
                return $styles;
        }

        private static function get_box_settings_array( $callforaction, $colors, $color_number ) {
                return array(
                    'callforaction' => $callforaction,
                    'font_size' => 'original',
                    'colors' => $colors,
                    'color_number' => $color_number
                );
        }

        private static function set_image_styles() {
                $styles = array();
                $default_callforaction = 'Tweet';
                for ($i = 1; $i < 7; $i++) {
                        $key = 'template_' . $i;
                        if ($i !== 1) {
                            $position = 'left';
                        }
                        else {
                            $position = 'center';
                        }
                        $value = self::get_image_settings_array($default_callforaction, $position);
                        $styles[$key] = $value;
                }

                return $styles;
        }

        private static function get_image_settings_array( $callforaction, $position) {
                return array(
                    'hover_action' => 'original',
                    'position' => $position,
                    'button_size' => 'original',
                    'callforaction' => $callforaction
                );

        }
}