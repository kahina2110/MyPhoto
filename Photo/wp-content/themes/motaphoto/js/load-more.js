document.addEventListener('DOMContentLoaded', function() {
    let offset = 8; // Commencez avec un offset de 0
    let totalPosts = 0; 

    document.querySelector('#loadmore').addEventListener('click', function(event) {
        event.preventDefault(); 
        
        let formData = new FormData();
        formData.append('action', 'load_more_posts');
        formData.append('offset', offset); 

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
                if (data && data.success && data.data && Array.isArray(data.data)) {
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
                    });

                    offset += 8; 
                } else {
                    console.error('No more articles found');
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




