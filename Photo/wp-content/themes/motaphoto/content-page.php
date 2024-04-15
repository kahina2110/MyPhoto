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

    <form method="get" class="filters">
        <select name="category" id="category-filter">
            <option value="">CATEGORIES</option>
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'categorie', 
                'hide_empty' => false,
            ));
            foreach ($categories as $category) {
                echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
            }
            ?>
        </select>
        <button type="submit">Filtrer</button>
    </form>

    <form method="get" class="filters">
        <select name="format" id="format-filter">
            <option value="">FORMATS</option>
            <?php
            $categories = get_terms(array(
                'taxonomy' => 'format', 
                'hide_empty' => false,
            ));
            foreach ($formats as $format) {
                echo '<option value="' . $$format->slug . '">' . $format->name . '</option>';
            }
            ?>
        </select>
        <button type="submit">Filtrer</button>
    </form>

    <!-- Affichage des articles filtrés -->
    <div class="row">
        <div class="post-home">
            <div id="filtered-posts">
                <?php
                $category = isset($_GET['category']) ? $_GET['category'] : '';
                $args = array(
                    'post_type' => 'photos', 
                    'posts_per_page' => -1, 
                );
                if (!empty($category)) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'categorie',
                            'field' => 'slug',
                            'terms' => $category,
                        ),
                    );
                }

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        ?>
                        <div class="post">
                            <?php  $image = get_field('image');
                    if ($image) {
                        $image_url = $image['url'];
                        $image_alt = $image['alt'];}
                           ?>
                            <div class="post-content">
                                <img class="catalog" src="<?= $image_url; ?>" alt="<?= $image_alt; ?>"/><br/>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo 'Aucun article trouvé.';
                endif;
                ?>
            </div>
            
        </div>
    </div>
    <button
	class="js-load-comments"
    data-postid="<?php echo get_the_ID(); ?>"
    data-nonce="<?php echo wp_create_nonce('capitaine_load_comments'); ?>"
    data-action="capitaine_load_comments"
    data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>"
>
</div>

<?php get_footer(); ?>
