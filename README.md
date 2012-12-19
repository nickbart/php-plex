php-plex
========

A simple PHP library for interacting with the Plex (http://plexapp.com) HTTP API.

Requirements
------------

php-curl  
simpleXML

Examples
--------

	$servers = array(
		'shepherd' => array(
			'host' => '192.168.11.9'
		)
	);
	
	
	$plex = new Plex();
	$plex->registerServers($servers);
	
	$server = $plex->getServer('shepherd');
	$client = $plex->getClient('zoe');


	// Library 
	$onDeck = $server->getLibrary()->getOnDeckItems();
	$recentlyAddedItems = $server->getLibrary()->getRecentlyAddedItems();
	$allSections = $server->getLibrary()->getSections();
	$movieSection = $server->getLibrary()->getSectionByKey(1);
	$showSection = $server->getLibrary()->getSectionByKey(4);
	$artistSection = $server->getLibrary()->getSectionByKey(5);
	$photoSection = $server->getLibrary()->getSectionByKey(6);
	
	// Show Section
	$allShows = $showSection->getAllShows();
	$unwatchedShows = $showSection->getUnwatchedShows();
	$recentlyAiredEpisodes = $showSection->getRecentlyAiredEpisodes();
	$recentlyAddedEpisodes = $showSection->getRecentlyAddedEpisodes();
	$recentlyViewedEpisodes = $showSection->getRecentlyViewedEpisodes();
	$onDeckEpisodes = $showSection->getOnDeckEpisodes();
	$collections = $showSection->getCollections();
	$showsByCollection = $showSection->getShowsByCollection(13205);
	$showsByFirstCharacter = $showSection->getShowsByFirstCharacter('Q');
	$genres = $showSection->getGenres();
	$showsByGenre = $showSection->getShowsByGenre(8196);
	$showsByYear = $showSection->getShowsByYear(1983);
	$showsByContentRating = $showSection->getShowsByContentRating('TV-MA');
	
	// Movie Section
	$allMovies = $movieSection->getAllMovies();
	$unwatchedMovies = $movieSection->getUnwatchedMovies();
	$recentlyReleasedMovies = $movieSection->getRecentlyReleasedMovies();
	$recentlyAddedMovies = $movieSection->getRecentlyAddedMovies();
	$recentlyViewedMovies = $movieSection->getRecentlyViewedMovies();
	$onDeckMovies = $movieSection->getOnDeckMovies();
	$collections = $movieSection->getCollections();
	$moviesByCollection = $movieSection->getMoviesByCollection(13206);
	$moviesByGenre = $movieSection->getMoviesByGenre(1252);
	$moviesByYear = $movieSection->getMoviesByYear(1983);
	$moviesByDecade = $movieSection->getMoviesByDecade(1980);
	$directors = $movieSection->getDirectors();
	$moviesByDirector = $movieSection->getMoviesByDirector(357);
	$actors = $movieSection->getActors();
	$moviesByContentRating = $movieSection->getMoviesByContentRating('R');
	$moviesByResolution = $movieSection->getMoviesByResolution('1080');
	$moviesByFirstCharacter = $movieSection->getMoviesByFirstCharacter('Q');
	
	// Artist Section
	$allArtists = $artistSection->getAllArtists();
	$allAlbums = $artistSection->getAllAlbums();
	$genres = $artistSection->getGenres();
	$artistsByGenre = $artistSection->getArtistsByGenre(11644);
	$albumsByDecade = $artistSection->getAlbumsByDecade(1980);
	$albumsByYear = $artistSection->getAlbumsByYear(1983);
	$collections = $artistSection->getCollections()
	$artistsByCollection = $artistSection->getMoviesByCollection(13207);
	$recentlyAddedAlbums = $artistSection->getRecentlyAddedAlbums();
