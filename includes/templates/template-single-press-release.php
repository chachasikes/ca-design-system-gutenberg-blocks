<?php
/*
 * Template Name: Press Release
 * Template Post Type: post
 */
?>

<?php 
	// Pull header file from theme if it exists.
	if (file_exists(get_stylesheet_directory() . '/header.php')) {
		require_once get_stylesheet_directory() . '/header.php';
	}
	if (file_exists(get_stylesheet_directory() . '/header.php')) {
		require_once get_stylesheet_directory() . '/partials/header.php';
	}	
?>
	<div id="page-container">


			<div id="main-content" class="main-content" tabindex="-1">

				<main class="main-primary">

					<?php
					while ( have_posts() ) :
						the_post();
						?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<!-- Page Title-->
						<?php
						if ( 'on' === get_post_meta( $post->ID, 'ca_custom_post_title_display', true ) ) {
							$caweb_padding = get_option( 'ca_default_post_date_display' ) ? ' pb-0' : '';

							esc_html( the_title( sprintf( '<h1 class="page-title%1$s">', $caweb_padding ), '</h1>' ) );
						}

						// if ( get_option( 'ca_default_post_date_display' ) && ! $caweb_is_page_builder_used ) {
						// 	printf( '<p class="page-date published">Published: <time datetime="%1$s">%1$s</time></p>', get_the_date( 'M d, Y' ) );
						// }

						print '<div class="entry-content">';

						the_content();


						print '</div>';

						?>


					</article>

					<?php endwhile; ?>

				</main>

		</div>
	</div>

	<?php get_footer(); ?>