<?php
	/**
	 * The template for displaying archive pages
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
	 *
	 * @package WordPress
	 * @subpackage Twenty_Twenty_One
	 * @since Twenty Twenty-One 1.0
	 */

	get_header(); 

	$arg = array(
		'post_type' => 'events',
		'posts_per_page' => -1,
		'post_status' => 'publish'
	);
	$events = new WP_Query($arg); ?>
	
	<div class="container mt-5">
        <div class="row">
        	<header class="page-header alignwide">
				<?php the_archive_title( '<h3 class="page-title">', '</h3>' ); ?>
			</header><!-- .page-header -->
	<?php
		if($events->have_posts()){
			while($events->have_posts()) : $events->the_post(); ?>
				<div class="evets-archive">
					<h4 class="fs-5 mt-4"><?php the_title(); ?></h4>
					<?php the_content(); ?>
				</div>
				<?php endwhile; 
					wp_reset_postdata();
			}else{
				echo esc_html('Sorry, no posts matched your criteria.');
			}
		?>

		</div>
	</div>

<?php get_footer();
