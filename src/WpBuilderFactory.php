<?php

namespace Dwnload\WpContainerBuilder;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

/**
 * Class BuilderFactory
 *
 * @package Dwnload\WpContainerBuilder
 */
class WpBuilderFactory implements WpBuilderInterface {
	
	const PRIORITY = 99;
	
	/**
	 * ContainerBuilder Object.
	 *
	 * @var ContainerBuilder $container_builder
	 */
	private $container_builder;
	
	/**
	 * A factory for creating a service configuration for injection.
	 *
	 * @return WpBuilderFactory
	 */
	public function createContainer(): WpBuilderFactory {
		$this->setContainerBuilder( new ContainerBuilder() );
		
		return $this;
	}
	
	/**
	 * Get the cached ContainerBuilder
	 *
	 * @return ContainerBuilder
	 */
	public function getContainerBuilder(): ContainerBuilder {
		return $this->container_builder;
	}
	
	/**
	 * @param string|array $paths A path or an array of paths where to look for resources
	 * @param string $resource The resource
	 */
	public function loadServicesAndCompile( $paths = [], string $resource ) {
		$this->loadServices( $paths, $resource );
		$this->getContainerBuilder()->compile();
	}
	
	/**
	 * Set the ContainerBuilder and follow 'Fluent_interface' practices.
	 *
	 * @param ContainerBuilder $container
	 *
	 * @return ContainerBuilder
	 */
	private function setContainerBuilder( ContainerBuilder $container ): ContainerBuilder {
		$this->container_builder = $container;
		
		return $container;
	}
	
	/**
	 * Load the services from our PHP file.
	 *
	 * @param string|array $paths A path or an array of paths where to look for resources
	 * @param string $resource The resource
	 */
	private function loadServices( array $paths, string $resource ) {
		( new PhpFileLoader( $this->getContainerBuilder(), new FileLocator( $paths ) ) )
			->load( $resource );
	}
}
