document.addEventListener('DOMContentLoaded', () => {
    const formatFilterForm = document.querySelector('#format-filter-form');
    const filteredPosts = document.querySelector('#filtered-posts');

    formatFilterForm.addEventListener('change', async (event) => {
        event.preventDefault();

        const formData = new FormData(formatFilterForm);
        formData.append('action', 'order_by_format');

        try {
            const response = await fetch(motaphoto_format_js.ajax_url, {
                method: 'POST',
                body: formData,
            });

            if (!response.ok) {
                throw new Error('Network response error.');
            }

            const data = await response.json();

            if (data && data.data && Array.isArray(data.data)) {
                console.log(data);
                filteredPosts.innerHTML = ''; 
                data.data.forEach(post => {
                    const postHTML = `
                        <div class="post">
                            <div class="post-content">
                                <img class="catalog" src="${post.image_src}" alt="${post.image_alt}" /><br />
                                <div class="overlay">
                                <p style="color: white; position: absolute; bottom: 0; left: 10px;">${post.title}</p>
                                <p style="color: white; position: absolute; bottom: 0; left: 470px;" >${post.format}</p>
                                </div>
                                <span class="icon-fullscreen">
                                    <i class="fa-solid fa-expand "></i>
                                </span>
                                <a href="${post.post_link}">
                                    <span class="icon-eye">
                                        <i class="fa-regular fa-eye fa-2xl"></i>
                                    </span>
                                </a>
                            </div>
                        </div>`;
                        
                    filteredPosts.insertAdjacentHTML('beforeend', postHTML);
                });

                attachEventHandlersToImages(document.querySelectorAll('.catalog'), document.querySelectorAll('.icon-fullscreen'));

            } else {
                console.error('Invalid data format received from server.');
                filteredPosts.innerHTML = '<p>Aucun article trouvé.</p>';
            }
        } catch (error) {
            console.error('There was a problem with the fetch operation: ', error);
            filteredPosts.innerHTML = '<p>Une erreur s\'est produite lors du chargement des articles.</p>';
        }
    });
});

function load_more_posts() {
    var offset = jQuery('.posts-container .post').length;
    var filters = {
        // Récupérez les valeurs des filtres ici, par exemple :
        category: jQuery('#category-filter').val(),
        // Ajoutez d'autres filtres si nécessaire
    };

    jQuery.ajax({
        url: ajaxurl,
        type: 'post',
        data: {
            action: 'load_more_posts',
            offset: offset,
            filters: filters // Envoyez les valeurs des filtres
        },
        success: function(response) {
            // Traitez la réponse ici
        }
    });
}


function attachEventHandlersToImages(images, fullScreenIcons) {
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
    const navButtons = document.querySelectorAll('.navBtn');

    navButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (this.id === 'prevBtn') {
                currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            } else if (this.id === 'nextBtn') {
                currentImageIndex = (currentImageIndex + 1) % images.length;
    }})})


    // Ajoutez le code HTML du lightbox ici
    const lightboxHTML = `
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
    `;
     // Ajoutez le lightbox HTML au corps du document
     document.body.insertAdjacentHTML('beforeend', lightboxHTML);
     document.getElementById('closeBtn').addEventListener('click', function() {
         document.getElementById('overlay').style.display = 'none';
     });
 
    };
   

