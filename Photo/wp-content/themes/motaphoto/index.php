<?php get_header(); 

?>
<div class="container"  style="height: 100vh; font-weight: 400;">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php 
            $image = get_field('image');        
            if ($image) {
                $image_url = $image['url'];
                $image_title = $image['title'];
                $image_alt = $image['alt'];
                
                echo '<img class="image-post" " src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" title="' . esc_attr($image_title) . '">';
            
            } else {
                echo 'Aucune image trouvée.';
            }?>
            
            <h1 style="font-style: italic;" ><?php echo get_field('title'); ?></h1>
            <p>RÉFERENCE : <?php echo get_field('reference'); ?></p>
            <p>TYPE : <?php echo get_field('type'); ?></p>




            <?php
            $categories = get_the_terms( get_the_ID(), 'categorie' );

// Vérifier si des termes existent
if ( $categories && ! is_wp_error( $categories ) ) {
    // Afficher les termes de la taxonomie
    echo '<ul>';
    foreach ( $categories as $category ) {
        echo '<li>' . esc_html( $category->name ) . '</li>';
    }
    echo '</ul>';
}?> <!-- Ajoutez d'autres champs ACF ici si nécessaire -->
        </div>
    <?php endwhile; else : ?>
        <p>Aucun post trouvé.</p>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
