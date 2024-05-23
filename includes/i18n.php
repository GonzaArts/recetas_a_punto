<?php
function wp_recetasapunto_load_textdomain() {
    load_plugin_textdomain('wp_recetasapunto', false, dirname(plugin_basename(__FILE__)) . '/../languages');
}
add_action('plugins_loaded', 'wp_recetasapunto_load_textdomain');
