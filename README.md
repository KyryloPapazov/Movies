# Movie Management System

## 📋 Description

A simple PHP CRUD application for managing movies. Users can add, edit, delete, and view movie records with pagination.

This project was developed as a test assignment **without using any frameworks or third-party libraries**, following the **PSR-12** coding standard.

---

## 🚀 Features

- Movie list with pagination 
- Movie details page
- Add new movie
- Edit existing movie (retain the old poster if a new one is not selected)
- Delete movie
- Server-side form validation
- Image upload (poster) with file type validation

---

## 🛠 Technologies Used

- PHP 8+
- MySQL (InnoDB)
- PDO (for database interactions)
- HTML5 / CSS3
- File uploads handled via `move_uploaded_file`
- PSR-12 code formatting standard

---

## 🧩 Database Structure

Database name: `test_firstname_lastname`

Table `movie`:

| Field        | Type           | Description                    |
|--------------|----------------|--------------------------------|
| movieId      | INT (PK)       | Unique identifier              |
| name         | VARCHAR(200)   | Movie title                    |
| description  | TEXT           | Movie description              |
| releaseDate  | DATE           | Release date                   |
| image        | VARCHAR(255)   | Path to movie poster image     |

---

## 💾 Installation

1. Create a MySQL database named test_firstname_lastname
2. Import the provided SQL dump
3. Place the project in your server directory (e.g., htdocs)
4. Make sure PHP error_reporting is set to E_ALL
5. Open the project in your browser: http://localhost/project/

