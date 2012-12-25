<?php

/**
 * Plex Server Library Artist Section
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
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
 * Class that represents a Plex library artist section and makes available the
 * retrieval of library child and grandchild music items.
 * 
 * @category php-plex
 * @package Plex_Server
 * @subpackage Plex_Server_Library
 * @author <nickbart@gmail.com> Nick Bartkowiak
 * @copyright (c) 2012 Nick Bartkowiak
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public Licence (GPLv3)
 * @version 0.0.1
 */
class Plex_Server_Library_Section_Artist
	extends Plex_Server_Library_SectionAbstract
{
	/**
	 * Endpoint for retrieving albums.
	 */
	const ENDPOINT_CATEGORY_ALBUM = 'albums';
	
	/**
	 * Endpoint for retrieving albums by decade.
	 */
	const ENDPOINT_CATEGORY_DECADE = 'decade';	

	/**
	 * Returns all the artists for the given section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getAllItems()
	 *
	 * @return Plex_Server_Library_Item_Artist[] An array of artists.
	 */
	public function getAllArtists()
	{
		return $this->getAllItems();
	}
	
	/**
	 * Returns all the albusm for the given section.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_Section_Artist::ENDPOINT_CATEGORY_ALBUM
	 *
	 * @return Plex_Server_Library_Item_Album[] An array of albums.
	 */
	public function getAllAlbums()
	{
		return $this->getItems(
			$this->buildEndpoint(
				self::ENDPOINT_CATEGORY_ALBUM
			)
		);
	}
	
	/**
	 * Returns all the artists categorized under a given genre.
	 *
	 * @param integer $genreKey Key that represents the genre by which the 
	 * artists will be retrieved. The genre key can be discovered by using the 
	 * getGenres() method from the parent class.
	 * 
	 * @uses Plex_Server_Library_SectionAbstract::getItemsByGenre()
	 * 
	 * @return Plex_Server_Library_Item_Artist[] An array of artists.
	 */
	public function getArtistsByGenre($genreKey)
	{
		return $this->getItemsByGenre($genreKey);
	}
	
	/**
	 * Returns all the albums from a given four digit decade.
	 *
	 * @param integer $decade Four digit decade by which the albums will be 
	 * retrieved.
	 * 
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildEndpoint()
	 * @uses Plex_Server_Library_Section_Artist::ENDPOINT_CATEGORY_DECADE
	 * 
	 * @return Plex_Server_Library_Item_Album[] An array of albums.
	 */
	public function getAlbumsByDecade($decade)
	{
		return $this->getItems(
			$this->buildEndpoint(
				sprintf(
					'%s/%d',
					self::ENDPOINT_CATEGORY_DECADE,
					$decade
				)
			)
		);
	}
	
	/**
	 * Returns all the albums from a given four digit year.
	 *
	 * @param integer $year Four digit year by which the albums will be 
	 * retrieved.
	 * 
	 * @uses Plex_Server_Library_SectionAbstract::getItemsByYear()
	 * 
	 * @return Plex_Server_Library_Item_Album[] An array of albums.
	 */
	public function getAlbumsByYear($year)
	{
		return $this->getItemsByYear($year);
	}

	/**
	 * Returns all the artists contained in a given collection.
	 *
	 * @param integer $collectionKey Key that represents the collection by which
	 * the artists will be retrieved. The genre key can be discovered by using
	 * the getGenres() method from the parent class.
	 * 
	 * @uses Plex_Server_Library_SectionAbstract::getItemsByCollection()
	 * 
	 * @return Plex_Server_Library_Item_Artist[] An array of artists.
	 */
	public function getArtistsByCollection($collectionKey)
	{
		return $this->getItemsByCollection($collectionKey);
	}
	
	/**
	 * Returns an array of albums recently added to the section.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getRecentlyAddedSectionItems()
	 *
	 * @return Plex_Server_Library_Item_Album[] An array of albums.
	 */
	public function getRecentlyAddedAlbums()
	{
		return $this->getRecentlyAddedSectionItems();
	}
	
	/**
	 * Searches artist titles for the passed query and returns the artists that
	 * match.
	 *
	 * @param string $query The search term against which the artists will be
	 * matched.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildSearchEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::SEARCH_TYPE_ARTIST
	 *
	 * @return Plex_Server_Library_Item_Artist[] An array of artist objects.
	 */
	public function searchArtists($query)
	{
		return $this->getItems(
			$this->buildSearchEndpoint(
				Plex_Server_Library_SectionAbstract::SEARCH_TYPE_ARTIST,
				$query
			)
		);
	}

	/**
	 * Searches track titles for the passed query and returns the tracks that
	 * match.
	 *
	 * @param string $query The search term against which the tracks will be
	 * matched.
	 *
	 * @uses Plex_Server_Library::getItems()
	 * @uses Plex_Server_Library_SectionAbstract::buildSearchEndpoint()
	 * @uses Plex_Server_Library_SectionAbstract::SEARCH_TYPE_TRACK
	 *
	 * @return Plex_Server_Library_Item_Track[] An array of track objects.
	 */
	public function searchTracks($query)
	{
		return $this->getItems(
			$this->buildSearchEndpoint(
				Plex_Server_Library_SectionAbstract::SEARCH_TYPE_TRACK,
				$query
			)
		);
	}
	
	/**
	 * Returns a single artist by its rating key, key, or exact title match.
	 *
	 * @param integer|string $polymorphicData Either a rating key, a key, or a
	 * title for an exact title match that will be used to retrieve a single
	 * artist.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getPolymorphicItem()
	 *
	 * @retrun Plex_Server_Library_Item_Artist A Plex library artist object.
	 */
 	public function getArtist($polymorphicData)
	{
		return $this->getPolymorphicItem($polymorphicData);
	}
	
	/**
	 * Returns a single track by its rating key, key, or exact title match.
	 *
	 * @param integer|string $polymorphicData Either a rating key, a key, or a
	 * title for an exact title match that will be used to retrieve a single
	 * track.
	 *
	 * @uses Plex_Server_Library_SectionAbstract::getPolymorphicItem()
	 *
	 * @retrun Plex_Server_Library_Item_Track A Plex library track object.
	 */
 	public function getTrack($polymorphicData)
	{
		return $this->getPolymorphicItem($polymorphicData);
	}
}
