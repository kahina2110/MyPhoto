<footer>
        <?php
        wp_footer();
        wp_nav_menu(array(
            'theme_location' => 'footer-menu', // identifiant du menu enregistré
            'menu_class' => 'footer-menu', // classe CSS pour le menu
        ));
        ?>
</footer>