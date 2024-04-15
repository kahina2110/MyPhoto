<?php
function motaphoto_enqueue_styles()
{
    // Charger le fichier style.css du thème motaphoto
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_styles');


function motaphoto_settings_register()
{
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

function motaphoto_settings_fields_validate($inputs)
{
    if (!empty($_POST)) {
        if (!empty($_POST['motaphoto_settings_field_introduction'])) {
            update_option('motaphoto_settings_field_introduction', $_POST['motaphoto_settings_field_introduction']);
        }
        if (!empty($_POST['motaphoto_settings_field_numberphone'])) {
            update_option('motaphoto_settings_field_numberphone', $_POST['motaphoto_settings_field_numberphone']);
        }
        if (!empty($_POST['motaphoto_settings_field_email'])) {
            update_option('motaphoto_settings_field_email', $_POST['motaphoto_settings_field_email']);
        }
        // Add validation for other fields if needed
    }
    return $inputs;
}

function motaphoto_settings_section_introduction()
{
    _e('Paramètrez les différentes options de votre thème Motaphoto.', 'motaphoto');
}

function motaphoto_settings_field_introduction_output()
{
    $value = get_option('motaphoto_settings_field_introduction');
    echo '<input name="motaphoto_settings_field_introduction" type="text" value="' . esc_attr($value) . '" />';
}

function motaphoto_settings_field_numberphone_output()
{
    $value = get_option('motaphoto_settings_field_numberphone');
    echo '<input name="motaphoto_settings_field_numberphone" type="text" value="' . esc_attr($value) . '" />';
}

function motaphoto_settings_field_email_output()
{
    $value = get_option('motaphoto_settings_field_email');
    echo '<input name="motaphoto_settings_field_email" type="text" value="' . esc_attr($value) . '" />';
}
function motaphoto_theme_settings()
{
    echo '<div class="wrap">';
    echo '<h1>' . esc_html(get_admin_page_title()) . '</h1>';
    echo '<form action="options.php" method="post" name="motaphoto_settings">';
    settings_fields('motaphoto_settings_fields');
    do_settings_sections('motaphoto-settings');
    submit_button();
    echo '</form>';
    echo '</div>';
}

function register_my_menus()
{
    register_nav_menus(
        array(
            'footer-menu' => __('Footer Menu'),
            'header-menu' => __('Header')
        )
    );
}
add_action('init', 'register_my_menus');


function load_google_fonts()
{
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Spline+Sans+Mono:ital,wght@0,300..700;1,300..700&display=swap', false);
    wp_enqueue_style('poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap ', false);
    wp_enqueue_style('space mono', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap', false);
}
add_action('wp_enqueue_scripts', 'load_google_fonts');


function charger_modele_page_personnalise()
{
    add_theme_support('page-templates', array('template-custom.php'));
}
add_action('init', 'charger_modele_page_personnalise');



function tutsplus_burger_menu_scripts()
{

    wp_enqueue_script('burger-menu-script', get_stylesheet_directory_uri() . '/burger-menu.js', array('jquery'));

}
add_action('wp_enqueue_scripts', 'tutsplus_burger_menu_scripts');
function cptui_register_my_taxes_categorie()
{

    /**
     * Taxonomy: catégories.
     */

    $labels = [
        "name" => esc_html__("catégories", "motaphoto"),
        "singular_name" => esc_html__("catégorie", "motaphoto"),
    ];


    $args = [
        "label" => esc_html__("catégories", "motaphoto"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => 'categorie', 'with_front' => true,],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "categorie",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => false,
        "sort" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy("categorie", ["attachment", "photos"], $args);
}
add_action('init', 'cptui_register_my_taxes_categorie');
function cptui_register_my_taxes_format()
{

    /**
     * Taxonomy: formats.
     */

    $labels = [
        "name" => esc_html__("formats", "motaphoto"),
        "singular_name" => esc_html__("format", "motaphoto"),
    ];


    $args = [
        "label" => esc_html__("formats", "motaphoto"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => 'format', 'with_front' => true,],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "format",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => false,
        "sort" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy("format", ["photos"], $args);
}
add_action('init', 'cptui_register_my_taxes_format');


function add_theme_scripts()
{
    wp_enqueue_script('menu', get_template_directory_uri() . '/burger-menu.js', array(), '1.0', true);
    wp_enqueue_script('modal', get_template_directory_uri() . '/modal.js', array(), '1.0', true);
    wp_enqueue_script('scripts', get_template_directory_uri() . '/scripts.js', array(), '1.0');


}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

function motaphoto_scripts() {
    wp_enqueue_script('motaphoto', get_template_directory_uri() . '/load-more.js', array('jquery'), '1.0.0', true);
    wp_localize_script('motaphoto', 'motaphoto_js', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'motaphoto_scripts');


// Fonction pour charger plus de posts personnalisés
function load_more_posts() {

    $args = array(
        'post_type' => 'photos', 
        'posts_per_page' => 8, 
        'offset' => $_POST['offset'] 
    );

    $query = new WP_Query($args);

    $posts = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $image = get_field('image');
                            if ($image) {
                                $image_url = $image['url'];
                                $image_alt = $image['alt'];
                            }
            $post_data = array(
                'post_title' => get_the_title(),
                'post_content' => get_the_excerpt(),
                'post_link' => get_permalink(),
                'image_src' => $image_url,
                'image_alt' => $image_alt
            );
            $posts[] = $post_data;
        }
    }

    wp_reset_postdata();

    // Renvoie les données des posts au format JSON
    wp_send_json_success($posts);
}

// Action Ajax pour charger plus de posts personnalisés
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts'); // Pour les utilisateurs non connectés

?>