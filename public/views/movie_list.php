<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список фильмов</title>
    <link rel="stylesheet" href="/css/list.css">
</head>
<body>
    <h1>Список фильмов</h1>
    <a href="#" onclick="openModalAdd()" class="add-movie-button">Добавить фильм</a>
    <div class="movies-container">
        <?php foreach ($movies as $movie): ?>
            <div class="movie-card">
                <a href="#" onclick="openModalShow(<?= $movie['movieId'] ?>)">
                    <img src="<?= htmlspecialchars($movie['image']) ?>" alt="<?= htmlspecialchars($movie['name']) ?>">
                    <div class="movie-info">
                        <h2><?= htmlspecialchars($movie['name']) ?></h2>                        
                        <p>Дата выхода: <?= htmlspecialchars($movie['releaseDate']) ?></p>
                    </div>
                </a>
                <div class="movie-actions">
                    <div class="dropdown">
                        <button class="dropdown-button">⋮</button>
                        <div class="dropdown-content">
                            <a href="#" onclick="openModalShow(<?= $movie['movieId'] ?>)">Просмотр</a>
                            <a href="#" onclick="openModalEdit(<?= $movie['movieId'] ?>)">Редактировать</a>
                            <a href="?page=movies&action=delete&id=<?= $movie['movieId'] ?>" onclick="return confirm('Вы уверены?');">Удалить</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Модальное окно -->
    <div id="movieModal" class="modal">
        <div class="modal-content">            
            <div id="modalBody">Загрузка...</div>
        </div>
    </div>

    <!-- Пагинация -->
    <?php if ($totalPages > 1): ?>
        <nav>
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li>
                        <a href="?page=movies&pageNumber=1">Первая</a>
                    </li>
                    <li>
                        <a href="?page=movies&pageNumber=<?= $page - 1 ?>">Предыдущая</a>
                    </li>
                <?php endif; ?>


                <?php
                $range = 2; 
                $start = max(1, $page - $range);
                $end = min($totalPages, $page + $range);
                
                if ($start > 1): ?>
                    <li><span>...</span></li>
                <?php endif; ?>

                <?php for ($i = $start; $i <= $end; $i++): ?>
                    <li class="<?= $i === $page ? 'active' : '' ?>">
                        <a href="?page=movies&pageNumber=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($end < $totalPages): ?>
                    <li><span>...</span></li>
                <?php endif; ?>


                <?php if ($page < $totalPages): ?>
                    <li>
                        <a href="?page=movies&pageNumber=<?= $page + 1 ?>">Следующая</a>
                    </li>
                    <li>
                        <a href="?page=movies&pageNumber=<?= $totalPages ?>">Последняя</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    <?php endif; ?>

    <script src="/js/showAdd.js"></script>
    <script src="/js/showEdit.js"></script>
    <script src="/js/showShow.js"></script>
    <script src="/js/close.js"></script>
</body>
</html>
