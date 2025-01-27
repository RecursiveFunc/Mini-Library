# Mini-Library
 
# Mini Library Management System

## Introduction
The Mini Library Management System is a lightweight web-based application that allows users to manage their book collection effectively. Users can add books, categorize them by genres, update their reading status, and search for specific books. The project is built using PHP and MySQL for the backend, and HTML/CSS with Bootstrap for the frontend, and little bit JavaScript for read data.

---

## Features
1. **Add and Manage Books**: Add books with details like title, author, genres, synopsis, and start reading date.
2. **Update Reading Status**: Mark books as "Want to Read," "Reading," or "Finished Reading" along with the finish date.
3. **Search Functionality**: Search books by title in a dropdown preview.
4. **Categorize by Genre**: Books can be categorized and displayed with their respective genres.
5. **Responsive Design**: The application adapts to various screen sizes.
6. **Dynamic Dropdown for Search Results**: Displays book details in a dropdown as you type in the search field.

---

## Screenshots

### Main Dashboard
![Main Dashboard](/images/main-dashboard.png)

### Search Functionality
![Search Dropdown](/images/dropdown-menu.png)

### Book Details
![Book Details](/images/detailed-info.png)

---

## Database Setup

### Required Tables
To use the Mini Library Management System, create the following tables in your database:

#### 1. `books`
```sql
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    penulis VARCHAR(255) NOT NULL,
    status ENUM('Ingin Dibaca', 'Sedang Dibaca', 'Selesai Dibaca') NOT NULL DEFAULT 'Ingin Dibaca',
    sinopsis TEXT,
    tgl_mulai_baca DATE,
    tgl_selesai_baca DATE
);
```

#### 2. `genres`
```sql
CREATE TABLE genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_genre VARCHAR(255) NOT NULL
);
```

#### 3. `books_genres`
```sql
CREATE TABLE books_genres (
    book_id INT NOT NULL,
    genre_id INT NOT NULL,
    PRIMARY KEY (book_id, genre_id),
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE,
    FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE CASCADE
);
```

#### 2. `users`
```sql
CREATE TABLE genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

---

## Installation
Follow these steps to implement the Mini Library Management System on your local device:

### 1. Requirements
- **XAMPP/WAMP/MAMP**: A local web server with PHP and MySQL support.
- **Browser**: Any modern browser (e.g., Chrome, Firefox).

### 2. Setup Steps
1. **Clone or Download the Project**:
   ```bash
   git clone https://github.com/your-repo/mini-library.git
   ```
2. **Move the Project to the Server**:
   Copy the project folder to the `htdocs` directory in XAMPP (or equivalent in other tools).

3. **Import the Database**:
   - Open `phpMyAdmin`.
   - Create a new database (e.g., `mini_library`).
   - Import the `mini_library.sql` file from the project folder.

4. **Configure Database Connection**:
   Update the `dbconn.php` file with your database credentials:
   ```php
   $conn = new mysqli("localhost", "username", "password", "mini_library");
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ```

5. **Run the Application**:
   Open your browser and navigate to:
   ```
   http://localhost/mini-library
   ```

---

## Usage
- **Add Books**: Navigate to the "Add Book" section and fill in the required details.
- **Search Books**: Use the search bar in the header to find books by title.
- **Update Status**: View a book's details and update its status (e.g., mark as finished).

---

## Contributing
Feel free to fork the repository and submit pull requests for new features or bug fixes. Contributions are always welcome!

---

## License
This project is licensed under the MIT License.

