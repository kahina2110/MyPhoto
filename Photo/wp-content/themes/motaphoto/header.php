<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Motaphoto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans+Mono:ital,wght@0,300..700;1,300..700&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <div class="navbar">
                <div class="logo">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/PhotosNMota/Logo.png' ?>" />
                </div>
                <input style="display: none;" id="menu-toggle" type="checkbox" />
                <label class='menu-button-container' for="menu-toggle"></label>
                <div class="menu">
                    <?php
                    wp_head();
                    wp_nav_menu(
                        array(
                            'theme_location' => 'header-menu',
                        )
                    );
                    ?>
                </div>
            </div>
        </nav>
        <div class="right quarter">
            <img class="toggle-nav" src="<?php echo get_stylesheet_directory_uri() . '/PhotosNMota/Icon Menu.png' ?>" />
        </div>
    </header>
</body>

</html>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/burger-menu.js"></script>


<?php get_template_part('page-modal') ?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/modal.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
  const images = document.querySelectorAll('.catalog');
  const fullScreenIcons = document.querySelectorAll('.icon-fullscreen');

  images.forEach((image, index) => {
      const fullScreenIcon = fullScreenIcons[index];
      
      fullScreenIcon.addEventListener('click', function(event) {
          event.stopPropagation(); 
          
          const imageSrc = image.getAttribute('src');
          const imageAlt = image.getAttribute('alt');

          document.getElementById('photo').src = imageSrc;
          document.getElementById('photo').alt = imageAlt;
          document.getElementById('caption').textContent = imageAlt;

          document.getElementById('overlay').style.display = 'block';
      });
  });

  document.getElementById('closeBtn').addEventListener('click', function() {
      document.getElementById('overlay').style.display = 'none';
  });
});
</script>