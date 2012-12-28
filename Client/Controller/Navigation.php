<?php

/**
 * Plex Client Navigation Controller
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
class Plex_Client_Controller_Navigation extends Plex_Client_ControllerAbstract
{
	/**
	 * Executes the move up command.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function moveUp()
	{
		$this->executeCommand();
	}

	/**
	 * Executes the move down command.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */	
	public function moveDown()
	{
		$this->executeCommand();
	}
	
	/**
	 * Executes the move left command.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function moveLeft()
	{
		$this->executeCommand();
	}
	
	/**
	 * Executes the move right command.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function moveRight()
	{
		$this->executeCommand();
	}
	
	/**
	 * Executes the page up command.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function pageUp()
	{
		$this->executeCommand();
	}
	
	/**
	 * Executes the page down command.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function pageDown()
	{
		$this->executeCommand();
	}

	/**
	 * Executes the next letter command.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function nextLetter()
	{
		$this->executeCommand();
	}
	
	/**
	 * Executes the previous letter command.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function previousLetter()
	{
		$this->executeCommand();
	}
	
	/**
	 * Executes the select command.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function select()
	{
		$this->executeCommand();
	}
	
	/**
	 * Executes the back command.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function back()
	{
		$this->executeCommand();
	}

	/**
	 * Executes the context menu command.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function contextMenu()
	{
		$this->executeCommand();
	}

	/**
	 * Executes the toggle OSD command.
	 *
	 * @uses Plex_Client_ControllerAbstract::executeCommand()
	 *
	 * @return void
	 */
	public function toggleOSD()
	{
		$this->executeCommand();
	}
}
