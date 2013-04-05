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
 * Base class for all module specific exception classes.
 * 
 * @category php-plex
 * @package Plex_Exception
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2013 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.2
 */
abstract class Plex_ExceptionAbstract extends Exception 
	implements Plex_ExceptionInterface
{
	/**
	 * List of valid exception types for the instantiated exception class.
	 * @var mixed[]
	 */
	protected $validTypes = array();

	/**
	 * The default error message if no error message can be found.
	 */
	const DEFAULT_MESSAGE = 'A system error occurred.';

	/**
	 * The default error code if no error code can be found.
	 */
	const DEFAULT_CODE = 500;

	/**
	 * If an invalid type is thrown against an exception a higher level
	 * exception will be thrown. This message is shown in that case.
	 */
	const INVALID_EXCEPTION_TYPE_MESSAGE = 'The exception type "%s" is not supported';
		
	
	/**
	 * Constructor for an exception. This makes sure the type being set up is
	 * valid, gets the code and message of the exception type and instantiates
	 * a PHP Exception object.
	 *
	 * @param string $type The type of exception being thrown.
	 * @param mixed[] $params Optional parameters that can be used to fill in 
	 * variables in the exception message.
	 *
	 * @uses Plex_ExceptionAbstract::INVALID_EXCEPTION_TYPE_MESSAGE
 	 * @uses Plex_ExceptionAbstract::DEFAULT_CODE
  	 * @uses Plex_ExceptionAbstract::DEFAULT_MESSAGE
	 * @uses Plex_ExceptionAbstract::isValidType()
	 * @uses Plex_ExceptionAbstract::getCodeForType()
	 * @uses Plex_ExceptionAbstract::getMessageForType()
	 * @uses Exception::__construct()
	 *
	 * @return void
	 */
	public function __construct($type, $params = array())
	{
		// Ensure the type is valid.
		if ($this->isValidType($type) === FALSE) {
			throw new Exception(
				sprintf(self::INVALID_EXCEPTION_TYPE_MESSAGE, $type),
				self::DEFAULT_CODE
			);
		}
		
		// Get the code for the type.
		$code = $this->getCodeForType($type);
		$code = $code ? $code : self::DEFAULT_CODE;
		
		// Get the message for the tpe.
		$message = $this->getMessageForType($type, $params);
		$message = $message ? $message : self::DEFAULT_MESSAGE;
		
		parent::__construct($message, $code);
	}

	/**
	 * Makes sure the type of exception being thrown is valid for the module
	 * trying to throw the exception.
	 *
	 * @param string $type The type of exception being thrown.
	 *
	 * @uses Plex_ExceptionAbstract::getValidTypes()
	 * 
	 * @return boolean Whether or not the type of exception being thrown is
	 * valid for the module trying to throw the exception.
	 */
	public function isValidType($type)
	{
		return in_array($type, array_keys($this->getValidTypes()));
	}
	
	/**
	 * Every valid exception type should have an HTTP code with which it is
	 * associated. This method brings back said code for the given exception
	 * type.
	 * 
	 * @param string $type The type of exception being thrown.
	 *
	 * @uses Plex_ExceptionAbstract::getValidTypes()
	 *
	 * @return integer The HTTP code for the given exception type.
	 */
	public function getCodeForType($type)
	{
		$validTypes = $this->getValidTypes();
		return isset($validTypes[$type]['code']) 
			? $validTypes[$type]['code'] : NULL;
	}
	
	/**
	 * Every valid exception type should have a message with which it is
	 * associated. This method brings back said message for the given exception
	 * type.
	 *
	 * @param string $type The type of exception being thrown.
	 * @param mixed[] $params An array of values that will fill in variables in
	 * the message. This is used for exception messages that can not be static.
	 * 
	 * @uses Plex_ExceptionAbstract::getValidTypes()
	 *
	 * @return string The message of the exception being thrown. If parameters
	 * were passed and correclty correlated, the variables in the message will
	 * be properly filled in.
	 */
	public function getMessageForType($type, $params = array())
	{
		$validTypes = $this->getValidTypes();
		$message = isset($validTypes[$type]['message']) 
			? $validTypes[$type]['message'] : NULL;

		if ($message && !empty($params)) {
			$message = vsprintf($message, $params);
		}
		
		return $message;
	}
	
	/**
	 * Module specific exceptions will have a defined set of exception types
	 * they are allowed to throw. This method will list the valid exception
	 * types for the instantiated exception class.
	 *
 	 * @uses Plex_ExceptionAbstract::$validTypes
	 *
	 * @return mixed[] Associative array of exception types for the
	 * instantiated exception class.
	 */
	public function getValidTypes()
	{
		return $this->validTypes;
	}
}
