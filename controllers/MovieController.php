<?php 
require_once '../config/db.php';
require_once '../models/Movie.php';
require_once '../config/config.php';

class MovieController
{
    private $movieModel;

    public function __construct()
    {
        global $pdo;
        $this->movieModel = new Movie($pdo);
    }

    public function index($page = 1)
    {
        $limit = 2;
        $offset = ($page -1) * $limit;
        $movies = $this->movieModel->getAllMovies($limit, $offset);
        $totalMovies = $this->movieModel->getMoviesCount();
        $totalPages = ceil($totalMovies / $limit);
        require '../public/views/movie_list.php';
    }

    public function show($id)
    {
        $movie = $this->movieModel->getMovieById($id);
        if (!$movie) {
            die('Not found this movies');
        }
        require '../public/views/movie_show.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $releaseDate = $_POST['releaseDate'];
            $image = $_FILES['image'];

            $errors = $this->validateMovie($name, $releaseDate, $image);

            if (empty($errors)) {
                $imagePath = $this->uploadImage($image);
                if ($imagePath) {
                    $this->movieModel->addMovie($name, $description, $releaseDate, $imagePath);
                    header('Location: index.php?page=movies');
                    exit();
                } else {
                    $errors[] = "Error load image";
                }
            } 
        }
        require '../public/views/movie_add.php';
    }

    public function edit($id)
    {
        $movie = $this->movieModel->getMovieById($id);
        if (!$movie) {
            die('Фильм не найден.');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $releaseDate = $_POST['releaseDate'];
            $image = $_FILES['image'];

            $errors = $this->validateMovie($name, $releaseDate, $image, true);

            if (empty($errors)) {
                $imagePath = $movie['image'];
                if (!empty($image['name'])){
                    $uploadedImagePath = $this->uploadImage($image);
                    if ($uploadedImagePath) {
                        $imagePath = $uploadedImagePath;
                    } else {
                        $errors[] = 'Error load image';
                    }
                }
                if (empty($errors)) {
                    $this->movieModel->updateMovie($id, $name, $description, $releaseDate, $imagePath);
                    header('Location: index.php?page=movies');
                    exit();
                }
            }
        }
        require '../public/views/movie_edit.php';
    }

    public function delete($id)
    {
        $this->movieModel->deleteMovie($id);
        header('Location: index.php?page=movies');
    }

    private function validateMovie($name, $releaseDate, $image, $isEdit = false)
    {
        $errors = [];

        // Валидация названия фильма
        if (empty($name) || strlen($name) > 200) {
            $errors[] = 'The name of the film must be filled in and not exceed 200 characters.';
        }

        // Валидация даты выхода
        if (empty($releaseDate)) {
            $errors[] = 'The release date must be filled.';
        }

        // Валидация изображения
        if (!$isEdit || !empty($image['name'])) {
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = pathinfo($image['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
                $errors[] = 'Acceptable image formats: jpg, jpeg, png.';
            }

            if ($image['size'] > 2 * 1024 * 1024) {
                $errors[] = 'The size of the image should not exceed 2 MB';
            }
        }

        return $errors;
    }

    private function uploadImage($image)
    {
        $uploadDir = '../public/storage/';
        $fileName = uniqid() . '-' . basename($image['name']);
        $targetFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            return '/storage/' . $fileName;
        }

        return false;
    }
}