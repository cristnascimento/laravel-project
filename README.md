# Contact list project with Laravel + MySQL + Bootstrap
**created at:** 4th of July 2020 /
**last update:** 4th of July 2020

## Description
This is a simple PHP project using Laravel Framework to build a contact list. In this project we build both front-end and back-end with Laravel.

Feel free to copy and use it as your own project. No need to give credits ;-)

## Dependencies

* Ubuntu 18.04
* PHP
* Composer
* Bootstrap
* MySQL


## Set up PHP

```console
$ sudo apt install php7.2-common php7.2-cli php7.2-gd php7.2-mysql php7.2-curl php7.2-intl php7.2-mbstring php7.2-bcmath php7.2-imap php7.2-xml php7.2-zip
```
## Set up Composer

### Install Composer
```console
$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
$ sudo chmod +x /usr/local/bin/composer
$ composer --version
```

### Make Composer faster

```
$ composer config -g repo.packagist composer https://packagist.phpcomposer.com
$ composer global require hirak/prestissimo
```
If you prefer you can use https://packagist.org instead.

Try it:

```console
composer create-project laravel/laravel laravel1 --no-progress --profile --prefer-dist
```
On localhost it runs in 3 minutes and on AWS in 30 seconds.

If it does not work try to remove composer folder and try again.

localhost
```console
$ rm -rf ~/.composer
```

aws
```console
$ rm -rf ~/.config/composer
```

## Create your Laravel project

### Create project
```console
composer create-project --prefer-dist laravel/laravel contact-list-app
```
### Start and run

```console
$ cd contact-list-app
$ php artisan serve
```
Access it on http://127.0.0.1:8000

### Install dependencies

When you want to download your project from git you dont need to create it with composer. However, you should install the dependencies

```console
$ cd contact-list-app
$ composer install
```

## Set up Database


### Install MySQL

```console
$ sudo apt install mysql-server mysql-client
$ sudo mysql_secure_installation
$ sudo mysql -u root -p
```

### Create Laravel database


```console
$ sudo mysql -u root -p
mysql> create database laravel;
```

### Create Laravel MySQL user

```console
$ sudo mysql -u root -p
mysql> CREATE USER 'laravel'@'localhost' IDENTIFIED BY 'laravel';
mysql> GRANT ALL PRIVILEGES ON laravel . * TO 'laravel'@'localhost';
mysql> FLUSH PRIVILEGES;
```
### Set up Laravel DB connection


```console
$ mv .env.example .env
$ vim .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

## Create Laravel Model
```console
$ php artisan make:model Contact
```
Check app/Contact.php

## Create Laravel Tables

Create file that will change MySQL
```console
$ php artisan make:migration create_contacts_table
```
Edit database/migrations/<date_prefix>_create_contacts_table.php

```php
public function up()
{
    Schema::create('contacts', function (Blueprint $table) {
        $table->id();
        $table->string("firstName");
        $table->string("lastName");
        $table->string("email");
        $table->string("phone");
        $table->string("phoneCategory");
        $table->string("address");
        $table->string("city");
        $table->string("state");
        $table->string("zip");
        $table->string("closeFriend");
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('contacts');
}
```

Apply the changes to MySQL

```console
$ php artisan migrate
```

## Create Laravel Controller

```console
$ php artisan make:controller ContactsController
```

Edit app/Http/Controllers/ContactsController.php

```php
...

public function add() {
    $contact = new Contact();
    $contact->state = "MG";

    return view ("contact", [
        "title" => "Add contact",
        "mode" => "add",
        "contact" => $contact ]);
}

public function edit($id) {
    $contact = Contact::findOrFail($id);

    return view ("contact", [
        "title" => "Update contact",
        "mode" => "edit",
        "contact" => $contact]);
}

public function view($id) {
    $contact = Contact::findOrFail($id);

    return view ("contact", [
        "title" => "View contact",
        "mode" => "view",
        "contact" => $contact]);
}

public function post(Request $request) {
    $contact = new Contact();
    $contact->firstName = $request->firstName;
    $contact->lastName = $request->lastName;
    $contact->email = $request->email;
    $contact->phone = $request->phone;
    $contact->phoneCategory = $request->phoneCategory;
    $contact->address = $request->address;
    $contact->city = $request->city;
    $contact->state = $request->state;
    $contact->zip = $request->zip;
    $contact->closeFriend = $request->closeFriend ? $request->closeFriend : "off";

    $contact->save();

    return redirect("/users/view/".$contact->id);
}

...

```
## Edit Laravel Routes

Edit routes/web.php

```php
Route::get('/', function () {
    return view('home');
});

Route::get('/contacts/add', "ContactsController@add");
Route::get('/contacts/list', "ContactsController@list");
Route::get('/contacts/edit/{id}', "ContactsController@edit");
Route::get('/contacts/view/{id}', "ContactsController@view");

Route::post('/contacts/post', "ContactsController@post");
Route::post('/contacts/update/{id}', "ContactsController@update");
Route::get('/contacts/delete/{id}', "ContactsController@delete");

```

## Create Laravel Views with Blade

### Create base view

Create and edit resouces/views/base.blade.php

```php
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        ...
        <title>@yield("title")</title>
    </head>
    <body>
    ...
      @yield("content")
    ...
    <body>
</html>

```
Check full file on git repository.
### Extend base view

```php
@extends("base")

@section("title", "Laravel Add New Contact")

@section("content")
    <div class="container col-md-6" >
    <br/>
    <h3>{{ $title }}</h3><br/>
    @if ($mode == "add")
        <form method="POST" action="/users/add/post">
    @elseif ($mode == "edit")
        <form method="POST" action="/users/update/{{ $contact->id }}">
    @else
        <form>
    @endif

    @csrf
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" id="firstName" name="firstName" value="{{ $contact->firstName }}" {{ $mode == "view" ? "readonly" : "" }}>
        </div>
        ...
@endsection
```
Check full file on git repository.

## Using Bootstrap

Just copy the links on resources/views/base.blade.php

```php
<head>
...
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
...
<body>
  ...
  @yield("content")
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

```
