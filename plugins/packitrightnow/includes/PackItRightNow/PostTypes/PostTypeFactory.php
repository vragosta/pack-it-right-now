<?php

namespace PackItRightNow\PostTypes;

/**
 * PostTypeFactory creates the post type objects and registers them with
 * WordPress. The instance are also cached here for later lookup.
 *
 * NOTE: The PostTypeFactory determines what post types are 'available'
 * by default. When adding new post types you need to declare them as
 * supported by default by adding them to the get_supported_post_types()
 * method.
 */
class PostTypeFactory {

	public $post_types = array();

	/**
	 * Creates a post type object and saves it locally. Subsequent
	 * lookups use the local instance.
	 *
	 * @param string The post type name
	 */
	public function build( $post_type ) {
		if ( $this->exists( $post_type ) ) {
			return $this->post_types[ $post_type ];
		} else {
			switch ( $post_type ) {
				case POST_POST_TYPE:
					$instance = new PostPostType();
					break;
				case PAGE_POST_TYPE:
					$instance = new PagePostType();
					break;
				case ACCESSORY_POST_TYPE:
					$instance = new AccessoryPostType();
					break;
				case CLOTHING_POST_TYPE:
					$instance = new ClothingPostType();
					break;
				case KITCHEN_POST_TYPE:
					$instance = new KitchenPostType();
					break;
				case PACKAGE_POST_TYPE:
					$instance = new PackagePostType();
					break;

				default:
					throw new \Exception(
						"PostTypeFactory - Unknown PostType: $post_type"
					);
			}
			$instance->register();
			$this->post_types[ $post_type ] = $instance;
			return $instance;
		}
	}

	/**
	 * Builds all supported post type objects.
	 */
	public function build_all() {
		foreach ( $this->get_supported_post_types() as $post_type ) {
			$this->build( $post_type );
		}
	}

	/**
	 * Checks if a post type was previously created.
	 *
	 * @return bool When the post type was created previously
	 */
	public function exists( $post_type ) {
		return ! empty( $this->post_types[ $post_type ] );
	}

	/**
	 * The post types supported by default. Themes can override this by
	 * using the packitrightnow_post_types filter.
	 *
	 * @return array List of supported post type names
	 */
	public function get_supported_post_types() {
		$post_types = array(
			POST_POST_TYPE,
			PAGE_POST_TYPE,
			ACCESSORY_POST_TYPE,
			CLOTHING_POST_TYPE,
			KITCHEN_POST_TYPE,
			PACKAGE_POST_TYPE
		);

		$post_types = apply_filters( 'packitrightnow_post_types', $post_types );
		return $post_types;
	}
}
