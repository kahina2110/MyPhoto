<?php
get_header();
?>
<div id="primary" style="height: 100vh;" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
     
     wp_get_archives();
        ?>
    </main><!-- #main -->
</div><!-- #primary -->
<footer>
<?php 
get_footer();
?>
</footer>
<?php
