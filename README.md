This project is a simple Laravel API setup where I implemented user login and logout using JWT, along with an API to add products to a cart. I also added seed data for users, categories, and products so the project is easy to test.

Features:

JWT login and logout

Custom middleware for expired or invalid token handling

Add-to-cart API with automatic quantity update and cart total calculation

Seed data (2 users, 3 categories, 3 products)

Demo User Credentials:
Admin – admin@example.com
 / Admin@123
Buyer – buyer@example.com
 / Buyer@123

Setup Steps:
Install required packages
# composer install

Copy environment file
cp .env.example .env

Generate application key
# php artisan key:generate

Update .env file with database details

Install JWT
# composer require tymon/jwt-auth
# php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
# php artisan jwt:secret

Run migrations and seeders
# php artisan migrate --seed

Start the application
# php artisan serve

API Hit Process (how I tested the APIs):

Login API
Endpoint: POST /api/login
Body:
email, password
If login is successful, I get a JWT token.
I copy this token from the response.

Add Authorization header
In Postman, I use
Authorization → Bearer <paste token>

Add to Cart API
Endpoint: POST /api/cart/add
Body:
product_id, quantity
This adds the product to the buyer’s cart.
If the product already exists, the quantity increases automatically.

Logout API
Endpoint: POST /api/logout
Header: Bearer token
This blacklists the token so it can’t be used again.

This covers the complete flow of logging in, using the token, adding items to the cart, and logging out.
