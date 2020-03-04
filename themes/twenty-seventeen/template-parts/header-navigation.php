<?php
/**
 * Main header navigation for both desktop and mobile designs.
 *
 * @package PackItRightNow - Twenty Seventeen
 * @since 0.1.0
 */

namespace PackItRightNow;

$admin_user = get_user_by( 'login', 'jserianni' );
$phone = get_user_meta( $admin_user->ID, '_phone', true );

$post_types = get_supported_post_types();

?>

<header class="header">
	<div class="container">
		<a href="<?php echo home_url(); ?>" class="logo">
			<img src="<?php echo PACKITRIGHTNOW_TEMPLATE_URL . '/assets/images/PIR_LOGO_2017_LARGER_WHITE_BOX.png'; ?>" style="width: 300px" />
		</a>

		<div class="header-information">
			<p>Call : <a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></p>
			<p>Email : <a href="mailto:packitrightnow@gmail.com">packitrightnow@gmail.com</a></p>
		</div>
	</div>
	<div class="row menu-container">
		<nav class="menu container">
			<a href="<?php echo home_url(); ?>">Home</a>

			<?php foreach( $post_types as $post_type ) { ?>
				<?php $taxonomy = reset( get_taxonomies_by_post_type( $post_type->name ) ); ?>
				<?php $parent_terms = get_parent_terms( $taxonomy->name ); ?>

				<!-- Patch fix for misc -->
				<?php if ($post_type->name === MISCELLANEOUS_POST_TYPE) : ?>
					<?php continue; ?>
				<?php endif; ?>

				<?php if ( ! empty( $parent_terms ) ) { ?>
					<a href="<?= home_url(strtolower($post_type->labels->menu_name)); ?>">
						<?php echo esc_html( $post_type->label ); ?>
					</a>
				<?php } ?>

			<?php } ?>

			<a href="<?php echo home_url( '/about/' ); ?>">About Us</a>
			<a href="<?php echo home_url( '/contact/' ); ?>">Contact Us</a>
		</nav>
		<i class="ion ion-navicon drop-down"></i>
	</div>
</header>
