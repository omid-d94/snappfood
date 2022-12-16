<p align="center">
    <img style="border-radius: 50%;" width="125px" height="125px" src="public/img/logo-400x400.png" alt="SnappFood">
</p>

---
<p>
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" 
         height="50px" alt="Laravel Logo" style="margin-right: 10px;"> 
    <img src="public/img/tailwindcss.jpg" alt="tailwindcss" height="50px" style="margin-right: 10px;">
    <img src="public/img/laravel%20excel.png" alt="laravel-excel" height="50px" style="margin-right: 10px;">
    <img src="public/img/neshan.png" alt="neshan map" height="50px" width="50px">
</p>

---

## Features

- Authentication system by laravel [breeze](https://laravel.com/docs/9.x/starter-kits#laravel-breeze).
- Make separate panel for the admin and seller.
- Authorizing
    - Use guard to authorizing the seller and admin.
    - Use laravel sanctum to authorizing user as a customer.
- Send email to the customer at any stage of the order status with job and [queue](https://laravel.com/docs/9.x/queues).

## Seller's Panel:

- Profile
    - First, seller should be filled restaurant profile
    - even he/she can use other features in seller's panel.
    - later the seller can [edit](#editing-restaurant-info) restaurant info.
- [Orders](#order-details)
    - Recieve active orders in the dashboard and access their details.
    - After the order is received by the customer, it will be transferred to the orders archive tab.
- [Foods](#foods)
    - Add foods to restaurant menu and CRUD on the food.
- [Comments](#comments)
    - see all comments related to orders,
    - confirm them to show the other customers,
    - make delete request and send to the admin for deleting specific comment.
    - Reply to comment message by the seller.
- [Reports](#reporsts)
    - Ability to report income and number of orders <br>
    - filter them between two dates, last week or last month.<br>
    - export the report to [excel](https://packagist.org/packages/maatwebsite/excel). <br>

## Admin's Panel:

- Making Categories for restaurants and foods.
- Adding banner to display in customer side.
- Adding discounts to use the seller in her/his foods.
- Delete comments requested by the seller.

---

## Steps:

- Receive project

<pre><code>git clone https://github.com/omid-d94/snappfood.git </code></pre>

- Change directory to project directory

<pre><code>cd snappfood</code></pre>

- completing variables in <b>.env</b> file

<pre><code>cp .env.example .env</code></pre>

- Installing dependencies that used in project.

<pre><code>composer install --ignore-platform-reqs </code></pre>

- Updating packages if you want!

<pre><code>composer update --ignore-platform-reqs </code></pre>

- Installing packages like tailwindcss that used in project

<pre><code>npm install & npm run build</code></pre>

- For encrypting cookies

<pre><code>php artisan key:generate</code></pre>

- After creating the new database and set config for it,<br>now you can migrate tables into database with fake data by
  seeders.

<pre><code>php artisan migrate --seed</code></pre>

- credentials for admin
    - <p>email: <pre><code>admin@admin.com</code></pre></p>
    - <p>password: <pre><code>password</code></pre></p>

---

## Screenshots

- ### Foods:

<img style="border:4px black solid; border-radius:10px;" src="screenshots/Foods.png" alt="Foods">

- ### comments:

<img style="border:4px black solid; border-radius:10px;"  src="screenshots/Comments.png" alt="Comments">

- ### reports:

<img style="border:4px black solid; border-radius:10px;"  src="screenshots/Reports.png" alt="Reports">

- ### editing restaurant info:

<img style="border:4px black solid; border-radius:10px;"  src="screenshots/Restaurant.png" alt="Restaurant">

- ### order details

<img style="border:4px black solid; border-radius:10px;"  src="screenshots/Orders.png" alt="Orders">



