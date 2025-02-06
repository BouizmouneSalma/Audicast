<?php
namespace App\Controllers;

class PlaylistController {
    private $playlistService;

    public function __construct() {
        $this->playlistService = new \App\Services\PlaylistService();
    }

    public function index() {
        // Récupérer les playlists de l'utilisateur connecté
        $playlists = $this->playlistService->getUserPlaylists($_SESSION['user_id']);
        
        return view('playlist/index', [
            'pageTitle' => 'Mes Playlists',
            'playlists' => $playlists,
            'scripts' => ['/js/playlist.js']
        ]);
    }

    public function create() {
        $data = $_POST;
        
        // Gérer l'upload de l'image
        if (isset($_FILES['image'])) {
            $data['image'] = $this->handleImageUpload($_FILES['image']);
        }
        
        $playlist = $this->playlistService->create($data);
        
        return json_encode(['success' => true, 'playlist' => $playlist]);
    }

    public function update($id) {
        $data = $_POST;
        
        if (isset($_FILES['image'])) {
            $data['image'] = $this->handleImageUpload($_FILES['image']);
        }
        
        $playlist = $this->playlistService->update($id, $data);
        
        return json_encode(['success' => true, 'playlist' => $playlist]);
    }

    public function delete($id) {
        $this->playlistService->delete($id);
        return json_encode(['success' => true]);
    }

    private function handleImageUpload($file) {
        $uploadDir = 'uploads/playlists/';
        $filename = uniqid() . '_' . basename($file['name']);
        move_uploaded_file($file['tmp_name'], $uploadDir . $filename);
        return $uploadDir . $filename;
    }
}