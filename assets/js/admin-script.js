jQuery(document).ready(function($) {
    console.log('Document ready');
    
    // Función para actualizar los campos ocultos
    function updateHiddenFields() {
        var ingredients = [];
        $('#ingredient-list li').each(function() {
            ingredients.push($(this).text().replace(' x', '').trim());
        });
        $('#receta_ingredients').val(JSON.stringify(ingredients));
        console.log('Ingredients after update:', ingredients);

        var tools = [];
        $('#tool-list li').each(function() {
            tools.push($(this).text().replace(' x', '').trim());
        });
        $('#receta_tools').val(JSON.stringify(tools));
        console.log('Tools after update:', tools);
    }

    // Función para vaciar y luego cargar elementos existentes evitando duplicados
    function loadExistingItems(listId, items) {
        console.log('Loading items for:', listId, 'with items:', items);
        $(listId).empty();  // Vacía la lista antes de agregar elementos

        items.forEach(function(item) {
            if (item.trim() !== '') {
                var existingItems = $(listId + ' li').map(function() {
                    return $(this).text().replace(' x', '').trim();
                }).get();

                if (!existingItems.includes(item)) {
                    console.log('Adding item:', item, 'to', listId);
                    $(listId).append('<li style="display: inline-block; padding: 5px 10px; margin: 5px; background-color: #f1f1f1; border: 1px solid #ccc; border-radius: 3px; position: relative;">' + item + ' <span class="remove-tag tag-remove" style="position: absolute; top: 50%; right: 5px; transform: translateY(-50%); color: red; cursor: pointer; margin-left: 10px;">x</span></li>');
                }
            }
        });
    }

    // Añadir nuevo ingrediente
    $('#add-ingredient').click(function() {
        var newIngredient = $('#new-ingredient').val().trim();
        console.log('Trying to add new ingredient:', newIngredient);
        if (newIngredient) {
            var existingIngredients = $('#ingredient-list li').map(function() {
                return $(this).text().replace(' x', '').trim();
            }).get();

            if (!existingIngredients.includes(newIngredient)) {
                console.log('Ingredient added:', newIngredient);
                $('#ingredient-list').append('<li style="display: inline-block; padding: 5px 10px; margin: 5px; background-color: #f1f1f1; border: 1px solid #ccc; border-radius: 3px; position: relative;">' + newIngredient + ' <span class="remove-ingredient tag-remove" style="position: absolute; top: 50%; right: 5px; transform: translateY(-50%); color: red; cursor: pointer; margin-left: 10px;">x</span></li>');
                $('#new-ingredient').val('');
                updateHiddenFields();
            } else {
                alert('El ingrediente ya está en la lista');
            }
        }
    });

    // Eliminar ingrediente de la lista
    $('#ingredient-list').on('click', '.remove-ingredient', function() {
        console.log('Removing ingredient:', $(this).parent().text().replace(' x', '').trim());
        $(this).parent().remove();
        updateHiddenFields();
    });

    // Añadir nuevo utensilio
    $('#add-tool').click(function() {
        var newTool = $('#new-tool').val().trim();
        console.log('Trying to add new tool:', newTool);
        if (newTool) {
            var existingTools = $('#tool-list li').map(function() {
                return $(this).text().replace(' x', '').trim();
            }).get();

            if (!existingTools.includes(newTool)) {
                console.log('Tool added:', newTool);
                $('#tool-list').append('<li style="display: inline-block; padding: 5px 10px; margin: 5px; background-color: #f1f1f1; border: 1px solid #ccc; border-radius: 3px; position: relative;">' + newTool + ' <span class="remove-tool tag-remove" style="position: absolute; top: 50%; right: 5px; transform: translateY(-50%); color: red; cursor: pointer; margin-left: 10px;">x</span></li>');
                $('#new-tool').val('');
                updateHiddenFields();
            } else {
                alert('El utensilio ya está en la lista');
            }
        }
    });

    // Eliminar utensilio de la lista
    $('#tool-list').on('click', '.remove-tool', function() {
        console.log('Removing tool:', $(this).parent().text().replace(' x', '').trim());
        $(this).parent().remove();
        updateHiddenFields();
    });

    // Al enviar el formulario, actualizar los campos ocultos
    $('#post').on('submit', function() {
        console.log('Submitting form...');
        updateHiddenFields();
    });

    // Cargar ingredientes y utensilios existentes desde los campos ocultos
    var existingIngredients = JSON.parse($('#receta_ingredients').val() || '[]');
    var existingTools = JSON.parse($('#receta_tools').val() || '[]');

    console.log('Existing ingredients on load:', existingIngredients);
    console.log('Existing tools on load:', existingTools);

    // Asegurarse de que los elementos se carguen sin duplicados
    loadExistingItems('#ingredient-list', existingIngredients);
    loadExistingItems('#tool-list', existingTools);

    // Actualizar los campos ocultos después de cargar los elementos
    updateHiddenFields();
});
