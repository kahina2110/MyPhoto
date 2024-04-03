<?php
function motaphoto_enqueue_styles() {
    // Charger le fichier style.css du thème motaphoto
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_styles');


function motaphoto_settings_register() {
    register_setting('motaphoto_settings_fields', 'motaphoto_settings_fields_validate');

    add_settings_section(
        'motaphoto_settings_section', 
        __('Paramètres du thème motaphoto', 'motaphoto'), 
        'motaphoto_settings_section_introduction', 
        'motaphoto-settings'
    );

    add_settings_field(
        'motaphoto_settings_field_introduction', 
        __('Introduction', 'motaphoto'), 
        'motaphoto_settings_field_introduction_output', 
        'motaphoto-settings', 
        'motaphoto_settings_section'
    );
    add_settings_field(
        'motaphoto_settings_field_numberphone', 
        __('Numéro de téléphone', 'motaphoto'), 
        'motaphoto_settings_field_numberphone_output', 
        'motaphoto-settings', 
        'motaphoto_settings_section'
    );
    add_settings_field(
        'motaphoto_settings_field_email', 
        __('E-mail', 'motaphoto'), 
        'motaphoto_settings_field_email_output', 
        'motaphoto-settings', 
        'motaphoto_settings_section'
    );
}

add_action('admin_init', 'motaphoto_settings_register');

function motaphoto_settings_fields_validate($inputs) {
    if(!empty($_POST)) {
        if(!empty($_POST['motaphoto_settings_field_introduction'])) {
            update_option('motaphoto_settings_field_introduction', $_POST['motaphoto_settings_field_introduction']);
        }
        if(!empty($_POST['motaphoto_settings_field_numberphone'])) {
            update_option('motaphoto_settings_field_numberphone', $_POST['motaphoto_settings_field_numberphone']);
        }
        if(!empty($_POST['motaphoto_settings_field_email'])) {
            update_option('motaphoto_settings_field_email', $_POST['motaphoto_settings_field_email']);
        }
        // Add validation for other fields if needed
    }
    return $inputs;
}

function motaphoto_settings_section_introduction() {
    _e('Paramètrez les différentes options de votre thème Motaphoto.', 'motaphoto');
}

function motaphoto_settings_field_introduction_output() {
    $value = get_option('motaphoto_settings_field_introduction');
    echo '<input name="motaphoto_settings_field_introduction" type="text" value="'.esc_attr($value).'" />';
}

function motaphoto_settings_field_numberphone_output() {
    $value = get_option('motaphoto_settings_field_numberphone');
    echo '<input name="motaphoto_settings_field_numberphone" type="text" value="'.esc_attr($value).'" />';
}

function motaphoto_settings_field_email_output() {
    $value = get_option('motaphoto_settings_field_email');
    echo '<input name="motaphoto_settings_field_email" type="text" value="'.esc_attr($value).'" />';
}
function motaphoto_theme_settings() {
    echo '<div class="wrap">';
    echo '<h1>'.esc_html(get_admin_page_title()).'</h1>';
    echo '<form action="options.php" method="post" name="motaphoto_settings">';
    settings_fields('motaphoto_settings_fields');
    do_settings_sections('motaphoto-settings');
    submit_button();
    echo '</form>';
    echo '</div>';
}

function register_my_menus() {
    register_nav_menus(
      array(
        'footer-menu' => __( 'Footer Menu' ),
        'header-menu' => __( 'Header' )
      )
    );
  }
  add_action( 'init', 'register_my_menus' );


  function load_google_fonts() {
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Spline+Sans+Mono:ital,wght@0,300..700;1,300..700&display=swap', false );
    wp_enqueue_style('poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap ', false);
    wp_enqueue_style( 'space mono', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap', false);
}
add_action( 'wp_enqueue_scripts', 'load_google_fonts' );


function charger_modele_page_personnalise() {
    add_theme_support('page-templates', array('template-custom.php'));
}
add_action('init', 'charger_modele_page_personnalise');

// Fonction pour enregistrer une nouvelle taxonomie "catégorie" pour les posts personnalisés
function register_custom_taxonomy() {
    $args = array(
        'labels' => array(
            'name' => 'Catégories',
            'singular_name' => 'Catégorie',
        ),
        'public' => true,
        'hierarchical' => true, // Pour créer une taxonomie hiérarchique comme les catégories
        'show_admin_column' => true, // Pour afficher la colonne dans l'administration
        'rewrite' => array( 'slug' => 'categorie' ), // Slug de l'URL
    );

    register_taxonomy( 'categorie', 'photos', $args ); 
}
add_action( 'init', 'register_custom_taxonomy' );

function tutsplus_burger_menu_scripts() {
    
	wp_enqueue_script( 'burger-menu-script', get_stylesheet_directory_uri() . '/burger-menu.js', array( 'jquery' ) );
 
}
add_action( 'wp_enqueue_scripts', 'tutsplus_burger_menu_scripts' );

?>
