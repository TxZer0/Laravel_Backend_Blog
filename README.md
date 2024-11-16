# Laravel Backend Blog
This is the source code for the API backend of a blog application. The project provides basic functionalities like user registration, login, post management, comment management, and user role management.

## Features

- User Authentication: User registration, login, logout, and token management.
- Post Management: Create, update, delete, view and search posts.
- Comment Management: Add, update, delete comments on posts.
- Upload Avatar and Files: Allow users to upload avatars and attach files to posts or comments.
- User Role Management: Ensure that only authorized users can perform sensitive actions.

## Requirements

- PHP: 8.1
- Composer: 2.8.2
- Laravel: 10.*
- MySQL: Running on default port (3306)

## Installation

1. Clone the repository:
    ```
    https://github.com/TxZer0/Laravel_Backend_Blog.git
    cd Laravel_Backend_Blog
    ```

2. Install dependencies:
    ```
    composer install
    ```

3. Create a `.env` file:
    ```
    cp .env.example .env
    ```

4. Run migrations:
    ```
    php artisan migrate
    ```

5. Start the development server:
    ```
    php artisan serve
    ```

### Contact:
  Feel free to reach out with any questions or feedback!  
  Email: laithanhtaeh190@gmail.com
