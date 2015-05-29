<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Able WP
 */

$icon_web = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="21.7" height="21.7" viewBox="0 0 21.7 21.7" enable-background="new 0 0 21.733 21.724" xml:space="preserve"><path fill="#FFFFFF" d="M17.1 5.5c-0.2-0.2-0.5-0.3-0.8-0.3H5.4c-0.3 0-0.6 0.1-0.8 0.3S4.3 6 4.3 6.3v7.4c0 0.3 0.1 0.6 0.3 0.8s0.5 0.3 0.8 0.3h3.7c0 0.2 0 0.4-0.1 0.5 -0.1 0.2-0.1 0.3-0.2 0.5 -0.1 0.1-0.1 0.2-0.1 0.3 0 0.1 0 0.2 0.1 0.3 0.1 0.1 0.2 0.1 0.3 0.1h3.5c0.1 0 0.2 0 0.3-0.1 0.1-0.1 0.1-0.2 0.1-0.3 0-0.1 0-0.2-0.1-0.3 -0.1-0.1-0.1-0.3-0.2-0.5 -0.1-0.2-0.1-0.4-0.1-0.5h3.7c0.3 0 0.6-0.1 0.8-0.3s0.3-0.5 0.3-0.8V6.3C17.4 6 17.3 5.7 17.1 5.5M16.5 12.1c0 0-0.1 0.1-0.2 0.1H5.4c-0.1 0-0.1 0-0.2-0.1s-0.1-0.1-0.1-0.2V6.3c0-0.1 0-0.1 0.1-0.2s0.1-0.1 0.2-0.1h10.9c0.1 0 0.1 0 0.2 0.1s0.1 0.1 0.1 0.2v5.7C16.6 12 16.5 12.1 16.5 12.1"/></svg>';
$icon_brand = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="21.7" height="21.7" viewBox="0 0 21.7 21.7" enable-background="new 0 0 21.733 21.724" xml:space="preserve"><path fill="#FFFFFF" d="M11.3 4.8L11.1 5.4l-0.7 0.2 0.7 0.2 0.2 0.7 0.2-0.7 0.7-0.2 -0.7-0.2L11.3 4.8zM15.7 9.1L15.5 9.8l-0.7 0.2 0.7 0.2 0.2 0.7 0.2-0.7 0.7-0.2L15.9 9.8 15.7 9.1zM9.2 5.2l-0.4 1.3 -1.3 0.4 1.3 0.4 0.4 1.3 0.4-1.3 1.3-0.4 -1.3-0.4L9.2 5.2zM7 4.8L6.8 5.4 6.1 5.6l0.7 0.2 0.2 0.7 0.2-0.7 0.7-0.2L7.2 5.4 7 4.8zM16.3 6.4l-1.4-1.4c-0.1-0.1-0.2-0.1-0.3-0.1s-0.2 0-0.3 0.1l-8.8 8.8c-0.1 0.1-0.1 0.2-0.1 0.3s0 0.2 0.1 0.3l1.4 1.4c0.1 0.1 0.2 0.1 0.3 0.1S7.4 15.9 7.5 15.8l8.8-8.8c0.1-0.1 0.1-0.2 0.1-0.3C16.4 6.6 16.4 6.5 16.3 6.4M12.6 8l2-2 0.7 0.7 -2 2L12.6 8z"/></svg>';
$icon_event = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="21.7" height="21.7" viewBox="0 0 21.7 21.7" enable-background="new 0 0 21.733 21.724" xml:space="preserve"><path fill="#FFFFFF" d="M16.3 6.8c-0.2-0.2-0.4-0.3-0.6-0.3h-0.9V5.9c0-0.3-0.1-0.6-0.3-0.8C14.3 4.9 14 4.8 13.7 4.8h-0.4c-0.3 0-0.6 0.1-0.8 0.3 -0.2 0.2-0.3 0.5-0.3 0.8v0.7H9.6V5.9c0-0.3-0.1-0.6-0.3-0.8C9 4.9 8.8 4.8 8.5 4.8H8c-0.3 0-0.6 0.1-0.8 0.3S6.9 5.6 6.9 5.9v0.7H6.1c-0.2 0-0.4 0.1-0.6 0.3 -0.2 0.2-0.3 0.4-0.3 0.6v8.7c0 0.2 0.1 0.4 0.3 0.6C5.6 16.9 5.8 17 6.1 17h9.6c0.2 0 0.4-0.1 0.6-0.3 0.2-0.2 0.3-0.4 0.3-0.6V7.4C16.6 7.1 16.5 6.9 16.3 6.8M13.9 8c0 0-0.1 0.1-0.2 0.1h-0.4c-0.1 0-0.1 0-0.2-0.1s-0.1-0.1-0.1-0.2V5.9c0-0.1 0-0.1 0.1-0.2s0.1-0.1 0.2-0.1h0.4c0.1 0 0.1 0 0.2 0.1s0.1 0.1 0.1 0.2v2C13.9 7.9 13.9 7.9 13.9 8M8.6 8C8.6 8 8.5 8 8.5 8H8c-0.1 0-0.1 0-0.2-0.1S7.8 7.9 7.8 7.8V5.9c0-0.1 0-0.1 0.1-0.2s0.1-0.1 0.2-0.1h0.4c0.1 0 0.1 0 0.2 0.1s0.1 0.1 0.1 0.2v2C8.7 7.9 8.7 7.9 8.6 8M6.1 9.1h9.6v7H6.1V9.1z"/></svg>';
$icon_video = '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" width="21.7" height="21.7" viewBox="0 0 21.7 21.7" enable-background="new 0 0 21.7 21.7" xml:space="preserve"><path fill="#FFFFFF" d="M17.7 5.2c-0.2-0.2-0.5-0.3-0.8-0.3H5c-0.3 0-0.6 0.1-0.8 0.3C4 5.4 3.8 5.7 3.8 6v9.9c0 0.3 0.1 0.6 0.3 0.8 0.2 0.2 0.5 0.3 0.8 0.3H16.9c0.3 0 0.6-0.1 0.8-0.3 0.2-0.2 0.3-0.5 0.3-0.8V6C18 5.7 17.9 5.4 17.7 5.2M16.9 7.5c-0.1 0.1-0.2 0.1-0.3 0.1h-0.9c-0.1 0-0.2 0-0.3-0.1 -0.1-0.1-0.1-0.2-0.1-0.3V6.3c0-0.1 0-0.2 0.1-0.3 0.1-0.1 0.2-0.1 0.3-0.1h0.9c0.1 0 0.2 0 0.3 0.1 0.1 0.1 0.1 0.2 0.1 0.3v0.9C17.1 7.3 17 7.4 16.9 7.5M16.9 10.4c-0.1 0.1-0.2 0.1-0.3 0.1h-0.9c-0.1 0-0.2 0-0.3-0.1 -0.1-0.1-0.1-0.2-0.1-0.3V9.1c0-0.1 0-0.2 0.1-0.3s0.2-0.1 0.3-0.1h0.9c0.1 0 0.2 0 0.3 0.1 0.1 0.1 0.1 0.2 0.1 0.3v0.9C17.1 10.2 17 10.3 16.9 10.4M16.9 13.2c-0.1 0.1-0.2 0.1-0.3 0.1h-0.9c-0.1 0-0.2 0-0.3-0.1 -0.1-0.1-0.1-0.2-0.1-0.3v-0.9c0-0.1 0-0.2 0.1-0.3 0.1-0.1 0.2-0.1 0.3-0.1h0.9c0.1 0 0.2 0 0.3 0.1 0.1 0.1 0.1 0.2 0.1 0.3v0.9C17.1 13 17 13.1 16.9 13.2M14.1 10.4c-0.1 0.1-0.2 0.1-0.3 0.1H8.1c-0.1 0-0.2 0-0.3-0.1 -0.1-0.1-0.1-0.2-0.1-0.3V6.3c0-0.1 0-0.2 0.1-0.3C7.9 5.8 8 5.8 8.1 5.8h5.7c0.1 0 0.2 0 0.3 0.1 0.1 0.1 0.1 0.2 0.1 0.3v3.8C14.3 10.2 14.2 10.3 14.1 10.4M16.9 16.1c-0.1 0.1-0.2 0.1-0.3 0.1h-0.9c-0.1 0-0.2 0-0.3-0.1s-0.1-0.2-0.1-0.3v-0.9c0-0.1 0-0.2 0.1-0.3 0.1-0.1 0.2-0.1 0.3-0.1h0.9c0.1 0 0.2 0 0.3 0.1 0.1 0.1 0.1 0.2 0.1 0.3v0.9C17.1 15.9 17 16 16.9 16.1M6.5 7.5c-0.1 0.1-0.2 0.1-0.3 0.1H5.3c-0.1 0-0.2 0-0.3-0.1C4.8 7.4 4.8 7.3 4.8 7.2V6.3c0-0.1 0-0.2 0.1-0.3 0.1-0.1 0.2-0.1 0.3-0.1h0.9c0.1 0 0.2 0 0.3 0.1 0.1 0.1 0.1 0.2 0.1 0.3v0.9C6.7 7.3 6.6 7.4 6.5 7.5M14.1 16.1c-0.1 0.1-0.2 0.1-0.3 0.1H8.1c-0.1 0-0.2 0-0.3-0.1 -0.1-0.1-0.1-0.2-0.1-0.3v-3.8c0-0.1 0-0.2 0.1-0.3 0.1-0.1 0.2-0.1 0.3-0.1h5.7c0.1 0 0.2 0 0.3 0.1 0.1 0.1 0.1 0.2 0.1 0.3v3.8C14.3 15.9 14.2 16 14.1 16.1M6.5 10.4c-0.1 0.1-0.2 0.1-0.3 0.1H5.3c-0.1 0-0.2 0-0.3-0.1 -0.1-0.1-0.1-0.2-0.1-0.3V9.1c0-0.1 0-0.2 0.1-0.3 0.1-0.1 0.2-0.1 0.3-0.1h0.9c0.1 0 0.2 0 0.3 0.1C6.6 8.9 6.7 9 6.7 9.1v0.9C6.7 10.2 6.6 10.3 6.5 10.4M6.5 13.2c-0.1 0.1-0.2 0.1-0.3 0.1H5.3c-0.1 0-0.2 0-0.3-0.1 -0.1-0.1-0.1-0.2-0.1-0.3v-0.9c0-0.1 0-0.2 0.1-0.3 0.1-0.1 0.2-0.1 0.3-0.1h0.9c0.1 0 0.2 0 0.3 0.1 0.1 0.1 0.1 0.2 0.1 0.3v0.9C6.7 13 6.6 13.1 6.5 13.2M6.5 16.1c-0.1 0.1-0.2 0.1-0.3 0.1H5.3c-0.1 0-0.2 0-0.3-0.1 -0.1-0.1-0.1-0.2-0.1-0.3v-0.9c0-0.1 0-0.2 0.1-0.3 0.1-0.1 0.2-0.1 0.3-0.1h0.9c0.1 0 0.2 0 0.3 0.1 0.1 0.1 0.1 0.2 0.1 0.3v0.9C6.7 15.9 6.6 16 6.5 16.1"/></svg>';

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main row" role="main">

		<?php if ( have_posts() ) : ?>

			<?php 
				$cpt_portfolio = get_post_type_object( 'projects' );
				$portfolio_description = $cpt_portfolio->description;
			?>
			<?php 
				$args = array(
				    'orderby'           => 'name', 
				    'order'             => 'ASC',
				    'hide_empty'        => true, 
				    'exclude'           => array(), 
				    'exclude_tree'      => array(), 
				    'include'           => array(),
				    'number'            => '', 
				    'fields'            => 'all', 
				    'slug'              => '',
				    'parent'            => '',
				    'hierarchical'      => true, 
				    'child_of'          => 0,
				    'childless'         => false,
				    'get'               => '', 
				    'name__like'        => '',
				    'description__like' => '',
				    'pad_counts'        => false, 
				    'offset'            => '', 
				    'search'            => '', 
				    'cache_domain'      => 'core'
				); 
				$project_types = get_terms( 'project_type', $args );

			?>

			<header class="page-header container">
				<h1 class="col-xs-12 col-lg-8 col-lg-push-1">Our digital design portfolio</h1>
				<div class="col-xs-12 col-lg-8 col-lg-push-1"><p class="lead"><?php echo $portfolio_description; ?></p>

				<?php
				if ( ! empty( $project_types ) && ! is_wp_error( $project_types ) ){
				echo '<ul class="project-types filter">';
					foreach ( $project_types as $type ) {
				    	if ($type->parent == 0) {
								echo '<li class="pt_' . $type->slug . '">';
								if ($type->slug == 'web') echo '<span class="icon">' . $icon_web . '</span>'; 
								if ($type->slug == 'event') echo '<span class="icon">' . $icon_event . '</span>'; 
								if ($type->slug == 'brand') echo '<span class="icon">' . $icon_brand . '</span>'; 
								if ($type->slug == 'video') echo '<span class="icon">' . $icon_video . '</span>'; 
								echo '<b class="">' . $type->name . '</b></li>';
				        }
					}
					echo '</p>';
				}
				?>
				</div>

			</header><!-- .page-header -->

			<div class="container main">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-6 col-md-4 col-lg-3'); ?>>

			<?php if ( has_post_thumbnail() ) { ?>
					<figure class="excerpt">
					<a href="<?php echo get_permalink(); ?>" class="work-thumb">
					<figcaption><?php the_title(); ?></figcaption>
					<?php 
					if (class_exists('MultiPostThumbnails')) :
				    
				    if (MultiPostThumbnails::has_post_thumbnail(get_post_type(),'thumbnail-image')) {
				    	MultiPostThumbnails::the_post_thumbnail(get_post_type(),'thumbnail-image');
				    } else {
				    	echo the_post_thumbnail('medium');
				    }

					endif;

					?>
					</a>
					</figure>
				<?php }
				?>
				
				<?php 
					$project_types = get_the_terms( $post->ID, 'project_type' );

					#print_r($project_types);
					if ($project_types != '') {
						echo '<ul class="project-types">';
						foreach ($project_types as $type) {
							if ($type->parent == 0) {
								echo '<li class="pt_' . $type->slug . '">';
								if ($type->slug == 'web') echo '<span>' . $icon_web . '</span>'; 
								if ($type->slug == 'event') echo '<span>' . $icon_event . '</span>'; 
								if ($type->slug == 'brand') echo '<span>' . $icon_brand . '</span>'; 
								if ($type->slug == 'video') echo '<span>' . $icon_video . '</span>'; 
								echo '<i class="screenreader-text">' . $type->name . '</i></li>';
							}
						}
						echo '</ul>';
					}
				?> 

			</article><!-- #post-## -->

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
