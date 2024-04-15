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

    <!-- Balises select pour filtrer les articles -->
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
</div>

<?php get_footer(); ?>
