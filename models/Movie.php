<?php 

require_once '../config/config.php';
require_once '../config/db.php';

Class Movie
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllMovies($limit, $offset)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM movie LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMovieById($idMovie)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM movie WHERE movieId = :id');
        $stmt->bindValue(':id', $idMovie, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMoviesCount()
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM movie");
        return $stmt->fetchColumn();
    }


    public function addMovie($name, $description, $releaseDate, $imagePath)
    {
        $stmt = $this->pdo->prepare('INSERT INTO movie (name, description, releaseDate, image) 
        VALUES (:name, :description, :releaseDate, :image)');
        $stmt->execute([
            ':name'=> $name,
            ':description'=> $description,
            ':releaseDate'=> $releaseDate,
            ':image'=> $imagePath,
        ]);
        return $this->pdo->lastInsertId();
    }

    public function updateMovie($idMovie, $name, $description, $releaseDate, $imagePath = null)
    {
        $sql = "UPDATE movie SET name = :name, description = :description, releaseDate = :releaseDate";
        if ($imagePath) {
            $sql .= ", image = :image";
        }
        $sql .= " WHERE movieId = :idMovie";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":description", $description);
        $stmt->bindValue(":releaseDate", $releaseDate);
        if ($imagePath) {
            $stmt->bindValue(":image", $imagePath);
        }
        $stmt->bindValue(":idMovie", $idMovie, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteMovie($idMovie)
    {
        $stmt = $this->pdo->prepare("DELETE FROM movie WHERE movieId = :movieId");
        $stmt->bindValue(":movieId", $idMovie, PDO::PARAM_INT);
        return $stmt->execute();
    }
}