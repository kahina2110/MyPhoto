<?php get_header(); ?>

<div class="container">
    <?php if (have_posts()):
        while (have_posts()):
            the_post(); ?>
            <div class="entry-content">

                <div class="photo-details">
                
                    <h1>
                        <?php the_field('title'); ?>
                    </h1>
                    <p>RÉFÉRENCE :
                        <?php the_field('reference'); ?>
                    </p>
                    <p>TYPE :
                        <?php the_field('type'); ?>
                    </p>
                    <?php
                    $categories = get_the_terms(get_the_ID(), 'categorie');
                    ;
                    if ($categories && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            echo '<p> CATEGORIE :' . ' ' . esc_html($category->name) . '</p>';
                            ;
                        }
                    }

                    ?>
                    <?php
                    $formats = get_the_terms(get_the_ID(), 'format');
                    if ($formats && !is_wp_error($formats)) {
                        foreach ($formats as $format) {
                            echo '<p>FORMAT :' . ' ' . esc_html($format->name) . '</p>';
                        }
                    }
                    ?>
                    <p>ANNEE :
                        <?php the_field('annee'); ?>
                    </p>
                    <div class="contact-div">
                        <p>Cette photo vous intéresse ?</p>
                        <div id="menu-item-157" class="contact-btn">
                            <button href="#">Contact</button>
                        </div>
                    </div>
                </div>

                <div class="image-part">

                    <?php the_content(); ?>

                    <?php
                    $image = get_field('image');
                    if ($image) {
                        $image_url = $image['url'];
                        $image_title = $image['title'];
                        $image_alt = $image['alt'];

                        echo '<img class="image-post" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" title="' . esc_attr($image_title) . '">';

                    } else {
                        echo 'Aucune image trouvée.';
                    }
                    ?>


                </div>

            </div>
        <?php endwhile; else: ?>
        <p>Aucun post trouvé.</p>
    <?php endif; ?>
</div>



<div class="more">
    <h4>VOUS AIMEREZ AUSSI</h4>
</div>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/modal.js"></script>
<?php get_template_part('/page-modal')?>
<?php get_footer(); ?>