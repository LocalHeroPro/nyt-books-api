# New York Times Best Sellers List

Application acting as a wrapper/middleman to fetch the New York Times Best Sellers list using the NYT API.

## Overview

Application enables support the following subset of the NYT API's Query Parameters:

- `author` : string
- `isbn[]` : string
- `title` : string
- `offset` : integer

## Requirements

- PHP 8.4
- Composer
- Git
- Make

## Testing

```bash
$ git clone
$ cd nyt-books-api
$ composer install
$ php artisan migrate --force
$ make phpunit-test
```

Happy coding!
