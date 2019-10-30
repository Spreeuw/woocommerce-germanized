<?php
/**
 * This file `autoload_packages.php`was generated by automattic/jetpack-autoloader.
 *
 * From your plugin include this file with:
 * require_once . plugin_dir_path( __FILE__ ) . '/vendor/autoload_packages.php';
 *
 * @package Automattic\Jetpack\Autoloader
 */

// phpcs:disable PHPCompatibility.LanguageConstructs.NewLanguageConstructs.t_ns_separatorFound
// phpcs:disable PHPCompatibility.Keywords.NewKeywords.t_namespaceFound
// phpcs:disable PHPCompatibility.Keywords.NewKeywords.t_ns_cFound

namespace Automattic\Jetpack\Autoloader;

if ( ! function_exists( __NAMESPACE__ . '\enqueue_package_class' ) ) {
	global $jetpack_packages_classes;

	if ( ! is_array( $jetpack_packages_classes ) ) {
		$jetpack_packages_classes = array();
	}
	/**
	 * Adds the version of a package to the $jetpack_packages global array so that
	 * the autoloader is able to find it.
	 *
	 * @param string $class_name Name of the class that you want to autoload.
	 * @param string $version Version of the class.
	 * @param string $path Absolute path to the class so that we can load it.
	 */
	function enqueue_package_class( $class_name, $version, $path ) {
		global $jetpack_packages_classes;

		if ( ! isset( $jetpack_packages_classes[ $class_name ] ) ) {
			$jetpack_packages_classes[ $class_name ] = array(
				'version' => $version,
				'path'    => $path,
			);
		}
		// If we have a @dev version set always use that one!
		if ( 'dev-' === substr( $jetpack_packages_classes[ $class_name ]['version'], 0, 4 ) ) {
			return;
		}

		// Always favour the @dev version. Since that version is the same as bleeding edge.
		// We need to make sure that we don't do this in production!
		if ( 'dev-' === substr( $version, 0, 4 ) ) {
			$jetpack_packages_classes[ $class_name ] = array(
				'version' => $version,
				'path'    => $path,
			);

			return;
		}
		// Set the latest version!
		if ( version_compare( $jetpack_packages_classes[ $class_name ]['version'], $version, '<' ) ) {
			$jetpack_packages_classes[ $class_name ] = array(
				'version' => $version,
				'path'    => $path,
			);
		}
	}
}

if ( ! function_exists( __NAMESPACE__ . '\autoloader' ) ) {
	/**
	 * Used for autoloading jetpack packages.
	 *
	 * @param string $class_name Class Name to load.
	 */
	function autoloader( $class_name ) {
		global $jetpack_packages_classes;

		if ( isset( $jetpack_packages_classes[ $class_name ] ) ) {
			if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				// TODO ideally we shouldn't skip any of these, see: https://github.com/Automattic/jetpack/pull/12646.
				$ignore = in_array(
					$class_name,
					array(
						'Automattic\Jetpack\JITM',
						'Automattic\Jetpack\Connection\Manager',
						'Automattic\Jetpack\Connection\Manager_Interface',
						'Automattic\Jetpack\Connection\XMLRPC_Connector',
						'Jetpack_Options',
						'Jetpack_Signature',
						'Automattic\Jetpack\Sync\Main',
						'Automattic\Jetpack\Constants',
						'Automattic\Jetpack\Tracking',
						'Automattic\Jetpack\Plugin\Tracking',
					),
					true
				);
				if ( ! $ignore && function_exists( 'did_action' ) && ! did_action( 'plugins_loaded' ) ) {
					_doing_it_wrong(
						esc_html( $class_name ),
						sprintf(
							/* translators: %s Name of a PHP Class */
							esc_html__( 'Not all plugins have loaded yet but we requested the class %s', 'jetpack' ),
							// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							$class_name
						),
						esc_html( $jetpack_packages_classes[ $class_name ]['version'] )
					);
				}
			}

			if ( file_exists( $jetpack_packages_classes[ $class_name ]['path'] ) ) {
				require_once $jetpack_packages_classes[ $class_name ]['path'];

				return true;
			}
		}

		return false;
	}

	// Add the jetpack autoloader.
	spl_autoload_register( __NAMESPACE__ . '\autoloader' );
}
/**
 * Prepare all the classes for autoloading.
 */
function enqueue_packages_e19bea951a79b82994a95b82f3268699() {
	$class_map = require_once dirname( __FILE__ ) . '/composer/autoload_classmap_package.php';
	foreach ( $class_map as $class_name => $class_info ) {
		enqueue_package_class( $class_name, $class_info['version'], $class_info['path'] );
	}
}
enqueue_packages_e19bea951a79b82994a95b82f3268699();
