<?php

namespace PackItRightNow\Taxonomies;

class TaxonomyFactory {

	public $taxonomies = array();

	public function build( $taxonomy ) {
		if ( $this->exists( $taxonomy ) ) {
			return $this->taxonomies[ $taxonomy ];
		} else {
			switch ( $taxonomy ) {
				case ACCESSORY_TYPE_TAXONOMY:
					$instance = new AccessoryTypeTaxonomy();
					break;
				case ALUMINUM_TYPE_TAXONOMY:
					$instance = new AluminumTypeTaxonomy();
					break;
				case CLOTHING_TYPE_TAXONOMY:
					$instance = new ClothingTypeTaxonomy();
					break;
				case KITCHEN_TYPE_TAXONOMY:
					$instance = new KitchenTypeTaxonomy();
					break;
				case GLOVE_TYPE_TAXONOMY:
					$instance = new GloveTypeTaxonomy();
					break;
				case PACKAGE_TYPE_TAXONOMY:
					$instance = new PackageTypeTaxonomy();
					break;
				case MISCELLANEOUS_TYPE_TAXONOMY:
					$instance = new MiscellaneousTypeTaxonomy();
					break;

				default:
					throw new \Exception(
						"TaxonomyFactory - Unknown Taxonomy: $taxonomy"
					);
			}

			$instance->register();
			$this->taxonomies[ $taxonomy ] = $instance;

			return $instance;
		}
	}

	public function build_all() {
		foreach ( $this->get_supported_taxonomies() as $taxonomy ) {
			$this->build( $taxonomy );
		}
	}

	public function exists( $taxonomy ) {
		return ! empty( $this->taxonomies[ $taxonomy ] );
	}

	public function get_supported_taxonomies() {
		$taxonomies = array(
			ACCESSORY_TYPE_TAXONOMY,
			ALUMINUM_TYPE_TAXONOMY,
			CLOTHING_TYPE_TAXONOMY,
			KITCHEN_TYPE_TAXONOMY,
			GLOVE_TYPE_TAXONOMY,
			PACKAGE_TYPE_TAXONOMY,
			MISCELLANEOUS_TYPE_TAXONOMY,
		);

		$taxonomies = apply_filters( 'packitrightnow_taxonomies', $taxonomies );

		return $taxonomies;
	}

}
