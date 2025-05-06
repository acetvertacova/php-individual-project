# Individual Project: Online Library

## 🚀 Installation and Project Launch Instructions
 
### Step 1: Installing PHP 

1. Download the latest version of PHP from the official website: https://www.php.net/downloads.
2. Add the PHP path to the environment variables (`Path`).
3. Verify the installation by running the following command in the terminal: `php -v`.

### Step 2: Launching the project

1. Cloning the repository:
   1.1 On GitHub, navigate to the main page of the repository.
   1.2 Above the list of files, click <> Code.

   <img scr="https://docs.github.com/assets/cb-13128/mw-1440/images/help/repository/code-button.webp">
   1.3 Copy the URL for the repository.
   1.4 Open Terminal, сhange the current working directory to the location where you want the cloned directory.
   1.5 Type `git clone`, and then paste the URL you copied earlier.
   1.6 Press Enter to create your local clone.
2. Navigating to the project folder in terminal: `cd [absolute-path-to-the-project-folder]`.
3. Starting the PHP server: `php -S localhost:8080 -t public/`.

## Lab's Description

This is a web-based Online Book Library system built using PHP, HTML, and Tailwind CSS. It allows users to browse, view, and search through a collection of books, while administrators have access to secure management features.

  - Authentication system with user roles (admin & user)
  - Browse and search books with details
  - Admin panel to add, edit, and delete books
  - User management (admin only)
  - Clean, responsive interface using Tailwind CSS

## Project Structure 

        php-database/
        │
        ├── db/                          # db related files
        │   ├── migrations/              # migragions for table creation
        │   └── seeds/                   # seed classes for data insertion into tables
        │
        ├── public/                      # app entry point
        │   └── index.php
        │
        ├── src/                         
        │   ├── handlers/           
        │   │   ├──auth/
        │   │   │  ├── login.php
        │   │   │  ├── signin.php
        │   │   │  └── signout.php
        │   │   │──crudWithBooks/
        │   │   │  ├── create.php
        │   │   │  ├── delete.php
        │   │   │  ├── edit.php
        │   │   │  └── show.php
        │   │   │──users/
        │   │   │  └── add.php
        │   ├── search.php  
        │   ├── helpers/           
        │   │   ├──db.php
        │   │   │──session.php
        │   │   │──validation.php
        │   ├── db.php  
        │
        ├── templates/                   # HTML templates
        │   ├── books/                    
        │   │   ├── create.php
        │   │   ├── edit.php
        │   │   ├── show.php
        │   │   ├── search.php
        │   │   └── card.php           
        │   ├── errors/
        │   │   ├── 403.php              # forbidden page
        │   │   └── 404.php              # error page
        │   ├── auth/
        │   │   ├── login.php             
        │   │   └── signin.php
        │   ├── users/
        │   │   ├── create.php             
        │   │   └── show.php 
        │   ├── layout.php
        ├── phinx.php                   # phinx configuration for migrations
        |...

### Usage Scenario

1. `Use Case:` View Books (Non-Authenticated User). `Actor:` Non-Authenticated User. `Description:` A user who is not logged in can view the list of available books and search by criteria (title, author, genre, availability).

Steps:
 - The user visits the homepage of the online library.

 <img src='/usage/home-page.png'>

 - The user can use the search feature to filter books by title, author, genre, or availability.

 <img src='/usage/search.png'>

 ```php
 function filter(string $criteria, string $value): array
{
    global $pdo;
    $allowed = ['title', 'author', 'genre', 'available'];

    if (!in_array($criteria, $allowed)) {
        echo "Not allowed criteria of search";
    }

    if ($criteria === 'available') {
        $sql = "SELECT * FROM book WHERE available = true";
        $stmt = $pdo->query($sql);
    } else {
        $sql = "SELECT * FROM book WHERE $criteria ILIKE :value";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['value' => "%$value%"]);
    }
    $books = $stmt->fetchAll();

    return $books;
}
```

 2. `Use Case:` View Books (Authenticated User - User Role). `Actor:` Authenticated User (User Role). `Description:` An authenticated user can view all available books, search for books, but cannot perform administrative actions.

