document.addEventListener("DOMContentLoaded", function() {
    // Votre code JavaScript ici
    var modal = document.getElementById('myModal');
    var btn = document.getElementById("contact");
    var span = document.getElementsByClassName("close")[0];

    function closeModalWithFade() {
        modal.style.opacity = "0";
        setTimeout(function() {
            modal.style.display = "none";
            modal.style.opacity = "1";
        }, 300);
    }

    btn.onclick = function() {
        modal.style.display = "block";
        var refPhoto = "<?php echo the_field('reference'); ?>";
        document.getElementById("ref-photo").setAttribute("value", refPhoto);
    }

    span.onclick = function() {
        closeModalWithFade();
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            closeModalWithFade();
        }
    }
});