document.addEventListener("DOMContentLoaded", function () {
    var icons = document.querySelectorAll(".icon-fullscreen i");
    var lightbox = null;
  
    icons.forEach(function (icon) {
      icon.addEventListener("click", function () {
        var imageContainer = icon.closest(".post-content");
        var images = imageContainer.querySelectorAll(".catalog");
        var currentIndex = 0;
  
        images.forEach(function (image, index) {
          if (image.src === icon.src) {
            currentIndex = index;
          }
        });
  
        if (!lightbox) {
          lightboxHTML = `
                    <div class="lightbox">
                        <button class="lightbox__close">×</button>
                        <button class="lightbox__prev">‹</button>
                        <button class="lightbox__next">›</button>
                        <div class="lightbox__container">
                            <img class="lightbox__image" src="${images[currentIndex].src}" alt="${images[currentIndex].alt}" />
                        </div>
                    </div>
                `;
  
          imageContainer.insertAdjacentHTML("beforeend", lightboxHTML);
          lightbox = document.querySelector(".lightbox");
        }
  
        var closeButton = lightbox.querySelector(".lightbox__close");
        var prevButton = lightbox.querySelector(".lightbox__prev");
        var nextButton = lightbox.querySelector(".lightbox__next");
        var lightboxImage = lightbox.querySelector(".lightbox__image");
  
        closeButton.addEventListener("click", function () {
          lightbox.remove();
          lightbox = null;
        });
  
        prevButton.addEventListener("click", function () {
          currentIndex = (currentIndex - 1 + images.length) % images.length;
          updateImage(images[currentIndex]);
        });
  
        nextButton.addEventListener("click", function () {
          currentIndex = (currentIndex + 1) % images.length;
          updateImage(images[currentIndex]);
        });
  
        function updateImage(newImage) {
          var newImageUrl = newImage.src;
          var newImageAlt = newImage.alt;
          lightboxImage.src = newImageUrl;
          lightboxImage.alt = newImageAlt;
        }
  
        // Set the initial image
        updateImage(images[currentIndex]);
      });
    });
  });