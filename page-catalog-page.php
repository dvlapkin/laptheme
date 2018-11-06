<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>
<div class="wrapper" id="page-wrapper">
		<div class="row title_box">
			<div class="col-4 col-sm-4 title_box_l">
				<i class="fa fa-building tbl" aria-hidden="true"></i>
				<p><?php echo get_theme_mod('title_box_left', 'Лучшая недвижимость'); ?>	</p>
			</div>
			<div class="col-4 col-sm-4 title_box_c">
				<i class="fa fa-usd tbl" aria-hidden="true"></i>
				<p><?php echo get_theme_mod('title_box_center', 'Лучшие цены'); ?>	</p>
			</div>
			<div class="col-4 col-sm-4 title_box_r">
				<i class="fa fa-thumbs-o-up tbl" aria-hidden="true"></i>
				<p><?php echo get_theme_mod('title_box_right', ' Надёжность'); ?> </p>
			</div>
		</div>

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">


		<main class="site-main" id="main">
		
		<?php if(get_theme_mod('ndv_content_p') != '')		
				get_template_part( 'parts/props' ); ?>
				
		<?php if(get_theme_mod('ndv_content_c') != '')
			get_template_part( 'parts/cities' ); ?>
		
		<?php 
			if ( is_user_logged_in() ) {

			if(get_theme_mod('ndv_content_a') != '')
			get_template_part( 'parts/add' );			
					}
			 ?>
		
			
		</main><!-- #main -->


</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
<a href="#" class="scrollup">Наверх</a>