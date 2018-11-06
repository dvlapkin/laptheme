 <?php
/*
Template Name: Шаблон для городов
Template Post Type: cities
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container   = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<!-- Do the left sidebar check -->
		<?php// get_template_part( 'global-templates/left-sidebar-check' ); ?>

		<main class="site-main" id="main">

		<?php 
			echo "<div class='row opacity085'><div class='col-12 col-sm-12'>";
			get_template_part( 'loop-templates/content', 'page' ); 	
			$postid=get_the_ID();
			$thispost= get_post($postid);?>		
			</div></div>
			<div class='row opacity085'><div class='col-4 col-sm-4'>О городе :</div>
			
			<?php 
				echo "<div class='col-8 col-sm-8'>".$thispost->post_content."</div></div>";				
				$props = get_posts(array( 'post_type'=>'realty_reviews', 'post_parent'=>$postid, 'posts_per_page'=>10 ));
				if( $props ){
					foreach( $props as $prop ){
						$postid=$prop->ID;
						?>
							<div class="col-12 col-sm-12 realty_review_box">
							<a href="<?php the_permalink($postid); ?>">
								<div class='row'>
								<div class="col-4 col-sm-4">					
									<?php	echo get_the_post_thumbnail($postid, 'thumbnail' );?>
								</div>
								<div class="col-8 col-sm-8">
									<h2 class="realty_review_title"><?php echo $prop->post_title ?></h2>
																		
									<?php
										$propmetas=get_post_meta($postid);
										foreach( $propmetas as $k => $m ){
											if ( '_' == $k{0} )
														continue;
											echo "<div class='row'><div class='col-6 col-sm-6'>".$k.":</div><div class='col-6 col-sm-6'>".implode($m)."</div></div>";
											}
										//echo "<div class='row'><div class='col-md-6 col-sm-6'>Цена :</div><div class='col-md-6 col-sm-6'>".get_post_meta($postid,'cost',true)."</div></div>";
										//echo "<div class='row'><div class='col-md-6 col-sm-6'>Площадь :</div><div class='col-md-6 col-sm-6'>".get_post_meta($postid,'area',true)."</div></div>";
										//echo "<div class='row'><div class='col-md-6 col-sm-6'>Адрес :</div><div class='col-md-6 col-sm-6'>".get_post_meta($postid,'adress',true)."</div></div>";
										//echo "<div class='row'><div class='col-md-6 col-sm-6'>Этаж :</div><div class='col-md-6 col-sm-6'>".get_post_meta($postid,'floor',true)."</div></div>";	
										//echo "<div class='row'><div class='col-md-6 col-sm-6'>Жилая площадь :</div><div class='col-md-6 col-sm-6'>".get_post_meta($postid,'living_space',true)."</div></div>";	
										?>	
								</div>
								</div><!-- row -->
							</a>
							</div> <!-- box -->
					<?php
					}
					}
					else
						echo 'Недвижимости нет :(';
				
				$nav_arg=array(
					'screen_reader_text'=>'Other cities',
					'next_text' => '<span class="post-title">%title</span>'.
							'<span class="meta-nav" aria-hidden="true"> >> </span> ',
					'prev_text' => '<span class="meta-nav" aria-hidden="true"> << </span> ' .
						'<span class="post-title">%title</span>',
					);
					
				the_post_navigation($nav_arg);?>	
			

		</main><!-- #main -->

	<!-- Do the right sidebar check -->
	<?php// get_template_part( 'global-templates/right-sidebar-check' ); ?>

	<!-- /div --><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
