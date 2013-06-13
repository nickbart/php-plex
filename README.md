php-plex
========

A simple PHP library for interacting with the Plex (http://plexapp.com) HTTP Control API.

Requirements
------------

php-curl  
simpleXML

What It Does
------------

Allows access to your Plex library so that you can retrieve your shows, seasons, episodes, movies, artists, albums, and tracks in a number of convenient ways.

Has simple commands for playback and navigation and also an interface for playing episodes, movies, and tracks.

What It Does Not Do
-------------------

Photos have not been implemented yet.

Playback is only implemented at the episode, movies, and track level. The plan is to implement passing a season or album to the application controller and have it play through the entire thing.

Paging has not been implemented for lists of items.

Examples
--------
	
Set Up

	require_once('path/to/Plex.php');
	
	$servers = array(
		'shepherd' => array(
			'address' => '192.168.11.9'
		)
	);
	
	$plex = new Plex();
	$plex->registerServers($servers);
	
	$server = $plex->getServer('shepherd');
	$client = $plex->getClient('zoe');

Get items at the library level
	
	// On deck and recently added items
	$server->getLibrary()->getOnDeckItems();
	$server->getLibrary()->getRecentlyAddedItems();
	
	// Sections
	$server->getLibrary()->getSections();
	$server->getLibrary()->getSection('Movies');
	$server->getLibrary()->getSection('TV Shows');
	$server->getLibrary()->getSection('Music');

Movies
	
	// Lists of movies
	$section->getAllMovies();
	$section->getUnwatchedMovies();
	$section->getRecentlyReleasedMovies();
	$section->getRecentlyAddedMovies();
	$section->getRecentlyViewedMovies();
	$section->getOnDeckMovies();
	$section->getMoviesByYear(1983);
	$section->getMoviesByDecade(1980);
	$section->getMoviesByContentRating('R');
	$section->getMoviesByResolution('1080');
	$section->getMoviesByFirstCharacter('Q');
	
	// Single movies
	
	// Exact title
	$section->getMovie('Heavy Metal in Baghdad');
	// Rating key
	$section->getMovie(83696);
	// Key
	$section->getMovie('/library/metadata/83696');	
	
	// Collections
	$section->getCollections();
	$section->getMoviesByCollection(13206);
	
	// Genres
	$section->getGenres();
	$section->getMoviesByGenre(1252);

	// Directors
	$section->getDirectors();
	$section->getMoviesByDirector(357);
	
	// Actors
	$section->getActors();
	$section->getMoviesByActor(3903);
	
	// Search
	$section->searchMovies('fly');
	
Shows, seasons, and episodes
	
	// Lists of shows
	$section->getAllShows();
	$section->getUnwatchedShows();
	$section->getShowsByFirstCharacter('Q');
	$section->getShowsByYear(1983);
	$section->getShowsByContentRating('TV-MA');
	
	// Single shows
	// Exact title
	$section->getShow('Firefly');
	// Rating key
	$section->getShow(46585);
	// Key
	$section->getShow('/library/metadata/46585');
	
	// Lists of episodes
	$section->getRecentlyAiredEpisodes();
	$section->getRecentlyAddedEpisodes();
	$section->getRecentlyViewedEpisodes();
	$section->getOnDeckEpisodes();
	
	// Single episodes
	// Exact title
	$section->getEpisode('Crucifixed');
	// Rating key
	$section->getEpisode(83780);
	// Key
	$section->getEpisode('/library/metadata/83780');
	
	// Collections
	$section->getCollections();
	$section->getShowsByCollection(13205);
	
	// Genres
	$section->getGenres();
	$section->getShowsByGenre(8196);
	
	// Search
	$section->searchShows('fly');
	$section->searchEpisodes('fly');
	
	// By show
	$show = $showSection->getShow('Peep Show');
	$seasons = $show->getSeasons();
	$seasonByIndex = $show->getSeason(2);
	$seasonByKey = $show->getSeason('/library/metadata/3112');
	$seasonByExactTitleMatch = $show->getSeason('Season 2');
	$episodes = $seasonByIndex->getEpisodes();
	$episodeByIndex = $seasonByIndex->getEpisode(4);
	$episodeByKey = $seasonByIndex->getEpisode('/library/metadata/3116');
	$episodeByExactTitleMatch = $seasonByIndex->getEpisode('University Challenge');
	
Artists, albums, and tracks
	
	// Lists of artists
	$section->getAllArtists();
	
	// Single artists
	// Exact title
	$section->getArtist('Acrassicauda');
	// Rating key
	$section->getArtist(83757);
	// Key
	$section->getArtist('/library/metadata/83757');

	// Collections
	$section->getCollections()
	$section->getArtistsByCollection(13206);
	
	// Genres
	$section->getGenres();
	$section->getArtistsByGenre(11644);

	// Albums
	$section->getAllAlbums();
	$section->getAlbumsByDecade(1980);
	$section->getAlbumsByYear(1983);
	$section->getRecentlyAddedAlbums();

	// Single tracks
	// Exact title
	$section->getTrack('Can\'t Buy Me Love');
	// Rating key
	$section->getTrack(67962);
	// Key
	$section->getTrack('/library/metadata/67962');
	
	// Search
	$section->searchArtists('fly');
	$section->searchTracks('fly');
	
	// By artist
	$artist = $artistSection->getArtist('Paolo Nutini');
	$albums = $artist->getAlbums();
	$albumByKey = $artist->getAlbum('/library/metadata/57718');
	$albumByExactTitleMatch = $artist->getAlbum('These Streets');
	$tracks = $albumByExactTitleMatch->getTracks();
	$trackByIndex = $albumByExactTitleMatch->getTrack(3);
	$trackByKey = $albumByExactTitleMatch->getTrack('/library/metadata/57726');
	$trackByExactTitleMatch = $albumByExactTitleMatch->getTrack('Rewind');	

Item Media Info

	$showSection = $library->getSection('TV Shows');
	$episode = $showSection->getShow("The Simpsons")
		->getSeason(4)
		->getEpisode(12);
	
	// Media Info
	$media = $episode->getMedia();
	$duration = $media->getDuration();
	$bitrate = $media->getBitrate();
	
	// File
	$file = reset($media->getFiles());
	$path = $file->getFile();
	$size = $file->getSize();

Playback Controller

	$playback = $client->getPlaybackController();
	$playback->play();
	$playback->pause();
	$playback->stop();
	$playback->rewind();
	$playback->fastForward();
	$playback->stepForward();
	$playback->bigStepForward();
	$playback->stepBack();
	$playback->bigStepBack();
	$playback->skipNext();
	$playback->skipPrevious();

Navigation Controller

	$navigation = $client->getNavigationController();
	$navigation->moveUp();
	$navigation->moveDown();
	$navigation->moveLeft();
	$navigation->moveRight()
	$navigation->pageUp();
	$navigation->pageDown();
	$navigation->nextLetter();
	$navigation->previousLetter();
	$navigation->select();
	$navigation->back();
	$navigation->contextMenu();
	$navigation->toggleOSD();

Application Controller

	$application = $client->getApplicationController();
	
	$episode = $section
		->getShow('It\'s Always Sunny in Philadelphia')
		->getSeason(5)
		->getEpisode(4);
	
	// Play episode from beginning
	$application->playMedia($episode);
	
	// Play epsiode from where it was last stopped
	$application->playMedia($episode, $episode->getViewOffset());
	
	// Set voume to half
	$application->setVolume(50);
