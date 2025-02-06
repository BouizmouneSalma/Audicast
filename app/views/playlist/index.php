<div class="dashboard">
    <div class="dashboard-header">
        <h1>Mes Playlists</h1>
        <button class="create-btn" onclick="openModal()">
            <i class="fas fa-plus"></i>
            Créer une playlist
        </button>
    </div>

    <div class="playlist-grid" id="playlistGrid">
        <?php foreach ($playlists as $playlist): ?>
            <div class="playlist-card" data-id="<?= $playlist['id'] ?>">
                <div class="playlist-image">
                    <img src="<?= $playlist['image'] ?>" alt="<?= $playlist['name'] ?>">
                </div>
                <div class="playlist-content">
                    <h3 class="playlist-title"><?= htmlspecialchars($playlist['name']) ?></h3>
                    <p class="playlist-description"><?= htmlspecialchars($playlist['description']) ?></p>
                    <div class="playlist-actions">
                        <button class="action-btn edit-btn" onclick="openModal(<?= htmlspecialchars(json_encode($playlist)) ?>)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="action-btn delete-btn" onclick="deletePlaylist(<?= $playlist['id'] ?>)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include '_modal.php'; ?>