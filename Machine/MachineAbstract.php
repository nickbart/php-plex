<?php

/**
 * Plex Machine
 * 
 * @category php-plex
 * @package Plex_Machine
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
 * Abstract base class containing methods and members for all Plex machines on
 * the network. This is used to define both Plex clients and servers.
 * 
 * @category php-plex
 * @package Plex_Machine
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
abstract class Plex_MachineAbstract implements Plex_MachineInterface
{
	/**
	 * The name of the Plex machine on the network.
	 * @var string 
	 */
	protected $name;
	
	/**
	 * The IP address  of the Plex machine on the network.
	 * @var string
	 */
	protected $address;
	
	/**
	 * The port on which the Plex machine is listening. Typically 32400 for
	 * servers and 3000 for clients.
	 * @var integer 
	 */
	protected $port;
	
	/**
	 * Returns the base URL, which will be standard for all requests made to the
	 * Plex machine.
	 *
	 * @uses Plex_MachineAbstract::$address
	 * @uses Plex_MachineAbstract::$port
	 *
	 * @return string The base URL, which will be standard for all requests made
	 * to the Plex machine.
	 */
	protected function getBaseUrl()
	{
		return sprintf(
			'http://%s:%s',
			$this->address,
			$this->port
		);
	}
	
	/**
	 * Typically the useful data returned by a Plex machine will containted in
	 * XML attributes. This allows a set of XML nodes to be passed and all the
	 * attribues extracted and returned as an associated array.
	 *
	 * @param SimpleXMLElement $xmlNodes An XML node to have its attributes
	 * converted to a useful PHP array.
	 * 
	 * @todo Make this recursive.
	 *
	 * @return array An associated array of XML attributes.
	 */
	protected function xmlAttributesToArray($xml)
	{
		if (!$xml) return false;
		
		$array = array();
		$i= 0;
		foreach($xml as $node) {
			foreach($node->attributes() as $key => $value) {
				// For abstraction, everything is casted to string. It is the
				// responsibility of the calling method to handle typing.
				$array[$i][$key] = (string) $value[0];
			}
			$i++;
		}
		return $array;
	}
	
	/**
	 * Utilizes php-curl to send a request to the passed URL and returns an XML
	 * document reprentation of the returned content.
	 *
	 * @param string $url The URL to which the request is to be made.
	 *
	 * @return SimpleXMLElement An XML document from a Plex machine.
	 */
	protected function makeCall($url)
	{
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		
		$response = curl_exec($ch);
		
		curl_close($ch);
		
		$xml = simplexml_load_string($response);
		
		return $this->xmlAttributesToArray($xml);
	}
	
	/**
	 * Universal function so any method belonging to a child class of a Plex
	 * machine can discover which fucntion called it. This is used mainly for
	 * some of our polymorphic requests as the calling function can tell us what
	 * type of item is being requested.
	 *
	 * @param integer $depth Depth defaults to 2 because 0 is this function and 
	 * 1 will be the function that asked for the calling function. This can be
	 * changed by the calling function in case a specific calling function needs
	 * to be identified. This can be handy if the original calling function goes
	 * through a number of hops on its way to identification.
	 *
	 * @return string The name of the function that called the function that
	 * issued the getCallingFunction request.
	 */
	protected function getCallingFunction($depth = 2)
	{
		$backtrace = debug_backtrace();

		return $backtrace[$depth]['function'];
	}
}
