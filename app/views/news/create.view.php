<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/news.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/forms.css">
</head>
<body>

    <div class="container">
        <a class="btn-return" href="<?= ROOT ?>/">⮌ Back</a>

        <h1>Create News</h1>

        <?php if (isset($error)): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="/news/store" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="title" class="form-input" placeholder=" ">
                <label for="name" class="form-label">Title</label>
            </div>
            
            <div class="form-group">
                <input type="text" name="description" class="form-input"  placeholder=" ">
                <label for="name" class="form-label">Description</label>
            </div>

            <!-- File input -->
            <div class="form-group">
                <div class="file-input-container">
                    <label class="file-input-button">
                        Choose Image File
                        <span class="file-name" id="file-name">No file selected</span>
                        <input type="file" name="image" class="file-input" id="file-upload" accept="image/*" required>
                    </label>
                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <textarea name="content" class="form-textarea" placeholder=" "></textarea>
                <label for="content" class="form-label">Your Text</label>
            </div>

            <button type="submit" class="btn-submit">Create</button>

        </form>
    </div>

    <script>
        // Update file name display
        document.getElementById('file-upload').addEventListener('change', function(e) {
            const fileName = e.target.files.length ? e.target.files[0].name : 'No file selected';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
    
</body>
</html>