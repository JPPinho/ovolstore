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
*   MySql Server

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
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ovolstore
    DB_USERNAME=root
    DB_PASSWORD=
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

8. Herd will now be serving your application. You can access it in your browser at:
       **http://ovolstore.test**


---

## Docker Development Environment Setup

This project includes a custom, multi-container Docker environment that provides the entire application stack (PHP, Nginx, MySQL, and Vite). This is the recommended way to run the application locally as it guarantees a consistent and hassle-free setup.

### Prerequisites

*   [Docker Desktop](https://www.docker.com/products/docker-desktop/) (for Mac, Windows, or Linux) must be installed and running.
*   Git

### 1. One-Time Setup Instructions

Follow these steps to build the Docker images and set up the application for the first time.

1.  **Clone the Repository:**
    ```bash
    git clone https://github.com/JPPinho/ovolstore.git
    ```

2.  **Navigate to the Project Directory:**
    ```bash
    cd ovolstore
    ```

3.  **Create the Environment File:**
    Laravel's configuration requires a `.env` file inside the `app/` subdirectory.
    ```bash
    cp app/.env.example app/.env
    ```

4. **Unzip the .docker.zip file that's inside /app to one level higher, alongside /app. Do the same thing to docker-compose.yaml**

5. **Build and Run the Docker Containers:**
    This single command will build all custom images and start the Nginx, PHP, MySQL, and Vite services in the background. The first run will take several minutes.
    ```bash
    docker-compose up -d --build
    ```

6.  **Install Backend & Frontend Dependencies:**
    Run Composer and NPM to install all required packages *inside* the application container.
    ```bash
    docker-compose exec backend composer install
    docker-compose exec backend npm install
    ```

7.  **Generate the Application Key:**
    This is a required security step for Laravel.
    ```bash
    docker-compose exec backend php artisan key:generate
    ```

8.  **Run Database Migrations:**
    This will create the database schema and populate it with sample data.
    ```bash
    docker-compose exec backend php artisan migrate --seed
    ```

The one-time setup is now complete. The application is running.

### 2. Accessing the Application

You can now access the application in your web browser at:

*   **[http://localhost](http://localhost)**

The Vite development server with Hot-Module Replacement (HMR) is running automatically. Any changes you make to CSS or JavaScript files will appear in your browser instantly.

### Daily Workflow & Useful Commands

*   **To start all services:** `docker-compose up -d`
*   **To stop all services:** `docker-compose down`
*   **To run any Artisan command:** `docker-compose exec backend php artisan <your-command>`
*   **To view live logs for a service (e.g., `vite`):** `docker-compose logs -f vite`
*   **To open a shell inside the main application container:** `docker-compose exec backend bash`

---

## Usage

### Frontend Admin Panel

The simple frontend provides a user interface to manage products.

*   **Homepage:** [http://ovolstore.test](http://ovolstore.test) - Displays a welcome page with a link to the admin panel.
*   **Admin Products Page:** [http://ovolstore.test/admin/products](http://ovolstore.test/admin/products) - The main interface to list, create, edit, and delete products.
*   ** If the application is running on Docker then all urls start with [http://localhost](http://localhost). This includes the api requests.
### Backend REST API

The API provides endpoints for programmatic access to the product and category data. Use the provided Postman collection for easy interaction.

#### Postman Collection
A Postman collection is included in the root of the project: `ovolstore.postman_collection.json`. Import this file into Postman to get a pre-configured set of requests for all API endpoints.
This collection includes all requests for the web and docker versions of this application.
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
