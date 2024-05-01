document.addEventListener('DOMContentLoaded', function() {
    let offset = 8; 
    let totalPosts = 0; 

    document.querySelector('#loadmore').addEventListener('click', function(event) {
        event.preventDefault(); 

        const categoryFilter = document.querySelector('#category-filter').value;
        
        let formData = new FormData();
        formData.append('action', 'load_more_posts');
        formData.append('offset', offset); 
        formData.append('category', categoryFilter); 

        try {
            fetch(motaphoto_js.ajax_url, {
                method: 'POST',
                body: formData,
            })
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Network response error.');
                }
                return response.json();
            })
            .then(function(data) {
                if (data && data.data && Array.isArray(data.data)) {
                    totalPosts = data.total_posts; 
                    data.data.forEach(function(post) {
                        const postHTML = `
                        <div class="post">
                            <div class="post-content">
                                <img class="catalog" src="${post.image_src}" alt="${post.image_alt}" /><br />
                                <div class="overlay">
                                <p style="color: white; position: absolute; bottom: 0; left: 10px;">${post.title}</p>
                                <p style="color: white; position: absolute; bottom: 0; left: 470px;" >${post.category}</p>
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
                        document.querySelector('#filtered-posts').insertAdjacentHTML('beforeend', postHTML);
                        attachEventHandlersToImages(document.querySelectorAll('.catalog'), document.querySelectorAll('.icon-fullscreen'));
                    });

                    offset += 8;
                } else {
                    console.error('PLUS D ARTICLES');
                }
            })
            .catch(function(error) {
                console.error('There was a problem with the fetch operation: ', error);
            });
        } catch (error) {
            console.error('An error occurred: ', error);
        }
    });
});
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
                <button id="prevBtn" class="navBtn">&lt;</button>
                <button id="nextBtn" class="navBtn">&gt;</button>
                <button id="closeBtn">Close</button>
            </div>
        </div>
    `;
     // Ajoutez le lightbox HTML au corps du document
     document.body.insertAdjacentHTML('beforeend', lightboxHTML);
     document.getElementById('closeBtn').addEventListener('click', function() {
         document.getElementById('overlay').style.display = 'none';
     });
 
    };