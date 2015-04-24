
# php-sdk

Retsly PHP language SDK. Requires PHP@5.4 or newer and curl extension.

## Install

With [Composer](https://getcomposer.org/):

    $ composer install retsly/php-sdk

## Usage

```php
use Retsly\Client;

$retsly = new Client("token", "test");

$arr = $retsly
  ->listings()
  ->where("bedrooms > 3")
  ->getAll();

// now do something with $arr
```

## API

All classes are in the `Retsly` namespace. Most methods are chainable.

### Client($token, [$vendor])

A new instance of `Client` needs an API token. Optionally set the vendor (the MLS data source).

### Client#vendor($vendor)

Sets the vendor to the given value.

### Client#listings([$query])

Returns a new `Request` for the Listings resource.

### Client#agents([$query])

Returns a new `Request` for the Agents resource.

### Client#offices([$query])

Returns a new `Request` for the Offices resource.

### Client#openHouses([$query])

Returns a new `Request` for the OpenHouses resource.

### Request($method, $url, $query, $token)

The request constructor takes an HTTP method, a complete URL, an
array representing the querystring, and a token. `Request` instances
are normally provided by a `Client`.

### Request#query($query)

Adds the array `$query` to the querystring. You can call this as
many times as you like.

### Request#where()

Convenience method for querystring building. Works as an alias for Request#query but also has alternate signatures:

```php
$req
  ->where('bedrooms', 'gt', 5) // greater than 5
  ->where('bedrooms < 7')      // less than 7
  ->where('baths', 3)          // equal to 3
```

### Request#limit($int)

Alias for `Request->query(["limit" => $int])`.

### Request#offset($int)

Alias for `Request->query(["offset" => $int])`.

### Request#get($id)

Get a single document by its id (`$id`).

### Request#getAll([$query])

Get an array of documents. Optionally pass an array for
the querystring.

## License

(The MIT License)

Copyright (c) 2015 Retsly Software Inc <support@rets.ly>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the 'Software'), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
