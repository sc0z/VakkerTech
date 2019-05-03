<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vakkertech
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/vakkertech/assets/build/icons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/wp-content/themes/vakkertech/assets/build/icons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="194x194" href="/wp-content/themes/vakkertech/assets/build/icons/favicon-194x194.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/wp-content/themes/vakkertech/assets/build/icons/android-chrome-192x192.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/wp-content/themes/vakkertech/assets/build/icons/favicon-16x16.png">
	<link rel="manifest" href="/wp-content/themes/vakkertech/assets/build/icons/site.webmanifest">
	<link rel="mask-icon" href="/wp-content/themes/vakkertech/assets/build/icons/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="/wp-content/themes/vakkertech/assets/build/icons/favicon.ico">
	<meta name="msapplication-TileColor" content="#2b5797">
	<meta name="msapplication-TileImage" content="/wp-content/themes/vakkertech/assets/build/icons/mstile-144x144.png">
	<meta name="msapplication-config" content="/wp-content/themes/vakkertech/assets/build/icons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">
	<?php wp_head(); ?>
</head>

<body <?php body_class('vt-page'); ?>>
	<div class="vt-page__wrapper">
		<header class="vt-page__header">
			<div class="vt-branding">
				<?php the_custom_logo(); ?>
			</div>

			<nav class="vt-nav vt-nav--main">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'vakkertech' ); ?></button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</nav>
		</header>
