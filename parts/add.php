<div class="row ">
			<div class="col-12 col-sm-12 col-md-6 add_prop_box">
			
			<form method="post" enctype="multipart/form-data" id="add_object">
			
			<div class="prop-title">
				Add New Property	
			</div>
			<div class='row'>
					<div class='col-4 col-sm-4'>Name</div> 
					<div class='col-8 col-sm-8'><input type="text" name="post_title" required value="New flat"/></div></div>
				<?php ;// Выводим форму 
				$propposts=get_posts(array('post_type'   => 'realty_reviews','numberposts' => 1,));
				$propmetas=get_post_meta($propposts[0]->ID);
				foreach( $propmetas as $k => $m ){
					if ( '_' == $k{0} ) continue;
					if ($m == NULL) $m='-';
					echo "<div class='row'><div class='col-4 col-sm-4'>".$k."</div>";
					echo "<div class='col-8 col-sm-8'><input type='text' class='".$k."' name='".$k."' value='txt' required/></div></div>";
					}
					
				echo "<div class='row type_radio'><div class='col-4 col-sm-4'>Type</div>";	
				$tags_array = get_terms('tax','hide_empty=0');
				$tags='';
				foreach ($tags_array as $tag) {
				  $tags .= "<div class='col-6 offset-4 col-sm-6 offset-sm-4'><input type='radio' name='tag' value='".$tag->term_id."'>".$tag->name."</div>";
				}
				echo $tags."</div>";
				?>
				
				<div class='row city_radio'>
					<div class='col-4 col-sm-4'>City</div>
				<?php
				$cities = get_posts(array( 'post_type'=>'cities', 'posts_per_page'=>-1, 'orderby'=>'post_title', 'order'=>'ASC' ));
				if( $cities ){
					foreach( $cities as $city ){
						echo "<div class='col-6 offset-4 col-sm-6 offset-sm-4'><input type='radio' name='city' value='".$city->ID."'>".$city->post_title."</div>";
					}

				}
				else
					echo " нет...";				
				?>
				</div>
				
					<label>Фото: <input id="image_file" type="file" name="img[]" multiple accept=".jpg, .jpeg, .png"/></label>
					 <input type="hidden" name="image_id" class="image_id">
					<!--label id="first_img" class='imgs'>Дополнительные фото(произвольное): <input type='file' name='imgs[]'/></label>
					
					< input type="submit" class="submit-button" name="button" value="Отправить" id="sub"/ -->
			</form> 
			
			<button id="btn"> Добавить объект </button>				
					
			</div>
		</div><!-- .row -->