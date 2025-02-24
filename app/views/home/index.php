<section class="hero">
    <div class="hero-content">
        <h1>La musique pour tous</h1>
        <p>Des millions de titres à portée de main. Sans publicité.</p>
        <a href="#explore" class="btn">Explorer la musique</a>
    </div>
</section>

<?php include '../app/views/partials/_search.php'; ?>

<section class="playlists">
    <h2>Playlists en vedette</h2>
    <div class="playlist-grid">
        <?php foreach ($playlists as $playlist): ?>
            <div class="playlist-card">
                <div class="playlist-image">
                    <img src="<?= $playlist['image'] ?>" alt="<?= $playlist['title'] ?>">
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div>
                <h3><?= $playlist['title'] ?></h3>
            </div>
        <?php endforeach; ?>
    </div>
</section>