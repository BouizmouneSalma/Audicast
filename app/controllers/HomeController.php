<?php
//best practice 
namespace App\Controllers;

class HomeController {
    private $playlistService;

    public function __construct() {
        $this->playlistService = new \App\Services\PlaylistService();
    }

    public function index() {

        $playlists = $this->playlistService->getFeaturedPlaylists();

        return view('home/index', [
            'pageTitle' => 'MusicStream - Accueil',
            'playlists' => $playlists,
            'scripts' => ['/js/home.js']
        ]);
    }
}
