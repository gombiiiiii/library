# 09.24 Backend óra

## library adatbázis

0 lépés az adatbázis létrehozása a MYSQL létrehozása (XAMPP-ban)
táblák és környezeti változók --> ezeknek meg kell lennie a migrálás előtt (sorrend mindegy)

migrálás

```shell
composer create-project laravel/laravel library_project
```

.env szerkesztése

```sql
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library
DB_USERNAME=root
DB_PASSWORD=
```

```shell
cd library_project
```

```shell
php artisan make:model Book -m
```

```shell
php artisan make:model Copy -m
```

Book táblához :

Books:

```php
Schema::create('books', function (Blueprint $table) {
$table->id();
$table->string('author',32);
$table->longText('title',150);
$table->integer('pieces')->default(50);
$table->timestamps(); // ezzel egyenlőre nem foglalkozunk, de nem töröljük
});
```

copy táblához

copies:

```php
Schema::create('copies', function (Blueprint $table) {
$table->id();
$table->foreignId('book_id')->constrained("books")->onDelete('cascade');
$table->foreignId('user_id')->constrained("users")->onDelete('cascade');
$table->timestamps();
});
```

```shell
php artisan migrate
```

```shell
php artisan migrate:fresh
```

users táblába

```php
User::create([
'name' => 'Admin',
'email' => 'admin@example.com',
// 'password' => bcrypt('password'),
'password' => 'admin123'
]);

User::create([
'name' => 'Teszt1',
'email' => 'teszt1@example.com',
// 'password' => bcrypt('password'),
'password' => 'test123'
]);
```

books táblába

```php
Book::create([
'author' => 'Carl Marx',
'title' => 'Tőke',
'pieces' => 100
]);

Book::create([
'author' => 'Stephen King',
'title' => 'Ragyogás'
]);
```

Copys táblába

```php
Copy::create([
'book_id' => 1,
'user_id' => 2
]);

Copy::create([
'book_id' => 2,
'user_id' => 2
]);
```

```shell
php artisan key:generate
```

```shell
php artisan serve
```

## Filmes adatbázis

film : id , title
users: id , name , email , passw
szerepel: id , film_id , user_id

szerepel mutat a users és film táblára (azok id-jére értelem szerűen)

```shell
cd ..
```

```shell
composer create-project laravel/laravel film_kolcsonzes_project
```

```shell
cd fiml_kolcsonzes_project
```

.env szerkesztése

```sql
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=filmesdi
DB_USERNAME=root
DB_PASSWORD=
```

```shell
php artisan make:model Film -m
```

```shell
php artisan make:model Szerepel -m
```

Film:

```php
<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Film extends Model
{
	protected $fillable = [
		'title',
		'director',
		'release_year',
		'how_long',
	];

}
```

Szerepel:

```php
<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Szerepel extends Model
{
	protected $fillable = [
		'film_id',
		'szerepel_id',
	];

}
```

Users:

```php
		User::create([
            'name' => 'Admin21',
            'email' => 'admin21@example.com',
            'password' => 'Admin_password'
        ]);

         User::create([
            'name' => 'Test2',
            'email' => 'test2@example.com',
            'password' => 'Test2_password'
        ]);
```

Films:

```php
		Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->longText('title',150);
            $table->string('director',100);
            $table->year('release_year');
            $table->integer('how_long');
            $table->timestamps();
        });

        Film::create([
            'title' => 'Inception',
            'director' => 'Christopher Nolan',
            'release_year' => 2010,
            'how_long' => 148
        ]);

         Film::create([
            'title' => 'The Matrix',
            'director' => 'The Wachowskis',
            'release_year' => 1999,
            'how_long' => 136
        ]);
```

Szerepels:

```php
        Schema::create('szerepels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained("films")->onDelete('cascade');
            $table->foreignId('user_id')->constrained("users")->onDelete('cascade');

            $table->timestamps();
        });


    Szerepel::create([
        'film_id' => 1,
        'user_id' => 2
    ]);

    Szerepel::create([
        'film_id' => 2,
        'user_id' => 2
    ]);

```
