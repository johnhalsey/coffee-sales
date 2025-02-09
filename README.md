# Coffee ☕️ Sales

Laravel application to calculate the selling cost of coffee based on the quantity and unit price, and a percentage markup plus shipping. 

This was originally part of a technical test, [here are the instructions.](https://github.com/johnhalsey/coffee-sales/blob/main/Laravel%20Tech%20Task%20v1.0.pdf)

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

### Decsisions made during development

Phase 1:
- I decided on using `php artisan serve` instead of Docker for ease/speed.
- I put the product in an Enum instead of a Databse table, as it was only 1 product I felt like a table for 1 product was overkill.

Phase 2:
- I moved the products to a table, and added a foreign key to the sales table.
- I decided to send the products through to the Sales.vue file as a prop, instead of making a seperate api request since its only 2 products, that small extra query on page load was worth it, to ensure the products were there as soon as the page loaded.
- I put the order in an api request because thinking ahead, if there are many sales, tens or hundreads, it will likely be paginated, or may take slightly longer to load, in which case, a loading state could be added to the Vue file for a better UX.

