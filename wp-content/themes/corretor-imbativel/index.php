<?php
/**
 * Fallback template. The landing page itself lives in front-page.php.
 *
 * @package Corretor_Imbativel
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main class="ci-container" style="padding: 4rem 0;">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<div><?php the_content(); ?></div>
			</article>
		<?php endwhile; ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Nada encontrado.', 'corretor-imbativel' ); ?></p>
	<?php endif; ?>
</main>
<?php
get_footer();
