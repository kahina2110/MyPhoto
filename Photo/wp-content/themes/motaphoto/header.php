<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Motaphoto</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Spline+Sans+Mono:ital,wght@0,300..700;1,300..700&display=swap" rel="stylesheet">
    </head>
<body>
    <header>

		<div class="right quarter">	
            <img class="toggle-nav" src="<?php echo get_stylesheet_directory_uri() . '/PhotosNMota/Icon Menu.png'?>"/>
		</div>
        <nav>
            <div class="navbar">
                <div class="logo">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/PhotosNMota/Logo.png'?>"/>
                </div>
                <input style="display: none;" id="menu-toggle" type="checkbox" />
                <label  class='menu-button-container' for="menu-toggle"></label>
                <div class="menu">
                    <?php
    wp_head();
    wp_nav_menu(array(
        'theme_location' => 'header-menu', // identifiant du menu enregistré
    ));
    ?>
    </div>
</div>
</nav>
</header>
</body>
</html>
<script>
    jQuery(document).ready(function() {
    jQuery('.toggle-nav').click(function(e) {
        jQuery('.navbar ul').slideToggle(3000);
        e.preventDefault();
    });
    
});
</script> 