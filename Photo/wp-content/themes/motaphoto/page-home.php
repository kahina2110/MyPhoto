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

    <div class="row">

        <div class="post-home">
            <div class="filters">
                <div class="form-filter">


                    <form id="category-filter-form" method="post" action="?">
                        <select name="category" id="category-filter">
                            <option value="toutes les catégories" <?php echo isset($_GET['category']) && $_GET['category'] === 'toutes les catégories' ? 'selected' : ''; ?>>CATÉGORIES</option>
                            <?php
                            $categories = get_terms(
                                array(
                                    'taxonomy' => 'categorie',
                                    'hide_empty' => false,
                                )
                            );
                            foreach ($categories as $category) {
                                echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                            }
                            ?>
                        </select>
                    </form>



                    <form method="post" id="format-filter-form" class="filters" action="?">
                        <select name="format" id="format-filter">
                            <option value="tous les formats" <?php echo isset($_GET['format']) && $_GET['format'] === 'tous les formats' ? 'selected' : ''; ?>>FORMATS</option>
                            <?php
                            $formats = get_terms(
                                array(
                                    'taxonomy' => 'format',
                                    'hide_empty' => false,
                                )
                            );
                            foreach ($formats as $format) {
                                echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
                            }
                            ?>
                        </select>
                    </form>
                </div>


                <form method="POST" action="#" id="date-filter-form">
                    <select class="filterby" name="date">
                        <option value="" selected>TRIER PAR</option>
                        <option value="DESC">PLUS RÉCENTES</option>
                        <option value="ASC">PLUS ANCIENNES</option>
                    </select>
                </form>
            </div>

            <div id="filtered-posts">
                <?php
                $category = isset($_POST['category']) ? $_POST['category'] : '';
                $format = isset($_POST['format']) ? $_POST['format'] : '';

                $args = array(
                    'post_type' => 'photos',
                    'posts_per_page' => 8,
                );

                if (!empty($category)) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'categorie',
                            'field' => 'slug',
                            'terms' => $category,
                        )
                    );
                }

                if (!empty($format)) {
                    $args['tax_query'] = array(
                        array(
                            'taxonomy' => 'format',
                            'field' => 'slug',
                            'terms' => $format,
                        )
                    );
                }

                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $ref = get_field('reference');
                        $image = get_field('image');
                        if ($image) {
                            $image_url = $image['url'];
                        }
                        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                        $category_name = '';
                        $categories = get_the_terms(get_the_ID(), 'categorie');
                        if ($categories && !is_wp_error($categories)) {
                            $category_name = $categories[0]->name;
                        }
                        ?>
                        <div class="post">
                            <div class="post-content">
                                <img id="image<?= get_the_ID(); ?>" class="catalog" src="<?= $image_url; ?>"
                                    alt="<?= $image_alt; ?>" data-reference="<?= $ref; ?>"
                                    data-category="<?= $category_name; ?>" />
                                <div class="overlay">
                                <p style="color: white; position: absolute; bottom: 0; left: 10px;"><?php echo get_field('title') ;?></p>
                                    <p style="color: white; position: absolute; bottom: 0; left: 470px;" ><?= $category_name ?></p>
                                </div>
                                <span class="icon-fullscreen">
                                    <i class="fa-solid fa-expand "></i>
                                </span>

                                <a href="<?php the_permalink(); ?>">
                                    <span class="icon-eye">
                                        <i class="fa-regular fa-eye fa-2xl"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    wp_reset_postdata();
                }
                ?>

                <!-- Add the lightbox HTML code below -->
                <div id="overlay" style="display: none;">
                    <div id="lightbox">
                        <img id="photo" src="" alt="">
                        <p id="caption"></p>
                        <div class="infos">
                            <p id="reference"></p>
                            <p id="category"></p>
                        </div>
                        <button id="prevBtn" class="navBtn"><img src="<?= get_stylesheet_directory_uri() . '/PhotosNMota/precedent.png'?>"></button>
                        <button id="nextBtn" class="navBtn"><img src="<?= get_stylesheet_directory_uri() . '/PhotosNMota/suivant.png'?>"></button>
                        <button id="closeBtn">X</button>
                    </div>
                </div>



            </div>
        </div>
    </div>
    <form action="?" method="POST" id="filterForm" class="load-more">
        <button id="loadmore" type="button">Charger plus</button>
    </form>


</div>

<div>
  
</div>



<script src="<?php echo get_template_directory_uri(); ?>/js/lightbox.js">
</script>
<footer>
    <?php get_footer(); ?>
</footer>



