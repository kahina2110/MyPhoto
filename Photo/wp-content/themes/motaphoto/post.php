


<?php
if ( is_home() ) {
    get_template_part('home');  // Ajouter le contenu de home.php à la page d’accueil du site
}else{
    get_sidebar();   // Charger le fichier sidebar.php qui est dans le thème pour afficher les boutons de navigation sur la gauche et le bas de
    get_sidebar();   // Afficher la barre latérale sur les pages autres que l’index
};?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.bouton').click(function () {
       $('#description').toggle();
    });
});
</script>
</body>
</html>


