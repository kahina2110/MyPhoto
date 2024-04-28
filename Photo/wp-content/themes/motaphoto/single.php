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
                            <button id="contact" href="#">Contact</button>
                        </div>
                    </div>

                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>

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
                    <div class="site__navigation">
                        <div class="site__navigation__prev">
                            <?php $prev_post = get_previous_post(); ?>
                            <?php if (!empty($prev_post)): ?>
                                <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                    <img class="" src="<?php echo get_stylesheet_directory_uri() . '/PhotosNMota/prev.png'; ?>"
                                        alt="Article Précédent">
                                </a>
                            <?php endif; ?>
                            <?php $next_post = get_next_post(); ?>
                            <?php if (!empty($next_post)): ?>
                                <a href="<?php echo get_permalink($next_post->ID); ?>">
                                    <img class="" src="<?php echo get_stylesheet_directory_uri() . '/PhotosNMota/next.png'; ?>"
                                        alt="Article Suivant">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="site__navigation__next">
                        </div>
                    </div>


                </div>


            </div>
        <?php endwhile; else: ?>
        <p>Aucun post trouvé.</p>
    <?php endif; ?>

</div>


<div class="more">
    <div class="border-top">
        <br>
    </div>
    <h4>VOUS AIMEREZ AUSSI</h4>
</div>
<div class="suggest">
    <?php
    $categories = get_the_terms(get_the_ID(), 'categorie');
    if ($categories) {
        $term_ids = array();
        foreach ($categories as $category) {
            $term_ids[] = $category->term_id;
        }
        $args = array(
            'post_type' => 'photos',
            'posts_per_page' => 2,
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'term_id',
                    'terms' => $term_ids,
                    'operator' => 'IN'
                )
            )
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) {
            echo '
                <ul class="ul-suggestions">';
            while ($query->have_posts()) {
                $query->the_post();
                $image = get_field('image');
                if ($image) {
                    $image_url = $image['url'];
                    $image_alt = $image['alt'];
                }

                echo '<li>
                    <a href="' . get_permalink() . '" >
                    <img class="suggestions" src="' . $image_url . '" alt="' . $image_alt . '">
                    </a>
                    </li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        } else {
            echo '<p>Aucun article similaire trouvé.</p>';
        }
    }
    ?>


</div>


<?php get_template_part('/page-modal') ?>
<script >
document.addEventListener("DOMContentLoaded", function() {
    // Votre code JavaScript ici
    var modal = document.getElementById('myModal');
    var btn = document.getElementById("contact");
    var span = document.getElementsByClassName("close")[0];

    function closeModalWithFade() {
        modal.style.opacity = "0";
        setTimeout(function() {
            modal.style.display = "none";
            modal.style.opacity = "1";
        }, 300);
    }

    btn.onclick = function() {
        modal.style.display = "block";
        var refPhoto = "<?php echo the_field('reference'); ?>";
        document.getElementById("ref-photo").setAttribute("value", refPhoto);
    }

    span.onclick = function() {
        closeModalWithFade();
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            closeModalWithFade();
        }
    }
});
</script>

<?php get_footer(); ?>