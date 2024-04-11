// JavaScript pour afficher la modal et insérer le formulaire de contact
document.addEventListener("DOMContentLoaded", function() {
    var contactLink = document.querySelector('.menu-item-contact a');
  
    contactLink.addEventListener('click', function(event) {
      event.preventDefault();
  
      // Afficher la modal
      document.getElementById('contactModal').style.display = 'block';
  
      // Insérer le shortcode du formulaire de contact
      document.getElementById('contactModalContent').innerHTML = '[contact-form-7 id="4e9a26e" title="Contact"]';
    });
  });
  