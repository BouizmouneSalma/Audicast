<?php
//best practice 
namespace App\Controllers;

class HomeController {
    private $playlistService;

    public function __construct() {
        $this->playlistService = new \App\Services\PlaylistService();
    }

    public function index() {
        // Récupérer les playlists depuis le service
        $playlists = $this->playlistService->getFeaturedPlaylists();

        // Rendre la vue avec les données
        return view('home/index', [
            'pageTitle' => 'MusicStream - Accueil',
            'playlists' => $playlists,
            'scripts' => ['/js/home.js']
        ]);
    }
}
