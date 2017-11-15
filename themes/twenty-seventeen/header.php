<?php
/**
 * The template for displaying the header.
 *
 * @package PackItRightNow - Twenty Seventeen
 * @since 0.1.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<?php
		if ( is_front_page() ) {
			\PackItRightNow\get_partial( 'template-parts/header-navigation-front-page' );
		} else {
			\PackItRightNow\get_partial( 'template-parts/header-navigation' );
		}
	?>
