document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.catalog');
    const fullScreenIcons = document.querySelectorAll('.icon-fullscreen');
    const navButtons = document.querySelectorAll('.navBtn');

    let currentImageIndex = 0;

    images.forEach((image, index) => {
        const fullScreenIcon = fullScreenIcons[index];
        
        fullScreenIcon.addEventListener('click', function(event) {
            event.stopPropagation(); 
            
            const imageSrc = image.getAttribute('src');
            const imageAlt = image.getAttribute('alt');
            const imageRef = image.getAttribute('data-reference');
            const category = image.getAttribute('data-category');

            document.getElementById('photo').src = imageSrc;
            document.getElementById('photo').alt = imageAlt;
            document.getElementById('caption').textContent = imageAlt;
            document.getElementById('reference').textContent = imageRef;
            document.getElementById('category').textContent = category;

            currentImageIndex = index;

            document.getElementById('overlay').style.display = 'block';
        });
    });

    navButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.id === 'prevBtn') {
                currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            } else if (this.id === 'nextBtn') {
                currentImageIndex = (currentImageIndex + 1) % images.length;
            }

            const image = images[currentImageIndex];
            const imageSrc = image.getAttribute('src');
            const imageAlt = image.getAttribute('alt');
            const imageRef = image.getAttribute('data-reference');
            const category = image.getAttribute('data-category');

            document.getElementById('photo').src = imageSrc;
            document.getElementById('photo').alt = imageAlt;
            document.getElementById('caption').textContent = imageAlt;
            document.getElementById('reference').textContent = imageRef;
            document.getElementById('category').textContent = category;
        });
    });

    document.getElementById('closeBtn').addEventListener('click', function() {
        document.getElementById('overlay').style.display = 'none';
    });
});
