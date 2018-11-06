<?php
/*
Plugin Name: Ndv Post
Plugin URI: http://laplab.h1n.ru
Description: Declares a plugin that will create a custom post type displaying realty.
Version: 1.0
Author: Lapkin
Author URI: http://laplab.h1n.ru
License: GPLv2
*/
add_action( 'init', 'tx_reg' );
add_action( 'init', 'tx_ins' );
add_action( 'init', 'create_realty_review' );
add_action( 'init', 'create_cities' );
add_action( 'admin_init', 'my_admin' );

function tx_ins() {
	wp_insert_term('Flat','tax',array(
		'description' => 'Flat term for the property',
		'slug'        => 'flat',
		'parent'      => 0
	));
	wp_insert_term('House','tax',array(
		'description' => 'House term for the property',
		'slug'        => 'house',
		'parent'      => 0
	));
	wp_insert_term('Office','tax',array(
		'description' => 'Office term for the property',
		'slug'        => 'office',
		'parent'      => 0
	));
	wp_insert_term('Townhouse','tax',array(
		'description' => 'Townhouse term for the property',
		'slug'        => 'townhouse',
		'parent'      => 0
	));
}

function tx_reg() {
// список параметров: http://wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy('tax', 'realty_reviews', array(
		'label'                 => 'Property type', // определяется параметром $labels->name
		'labels'                => array(
			'name'              => 'Property types',
			'singular_name'     => 'Property type',
			'search_items'      => 'Search Property type',
			'all_items'         => 'All Property types',
			'view_item '        => 'View Property type',
			'parent_item'       => 'Parent Property type',
			'parent_item_colon' => 'Parent Property type:',
			'edit_item'         => 'Edit Property type',
			'update_item'       => 'Update Property type',
			'add_new_item'      => 'Add New Property type',
			'new_item_name'     => 'New Property type Name',
			'menu_name'         => 'Property type',
		),
		'description'           => 'My taxonomy Property type', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => null, // равен аргументу public
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_menu'          => true, // равен аргументу show_ui
		'show_tagcloud'         => true, // равен аргументу show_ui
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		'hierarchical'          => true,
		'rewrite'               => false,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => 'post_categories_meta_box', // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	) );

}


function create_realty_review() {
    register_post_type( 'realty_reviews',
        array(
			'label'=>'The Property',
            'labels' => array(
                'name' => 'The Property',
                'singular_name' => 'Realty Review',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Realty Review',
                'edit' => 'Edit',
                'edit_item' => 'Edit Realty Review',
                'new_item' => 'New Realty Review',
                'view' => 'View',
                'view_item' => 'View Realty eview',
                'search_items' => 'Search Realty Reviews',
                'not_found' => 'No Realty Reviews found',
                'not_found_in_trash' => 'No Realty Reviews found in Trash',
                'parent' => 'Parent Realty Review'
            ),
			'description'=>'Realty_review',
			//'show_in_admin_bar' => true,
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields','page-attributes'),
            'taxonomies' => array( 'tax' ),
            'has_archive' => true,
        )
    );
}
function my_admin() {
    add_meta_box( 'movie_review_meta_box',
        'Movie Review Details',
        'display_movie_review_meta_box',
        'movie_reviews', 'normal', 'high'
    );
}


function create_cities() {
    register_post_type( 'cities',
        array(
			'label'=>'Cities',
            'labels' => array(
                'name' => 'Cities',
                'singular_name' => 'Cities',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New City',
                'edit' => 'Edit',
                'edit_item' => 'Edit City',
                'new_item' => 'New City',
                'view' => 'View',
                'view_item' => 'View City',
                'search_items' => 'Search City',
                'not_found' => 'No Realty City',
                'not_found_in_trash' => 'No City found in Trash',
                'parent' => 'Parent City Review'
            ),
			'description'=>'City_review',
			//'show_in_admin_bar' => true,
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields','page-attributes'),
           // 'taxonomies' => array(),
            'has_archive' => true,
        )
    );
}

?>