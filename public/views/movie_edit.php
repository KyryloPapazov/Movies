<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать фильм</title>
    <link rel="stylesheet" href="/css/edit.css">
</head>
<body>
    <div class="container">
        <span class="close-btn" onclick="closeModal()">&times;</span> <!-- Кнопка закрытия -->
        <form action="?page=movies&action=edit&id=<?= $movie['movieId'] ?>" method="post" enctype="multipart/form-data">
        <h1>Редактировать фильм</h1>
        
            <p>
                <label for="name">Название фильма:</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($movie['name']) ?>" required maxlength="200">
            </p>
            <p>
                <label for="releaseDate">Дата выхода:</label>
                <input type="date" name="releaseDate" id="releaseDate" value="<?= htmlspecialchars($movie['releaseDate']) ?>" required>
            </p>
            <p>
                <label for="image">Постер фильма (оставьте пустым, чтобы не менять):</label>
                <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg">
            </p>
            <p>
                <label for="description">Описание фильма:</label>
                <textarea name="description" id="description" rows="4"><?= htmlspecialchars($movie['description']) ?></textarea>
            </p>
            <button class="edit" type="submit">Сохранить изменения</button>
        </form>
    </div>
    <script>

    </script>
</body>
</html>
