<?php
function wp_recetasapunto_add_meta_box() {
    add_meta_box(
        'wp_recetasapunto',
        __('Detalles de la Receta', 'wp_recetasapunto'),
        'wp_recetasapunto_meta_box_callback',
        'avada_portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'wp_recetasapunto_add_meta_box');

function wp_recetasapunto_meta_box_callback($post) {
    $servings = get_post_meta($post->ID, '_receta_servings', true);
    $time = get_post_meta($post->ID, '_receta_time', true);
    $type = get_post_meta($post->ID, '_receta_type', true);
    $difficulty = get_post_meta($post->ID, '_receta_difficulty', true);
    $ingredients = get_post_meta($post->ID, '_receta_ingredients', true) ?: [];
    $tools = get_post_meta($post->ID, '_receta_tools', true) ?: [];

    // Ensure we have arrays
    if (!is_array($ingredients)) {
        $ingredients = [];
    }
    if (!is_array($tools)) {
        $tools = [];
    }

    wp_nonce_field('wp_recetasapunto_save_meta_box_data', 'wp_recetasapunto_meta_box_nonce');

    echo '<div class="receta-meta-box">';

    echo '<div class="field-group" style="display: flex; align-items: center; margin-bottom: 15px;">';
    echo '<label for="receta_servings" style="flex: 1; margin-bottom: 0;">' . __('Comensales', 'wp_recetasapunto') . '</label>';
    echo '<input type="number" id="receta_servings" name="receta_servings" value="' . esc_attr($servings) . '" style="flex: 2; padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 20%;" />';
    echo '</div>';

    echo '<div class="field-group" style="display: flex; align-items: center; margin-bottom: 15px;">';
    echo '<label for="receta_time" style="flex: 1; margin-bottom: 0;">' . __('Tiempo', 'wp_recetasapunto') . '</label>';
    echo '<input type="text" id="receta_time" name="receta_time" value="' . esc_attr($time) . '" style="flex: 2; padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 20%;" />';
    echo '</div>';

    echo '<div class="field-group" style="display: flex; align-items: center; margin-bottom: 15px;">';
    echo '<label for="receta_type" style="flex: 1; margin-bottom: 0;">' . __('Tipo de Comida', 'wp_recetasapunto') . '</label>';
    echo '<select id="receta_type" name="receta_type" style="flex: 2; padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 20%;">';
    $meal_types = array('Desayuno', 'Almuerzo', 'Cena', 'Merienda', 'Brunch', 'Snack');
    foreach ($meal_types as $meal_type) {
        echo '<option value="' . esc_attr($meal_type) . '"' . selected($type, $meal_type, false) . '>' . esc_html($meal_type) . '</option>';
    }
    echo '</select>';
    echo '</div>';

    echo '<div class="field-group" style="display: flex; align-items: center; margin-bottom: 15px;">';
    echo '<label for="receta_difficulty" style="flex: 1; margin-bottom: 0;">' . __('Dificultad', 'wp_recetasapunto') . '</label>';
    echo '<select id="receta_difficulty" name="receta_difficulty" style="flex: 2; padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 20%;">';
    echo '<option value="baja"' . selected($difficulty, 'baja', false) . '>' . __('Baja', 'wp_recetasapunto') . '</option>';
    echo '<option value="media"' . selected($difficulty, 'media', false) . '>' . __('Media', 'wp_recetasapunto') . '</option>';
    echo '<option value="alta"' . selected($difficulty, 'alta', false) . '>' . __('Alta', 'wp_recetasapunto') . '</option>';
    echo '</select>';
    echo '</div>';

    echo '<label for="receta_ingredients">' . __('Ingredientes', 'wp_recetasapunto') . '</label>';
    echo '<div class="input-group" style="display: flex; align-items: center; margin-bottom: 15px;">';
    echo '<input type="text" id="new-ingredient" style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-right: 10px;" placeholder="' . __('Añadir nuevo ingrediente', 'wp_recetasapunto') . '" />';
    echo '<button type="button" id="add-ingredient" class="button button-primary" style="padding: 10px 15px; background-color: #0073aa; color: #fff; border: none; border-radius: 3px; cursor: pointer; font-size: 14px;">' . __('Añadir', 'wp_recetasapunto') . '</button>';
    echo '</div>';
    echo '<ul id="ingredient-list" class="tag-list">';
    foreach ($ingredients as $ingredient) {
        echo '<li style="display: inline-block; padding: 5px 10px; margin: 5px; background-color: #f1f1f1; border: 1px solid #ccc; border-radius: 3px; position: relative;">' . esc_html($ingredient) . ' <span class="remove-ingredient tag-remove" style="position: absolute; top: 50%; right: 5px; transform: translateY(-50%); color: red; cursor: pointer; margin-left: 10px;">x</span></li>';
    }
    echo '</ul>';
    echo '<input type="hidden" id="receta_ingredients" name="receta_ingredients" value="' . esc_attr(json_encode($ingredients)) . '" />';

    echo '<label for="receta_tools">' . __('Utensilios', 'wp_recetasapunto') . '</label>';
    echo '<div class="input-group" style="display: flex; align-items: center; margin-bottom: 15px;">';
    echo '<input type="text" id="new-tool" style="flex: 1; padding: 10px; border: 1px solid #ccc; border-radius: 5px; margin-right: 10px;" placeholder="' . __('Añadir nuevo utensilio', 'wp_recetasapunto') . '" />';
    echo '<button type="button" id="add-tool" class="button button-primary" style="padding: 10px 15px; background-color: #0073aa; color: #fff; border: none; border-radius: 3px; cursor: pointer; font-size: 14px;">' . __('Añadir', 'wp_recetasapunto') . '</button>';
    echo '</div>';
    echo '<ul id="tool-list" class="tag-list">';
    foreach ($tools as $tool) {
        echo '<li style="display: inline-block; padding: 5px 10px; margin: 5px; background-color: #f1f1f1; border: 1px solid #ccc; border-radius: 3px; position: relative;">' . esc_html($tool) . ' <span class="remove-tool tag-remove" style="position: absolute; top: 50%; right: 5px; transform: translateY(-50%); color: red; cursor: pointer; margin-left: 10px;">x</span></li>';
    }
    echo '</ul>';
    echo '<input type="hidden" id="receta_tools" name="receta_tools" value="' . esc_attr(json_encode($tools)) . '" />';

    echo '</div>';
}

function wp_recetasapunto_save_meta_box_data($post_id) {
    // Verificación del nonce para seguridad
    if (!isset($_POST['wp_recetasapunto_meta_box_nonce']) || !wp_verify_nonce($_POST['wp_recetasapunto_meta_box_nonce'], 'wp_recetasapunto_save_meta_box_data')) {
        return;
    }

    // Salir si es un autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Verificación de permisos del usuario
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Lista de campos a guardar
    $fields = array('receta_servings', 'receta_time', 'receta_type', 'receta_difficulty');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $sanitized_value = sanitize_text_field($_POST[$field]);
            update_post_meta($post_id, '_' . $field, $sanitized_value);
        }
    }

    // Guardado de ingredientes
    if (isset($_POST['receta_ingredients'])) {
        $ingredients = json_decode(stripslashes($_POST['receta_ingredients']), true);
        if (is_array($ingredients)) {
            $ingredients = array_map('sanitize_text_field', $ingredients);
            update_post_meta($post_id, '_receta_ingredients', array_unique($ingredients));
        }
    } else {
        delete_post_meta($post_id, '_receta_ingredients');
    }

    // Guardado de utensilios
    if (isset($_POST['receta_tools'])) {
        $tools = json_decode(stripslashes($_POST['receta_tools']), true);
        if (is_array($tools)) {
            $tools = array_map('sanitize_text_field', $tools);
            update_post_meta($post_id, '_receta_tools', array_unique($tools));
        }
    } else {
        delete_post_meta($post_id, '_receta_tools');
    }
}

add_action('save_post', 'wp_recetasapunto_save_meta_box_data');