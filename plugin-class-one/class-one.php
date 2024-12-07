<?php
/*
 * Plugin Name: Plugin Class One
 * Plugin URI: https://plugins.morshadunnur.me
 * Description: This is a plugin class one.
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
class Plugin_Class_One {
    private static $instance;
    private function __construct(){
        add_filter('the_content', array($this, 'plugin_class_one_content'));

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
        $url = get_the_permalink();
        $image = '<p><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $url . '" alt="Placeholder Image" /></p>';
        return $content .=  $image;
    }
}

Plugin_Class_One::get_instance();





