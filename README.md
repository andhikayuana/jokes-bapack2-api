# jokes-bapack2-api
Kumpulan Jokes Bapack2

## Requirements
- PHP
- Composer
- Heroku

## How to Run
- clone this repository
- cd to root project directory
- execute `composer install`
- Run the server using `php -S localhost:8000 -t public`
- then you can see like below after you have request to `http://localhost:8000/`

```json
{
    "name": "Jokes Bapack2 API",
    "version": "1.0.0",
    "author": {
        "name": "andhikayuana",
        "email": "andhika@yuana.id"
    },
    "endpoints": {
        "/v1/text": "get all text jokes",
        "/v1/text/random": "get text jokes randomly"
    }
}
```

