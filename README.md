This project is a simple Laravel API where I implemented user login and logout using JWT, along with an API to add products to a cart. I also created seed data for users, categories, and products so the project is easy to test.

The main things included in this project:

JWT authentication

Login API

Logout API

Custom middleware to handle expired, invalid, or missing tokens

Cart functionality

Add product to cart

If the product is already in the cart, the quantity updates

Cart total updates automatically

Seed data

Two users (Admin and Buyer)

Three categories

Three sample products

Demo User Credentials:
Admin: admin@example.com
 / Admin@123
Buyer: buyer@example.com
 / Buyer@123

Setup steps I followed:

Installed Laravel dependencies

Set up the .env file with database credentials

Installed JWT package and generated the secret key

Ran migrations and seeders

Created controllers for Auth and Cart APIs

Main API endpoints:

POST /api/login

POST /api/logout

POST /api/cart/add

This project also includes a custom middleware that checks the JWT token and returns proper error messages if the token is expired or invalid.