Steps:
  - The user logs in with their credentials.

   <img src='/usage/signin.png'>

  - The user is greeted with a welcome message and can see the list of available books.

   <img src='/usage/greeting.png'>

3. `Use Case:` View Books (Admin User). `Actor:` Admin User. `Description:` An admin can view all available books, search for books, and perform administrative actions like adding, editing, and deleting books, as well as creating new users.

Steps:
  - The admin logs in with their credentials.
  - The admin is greeted with a welcome message.
  - The admin can see the list of available books, options for manipulating the data(edit, delete, create).

    <img src='/usage/admin.png'>

  - The admin can search for books by criteria.
  - The admin can **add** a new book:
    - The admin navigates to the "Add Book" page.
    - The admin fills in the form with the book's title, author, description, genre, and availability.
    - The admin submits the form to add the book.
    - The new book is added to the library and is visible in the book list.

  ```php
  function create($title, $author, $description, $genre, $available)
  {
      global $pdo;

      $stmt = $pdo->prepare("INSERT INTO book (title, author, description, genre, available, created_at)
      VALUES (:title, :author, :description, :genre, :available, NOW())");
      $stmt->execute([
          ':title' => $title,
          ':author' => $author,
          ':description' => $description,
          ':genre' => $genre,
          ':available' => $available,
      ]);
  }
  ```

   <img src='/usage/add.png'>

  **edit** existing book:
    - The admin clicks the "Edit" button for a book they want to edit.
    - The admin updates the book's title, author, description, genre, or availability.
    - The admin submits the form to save the changes.
    - The book details are updated in the system.

  ```php
    function update(string $title, string $author, string $description, string $genre, string $available, int $id)
  {
      global $pdo;
      $stmt = $pdo->prepare("UPDATE book SET title = :title, author = :author, description = :description, genre = :genre, available = :available, updated_at = NOW() WHERE id = :id");

      $stmt->execute([
          ':title' => $title,
          ':author' => $author,
          ':description' => $description,
          ':genre' => $genre,
          ':available' => $available,
          ':id' => $id,
      ]);
  }
  ```

   <img src='/usage/edit.png'>


  **delete** a book:
    - The admin clicks the "Delete" button next to a book.
    - The book is removed from the library.

  ```php
      function delete(int $id)
  {
      global $pdo;
      $stmt = $pdo->prepare("DELETE FROM book WHERE id = :id");
      $stmt->execute([':id' => $id]);
  }
  ```
    <img src='/usage/delete.png'>

  - The admin can create new users by navigating to the create user page and view the list of users.

    <img src='/usage/add-user.png'>

    <img src='/usage/users.png'>

### DataBase Structure

  <img src='/usage/db.png'>

**Dependencies:**

1. `permission`
- Depends on:
  - `role` 
  - `capability`
- Type: Many-to-Many (via foreign keys)
- Effect: Each role can have multiple capabilities; each capability can belong to multiple roles.

2. `users_role`
- Depends on:
  - `users` 
  - `role` 
- Type: Many-to-Many
- Effect: Each user can have multiple roles; each role can belong to multiple users.

3. Independent Tables
- These tables don't depend on others:
  - book — contains book data; not linked to users or roles.
  - users — stores user credentials.
  - role — defines roles like admin, librarian.
  - capability — defines permissions such as `"add_book"`, `"delete_user"`.

**Dependency Chain Example** 
Let’s say a user wants to edit a book:

The `user` is linked to a `role` (via users_role). The `role` is linked to a `capability` like `"edit_book"` (via permission). The app checks if the `user's roles` grant the required `capability`.

This forms a **Role-Based Access Control** (RBAC) pattern.

## Source List 

1. [Phinx] (https://phinx.org/)
2. [PHP Documentation](https://www.php.net/docs.php)
3. [Git Course](https://github.com/MSU-Courses/advanced-web-programming)


























