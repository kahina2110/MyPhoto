jQuery(document).ready(function() {
    jQuery('.toggle-nav').click(function(e) {
        jQuery('.navbar ul').slideToggle(500);
 
        e.preventDefault();
    });
    
});