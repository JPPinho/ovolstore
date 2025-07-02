# OVOL Fullstack Laravel Developer Test Submission

This project is a submission for the OVOL Fullstack Laravel Developer Test. It implements a simple product management module for a WebShop's admin backend, complete with a REST API and a Laravel Blade frontend.

**Repository:** [https://github.com/JPPinho/ovolstore](https://github.com/JPPinho/ovolstore)

---

## Setup and Installation Instructions

This project is configured to be run easily and quickly using **Laravel Herd**.

### Prerequisites
*   Git
*   [Laravel Herd](https://herd.laravel.com/) (macOS or Windows)
*   Composer

### Step-by-Step Guide

1.  **Clone the Repository:**
    Open your terminal and clone the project into your Herd directory.
    ```bash
    git clone https://github.com/JPPinho/ovolstore.git
    ```

2.  **Navigate to the Project Directory:**
    ```bash
    cd ovolstore
    ```

3.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```

4.  **Create Your Environment File:**
    Copy the example environment file. Herd will automatically configure the necessary server settings.
    ```bash
    cp .env.example .env
    ```

5.  **Configure the Database in `.env`:**
    Laravel Herd automatically creates a database named after the project folder. Open the `.env` file and ensure your database connection is set up as follows:
    ```env
    DB_CONNECTION=sqlite
    ```

6.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

7.  **Run Migrations and Seed the Database:**
    This command will create all the necessary tables and populate the `categories` table with sample data.
    ```bash
    php artisan migrate --seed
    ```

8.  **Visit Your Site:**
    Herd will now be serving your application. You can access it in your browser at:
    **http://ovolstore.test**

---

## Usage

### Frontend Admin Panel

The simple frontend provides a user interface to manage products.

*   **Homepage:** [http://ovolstore.test](http://ovolstore.test) - Displays a welcome page with a link to the admin panel.
*   **Admin Products Page:** [http://ovolstore.test/admin/products](http://ovolstore.test/admin/products) - The main interface to list, create, edit, and delete products.

### Backend REST API

The API provides endpoints for programmatic access to the product and category data. Use the provided Postman collection for easy interaction.

#### Postman Collection
A Postman collection is included in the root of the project: `ovolstore.postman_collection.json`. Import this file into Postman to get a pre-configured set of requests for all API endpoints.

#### API Endpoints
All API routes are prefixed with `/api`.

**Categories**
*   `GET /api/categories`: Fetches all categories in a nested tree structure.
*   `POST /api/categories`: Creates a new category.
*   `GET /api/categories/{id}`: Shows a specific category.
*   `PUT /api/categories/{id}`: Updates a category.
*   `DELETE /api/categories/{id}`: Deletes a category.

**Products**
*   `GET /api/products`: Lists all products (paginated).
*   `POST /api/products`: Creates a new product and assigns categories.
*   `GET /api/products/{id}`: Shows a specific product with its assigned categories.
*   `PUT /api/products/{id}`: Updates a product's details and/or categories.
*   `DELETE /api/products/{id}`: Deletes a product.

---

## Running Tests

To ensure application reliability and data integrity, a suite of tests has been included. You can run all tests using the following Artisan command:

```bash
php artisan test
```
