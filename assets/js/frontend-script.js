document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.receta-list input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                this.parentNode.classList.add('checked');
            } else {
                this.parentNode.classList.remove('checked');
            }
        });

        // Check if the item should be initially checked
        if (checkbox.checked) {
            checkbox.parentNode.classList.add('checked');
        }
    });
});
