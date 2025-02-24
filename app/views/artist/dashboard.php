<div class="dashboard">
    <header class="header">
        <h1>Tableau de bord Artiste</h1>
        <button class="upload-btn" onclick="openUploadModal()">
            <i class="fas fa-upload"></i>
            Ajouter une chanson
        </button>
    </header>

    <section class="stats">
        <div class="stat-card">
            <div class="stat-value"><?= number_format($stats['total_plays']) ?></div>
            <div class="stat-label">Écoutes totales</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?= $stats['total_songs'] ?></div>
            <div class="stat-label">Chansons</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?= $stats['total_albums'] ?></div>
            <div class="stat-label">Albums</div>
        </div>
    </section>

    <section class="songs-grid" id="songsGrid">
        <?php foreach ($songs as $song): ?>
            <div class="song-card" data-id="<?= $song['id'] ?>">
                <div class="song-image">
                    <img src="<?= $song['cover_path'] ?>" alt="<?= htmlspecialchars($song['title']) ?>">
                    <div class="play-overlay">
                        <button class="play-btn" onclick="playSong(<?= $song['id'] ?>)">
                            <i class="fas fa-play"></i>
                        </button>
                    </div>
                </div>
                <div class="song-info">
                    <h3 class="song-title"><?= htmlspecialchars($song['title']) ?></h3>
                    <div class="song-genre"><?= htmlspecialchars($song['genre']) ?></div>
                    <div class="song-actions">
                        <button class="action-btn edit-btn" onclick="editSong(<?= $song['id'] ?>)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete-btn" onclick="deleteSong(<?= $song['id'] ?>)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>

<?php include '_upload_modal.php'; ?>