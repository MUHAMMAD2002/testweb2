<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($data->title) ?></title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/news.css">
</head>
<body>

    
    <div class="container">
        <div class="show-header">
            <a class="btn-return" href="<?= ROOT ?>/">⮌ Back</a>
            <a class="btn-return" href="<?= ROOT ?>/news/edit/<?= $data->id ?>">✏️ Edit</a>
            <a class="btn-return" onclick="alert('are you shore?')" href="<?= ROOT ?>/news/delete/<?= $data->id ?>">🗑️ Delete</a>
        </div>

        <h1 class="nd-title"><?= esc($data->title) ?></h1>
        <p class="nd-date">📅 <?= esc($data->date) ?></p>
        <p class="nd-desc"><?= esc($data->description) ?></p>
        
        <img class="nd-img" src="<?= ROOT ?>/assets/images/news/<?= $data->image ?>" alt="">

        <p class="nd-text"><?= esc($data->text) ?></p>
    </div>
    
</body>
</html>