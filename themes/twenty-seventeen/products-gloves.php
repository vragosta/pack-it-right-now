<?php
/**
 * Template for displaying the glove archive.
 *
 * @package PackItRightNow - Twenty Seventeen
 * @since 0.1.0
 */

namespace PackItRightNow;

# Get post type description.
$description = get_post_type_description( GLOVE_POST_TYPE );

# Get all taxonomies of the glove post type.
$taxonomies = get_taxonomies_by_post_type( GLOVE_POST_TYPE );

get_header(); ?>

<div class="archive glove">
	<div class="preface row">
		<div class="container">
			<div class="col-xs-12 col-sm-6">
				<h2>Gloves</h2>
				<?php if ( ! is_null( $description ) ) { ?>
					<p><?php echo esc_html( $description ); ?></p>
				<?php } ?>
			</div>
			<div class="col-xs-12 col-sm-6">
				<ul>
					<?php foreach( $taxonomies as $taxonomy ) { ?>
						<li><a href="#<?php echo esc_attr( $taxonomy->name ); ?>"><?php echo esc_html( $taxonomy->label ); ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>

	<?php foreach( $taxonomies as $taxonomy ) { ?>
		<?php $terms = get_terms( $taxonomy->name ); ?>

		<div class="content row">
			<div class="taxonomy-header row">
				<div class="container">
					<div class="col-xs-12">
						<h2 id="<?php echo esc_attr( $taxonomy->name ); ?>" class="anchor"><?php echo esc_html( $taxonomy->label ); ?></h2>
					</div>
				</div>
			</div>

			<?php foreach( $terms as $term ) { ?>
				<?php $term_ids = get_accessories( $taxonomy->name, $term->slug ); ?>

				<?php if ( ! empty( $term_ids ) ) { ?>

					<div class="content-header row">
						<div class="container">
							<div class="col-xs-12 col-sm-6">
								<h3><?php echo esc_html( $term->name ); ?></h3>
							</div>
							<div class="col-xs-12 col-sm-6">
								<?php if ( $term->description ) { ?>
									<p><?php echo esc_html( $term->description ); ?></p>
								<?php } ?>
							</div>
						</div>
					</div>

					<div class="container">

						<?php foreach( $term_ids as $term_id ) { ?>
							<?php $featured_image = get_featured_image( $term_id ); ?>
							<?php $title = get_the_title( $term_id ); ?>

							<div class="content-item col-xs-12 col-sm-4">
								<figure class="image">
									<div class="source" style="background-image: url( <?php echo esc_url( $featured_image ); ?> );"></div>
								</figure>
								<h4><?php echo esc_html( $title ); ?></h4>
							</div>

						<?php } ?>

					</div>

				<?php } ?>

			<?php } ?>

		</div>

	<?php } ?>

</div>

<?php get_footer(); ?>
