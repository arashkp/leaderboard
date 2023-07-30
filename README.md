<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Leaderboard App

Welcome to the Leaderboard single page application (SPA)! This project is my first experience with Inertia, building a dynamic leaderboard app using Laravel 10, Vue JS 3, and Tailwind CSS. Throughout this journey of learning, I have explored the ins and outs of these powerful technologies and built a fully functional leaderboard app.

## Project Guideline

### Getting Started

1. Clone the repository from GitHub.

2. Install backend & frontend dependencies by running the following command in the root directory of the project:
```
composer install
```
```
npm install
```
3. Set up the backend by creating a `.env` file in the root directory of the Laravel project. Copy the contents from `.env.example` and configure the database connection.

4. Generate an application key for Laravel:
```
php artisan key:generate
```

5. Migrate the database and seed with initial data:
```
php artisan migrate --seed
```
	
### Running the Application

To start the development server for the frontend (Vue.js) and backend (Laravel):
```
npm run dev
```
```
php artisan serve
```
	
The project will be available at http://localhost:8000.


### Testing the Application
This project includes `two simple backend tests` for testing the page and the API endpoint to get all users. More comprehensive tests can be added for both the backend and frontend sides to ensure robust functionality.
To run the backend tests, use the following command in your terminal:
```
php artisan test
```
For the frontend tests, you can `add test cases` and run them with the following npm command:
```
npm run test:unit
```

There is a live version of this leaderboard app on my personal website, you can access it via:
https://leaderboard.arashkp.com/

## License
The Leaderboard app is licensed under the MIT License, enabling anyone to use, modify, and distribute the code without limitations.

## Contact
For queries, support, or just to connect, you can reach out to me at my email Arashkp [at] gmail.com
