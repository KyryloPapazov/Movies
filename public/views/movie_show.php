<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Информация о фильме</title>
    <link rel="stylesheet" href="/css/show.css">
</head>
<body>
    <div class="container">
        <span class="close-btn" onclick="closeModal()">&times;</span> 
        <div class="movie-poster">
            <img src="<?= htmlspecialchars($movie['image']); ?>" alt="<?= htmlspecialchars($movie['name']) ?>">
        </div>
        <div class="movie-details">           
            <h1><?= htmlspecialchars($movie['name']) ?></h1>
            <p><strong>Дата выхода:</strong> <?= htmlspecialchars($movie['releaseDate']) ?></p>
            <p><strong>Описание:</strong> <?= htmlspecialchars($movie['description']) ?></p>
            <div class="action-links">
                <a href="#" onclick="openModalEdit(<?= $movie['movieId'] ?>)">Редактировать</a>
                <a href="?page=movies&action=delete&id=<?= $movie['movieId'] ?>" onclick="return confirm('Вы уверены?')">Удалить</a>
            </div>
        </div>
    </div>

    <script src="/js/showEdit.js"></script>
    <script src="/js/close.js"></script>
</body>
</html>
