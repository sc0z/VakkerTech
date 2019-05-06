<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vakkertech
 */

get_header();
?>

	<main class="vt-page__content">
        <section class="vt-hero">
            <h2><?php the_title(); ?></h2>
            <i class="fas fa-cat"></i>
        </section>
    </main>

<?php
get_footer();
