# Coffee ☕️ Sales

Laravel application to calculate the selling cost of coffee based on the quantity and unit proce, and a percdentage markup plus shipping. 

It will also record the sales and display the sales history.

## Installation

1. Clone the repository
2. Run `composer install`
3. cd into the project directory
4. Copy the `.env.example` file to `.env` and update the database connection settings
5. Run `php artisan key:generate`
6. Run `php artisan migrate`
7. Run `php artisan db:seed`
8. Run `npm install`
9. Run `npm run dev`

in a new terminal windor or tab
9. Run `php artisan serve`

The application will be available at `http://localhost:8000`

## Usage

You will be prompted to log in. Use the following credentials:
    - Email: `test@example.com`
    - Password: `password`

Once you have logged in, you will be taken straight to the sales page.
Here you can calcluate the cost of GOLD coffee, and record new sales.

## Testing

To run the tests, run `php artisan test`
