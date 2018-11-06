 <?php
/*
Template Name: Шаблон для недвижимости
Template Post Type: realty_reviews
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">
			
			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">
				<div class="row opacity085"><div class="col-12 col-sm-12">
					<?php get_template_part( 'loop-templates/content', 'page' ); ?>

						<?php	
							$postid=get_the_ID();																					
						$propmetas=get_post_meta($postid);
										foreach( $propmetas as $k => $m ){
											if ( '_' == $k{0} )
														continue;
											if ($m == NULL) $m='-';
											echo "<div class='row'><div class='col-6 col-md-6 col-sm-6 col-xs-6'>".$k.":</div><div class='col-6 col-md-6 col-sm-6 col-xs-6'>".implode($m)."</div></div>";
											}
							//echo "<div class='row'><div class='col-md-4'>Цена :</div><div class='col-md-4'>".get_post_meta($postid,'cost',true)."</div></div>";
							//echo "<div class='row'><div class='col-md-4'>Площадь :</div><div class='col-md-4'>".get_post_meta($postid,'area',true)."</div></div>";
							//echo "<div class='row'><div class='col-md-4'>Адрес :</div><div class='col-md-4'>".get_post_meta($postid,'adress',true)."</div></div>";
							//echo "<div class='row'><div class='col-md-4'>Этаж :</div><div class='col-md-4'>".get_post_meta($postid,'floor',true)."</div></div>";	
							//echo "<div class='row'><div class='col-md-4'>Жилая площадь :</div><div class='col-md-4'>".get_post_meta($postid,'living_space',true)."</div></div>";	
					
					echo "<div class='row'><div class='col-12 col-md-6 offset-md-3 col-sm-12 col-xs-12 '>";					
					$nav_arg=array(
					'screen_reader_text'=>'Property navigation',
					'next_text' => '<span class="post-title">%title</span>'.
							'<span class="meta-nav" aria-hidden="true"> >> </span> ',
					'prev_text' => '<span class="meta-nav" aria-hidden="true"> << </span> ' .
						'<span class="post-title">%title</span>',
					);
				echo "</div></div>";	
				the_post_navigation($nav_arg);?>	
				</div></div>

			</main><!-- #main -->

		<!-- Do the right sidebar check -->
		
		<?php "<div class='ddd'>".get_template_part( 'global-templates/right-sidebar-check' )."</div>"; ?> 
	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
