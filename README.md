# Laboratory №5: Database

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

## Usage Examples


## Source List 

1. [Phinx] (https://phinx.org/)
2. [PHP Documentation](https://www.php.net/docs.php)
3. [Git Course](https://github.com/MSU-Courses/advanced-web-programming/tree/main/07_Forms_And_Validation)


























