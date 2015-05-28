<?php

add_shortcode('cx-latest-work', 'cx_sc_latest_work');
function cx_sc_latest_work() {

	$args = array( 'posts_per_page' => 4, 'post_type' => 'projects' );
	
	$recent_work_query = new WP_Query( $args ); ?>

	<div class="portfolio-drop-in ">
		<div class="container">
			<div class="row">
			<div class="col-xs-12"><h2 class="inline-title">Recent work</h2></div>
			<ul class="latest-work">

			<?php while ( $recent_work_query->have_posts() ) : $recent_work_query->the_post(); ?>

				<li class="col-xs-12 col-sm-6 col-lg-3"><a href="<?php the_permalink(); ?>">
					<?php 
					if ( has_post_thumbnail() ) {
						echo '<figure>';
						echo '<figcaption class="overlay"><div>';
						echo '<h3>';
						the_title();
						echo '</h3>';
						echo '<span class="project-type">';

							$terms = get_the_terms( $post->ID, 'project_type' );
							if ( $terms && ! is_wp_error( $terms ) ) : 
							
								$types = array();
								
								foreach ( $terms as $term ) {
									if ($term->parent == 0) {
										$types[] = $term->name;
									}
								}
													
								$types = join( " | ", $types );
								echo $types;
							endif;

						echo '</span></div>';
						echo '</figcaption>';
						
						if (class_exists('MultiPostThumbnails')) :
				    
					    if (MultiPostThumbnails::has_post_thumbnail(get_post_type(),'thumbnail-image')) {
					    	MultiPostThumbnails::the_post_thumbnail(get_post_type(),'thumbnail-image');
					    } else {
					    	echo the_post_thumbnail();
					    }

						endif;
						
						echo '</figure>';
					}
					?>
				</a></li>

			<?php endwhile; // end of the loop. ?>
			
			</ul>
			</div>
		</div>
	</div>
	
	<?php
	wp_reset_postdata();
}