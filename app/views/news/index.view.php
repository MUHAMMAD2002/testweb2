<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/news.css">
</head>
<body>

    <div class="container">
        <ul id="header">
            <li><a href="<?= ROOT ?>/news/create">Create +</a></li>
        </ul>

        <!-- <h2>Resent News</h2>
        <div class="rn-container">
            <div class="rn-card">
                <img src="<?= ROOT ?>/assets/images/default.jpg" alt="default">
                <h4>News Title Londons Car & animals</h4>
                <p>description of a news in London ve Car chasing the animal as it runs away...</p>
                <p>📅 Today 13:20</p>
            </div>
            <div class="rn-card">
                <img src="<?= ROOT ?>/assets/images/default.jpg" alt="default">
                <h4>News Title Londons Car & animals</h4>
                <p>description of a news in London ve Car chasing the animal as it runs away...</p>
                <p>📅 Today 13:20</p>
            </div>
            <div class="rn-card">
                <img src="<?= ROOT ?>/assets/images/default.jpg" alt="default">
                <h4>News Title Londons Car & animals</h4>
                <p>description of a news in London ve Car chasing the animal as it runs away...</p>
                <p>📅 Today 13:20</p>
            </div>
        </div> -->

        <h2>All News</h2>
        <div class="n-container">
            <?php foreach ($news as $card): ?>
                <div class="n-card">
                    <?php if ($card->image != "default.jpg"): ?>
                        <img src="<?= ROOT ?>/assets/images/news/<?= $card->image ?>" alt="default">
                    <?php endif; ?>
                    <div class="n-card-content">
                        <h3><?= esc($card->title) ?></h3>
                        <p class="nd-date"><?= $card->date ?></p>
                        <a href="<?= ROOT ?>/news/show/<?= $card->id ?>" class="btn">Read</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
</body>
</html>