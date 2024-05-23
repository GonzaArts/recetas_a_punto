<?php
function wp_recetasapunto_add_shortcode_meta_box() {
    add_meta_box(
        'wp_recetasapunto_shortcode',
        __('Shortcode de la Receta', 'wp_recetasapunto'),
        'wp_recetasapunto_shortcode_meta_box_callback',
        'avada_portfolio', // Asegúrate de que este sea el slug correcto para el tipo de post de Avada
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'wp_recetasapunto_add_shortcode_meta_box');

function wp_recetasapunto_shortcode_meta_box_callback($post) {
    echo '<p>' . __('Copia el shortcode y pégalo donde quieras mostrar esta receta:', 'wp_recetasapunto') . '</p>';
    echo '<input type="text" readonly="readonly" value="[receta id=&quot;' . esc_attr($post->ID) . '&quot;]" class="widefat" />';
}
