/**
 * @param {string} url URL de l'image
 * @return {HTMLElement}
 */
function build(url) {
  const dom = document.createElement('div');
  dom.classList.add('lightbox');
  dom.innerHTML = `
    <button class="lightbox__close">Fermer</button>
    <button class="lightbox__next">Suivant</button>
    <button class="lightbox__prev">Précédent</button>
    <div class="lightbox__container"></div>`;
  dom.querySelector('.lightbox__close').addEventListener('click', this.close.bind(this));
  dom.querySelector('.lightbox__next').addEventListener('click', this.next.bind(this));
  dom.querySelector('.lightbox__prev').addEventListener('click', this.prev.bind(this));
  return dom;
}

/**
 * @param {string} url URL de l'image
 */
function open(url) {
  const dom = this.buildDOM(url);
  const img = document.createElement('img');
  img.src = url;
  img.addEventListener('load', () => {
    dom.querySelector('.lightbox__container').appendChild(img);
    document.body.appendChild(dom);
  });
}

/**
 * @param {Event} e
 */
function close(e) {
  e.preventDefault();
  document.body.removeChild(this.dom);
}

/**
 * @param {Event} e
 */
function next(e) {
  e.preventDefault();
  const index = this.images.indexOf(this.url);
  if (index === this.images.length - 1) {
    this.open(this.images[0]);
  } else {
    this.open(this.images[index + 1]);
  }
}

/**
 * @param {Event} e
 */
function prev(e) {
  e.preventDefault();
  const index = this.images.indexOf(this.url);
  if (index === 0) {
    this.open(this.images[this.images.length - 1]);
  } else {
    this.open(this.images[index - 1]);
  }
}
