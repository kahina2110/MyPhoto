<?php get_header(); ?>

<div class="container">
    <h1>Single</h1>

    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Back to the homepage"><i class="fa fa-home"></i></a><span>/</span>Blog / Single

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2><?php the_title(); ?></h2>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    <?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>
