jQuery(document).ready(function($) {
    // Empêcher le rechargement de la page lors du changement de filtre
    $('#category-filter, #format-filter, .filterby').on('change', function(e) {
        e.preventDefault(); // Empêcher le comportement par défaut du changement de filtre
        
        var category = $('#category-filter').val();
        var format = $('#format-filter').val();
        var sortBy = $('.filterby').val();

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_photos',
                category: category,
                format: format,
                sort: sortBy
            },
            success: function(response) {
                $('#filtered-posts').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Charger plus de photos sans recharger la page
    $('#load-more').on('click', function(e) {
        e.preventDefault(); // Empêcher le comportement par défaut du clic sur le bouton
        
        // Ajouter votre code pour charger plus de photos ici
    });
});
