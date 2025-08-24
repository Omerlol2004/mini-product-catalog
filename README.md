# Mini Product Catalog - Laravel Application

A simple product catalog application built with Laravel and SQLite. This application allows users to manage products with basic CRUD operations, search products by name, and filter products by category.

## Features

- View all products with their details
- Add new products with name, description, price, and category
- Edit existing products
- Delete products
- Search products by name
- Filter products by category
- Responsive design using Bootstrap

## Technologies Used

- Laravel (PHP Framework)
- SQLite (Database)
- Blade (Templating Engine)
- Bootstrap 5 (CSS Framework)

## Prerequisites

- PHP 8.0 or higher
- Composer (PHP package manager)
- SQLite

## Installation

1. Clone the repository
   ```bash
   git clone https://github.com/yourusername/mini-product-catalog.git
   cd mini-product-catalog
   ```

3. Install PHP dependencies
   ```bash
   composer install
   ```
   
   **Note:** The `vendor` directory is not included in the repository to keep it lightweight. Running `composer install` will download all required dependencies.

4. Create a copy of the .env file
   ```bash
   # On Windows
   copy .env.example .env
   
   # On macOS/Linux
   cp .env.example .env
   ```

5. Generate an application key
   ```bash
   php artisan key:generate
   ```

6. Create an empty SQLite database file
   ```bash
   # On Windows
   type nul > database/database.sqlite
   
   # On macOS/Linux
   touch database/database.sqlite
   ```

7. Run database migrations
   ```bash
   php artisan migrate
   ```

8. (Optional) Seed the database with sample data
   ```bash
   php artisan db:seed
   ```

## Running the Application

1. Start the Laravel development server
   ```bash
   php artisan serve
   ```

2. Open your browser and navigate to `http://localhost:8000`


### Product Listing Page
The main page displays all products with search and filter functionality.

### Add/Edit Product Form
Simple form interface for managing product information.

## API Endpoints

- `GET /products` - Display all products
- `GET /products/create` - Show create product form
- `POST /products` - Store new product
- `GET /products/{id}/edit` - Show edit product form
- `PUT /products/{id}` - Update product
- `DELETE /products/{id}` - Delete product
- `GET /products/{id}/details` - Get product details (AJAX)

## Usage

### Viewing Products
- The home page displays all products in a grid layout
- Use the search box to find products by name
- Use the filter box or category buttons to filter products by category

### Adding Products
- Click the "Add Product" button in the navigation bar
- Fill in the product details (name, description, price, category)
- Click "Add Product" to save

### Editing Products
- Click the "Edit" button on a product card
- Update the product details
- Click "Update Product" to save changes

### Deleting Products
- Click the "Delete" button on a product card
- Confirm the deletion when prompted

## Project Structure

- `app/Models/Product.php` - Product model
- `app/Http/Controllers/ProductController.php` - Controller for product operations
- `database/migrations/` - Database migrations
- `resources/views/products/` - Blade templates for product views
- `routes/web.php` - Web routes

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Author


Created as a demonstration of Laravel CRUD operations with SQLite database.
