<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить фильм</title>
    <link rel="stylesheet" href="/css/add.css">
</head>
<body>
    <div class="container">
        <form action="?page=movies&action=add" method="post" enctype="multipart/form-data">
            <h1>Добавить фильм</h1>
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <p>
                <label for="name">Название фильма:</label>
                <input type="text" name="name" id="name" required maxlength="200">
            </p>
            <p>
                <label for="releaseDate">Дата выхода:</label>
                <input type="date" name="releaseDate" id="releaseDate" required>
            </p>
            <p>
                <label for="image">Постер фильма:</label>
                <input type="file" name="image" id="image" accept=".png, .jpg, .jpeg" required>
            </p>
            <p>
                <label for="description">Описание фильма:</label>
                <textarea name="description" id="description" rows="4">

                </textarea>
            </p>
            <button class="add" type="submit">Добавить</button>
        </form>
    </div>

    <script src="/js/close.js"></script>
</body>
</html>
