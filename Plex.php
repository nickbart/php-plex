<?php

/**
 * Plex Bootstrap
 *
 * This is the file to be included in your application and will bootstrap the
 * rest of what is required.
 * 
 * @category php-plex
 * @package Plex
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2
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

$phpPlexDir = dirname(__FILE__);

// Exception
require_once(sprintf('%s/Exception/ExceptionInterface.php', $phpPlexDir));
require_once(sprintf('%s/Exception/ExceptionAbstract.php', $phpPlexDir));
require_once(sprintf('%s/Exception/Machine.php', $phpPlexDir));
require_once(sprintf('%s/Exception/Server.php', $phpPlexDir));
require_once(sprintf('%s/Exception/Server/Library.php', $phpPlexDir));
// Machine
require_once(sprintf('%s/Machine/MachineInterface.php', $phpPlexDir));
require_once(sprintf('%s/Machine/MachineAbstract.php', $phpPlexDir));
// Server
require_once(sprintf('%s/Server.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/SectionAbstract.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Section/Movie.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Section/Show.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Section/Artist.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Section/Photo.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Item/Media/File/FileInterface.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Item/Media/File/File.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Item/Media/MediaInterface.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Item/Media/Media.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/ItemInterface.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/ItemAbstract.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/ItemGrandparentAbstract.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/ItemParentAbstract.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/ItemChildAbstract.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Item/Movie.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Item/Show.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Item/Season.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Item/Episode.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Item/Artist.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Item/Album.php', $phpPlexDir));
require_once(sprintf('%s/Server/Library/Item/Track.php', $phpPlexDir));
// Client
require_once(sprintf('%s/Client.php', $phpPlexDir));
require_once(sprintf('%s/Client/ControllerAbstract.php', $phpPlexDir));
require_once(sprintf('%s/Client/Controller/Navigation.php', $phpPlexDir));
require_once(sprintf('%s/Client/Controller/Playback.php', $phpPlexDir));
require_once(sprintf('%s/Client/Controller/Application.php', $phpPlexDir));

/**
 * Bootstrap class for using php-plex to interact with the Plex HTTP API.
 * 
 * @category php-plex
 * @package Plex
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2.5
 */
class Plex
{
	/**
	 * A list of Plex server machines on the network. This is defined by the 
	 * instantiating software.
	 * @var Plex_Server[]
	 */
	private static $servers = array();

	/**
	 * A list of the Plex client machines on the network This is found upon
	 * registring of Plex server. The first registered Plex server will go out
	 * and get the list of available clients and register them accordingly.
	 * @var Plex_Client[]
	 */
	private static $clients = array();
	
	/**
	 * Allows an instantiating software to define a list of Plex servers on the
	 * network. In addition, the first server listed will be used to find the
	 * list of available clients and will register them accordingly.
	 *
	 * @param array $servers An associative array of Plex server machines on the
	 * network defined thusly:
	 *
	 * array (
	 *     'server-1-name' => array(
	 *         'address' => '192.168.1.5',
	 *         'port' => 32400
	 *     ),
	 *     'server-2-name' => array(
	 *         'address' => '192.168.1.10',
	 *         'port' => 32400
	 *     )
	 * )
	 *
	 * @uses Plex::$servers
	 * @uses Plex::registerClients()
	 * @uses Plex::getServer()
	 * @uses Plex_Server::getClient()
	 *
	 * @return void
	 */
	public function registerServers(array $servers)
	{
		// Register each server.
		foreach ($servers as $name => $server) {
			$port = isset($server['port']) ? $server['port'] : NULL;
			self::$servers[$name] = new Plex_Server(
				$name,
				$server['address'],
				$port
			);
		}
		
		// We are going to use the first server in the list to get a list of the
		// availalble clients and register those automatically.
		$serverName = reset(array_keys(self::$servers));
		$this->registerClients(
			$this->getServer($serverName)->getClients()
		);
	}
	
	/**
	 * Registers each found client with the bootstrap, so they can be found and
	 * used by the instantiating software.
	 *
	 * @param Plex_Client[] $clients An associative array of Plex client machines on the
	 * network.
	 *
	 * @uses Plex::$clients
	 *
	 * @return void
	 */
   	private function registerClients(array $clients)
	{
		self::$clients = $clients;
	}
	
	/**
	 * Returns the requested server by the unique name under which it was registered.
	 *
	 * @param string $serverName The unique name of the requested server.
	 *
	 * @uses Plex::$servers
	 *
	 * @return Plex_Server The requested Plex server machine.
	 *
	 * @throws Plex_Exception_Server
	 */
	public function getServer($serverName)
	{
		if (!isset(self::$servers[$serverName])) {
			throw new Plex_Exception_Server(
				'RESOURCE_NOT_FOUND', 
				array($serverName)
			);
		}

		return self::$servers[$serverName];
	}
	
	/**
	 * Returns the requested client by the unique name under which it was registered.
	 *
	 * @param string $clientName The unique name of the requested client.
	 *
	 * @uses Plex::$clients
	 *
	 * @return Plex_Client The requested Plex client machine.
	 */
	public function getClient($clientName)
	{
		return self::$clients[$clientName];
	}
}
