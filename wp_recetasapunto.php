<?php
/*
Plugin Name: WP Recetas a Punto
Description: Un plugin para gestionar y mostrar recetas.
Version: 1.0
Author: Your Name
Text Domain: wp_recetasapunto
Domain Path: /languages
*/

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Load translations
require_once plugin_dir_path(__FILE__) . 'includes/i18n.php';

// Register Shortcode
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';

// Admin Metabox
if (is_admin()) {
    require_once plugin_dir_path(__FILE__) . 'admin/recipe-metabox.php';
    require_once plugin_dir_path(__FILE__) . 'admin/shortcode-metabox.php';     
}

function wp_recetasapunto_enqueue_scripts() {
    wp_enqueue_style('wp-recetasapunto-admin-style', plugins_url('assets/css/admin-style.css', __FILE__));
    wp_enqueue_script('wp-recetasapunto-admin-script', plugins_url('assets/js/admin-script.js', __FILE__), array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'wp_recetasapunto_enqueue_scripts');

function wp_recetasapunto_enqueue_frontend_scripts() {
    wp_enqueue_script('wp-recetasapunto-frontend-script', plugins_url('assets/js/frontend-script.js', __FILE__), array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'wp_recetasapunto_enqueue_frontend_scripts');

function wp_recetasapunto_enqueue_frontend_styles() {
    wp_enqueue_style('wp-recetasapunto-frontend-style', plugins_url('assets/css/frontend-style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'wp_recetasapunto_enqueue_frontend_styles');

