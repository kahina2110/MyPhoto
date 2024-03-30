var modal = document.getElementById('myModal');

var btn = document.getElementsByClassName("menu");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    console.log('coucou');
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
