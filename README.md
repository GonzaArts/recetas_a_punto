
# WP Recetas a Punto

WP Recetas a Punto es un plugin de WordPress para gestionar y mostrar recetas de cocina. Este plugin permite agregar, editar y visualizar recetas con detalles como el número de comensales, el tiempo de preparación, el tipo de comida, la dificultad, los ingredientes y los utensilios necesarios.

## Características

- Añadir y editar recetas desde el panel de administración.
- Mostrar recetas en el frontend utilizando un shortcode.
- Personalizar los detalles de cada receta, incluyendo comensales, tiempo, tipo de comida, dificultad, ingredientes y utensilios.
- Marcar los ingredientes y utensilios como completados en el frontend.

## Requisitos

- WordPress 5.6 o superior
- PHP 7.4 o superior

## Instalación

1. Descarga el plugin y súbelo a la carpeta `wp-content/plugins` de tu instalación de WordPress.
2. Activa el plugin desde el menú `Plugins` en WordPress.

## Uso

### Añadir una nueva receta

1. Ve al menú `Portfolio` en el panel de administración de WordPress.
2. Haz clic en `Añadir nuevo` para crear una nueva entrada de receta.
3. Rellena los campos de la receta, incluyendo comensales, tiempo, tipo de comida, dificultad, ingredientes y utensilios.
4. Publica la receta.

### Mostrar una receta en el frontend

Utiliza el shortcode `[receta id="POST_ID"]` para mostrar la receta en cualquier página o entrada de WordPress, reemplazando `POST_ID` con el ID de la entrada de receta.

### Archivos del plugin

- `wp-recetasapunto.php`: Archivo principal del plugin.
- `includes/shortcode.php`: Registra el shortcode y genera el contenido de la receta.
- `includes/i18n.php`: Maneja las traducciones del plugin.
- `admin/recipe-metabox.php`: Añade y guarda los metaboxes en el panel de administración.
- `admin/shortcode-metabox.php`: Añade un metabox para mostrar el shortcode en el panel de administración.
- `assets/css/admin-style.css`: Estilos para el panel de administración.
- `assets/css/frontend-style.css`: Estilos para el frontend.
- `assets/js/admin-script.js`: Scripts para el panel de administración.
- `assets/js/frontend-script.js`: Scripts para el frontend.

## Contribuciones

Las contribuciones son bienvenidas. Por favor, abre un issue o envía un pull request en GitHub.

## Licencia

Este plugin está licenciado bajo la [GPL-2.0-or-later](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html).
