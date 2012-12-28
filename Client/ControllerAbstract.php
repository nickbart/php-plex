<?php

/**
 * Plex Client Controller
 * 
 * @category php-plex
 * @package Plex_Client
 * @subpackage Plex_Client_Controller
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 *
 * This file is part of php-plex.
 * 
 * php-plex is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * php-plex is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/**
 * Represents a Plex client on the network.
 * 
 * @category php-plex
 * @package Plex_Client
 * @subpackage Plex_Client_Controller
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
abstract class Plex_Client_ControllerAbstract extends Plex_Client
{
	/**
	 * String representing the navigation controller type.
	 */
	const TYPE_NAVIGATION = 'navigation';
	
	/**
	 * String representing the playback controller type.
	 */
	const TYPE_PLAYBACK = 'playback';
	
	/**
	 * String representing the applicaton controller type.
	 */
	const TYPE_APPLICATION = 'application';
	
	/**
	 * Returns the URL representing a Plex client controller command.
	 *
	 * @param string $controller The controller whose command is to be executed.
	 * @param string $command The command to be executed.
	 *
	 * @uses Plex_Client::getServer()
	 * @uses Plex_Client::getAddress()
	 * @uses Plex_Server::getBaseUrl()
	 *
	 * @return string The URL of the Plex client controller command.
	 */
	private function buildUrl($controller, $command)
	{
		return sprintf(
			'%s/system/players/%s/%s/%s',
			$this->getServer()->getBaseUrl(),
			$this->getAddress(),
			$controller,
			$command
		);
	}
	
	/**
	 * Using the calling class and function builds and calls the URL for the
	 * Plex client controller command.
	 *
	 * @param array $params An array of parameters that will be used to build an
	 * http query string.
	 *
	 * @uses Plex_MachineAbstract::getCallingFunction()
	 * @uses Plex_MachineAbstract::makeCall()
	 * @uses Plex_Client_ControllerAbstract::buildUrl()
	 *
	 * @return void
	 */
	protected function executeCommand($params = array())
	{
		$controller = strtolower(array_pop(explode('_', get_class($this))));
		$command = $this->getCallingFunction();
		$url = $this->buildUrl($controller, $command);
		if (count($params) > 0) {
			$url = sprintf(
				'%s?%s',
				$url,
				http_build_query($params)
			);
		}
		$this->makeCall($url);
	}
	
	/**
	 * Static factory method for instantiating and returning a child controller
	 * class.
	 *
	 * @param string $type The type of the controller to be returned.
	 * @param string $name The name of the Plex client.
	 * @param string $address The IP address of the Plex client.
	 * @param integer $port The port on which the Plex client is listening.
	 * @param Plex_Server $server The server that registered teh client.
	 *
	 * @uses Plex_Client::setServer()
	 *
	 * @return Plex_Client_ControllerAbstract The requested controller object.
	 */
	public static function factory(
		$type,
		$name,
		$address,
		$port,
		Plex_Server $server
	)
	{
		$classString = sprintf(
			'Plex_Client_Controller_%s',
			ucfirst($type)
		);
		$controller = new $classString(
			$name,
			$address,
			$port
		);
		$controller->setServer($server);
		return $controller;
	}
}
