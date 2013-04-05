<?php

/**
 * Plex Exception (Plexception)
 * 
 * @category php-plex
 * @package Plex_Exception
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

/**
 * Interface that defines the structure of Plex exceptions.
 * 
 * @category php-plex
 * @package Plex_Exception
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2
 */
interface Plex_ExceptionInterface
{
	/**
	 * Makes sure the type of exception being thrown is valid for the module
	 * trying to throw the exception.
	 *
	 * @param string $type The type of exception being thrown.
	 *
	 * @return boolean Whether or not the type of exception being thrown is
	 * valid for the module trying to throw the exception.
	 */
	public function isValidType($type);
	
	/**
	 * Every valid exception type should have an HTTP code with which it is
	 * associated. This method brings back said code for the given exception
	 * type.
	 * 
	 * @param string $type The type of exception being thrown.
	 *
	 * @return integer The HTTP code for the given exception type.
	 */
	public function getCodeForType($type);

	/**
	 * Every valid exception type should have a message with which it is
	 * associated. This method brings back said message for the given exception
	 * type.
	 *
	 * @param string $type The type of exception being thrown.
	 * @param mixed[] $params An array of values that will fill in variables in
	 * the message. This is used for exception messages that can not be static.
	 * 
	 * @return string The message of the exception being thrown. If parameters
	 * were passed and correclty correlated, the variables in the message will
	 * be properly filled in.
	 */
	public function getMessageForType($type, $params);

	/**
	 * Module specific exceptions will have a defined set of exception types
	 * they are allowed to throw. This method will list the valid exception
	 * types for the instantiated exception class.
	 *
	 * @return mixed[] Associative array of exception types for the
	 * instantiated exception class.
	 */
	public function getValidTypes();
}
