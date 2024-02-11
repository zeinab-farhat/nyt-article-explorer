API Key Requirement:

To access the New York Times API and fetch articles, you need to obtain an API key. Follow these steps to create an account and obtain your API key:
1. Visit the New York Times Developer Portal at [https://developer.nytimes.com/](https://developer.nytimes.com/).
2. Sign up for an account or log in if you already have one.
3. Once logged in, navigate to the API section and select the desired API (e.g., Most Popular API).
4. Follow the instructions to generate an API key.
5. Use the API key in request in UpdateNyTimesArticlesCommand handle method.

Requirements:

1-Redis Server
    To run this application, you need to have a Redis server installed and running on your system. Redis is used for caching data, enhancing the performance of the application.
    If you haven't installed Redis yet, you can download and install it from the official Redis website. Once installed, make sure to start the Redis server before running the application.
2-PHP 8.1
    This application requires PHP version 8.1 or higher. If you haven't installed PHP 8.1 yet, you can download and install it from the official PHP website. Make sure to configure your web server to use PHP 8.1.

3-Laravel 10

How to Run the Application:

1. Make sure you have PHP and Composer installed on your system.
2. Clone this repository to your local machine.
3. Navigate to the project directory in your terminal.
4. Run the following commands:
    - composer install
    - cp .env.example .env (for copying the environment file)
    - php artisan key:generate (to generate application key)
    - Set up your database configuration in the .env file.
    - php artisan migrate (to run migrations)
    - php artisan db:seed (to run seeders (to create user in order to login))
    - php artisan serve (to start the development server)

Functionalities:

1. Login and Registration:
    - Users can register and login to the application.
2. Profile Management:
    - Users can edit their profile information and change their password.
3. Article Management:
    - Users can view a list of articles fetched from the NY Times API.
    - They can search articles by title or URL.
    - They can save articles to their profile.
    - They can view detailed information about a specific article.
    - They can remove saved articles from their profile.

Commands

UpdateNyTimesArticlesCommand Class
    The UpdateNyTimesArticlesCommand class is a Laravel console command responsible for fetching the latest articles from the New York Times API and storing them in the application's cache.

    handle() Method
    The handle() method within the UpdateNyTimesArticlesCommand class executes the command's functionality:

    1-Sends a request to the New York Times API to retrieve the most popular articles.
    2-Extracts the article data from the API response.
    3-Stores the article data in the application's cache using Laravel's Cache facade, making it accessible throughout the application.
    This command is scheduled to run hourly in the Laravel scheduler, ensuring that the application's cache is regularly updated with the latest articles from the New York Times.


Application Pages

    1-Login Page
    The login page allows users to securely access the application by entering their credentials. Users can either log in with their existing account credentials or register for a new account if they are new to the platform. Additionally, the login page provides a password reset option for users who have forgotten their passwords.

    2-Articles Page
    Description: The articles page displays a list of articles retrieved from the New York Times API. Users can search and filter articles by title, URL, or keywords. Each article card includes details such as the title, URL, section, and published date. Users can view the full article by clicking on the title.

    3-Profile Page
    The profile page displays user information and settings. Users can edit their profile details, change their password, and view their saved articles.
    The saved articles page allows users to view a list of articles they have saved to their profile. Users can remove articles from their saved list by clicking on the delete button next to each article.

