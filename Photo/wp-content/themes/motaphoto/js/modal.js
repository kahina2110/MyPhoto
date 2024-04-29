document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById('myModal');
    var btn = document.getElementById("menu-item-157");
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
