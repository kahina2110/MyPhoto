        <?php
        wp_footer();
        wp_nav_menu(array(
            'theme_location' => 'footer-menu', 
            'menu_class' => 'footer-menu', // classe CSS du menu
        ));
        ?>
        
    
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