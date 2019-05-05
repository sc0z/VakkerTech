<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vakkertech
 */

?>
	<footer class="vt-page__footer">
		<div class="vt-page__copyright">
			<small>&copy; 2019 VakkerTech.com. Powered by PHP <?php echo phpversion();?> and WordPress <?php bloginfo( 'version' ); ?></small>
		</div>
	</footer>
</div><!-- .vt-wrapper -->

<?php wp_footer(); ?>

</body>
</html>
