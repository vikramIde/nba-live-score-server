
## About NBA Live SERVER

To use this app , just clone the repo and run following command.


## Steps

1. clone the repo 

2. Prepare your .env file there with database connection and other settings

3. Run "composer install" command

4. Run "php artisan migrate --seed" command. Notice: seed is important, because it will create the first admin user for you.

5. Run "php artisan key:generate" command.
6. Run "php artisan serve"

7. the server will start in http://localhost:8000/

And that's it, go to your domain and login:

Email: admin@admin.com
Password: password

8. To start the game scheduller Run "php artisan game:start"




## Technology
    - **Laravel 5.7.0**

## License

The app  is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
