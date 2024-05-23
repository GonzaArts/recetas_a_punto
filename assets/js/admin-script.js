jQuery(document).ready(function($) {
    function updateHiddenFields() {
        var ingredients = [];
        $('#ingredient-list li').each(function() {
            ingredients.push($(this).text().replace(' x', '').trim());
        });
        $('#receta_ingredients').val(ingredients.join(', '));

        var tools = [];
        $('#tool-list li').each(function() {
            tools.push($(this).text().replace(' x', '').trim());
        });
        $('#receta_tools').val(tools.join(', '));
    }

    $('#add-ingredient').click(function() {
        var newIngredient = $('#new-ingredient').val().trim();
        if (newIngredient) {
            $('#ingredient-list').append('<li style="display: inline-block; padding: 5px 10px; margin: 5px; background-color: #f1f1f1; border: 1px solid #ccc; border-radius: 3px; position: relative;">' + newIngredient + ' <span class="remove-ingredient tag-remove" style="position: absolute; top: 50%; right: 5px; transform: translateY(-50%); color: red; cursor: pointer; margin-left: 10px;">x</span></li>');
            $('#new-ingredient').val('');
            updateHiddenFields();
        }
    });

    $('#ingredient-list').on('click', '.remove-ingredient', function() {
        $(this).parent().remove();
        updateHiddenFields();
    });

    $('#add-tool').click(function() {
        var newTool = $('#new-tool').val().trim();
        if (newTool) {
            $('#tool-list').append('<li style="display: inline-block; padding: 5px 10px; margin: 5px; background-color: #f1f1f1; border: 1px solid #ccc; border-radius: 3px; position: relative;">' + newTool + ' <span class="remove-tool tag-remove" style="position: absolute; top: 50%; right: 5px; transform: translateY(-50%); color: red; cursor: pointer; margin-left: 10px;">x</span></li>');
            $('#new-tool').val('');
            updateHiddenFields();
        }
    });

    $('#tool-list').on('click', '.remove-tool', function() {
        $(this).parent().remove();
        updateHiddenFields();
    });

    updateHiddenFields();
});
