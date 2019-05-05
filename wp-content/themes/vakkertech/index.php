<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package vakkertech
 */

get_header();
?>
    <main class="vt-page__content">
        <section class="vt-hero">
            <h2><?php bloginfo( 'name' ); ?></h2>
            <i class="fas fa-cat"></i>
        </section>
    </main>
<?php
get_footer();
