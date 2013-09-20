<?php
/*
 * Plugin Name: Terms Archive Support for Breadcrumbs
 * Plugin URI: http://wordpress.lowtone.nl/plugins/terms-archive-breadcrumbs/
 * Description: Assign products to brands.
 * Version: 1.0
 * Author: Lowtone <info@lowtone.nl>
 * Author URI: http://lowtone.nl
 * License: http://wordpress.lowtone.nl/license
 */
/**
 * @author Paul van der Meijs <code@lowtone.nl>
 * @copyright Copyright (c) 2013, Paul van der Meijs
 * @license http://wordpress.lowtone.nl/license/
 * @version 1.0
 * @package wordpress\plugins\lowtone\terms\archive\breadcrumbs
 */

namespace lowtone\terms\archive\breadcrumbs {

	use lowtone\ui\breadcrumbs\crumbs\Crumb;

	add_filter("lowtone_ui_breadcrumbs_trail", function($trail) {
		if (!check()) 
			return $trail;

		global $wp_query;

		$taxonomy = $wp_query->taxonomy;

		$trail["archive"] = new Crumb(array(
				Crumb::PROPERTY_TITLE => $taxonomy->label,
				Crumb::PROPERTY_URI => \lowtone\terms\archive\url($taxonomy),
				Crumb::PROPERTY_CLASS => "terms_archive",
			));

		return $trail;
	});

	// Functions

	function check() {
		return function_exists("lowtone\\terms\\archive\\isTermsArchive") && \lowtone\terms\archive\isTermsArchive();
	}

}