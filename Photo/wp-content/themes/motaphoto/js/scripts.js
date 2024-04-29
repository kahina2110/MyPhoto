function loadPosts(category, offset, sort) {
    let formData = new FormData();
    formData.append('action', 'order_by_category');
    formData.append('category', category);
    formData.append('offset', offset);
    formData.append('sort', sort); // Ajouter le paramètre 'sort'

    fetch(motaphoto_js.ajax_url, {
        method: 'POST',
        body: formData, // Utiliser le FormData pour envoyer les données
    })
    .then(function(response) {
        if (!response.ok) {
            throw new Error('Network response error.');
        }
        return response.json();
    })
    .then(function(data) {
        if (data && data.data && Array.isArray(data.data)) {
            // Efface les articles existants avant d'ajouter les nouveaux
            document.querySelector('#filtered-posts').innerHTML = '';
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
}
