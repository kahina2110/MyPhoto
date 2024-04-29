jQuery(document).ready(function() {
    jQuery('.toggle-nav').click(function(e) {
        jQuery('.navbar ul').toggle(); // Utilisez .toggle() pour afficher ou masquer sans animation
        e.preventDefault();
    });
});
