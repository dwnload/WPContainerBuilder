<?php

namespace Dwnload\WpContainerBuilder;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Interface ContainerBuilderInterface
 *
 * @package Dwnload\WPContainerBuilder
 */
interface WpBuilderInterface {
	
	/**
	 * @return ContainerBuilder
	 */
	public function getContainerBuilder(): ContainerBuilder;
}