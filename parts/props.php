<div class="row">

	<div class="col-12 col-sm-12">
			<div class="prop-title">
			Последние объекты недвижимости:	
			</div>
			<div class="prop-review">
			<div class='row'>
			<?php
				$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				
				$args = array('post_type' => 'realty_reviews','posts_per_page' => 6,'paged'=>$current_page);			
				$property = new WP_Query( $args );
				$i=0;
				if( $property->have_posts() ) : 
					while( $property->have_posts() ) :
						$property->the_post();
						$lastprop=$post->ID;
						?>
						
					<div class="col-12 col-sm-6 col-md-6 col-lg-4 realty_review_box">
					<!--div class="d-inline-flex p-2 realty_review_box"-->
						<a href="<?php the_permalink(); ?>">
						
						<!-- div class="col-12 col-sm-6  col-md-4" -->
						<div class='row'>
						
							<div class="col-4 col-sm-4">					
								<?php	echo get_the_post_thumbnail($post->ID, 'thumbnail' );?>
							</div>
							<div class="col-8 col-sm-8">
							<h2 class="realty_review_title"><?php the_title(); ?></h2>
							<?php	
								$propmetas=get_post_meta($post->ID);
										foreach( $propmetas as $k => $m ){
											if ( '_' == $k{0} ) continue;
											echo "<div class='row'><div class='col-6 col-sm-6'>".$k.":</div><div class='col-6 col-sm-6'>".implode($m)."</div></div>";
											}
								?>	
							</div>
						
						</div>
						<!--/div-->
						
						</a>
					</div>	
					<?php endwhile; ?>
					
			<?php endif;
			wp_reset_postdata();?>
</div> <!-- row -->
			</div> <!--class="prop-review"-->
	</div>
</div>
