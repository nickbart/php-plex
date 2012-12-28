<?php

/**
 * Plex Client Application Controller
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
class Plex_Client_Controller_Application extends Plex_Client_ControllerAbstract
{
	/**
	 * Given a Plex server library item, this method plays the given item on
	 * the Plex client.
	 *
	 * @param Plex_Server_Library_ItemAbstract $item The item to be played.
	 * @param integer $viewOffset The point from which to play the item in
	 * milliseconds.
	 *
	 * @uses Plex_Server_Library::ENDPOINT_LIBRARY
	 * @uses Plex_Server_Library::ENDPOINT_METADATA
	 * @uses Plex_Server_Library_ItemAbstract::getRatingKey()
	 * @uses Plex_Client::getServer()
	 * @uses Plex_Server::getBaseUrl()
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function playMedia(
		Plex_Server_Library_ItemAbstract $item,
		$viewOffset = NULL
	)
	{
		$key = sprintf(
			'/%s/%s/%d',
			Plex_Server_Library::ENDPOINT_LIBRARY,
			Plex_Server_Library::ENDPOINT_METADATA,
			$item->getRatingKey()
		);
		$params = array(
			'key' => $key,
			'path' => sprintf(
				'%s%s',
				$this->getServer()->getBaseUrl(),
				$key
			)
		);
		if ($viewOffset) {
			$params['viewOffset'] = $viewOffset;
		}
		
		$this->executeCommand($params);
	}
	
	/**
	 * Sets the volume to the given percentage level.
	 *
	 * @param integer $level The percentage level to which teh voume is to be
	 * set.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function setVolume($level)
	{
		$params = array(
			'level' => $level
		);
		
		$this->executeCommand($params);
	}
}
