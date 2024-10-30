<?php
/**
 * Plugin Name: Course Booking Platform
 * description: Plugin to integrate the Course Booking System (Course Finder) into Wordpress
 * Version: 1.0.0
 * Author: André Martin
 * Author URI: https://coursefinder.eu
 * Text Domain: course_booking_platform
 * Requires at least: 5.7.0
 * Tested up to: 6.5
 */

function course_booking_platform_register_admin_page() {
    add_menu_page( "Course Finder", "Course Finder", 'manage_options', 'course_booking_platform', 'course_booking_platform_admin_content', 'dashicons-welcome-widgets-menus', 26);
}

function course_booking_platform_admin_content()
{
?>
    <div class="wrap" style="height: 100vh;display: block;">
        <iframe scrolling="yes" id="bookingEngine" style="height:100%;width:100%" src="https://coursefinder.eu/?bdId=dyvymotlvw"></iframe>
    </div>
<?php
}

function course_booking_platform_wp_enqueue_scripts() {
    $ROOT = "https://coursefinder.eu";
    wp_enqueue_script( "course_widget_js_main", $ROOT."/widget/main.js?".rand(0,10000), array(), false, false);
    wp_enqueue_script( "course_widget_js_polyfills", $ROOT."/widget/polyfills.js?".rand(0,10000), array(), false, false);
    wp_enqueue_script( "course_widget_js_runtime", $ROOT."/widget/runtime.js?".rand(0,10000), array(), false, false);
    wp_enqueue_script( "course_widget_js_scripts", $ROOT."/widget/scripts.js?".rand(0,10000), array(), false, false);
}

function course_booking_platform_shortcode($atts) {
    $content = "";
    if (is_array($atts) && array_key_exists("id", $atts)) $content = "<widget id=\"".$atts["id"]."\"></widget>";
    if (is_array($atts) && array_key_exists("user", $atts)) $content = "<widget user=\"".$atts["user"]."\"></widget>";
    return $content;
}

add_action("admin_menu", "course_booking_platform_register_admin_page");
add_action("wp_enqueue_scripts", "course_booking_platform_wp_enqueue_scripts");
add_shortcode('course_widget', 'course_booking_platform_shortcode');

?>
