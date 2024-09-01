<?php
/*
Plugin Name: WP Recetas a Punto
Description: Un plugin para gestionar y mostrar recetas para Avada Themes.
Version: 1.0.1
Requires at least: 5.2 
Requires PHP: 7.4 o superior
Author: GonzaArts
Author URI: https://github.com/GonzaArts/recetas_a_punto
License URI: https://github.com/GonzaArts/recetas_a_punto?tab=GPL-2.0-1-ov-file
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

// Enqueue admin styles and scripts
function wp_recetasapunto_enqueue_admin_scripts($hook_suffix) {
    wp_enqueue_style('wp-recetasapunto-admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css');
    wp_enqueue_script('wp-recetasapunto-admin-script', plugin_dir_url(__FILE__) . 'assets/js/admin-script.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'wp_recetasapunto_enqueue_admin_scripts');

// Enqueue frontend styles and scripts
function wp_recetasapunto_enqueue_frontend_assets() {
    wp_enqueue_style('wp_recetasapunto-frontend-style', plugin_dir_url(__FILE__) . 'assets/css/frontend-style.css', array(), '1.0.0', 'all');
    wp_enqueue_script('wp_recetasapunto-frontend-script', plugin_dir_url(__FILE__) . 'assets/js/frontend-script.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'wp_recetasapunto_enqueue_frontend_assets');

// Clear cache on content update
function clear_cache_on_update() {
    if (function_exists('wp_cache_clear_cache')) {
        wp_cache_clear_cache();
    }
}
add_action('save_post', 'clear_cache_on_update');

// Prevent shortcode from rendering multiple times
add_shortcode('receta', 'wp_recetasapunto_shortcode');

