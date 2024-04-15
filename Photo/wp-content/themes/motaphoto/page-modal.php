<?php 
/*Template Name: Modal*/ 
?>
<?php get_header()?>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">x</span>
    <div class="form-contact">
                <img src="<?php echo get_stylesheet_directory_uri() . '/PhotosNMota/Contact.png' ?>" alt="Contact" />
                <?php echo do_shortcode('[contact-form-7 id="4e9a26e" title="Contact"]'); ?>
            </div>  </div>

</div>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/modal.js"></script>
