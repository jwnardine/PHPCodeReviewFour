# _Jon's Shoes/Brands Code Review_

#### By _**Jon Nardine**_

## Description

_This is Jon Nardine's fourth PHP code review, which will test his ability to use PHP, Twig, and Silex, as well as functionality for using a MySQL database. The site will allow the user to add a shoe STORE or shoe BRAND to a respective empty list. On the list pages will be dedicated links to each individual created STORE or BRAND, in which users will be able to assign BRANDs to STOREs, or vice versa. Both the STOREs and BRANDs will be updateable and deleteable via appropriate CRUD functions and routes. Join statements are also used in Store.php and Brand.php so that there are no MySQL commands within the foreach loops in the getStores and getBrands functions._

## Setup

Please visit this website:

https://github.com/jwnardine/PHPCodeReviewFour

Clone the repository into the desktop using the command __git clone https://github.com/jwnardine/PHPCodeReviewFour.git__

Open the project folder in the command prompt, and use the prompt __composer install__. This will set up the correct dependencies for your computer.

Once composer has installed, access the /web directory (prompt __cd web__ from project folder), and then type __php -S localhost:8000__ and hit enter.

From this point, type __localhost:8000__ into the url bar of your preferred internet browser, and the project homepage should show up in the browser.

If the project home page DOES NOT show up in the browser, you may have to delete the /vendor folder from the project folder, and run __composer install__ again.

## Technologies Used

_PHP, PHPUnit Twig, Silex, Markdown, MySQL, Github_

### MySQL Log

mysql> CREATE DATABASE shoes;
Query OK, 1 row affected (0.00 sec)

mysql> USE shoes;
Database changed
mysql> CREATE TABLE stores (store_name VARCHAR (255), id serial PRIMARY KEY);
Query OK, 0 rows affected (0.09 sec)

mysql> CREATE TABLE brands (brand_name VARCHAR (255), id serial PRIMARY KEY);
Query OK, 0 rows affected (0.07 sec)

mysql> CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id INT, brand_id INT);
Query OK, 0 rows affected (0.06 sec)

### Legal

Copyright (c) 2016 **_Jon Nardine_**

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
