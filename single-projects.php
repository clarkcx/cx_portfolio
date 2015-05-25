<?php
/**
 * The template for displaying all single posts.
 *
 * @package Able WP
 */

get_header(); ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<header class="entry-header container">
				<?php the_title( '<h1 class="entry-title col-xs-12">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<?php 
				if ( has_post_thumbnail() ) {
					echo '<figure class="hero">';
					the_post_thumbnail();
					echo '</figure>';
				}
			?>

			<div class="container">
				<div class="row">
					<div class="entry-content col-md-8">
						<?php the_content(); ?>
						<?php 
							$terms = get_the_terms( $post->ID, 'client' );
							if ( $terms && ! is_wp_error( $terms ) ) {
								$client_links = array();
								foreach ( $terms as $term ) {
									$client_links[] = $term->name;
								}
								$clients = join( ", ", $client_links );
								#	echo '<b class="info-label">Client: </b>' . $clients . ' <br />';			
						} ?>
					</div><!-- .entry-content -->
					
					<div class="project-meta col-md-4">
						<?php
						
						if (isset($project_duration)) {
							# echo '<b class="info-label">Duration: </b>' . $project_duration;
						}

						$project_types = get_the_terms( $post->ID, 'project_type' );

						#print_r($project_types);
						if ($project_types != '') {
							echo '<h3 class="project-types">';
							foreach ($project_types as $type) {
								if ($type->parent == 0) {
									echo '<span class="' . $type->slug . '">' . $type->name . '</span>';
								}
							}
							echo '</h3>';
						}

						if ($project_types != '') {
							echo '<div class="project-types">';
							$end = end($project_types);
							foreach ($project_types as $key => $type) {
								if ($type->parent != 0) {
									echo '<span class="' . $type->slug . '">' . $type->name . '</span>';
									if ($end != $type) {
										echo ', ';
									}
								}
							}
							echo '</div>';
						}

						$custom = get_post_custom($post->ID);
						$project_url = $custom["_url"][0];
						if (isset($project_url)) {
							echo '<a href="' . $project_url .'" class="btn">Visit ' . get_the_title() . '</a>';
						} ?>
					</div><!-- .project-meta -->
				</div><!-- .row -->






				<div class="row">




					<div class="col-sm-8">

						<div class="row">
							<div class="project-testimonial col-xs-7">

								<?php
								$project_duration = $custom["_duration"][0];
								$project_testimonial = $custom["_testimonial_text"][0];
								$project_testimonial_name = $custom["_testimonial_name"][0];

								if (isset($project_testimonial)) { ?>
								<blockquote>
									<p><?php echo $project_testimonial; ?></p>
									<footer>
										<cite><?php echo $project_testimonial_name; ?></cite>
									</footer>
								</blockquote>
								<?php }

								?> 
							</div><!-- .project-testimonial -->
							<div class="col-xs-5">
							<figure class="project-image">
							<?php if (class_exists('MultiPostThumbnails')) :
							    MultiPostThumbnails::the_post_thumbnail(
							        get_post_type(),
							        'second-image'
							    );
							endif; ?>
							</figure>

							<figure class="project-image">
							<?php if (class_exists('MultiPostThumbnails')) :
							    MultiPostThumbnails::the_post_thumbnail(
							        get_post_type(),
							        'third-image'
							    );
							endif; ?>
							</figure>
							</div>

							<div class="col-xs-12">
								<div class="cta row-same-height">
									<p class="col-xs-7 col-xs-height">Do you need help getting the most out of your business online?</p>
									<div class="col-xs-4 col-sm-offset-1 col-xs-height col-middle"><a class="btn" href="../../contact/">Contact us</a></div>
								</div>
							</div>

						</div><!-- .row -->
					</div><!-- .col-sm-8 -->



					<div class="col-md-4">
						<figure>
						<?php if (class_exists('MultiPostThumbnails')) :
						    MultiPostThumbnails::the_post_thumbnail(
						        get_post_type(),
						        'fourth-image'
						    );
						endif; ?>
						</figure>
					</div>





				</div><!-- .row -->






			</div>

			<div class="related-projects container-fluid">
				<div class="container">
					<?php
					// Find connected pages
					$connected = new WP_Query( array(
					  'connected_type' => 'project_to_project',
					  'connected_items' => get_queried_object(),
					  'nopaging' => true,
					) );

					// Display connected pages
					if ( $connected->have_posts() ) :
					?>
					<h3>Related projects</h3>
					<ul class="latest-work">
					<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
					    <li class="col-xs-12 col-sm-4 col-lg-4">
					    	<a href="<?php the_permalink(); ?>">
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
												$types[] = $term->name;
											}
																
											$types = join( " | ", $types );
											echo $types;
										endif;

									echo '</span></div>';
									echo '</figcaption>';
									the_post_thumbnail();
									echo '</figure>';
								}
								?>
					    	</a>
					    </li>
					<?php endwhile; ?>
					</ul>

					<?php 
					// Prevent weirdness
					wp_reset_postdata();

					endif;
					?>
				</div>
			</div>

		<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
