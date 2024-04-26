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
            console.log(motaphoto_js);
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
                        document.querySelector('#filtered-posts').insertAdjacentHTML('beforeend',  `
                        <div class="post">
                            <div class="post-content">
                                <img class="catalog" src="${post.image_src}" alt="${post.image_alt}" /><br />
                                <div class="overlay"></div>
                                <span class="icon-fullscreen">
                                    <i class="fa-solid fa-expand "></i>
                                </span>
                                <a href="${post.post_link}">
                                    <span class="icon-eye">
                                        <i class="fa-regular fa-eye fa-2xl"></i>
                                    </span>
                                </a>
                            </div>
                        </div>`);
                    });
                    offset += 8;
                } else {
                    console.log(data);
                    console.error('Invalid data format received from server.');
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
