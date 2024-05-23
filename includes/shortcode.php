<?php
function wp_recetasapunto_shortcode($atts) {
    $atts = shortcode_atts(array('id' => ''), $atts, 'receta');
    $post_id = $atts['id'];

    if (!$post_id) {
        return __('Receta no especificada.', 'wp_recetasapunto');
    }

    $servings = get_post_meta($post_id, '_receta_servings', true);
    $time = get_post_meta($post_id, '_receta_time', true);
    $type = get_post_meta($post_id, '_receta_type', true);
    $difficulty = get_post_meta($post_id, '_receta_difficulty', true);
    $ingredients = get_post_meta($post_id, '_receta_ingredients', true);
    $tools = get_post_meta($post_id, '_receta_tools', true);

    ob_start();
    ?>
    <div class="receta">
        <div class="receta-header">
            <span class="receta-item"><i class="fas fa-users"></i> <?php echo esc_html($servings); ?> <?php _e('comensales', 'wp_recetasapunto'); ?></span>
            <span class="receta-item"><i class="fas fa-clock"></i> <?php echo esc_html($time); ?></span>
            <span class="receta-item"><i class="fas fa-utensils"></i> <?php echo esc_html($type); ?></span>
            <span class="receta-item"><i class="fas fa-signal"></i> <?php _e('Dificultad', 'wp_recetasapunto'); ?> <?php echo esc_html($difficulty); ?></span>
        </div>
        <div class="receta-section">
            <h3><?php _e('Ingredientes', 'wp_recetasapunto'); ?></h3>
            <ul class="receta-list">
                <?php 
                $ingredient_array = explode(",", $ingredients);
                foreach ($ingredient_array as $ingredient) {
                    echo '<li><input type="checkbox"> ' . esc_html($ingredient) . '</li>';
                }
                ?>
            </ul>
        </div>
        <div class="receta-section">
            <h3><?php _e('Utensilios', 'wp_recetasapunto'); ?></h3>
            <ul class="receta-list">
                <?php 
                $tool_array = explode(",", $tools);
                foreach ($tool_array as $tool) {
                    echo '<li><input type="checkbox"> ' . esc_html($tool) . '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('receta', 'wp_recetasapunto_shortcode');
