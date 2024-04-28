document.addEventListener('DOMContentLoaded', function() {
  const images = document.querySelectorAll('.catalog');
  const fullScreenIcons = document.querySelectorAll('.icon-fullscreen');

  images.forEach((image, index) => {
      const fullScreenIcon = fullScreenIcons[index];
      
      fullScreenIcon.addEventListener('click', function(event) {
          event.stopPropagation(); // Pour éviter que le clic ne se propage vers l'image
          
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