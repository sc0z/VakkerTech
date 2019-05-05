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
        <div class="jumbotron">
            <h1><?php bloginfo('title'); ?></h1>
            <p>
                <i class="fa fa-calendar"></i>
                <p>Vakker Tech is a small, family-owned and family-run business located in Newtown, PA.</p>
                <p>We started making websites professionally in 2011. We are growing our knowledge-base everyday, and are not afraid to work with the latest cutting-edge technology stacks. We currently serve local businesses in Bucks County, Montgomery County, Philadelphia County in PA, along with New Jersey, New York, and Delaware.</p>
                <p>Feel free to contact us at anytime for an estimate on your project. You’ll find that our rates are very reasonable; we enjoy what we do!</p>
                <p>We will work with you to transform your great idea into a real, working website and/or application using the technologies that make sense.</p>
            </p>
        </div>
    </main>
<?php
get_footer();
