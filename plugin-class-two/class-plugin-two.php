<?php
/*
 * Plugin Name: Plugin Class Two
 * Plugin URI: https://plugins.morshadunnur.me
 * Description: This is a plugin class Two by Wedevs Academy.
 * Version: 1.0.0
 * Author: Md Morshadun Nur
 * Author URI: https://morshadunnur.me
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: plugin-class-one
 * Domain Path: /languages
 * Requires at least: 5.2
 * Requires PHP: 7.2
 *
 */

// following singleton pattern
class Plugin_Class_Two {
    private static $instance;
    private function __construct(){
        add_filter('the_content', array($this, 'plugin_class_one_content'));
        add_action('wp_footer', array($this, 'wp_footer'));
        add_filter('body_class', array($this, 'body_class'), 10, 2);

    }

    public static function get_instance()
    {
        if (self::$instance) {
            return self::$instance;
        }

        self::$instance = new self();
        return self::$instance;

    }

    public function plugin_class_one_content($content) {

        $is_show = apply_filters('academy_post_content_qr_code', true);
        if (!$is_show) {
            return $content;
        }
        $url = get_the_permalink();
        $custom_classes = implode(' ' , apply_filters('qr_code_classes',array()));

        $image = '<p><img class="' . $custom_classes .'" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $url . '" alt="Placeholder Image" /></p>';
        return $content .=  $image;
    }

    public function wp_footer()
    {

        do_action('before_footer_qr_code');

        $url = home_url();
        $image = '<p><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $url . '" alt="Placeholder Image" /></p>';
        echo $image;

    }

    public function body_class($classes, $css_class)
    {
        $classes[] = 'my-custom-class';
        return $classes;
    }
}

Plugin_Class_Two::get_instance();





