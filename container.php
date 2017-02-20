<?php
/**
 * Plugin Name: WpContainerBuilder
 * Plugin URI: https://github.com/dwnload/WpContainerBuilder
 * Description:
 * Version: 0.1.0
 * Author: Austin Passy
 * Author URI: https://austin.passy.co
 * License: MIT License
 */

use Dwnload\WpContainerBuilder\WpBuilderFactory;

$factory = new WpBuilderFactory();
add_action( 'plugins_loaded', function() use ( $factory ) {
	/**
	 * Apply paths filter array.
	 *
	 * @param array $paths
	 * @param WpBuilderFactory $factory
	 *
	 * @return array
	 */
	$paths = apply_filters( 'dwnload/wp_container_builder_paths', [ __DIR__ ], $factory );
	/**
	 * Apply paths filter array.
	 *
	 * @param string $resource
	 * @param WpBuilderFactory $factory
	 *
	 * @return string
	 */
	$resource = apply_filters( 'dwnload/wp_container_builder_resource', 'services.php', $factory );

	$container = $factory->createContainer()->getContainerBuilder();

	/**
	 * Custom action when the Container Builder is loaded.
	 *
	 * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
	 * @param WpBuilderFactory $factory
	 */
	do_action( 'dwnload/wp_container_builder_loaded', $container, $factory );

	$factory->loadServicesAndCompile( $paths, $resource );
}, WpBuilderFactory::PRIORITY );
