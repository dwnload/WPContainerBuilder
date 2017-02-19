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
	$paths    = apply_filters( 'dwnload/wp_container_builder_paths', '', $factory );
	$resource = apply_filters( 'dwnload/wp_container_builder_resource', '', $factory );

	$container = $factory->createContainer()->getContainerBuilder();

	/**
	 * @var \Symfony\Component\DependencyInjection\ContainerBuilder $container
	 */
	do_action( 'dwnload/wp_container_builder_loaded', $container, $factory );

	$factory->loadServicesAndCompile( $paths, $resource );
}, WpBuilderFactory::PRIORITY );
