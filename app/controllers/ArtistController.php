<?php
namespace App\Controllers;

class ArtistController {
    private $songService;
    private $artistService;

    public function __construct() {
        $this->songService = new \App\Services\SongService();
        $this->artistService = new \App\Services\ArtistService();
    }

    public function dashboard() {
        // Récupérer l'ID de l'artiste connecté
        $artistId = $_SESSION['user_id'];
        
        // Récupérer les statistiques
        $stats = $this->artistService->getStats($artistId);
        
        // Récupérer les chansons de l'artiste
        $songs = $this->songService->getArtistSongs($artistId);
        
        return view('artist/dashboard', [
            'pageTitle' => 'Tableau de bord Artiste',
            'stats' => $stats,
            'songs' => $songs,
            'scripts' => ['/js/artist.js']
        ]);
    }

    public function uploadSong() {
        try {
            $data = $_POST;
            $files = $_FILES;
            
            // Validation des fichiers
            if (!isset($files['audio']) || !isset($files['cover'])) {
                throw new \Exception('Fichiers manquants');
            }
            
            // Upload des fichiers
            $audioPath = $this->handleFileUpload($files['audio'], 'audio');
            $coverPath = $this->handleFileUpload($files['cover'], 'images');
            
            // Créer la chanson
            $songData = [
                'title' => $data['title'],
                'genre' => $data['genre'],
                'artist_id' => $_SESSION['user_id'],
                'audio_path' => $audioPath,
                'cover_path' => $coverPath
            ];
            
            $song = $this->songService->create($songData);
            
            return json_encode([
                'success' => true,
                'song' => $song
            ]);
        } catch (\Exception $e) {
            return json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function deleteSong($id) {
        try {
            $this->songService->delete($id, $_SESSION['user_id']);
            return json_encode(['success' => true]);
        } catch (\Exception $e) {
            return json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    private function handleFileUpload($file, $type) {
        $allowedAudioTypes = ['audio/mpeg', 'audio/wav'];
        $allowedImageTypes = ['image/jpeg', 'image/png'];
        
        if ($type === 'audio' && !in_array($file['type'], $allowedAudioTypes)) {
            throw new \Exception('Format audio non supporté');
        }
        
        if ($type === 'images' && !in_array($file['type'], $allowedImageTypes)) {
            throw new \Exception('Format image non supporté');
        }
        
        $uploadDir = "uploads/$type/";
        $filename = uniqid() . '_' . basename($file['name']);
        $targetPath = $uploadDir . $filename;
        
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            throw new \Exception("Erreur lors de l'upload");
        }
        
        return $targetPath;
    }
}