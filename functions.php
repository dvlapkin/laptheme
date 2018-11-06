<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'property-styles', get_stylesheet_directory_uri() . '/css/prop.css', array(), $the_theme->get( 'Version' ) );   
	wp_enqueue_script( 'jquery');	
	wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), false);
	 wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

function addprop_load_script() {
   wp_enqueue_script( 'add-prop-script', get_stylesheet_directory_uri() . '/js/add-prop.js', array(), false);
       $data = array(
                'upload_url' => admin_url('async-upload.php'),
                'ajax_url'   => admin_url('admin-ajax.php'),
                'nonce'      => wp_create_nonce('media-form')
            );
 
    wp_localize_script( 'add-prop-script', 'm_config', $data );
}
add_action('wp_enqueue_scripts', 'addprop_load_script');



function add_child_theme_textdomain() {
    load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

function js_variables(){
    $variables = array (
        'ajax_url' => admin_url('admin-ajax.php'),
    );
    echo '<script type="text/javascript">window.wp_data = '.json_encode($variables).';</script>';
}

add_action('wp_head','js_variables');

add_action( 'wp_ajax_add_prop', 'add_prop' );  
add_action( 'wp_ajax_nopriv_add_prop', 'add_prop' );  


function add_prop(){
$newprop=add_to_db($_POST);
add_img_from_db($newprop,$_POST);
update_post_meta($newprop, '_wp_page_template',  'page-flats.php');
	
$args = array('post_type' => 'realty_reviews','posts_per_page' => 6);			
$property = new WP_Query( $args );
$output='<div class="row">';
global $post;
$i=0;

if( $property->have_posts() ) : 
while( $property->have_posts() ) :
		$property->the_post();	
	$output.='<div class="col-12 col-sm-6 col-md-6 col-lg-4 realty_review_box">';
	$output.='	<a href="'.get_permalink().'">';
	$output.='	<div class="row">';
	$output.='	<div class="col-4 col-sm-4">'.get_the_post_thumbnail($post->ID, 'thumbnail' );
	$output.='		</div>
			<div class="col-8 col-sm-8">
			<h2 class="realty_review_title">'.get_the_title().'</h2>';	
				$propmetas=get_post_meta($post->ID);
						foreach( $propmetas as $k => $m ){
							if ( '_' == $k{0} ) continue;
							$output.= "<div class='row'><div class='col-6 col-sm-6'>".$k.":</div><div class='col-6 col-sm-6'>".implode($m)."</div></div>";
							}
	$output.='		</div>
		</div> <!-- row -->
		</a>
	</div>';	
endwhile;	
endif;
wp_reset_postdata();
echo $output.'</div>';
die; // обработчик закончил выполнение
}

function add_to_db($inp){
$metas=[];
foreach ($inp as $key => $value) {
	if (($key != 'action')and($key !='post_title')and($key !='city')
		and($key !='tag')and($key !='image_id')){
		$metas["$key"]=$value;}
}	
 $post_id = wp_insert_post(  wp_slash( array(
//	'ID'             => <post id>,                                                     // Вы обновляете существующий пост?
//	'menu_order'     => <order>,                                                       // Если запись "постоянная страница", установите её порядок в меню.
//	'comment_status' => 'closed' | 'open',                                             // 'closed' означает, что комментарии закрыты.
//	'ping_status'    => 'closed' | 'open',                                             	// 'closed' означает, что пинги и уведомления выключены.
//	'pinged'         => ?,                                                             	//?
	'post_author'    => $user_ID,                                                     	// ID автора записи
	'post_content'   => '',                                        						// Полный текст записи.
//	'post_date'      => Y-m-d H:i:s,                                                   // Время, когда запись была создана.
//	'post_date_gmt'  => Y-m-d H:i:s,                                                   // Время, когда запись была создана в GMT.
//	'post_excerpt'   => <an excerpt>,                                                  // Цитата (пояснительный текст) записи.
	'post_name'      => 'slugxxx',                                                    // Альтернативное название записи (slug) будет использовано в УРЛе.
	'post_parent'    => $inp['city'],                                                    // ID родительской записи, если нужно.
	'post_password'  => '',                                                             // Пароль для просмотра записи.
	'post_status'    => 'publish',        											 // Статус создаваемой записи.
	'post_title'     => $inp['post_title'],                                                   // Заголовок (название) записи.
	'post_type'      => 'realty_reviews',
	//'post_category'  => array( <category id>, <...> ),                                   // Категория к которой относится пост.
	//'tags_input'     => array( <tag>, <tag>, <...> ),                                         // Метки поста (указываем ярлыки, имена или ID).
	//'tax_input'      => array( 'taxonomy_name' => array( 'term', 'term2', 'term3' ) ), // К каким таксам прикрепить запись. Аналог 'post_category', только для для новых такс.
	//'to_ping'        => ?,	//?
	'meta_input'     => $metas,
) ) );
return $post_id;
}

function add_img_from_db($pid,$inp){
set_post_thumbnail ($pid,$inp['image_id']);
}

/* CUSTOMIZER */

add_action('customize_register', function($customizer){
    $customizer->add_section(
        'title_section',
        array(
            'title' => 'NDV title',
            'description' => 'NDV-theme customize title',
            'priority' => 11,
        )
    );
	
	$customizer->add_setting(
    'title_box_left',
    array('default' => 'Лучшая недвижимость')
	);

	$customizer->add_control(
    'title_box_left',
    array(
        'label' => 'Left',
        'section' => 'title_section',
        'type' => 'text',
    )
	);
	
	$customizer->add_setting(
    'title_box_center',
    array('default' => 'Лучшие цены')
	);
	
		$customizer->add_control(
    'title_box_center',
    array(
        'label' => 'Center',
        'section' => 'title_section',
        'type' => 'text',
    )
	);
	
	$customizer->add_setting(
    'title_box_right',
    array('default' => 'Надёжность')
	);
	
	$customizer->add_control(
    'title_box_right',
    array(
        'label' => 'Right',
        'section' => 'title_section',
        'type' => 'text',
    )
	);
	
	/* content */
	
    $customizer->add_section(
        'content_section',
        array(
            'title' => 'NDV content ',
            'description' => 'NDV-theme customize content',
            'priority' => 11,
        )
    );	
	/*last prop*/
	$customizer->add_setting(
    'ndv_content_p',
    array('default' => '')
	);

	$customizer->add_control(
    'ndv_content_p',
    array(
        'label' => 'View last',
        'section' => 'content_section',
        'type' => 'checkbox',
    )
	);
	/*cities*/
	$customizer->add_setting(
    'ndv_content_c',
    array('default' => '')
	);

	$customizer->add_control(
    'ndv_content_c',
    array(
        'label' => 'View cities',
        'section' => 'content_section',
        'type' => 'checkbox',
    )
	);
	/*add field*/
	$customizer->add_setting(
    'ndv_content_a',
    array('default' => '')
	);

	$customizer->add_control(
    'ndv_content_a',
    array(
        'label' => 'View Add field',
        'section' => 'content_section',
        'type' => 'checkbox',
    )
	);	
	
});
