<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'MusicStream' ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <?php include '../app/views/partials/_header.php'; ?>
    
    <main>
        <?= $content ?>
    </main>

    <?php include '../app/views/partials/_footer.php'; ?>
    
    <script src="/js/main.js"></script>
    <?php if (isset($scripts)) foreach($scripts as $script): ?>
        <script src="<?= $script ?>"></script>
    <?php endforeach; ?>
</body>
</html>