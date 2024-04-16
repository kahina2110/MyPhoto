document.addEventListener('DOMContentLoaded', function() {
    let offset = 8; 

    document.querySelector('#category-filter').addEventListener('change', function(event) {
        event.preventDefault(); 
        
        let formData = new FormData();
        formData.append('action', 'order_by_category');
        formData.append('offset', offset); 
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
                data.data.forEach(function(post) {
                    document.querySelector('#filtered-posts').insertAdjacentHTML('beforeend', '<div class="post"><div class="post-content"><a href="' + post.post_link + '"><img class="catalog" src="' + post.image_src + '" alt="' + post.image_alt + '" /><br /><span class="icon-eye"><i class="fa-light fa-eye "></i></span></a></div></div>');
                });
            } else {
                console.error('Invalid data format received from server.');
            }
        })
        .catch(function(error) {
            console.error('There was a problem with the fetch operation: ', error);
        });
    });
});
