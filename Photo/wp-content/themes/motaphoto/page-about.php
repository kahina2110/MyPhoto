<?php
/*
Template Name: About
*/ 
?>

<?php get_header(); ?>

<div class="container">


    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">x</span>
            <div class="form-contact">
                <img src="<?php echo get_stylesheet_directory_uri() . '/PhotosNMota/Contact.png' ?>" alt="Contact" />
                <?php echo do_shortcode('[contact-form-7 id="4e9a26e" title="Contact"]'); ?>
            </div>
        </div>
    </div>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/modal.js"></script>

</div>

<footer>
    <?php get_footer(); ?>
</footer>
