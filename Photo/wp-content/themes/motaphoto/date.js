document.addEventListener('DOMContentLoaded', () => {
    const dateFilterForm = document.querySelector('#date-filter-form');
    const filteredPosts = document.querySelector('#filtered-posts');

    dateFilterForm.addEventListener('change', async (event) => {
        event.preventDefault();

        const formData = new FormData(dateFilterForm);
        formData.append('action', 'order_by_date');

        try {
            const response = await fetch(motaphoto_date_js.ajax_url, {
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
                        </div>`;
                        
                    filteredPosts.insertAdjacentHTML('beforeend', postHTML);
                });
            } else {
                console.error('Invalid data date received from server.');
                filteredPosts.innerHTML = '<p>Aucun article trouvé.</p>';
            }
        } catch (error) {
            console.error('There was a problem with the fetch operation: ', error);
            filteredPosts.innerHTML = '<p>Une erreur s\'est produite lors du chargement des articles.</p>';
        }
    });
});
