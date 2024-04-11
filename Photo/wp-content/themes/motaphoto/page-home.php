<?php
/*
Template Name: Accueil
*/
?>
<?php get_header(); ?>

<div class="container">
<div>
    <img class="img-header" src="<?php echo get_stylesheet_directory_uri() . '/PhotosNMota/Header.png' ?>" alt="" />
</div>

<!-- Page Title -->
</br>
<div class="filters">

    <select >
        <option value="" selected>CATEGORIES</option>
        <option value="">MARIAGE</option>
        <option value="">CONCERT</option>
        <option value="">RECEPTION</option>
        <option value="">MARIAGE</option>
    

        <?php 
        $categories = get_the_terms(get_the_ID(), 'categorie');
        
        if ($categories && !is_wp_error($categories)) {
    
            foreach ($categories as $category) {
                var_dump($category->name);
                echo '<option value="'.$category->slug.'" >' .$category->name. '</option>';
            }
        }
        
        ?>
    </select>
    <select >
        <option value="" selected>FORMATS</option>
        <option value="">PAYSAGE</option>
        <option value="">PORTRAIT</option>
    
    

        <?php 
        $categories = get_the_terms(get_the_ID(), 'categorie');
        
        if ($categories && !is_wp_error($categories)) {
    
            foreach ($categories as $category) {
                var_dump($category->name);
                echo '<option value="'.$category->slug.'" >' .$category->name. '</option>';
            }
        }
        
        ?>
    </select>
    <select >
        <option value="" selected>TRIER PAR</option>
        <option value="">PAYSAGE</option>
        <option value="">PORTRAIT</option>
    
    

        <?php 
        $categories = get_the_terms(get_the_ID(), 'categorie');
        
        if ($categories && !is_wp_error($categories)) {
    
            foreach ($categories as $category) {
                var_dump($category->name);
                echo '<option value="'.$category->slug.'" >' .$category->name. '</option>';
            }
        }
        
        ?>
    </select>
</div>



    <div class="row">
        <div class="post-home">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // Récupérer le numéro de la page
            $args = array(
                'post_type' => 'photos', // Le type de post personnalisé
                'posts_per_page' => 6, // Nombre de posts par page
                'paged' => $paged // Numéro de la page actuelle
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                    <div class="photo">
                        <?php
                        $image = get_field('image');
                        if ($image) {
                            echo '<img class="home-image" src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
                        }
                        ?>

                    </div>
            <?php
                endwhile; // Fin de la boucle
                wp_reset_postdata();

                // Ajouter la pagination
                echo '<div class="pagination">';
                echo paginate_links(array(
                    'total' => $query->max_num_pages // Nombre total de pages
                ));
                echo '</div>';
            else :
                // Aucun post trouvé
                echo '<p>Aucune photo trouvée.</p>';
            endif;
            ?>

        </div>
    </div>
</div>

<footer>
    <?php get_footer(); ?>
</footer>
