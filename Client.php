<?php

/**
 * Plex Client
 * 
 * @category php-plex
 * @package Plex_Client
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
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Plex_Client extends Plex_MachineAbstract
{
	/**
	 * Plex client host as returned by Plex_Server::getClients().
	 * @var string
	 */
	private $host;

	/**
	 * Plex client machine identifier  as returned by Plex_Server::getClients().
	 * @var string
	 */
	private $machineIdentifier;
	
	/**
	 * Version of Plex the client is running as returned by 
	 * Plex_Server::getClients().
	 * @var string
	 */
	private $version;
	
	/**
	 * The server that registered the client.
	 * @var Plex_server 
	 */
	private $server;
	
	/**
	 * The default port on which a Plex client listens.
	 */
	const DEFAULT_PORT = 3000;
	
	/**
	 * Sets up our Plex client using the minimum amount of data required to
	 * interact.
	 *
	 * @param string $name The name of the Plex client.
	 * @param string $address The IP address of the Plex client.
	 * @param integer $port The port on which the Plex client is listening.
	 *
	 * @uses Plex_MachineAbstract::$name
	 * @uses Plex_MachineAbstract::$address
	 * @uses Plex_MachineAbstract::$port
	 * @uses Plex_Client::DEFAULT_PORT
	 *
	 * @return void
	 */
	public function __construct($name, $address, $port)
	{
		$this->name = $name;
		$this->address = $address;
		$this->port = $port ? $port : self::DEFAULT_PORT;
	}
	
	/**
	 * Given a controller type, returns an instantiated controller object.
	 *
	 * @param string $type The type of controller to be insantiated.
	 *
	 * @uses Plex_Client_ControllerAbstract::factory()
	 * @uses Plex_Client::$name
	 * @uses Plex_Client::$address
	 * @uses Plex_Client::$port
	 * @uses Plex_Client::getServer()
	 *
	 * @return Plex_Client_ControllerAbstract The requsted controller.
	 */
	private function getController($type)
	{
		return Plex_Client_ControllerAbstract::factory(
			$type,
			$this->name,
			$this->address,
			$this->port,
			$this->getServer()
		);
	}
	
	/**
	 * Returns the navigation controller.
	 *
	 * @uses Plex_Client::getController()
	 * @uses Plex_Client_ControllerAbstract::TYPE_NAVIGATION
	 *
	 * @return Plex_Client_Controller_Navigation The navigation controller.
	 */
	public function getNavigationController()
	{
		return $this->getController(
			Plex_Client_ControllerAbstract::TYPE_NAVIGATION
		);
	}
	
	/**
	 * Returns the playback controller.
	 *
	 * @uses Plex_Client::getController()
	 * @uses Plex_Client_ControllerAbstract::TYPE_PLAYBACK
	 *
	 * @return Plex_Client_Controller_Playback The playback controller.
	 */
	public function getPlaybackController()
	{
		return $this->getController(
			Plex_Client_ControllerAbstract::TYPE_PLAYBACK
		);
	}
	
	/**
	 * Returns the application controller.
	 *
	 * @uses Plex_Client::getController()
	 * @uses Plex_Client_ControllerAbstract::TYPE_APPLICATION
	 *
	 * @return Plex_Client_Controller_Application The application controller.
	 */
	public function getApplicationController()
	{
		return $this->getController(
			Plex_Client_ControllerAbstract::TYPE_APPLICATION
		);
	}
	
	/**
	 * Returns the Plex client's name.
	 *
	 * @uses Plex_MachineAbstract::$name
	 *
	 * @return string The name of the Plex client.
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * Returns the Plex client's IP address.
	 *
	 * @uses Plex_MachineAbstract::$address
	 *
	 * @return string The IP address of the Plex client.
	 */
	public function getAddress()
	{
		return $this->address;
	}
	
	/**
	 * Returns the port on which the Plex client listens.
	 *
	 * @uses Plex_MachineAbstract::$port
	 *
	 * @return integer The port on which the Plex client listens.
	 */
	public function getPort()
	{
		return $this->port;
	}
	
	/**
	 * Returns the hostname of the Plex client.
	 *
	 * @uses Plex_Client::$host
	 *
	 * @return string The hostname of the Plex client.
	 */
	public function getHost()
	{
		return $this->host;
	}
	
	/**
	 * Sets the hostname of the Plex client.
	 *
	 * @param string $host The hostname of the Plex client.
	 *
	 * @uses Plex_client::$host
	 *
	 * @return void
	 */
	public function setHost($host)
	{
		$this->host = $host;
	}
	
	/**
	 * Returns the mac address of the Plex client.
	 *
	 * @uses Plex_Client::$machineIdentifier
	 *
	 * @return string The mac address of the Plex client.
	 */
	public function getMachineIdentifier()
	{
		return $this->machineIdentifier;
	}
	
	/**
	 * Sets the mac address of the Plex client.
	 *
	 * @param string $machineIdentifier The macc address of the Plex client.
	 *
	 * @uses Plex_Client::$machineIdentifier
	 *
	 * @return void
	 */
	public function setMachineIdentifier($machineIdentifier)
	{
		$this->machineIdentifier = $machineIdentifier;
	}
	
	/**
	 * Returns the version of the Plex software the Plex client is running.
	 *
	 * @uses Plex_Client::$version
	 *
	 * @return string The version of the Plex software the Plex client is 
	 * running.
	 */
	public function getVersion()
	{
		return $this->version;
	}
	
	/**
	 * Sets the version of the Plex software the Plex client is running.
	 *
	 * @param string $version The version of the Plex software teh Plex client 
	 * is running.
	 *
	 * @uses Plex_Client::$version
	 *
	 * @return void
	 */
	public function setVersion($version)
	{
		$this->version = $version;
	}
	
	/**
	 * Returns the server that registered the client.
	 *
	 * @uses Plex_Client::$server
	 *
	 * @return Plex_Server The server that registered the client.
	 */
	protected function getServer()
	{
		return $this->server;
	}
	
	/**
	 * Sets the server that registered the client.
	 *
	 * @param Plex_Server $server The server that registered the client.
	 *
	 * @uses Plex_Client::$server
	 *
	 * @return void
	 */
	public function setServer(Plex_Server $server)
	{
		$this->server = $server;
	}
}
