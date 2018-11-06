<div class="row">
			
			<div class="col-12 col-sm-12"><div class="prop-title">	
			Города:
			</div>
			<?php 
				$args = array('post_type' => 'cities','posts_per_page' => 5,);			
				$property = new WP_Query( $args ); 	
				if( $property->have_posts() ) : 
					while( $property->have_posts() ) :
						$property->the_post();?>
						
					<div class="realty_review_box">
					<a href="<?php the_permalink(); ?>">
					<div class='row'>
						<div class="col-4 col-sm-4">					
							<?php	echo get_the_post_thumbnail(get_the_ID(), 'thumbnail' );?>
						</div>
						<div class="col-8 col-sm-8">
						<h2 class="realty_review_title"><?php the_title(); ?></h2>
						</div>
					</div>	
					</a>
					</div>	
					<?php endwhile; ?>
			<?php endif;			
			wp_reset_postdata() ?>	
						
			</div>
						
		</div><!-- .row -->