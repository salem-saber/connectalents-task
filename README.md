# Hotel Search API

This project is a RESTful API built with Laravel to allow searching within a provided hotel inventory. It fetches data from an external JSON endpoint containing hotel information and provides endpoints for searching and sorting based on various criteria such as hotel name, destination city, price range, and date range.

## Features

- Search hotels by name.
- Search hotels by destination city.
- Filter hotels by price range.
- Filter hotels by date range.
- Sort hotels by name or price.

## Requirements

- PHP >= 8.x
- Composer

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/salem-saber/connectalents-task.git
    ```

2. Install dependencies:

    ```bash
    composer install
    ```

3. Set up your environment variables by copying the `.env.example` file:

    ```bash
    cp .env.example .env
    ```

   Make sure to set the `URL_TO_JSON_ENDPOINT` variable in the `.env` file to the URL of the JSON endpoint containing hotel data.

4. Generate the application key:

    ```bash
    php artisan key:generate
    ```

5. Serve the application:

    ```bash
    php artisan serve
    ```

6. The API should now be accessible at `http://localhost:8000/api/hotels`.

## Usage

### Endpoints

- `GET /api/hotels`: Retrieve a list of hotels with optional search, filter, and sort parameters.

### Query Parameters

- `name`: Search by hotel name.
- `city`: Search by hotel destination city.
- `price_range`: Filter by price range (format: min_price:max_price).
- `date_range`: Filter by date range (format: start_date:end_date).
- `sort_by`: Sort by name or price.

### Examples

- Search by hotel name:

    ```bash
    /api/hotels?name=Le Meridien
    ```
- 
- Search by hotel city:

    ```bash
    /api/hotels?city=cairo
    ```

- Filter by price range:

    ```bash
    /api/hotels?price_range=80:100
    ```

- Filter by date range:

    ```bash
    /api/hotels?date_range=01-12-2023:15-12-2023
    ```

- Sort by name:

    ```bash
    /api/hotels?sort_by=name
    ```

- Sort by price:

    ```bash
    /api/hotels?sort_by=price
    ```

## Testing

You can run PHPUnit tests by executing:

```bash
php artisan test
