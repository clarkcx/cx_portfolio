<?php
/**
 * The template for displaying all single posts.
 *
 * @package Able WP
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php 
			if ( has_post_thumbnail() ) {
				echo '<figure class="fullwidth">';
				the_post_thumbnail();
				echo '</figure>';
			}
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

					<div class="entry-meta">
						<?php #ablewp_posted_on(); ?>
					</div><!-- .entry-meta -->
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>

					<?php
					$custom = get_post_custom($post->ID);
					$project_duration = $custom["_duration"][0];
					#$project_url = $custom["_url"][0];
					#$project_testimonial = $custom["_testimonial_text"][0];
					#$project_testimonial_name = $custom["_testimonial_name"][0];
					?>
					<p>
						<?php 
							$terms = get_the_terms( $post->ID, 'client' );
							if ( $terms && ! is_wp_error( $terms ) ) : 
							
								$client_links = array();
							
								foreach ( $terms as $term ) {
									$client_links[] = $term->name;
								}
													
								$clients = join( ", ", $client_links );
						?>
						<b class="info-label">Client: </b><?php echo $clients; ?> <br />
						<?php endif; ?>
						<?php if (isset($project_duration)) { ?>
						<b class="info-label">Duration: </b><?php echo $project_duration; ?>
						<?php } ?>
					</p>

					<?php if (isset($project_testimonial)) { ?>
					<blockquote>
						<p><?php echo $project_testimonial; ?></p>
						<footer>
							<cite><?php echo $project_testimonial_name; ?></cite>
						</footer>
					</blockquote>
					<?php } ?>
					<?php if (isset($project_url)) { ?>
						<a href="<?php echo $project_url; ?>" class="btn">Visit <?php the_title(); ?></a>
					<?php } ?>

					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'ablewp' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php ablewp_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-## -->

			<?php the_post_navigation(); ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php #get_sidebar(); ?>
<?php get_footer(); ?>
