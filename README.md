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

# 10.01 Backend óra

Frontend és Backend az Útvonallal(végpont) van összekapcsolva (url)

Mai órán:
-Githubról leszedett projektet hogy kell kezelni:
-Github link
-FACTORY
-Alap lekérdezések + tranzakciók (eddig nem jutottunk el)

** .env szerkesztése **

Laravel felépítés --MIGRÁLÁS--> mysql ben frissíti az adatokat (PHP myadmin felület)

```shell
cd mappa
git clone url
cd projekt
```

.env beállítása

```shell
composer install
php aritsan migrate
```

[Laravel Factory](https://medium.com/@maulanayusupp/how-to-use-factory-with-laravel-a5f45ddd61d)

```shell
php artisan make:factory UserFactory --model=User
```

**Az importálás legyen a modelben!**

```shell
use HasFactory;
```

**kiegészítések:**

magyar nyelvű adatok: fake('hu_HU')  
válogatunk meglévő adatokból - Factory.php:

factories és seederes mappaában lévők szereksztése

```shell
php artisan migrate:fresh --seed
```

Frissít és feltölti adatokkal

```shell
php artisan make:factory TaskFactory --model=Task
```

Task táblába bele kell tenni a "use HasFactory;" -t és a importálni a modult:
(use Illuminate\Database\Eloquent\Factories\HasFactory;)

TaskFactory -->

```php
'title' => fake('hu_HU')->title(),
'description' => fake()->sentence(),
'created_date' => now(),
'end_date' => fake()->date(),
'user_id' => User::all()->random()->id,
'status' => rand(0,1)
```

DatabaseSeeder -->

```php
Task::factory(10)->create();
```

```shell
php artisan migrate:fresh --seed
```

legyen új tábla categories

task-ban legyen új mező cat_id és legyen összekötve a categories-al

```shell
php artisan make:model Category -a --api
```

Cyetegory:

```php
protected $fillable = [
	'name'
];
```

categories tábla:

```php
$table->string('name');
```

adatbázis SORREND!!
categories tábla nevének szerkesztése ,hogy feljebb kerüljön.

database seederben a task előtt:

```php
Category::factory(10)->create();
```

task-hoz a +fillable:

```php
'category_id',
```

task_user tábla:

```php
$table->foreignId('category_id')->constrained('categories');
```

taskfactory:

```php
'category_id' => Category::all()->random()->id,
```

### REST API

Kérések
GET -> index (visszatér az adattal)
SHOW -> vissza adja/megmutatja az adatot
POST
store -> létrehoz
DELETE
destroy
PUT és PATCH -> Update (részleges módosításhoz)
Postman ()

CetegorController:

    return Category::all();

```shell
php artisan install:api
```

api.php-be:

```php
Route::get('/categories', [CategoryController::class, 'index']);
```

terminálba

```shell
php artisan key:generate
php artisan serve
```

böngészőbe:

```url
http://127.0.0.1:8000/api/categories
```

### A library projektet fojtatjuk

kell annak is factory illetve minden amit ma csináltunk

# 10.08

A library projektet visszük tovább, ismét

[Git link a letöltéshez](https://github.com/Agnes-milia/library_2025_esti.git)
ezután vscodeban :

```Shell
cd library_projekt
```

(betallóztuk a projekt mappát)

Ezután-> .env szerkesztése (23-tól 28.-ik sorig)

Majd jöhet az install

```php
composer install
```

ezután jöhet a felépítés:

```shell
php artisan make:model Lending -a --api
```

A pdf alapján átalakítjuk a modelleket, factrory-kat táblákat

Majd :

Ezt nem adtuk meg mert a copy factory-ban még nem volt kitöltve a publication:

```shell
php artisan migrate:fresh --seed
```

Ez ment helyette:

```shell
php artisan migrate:fresh
```

Landing modellbe (a 'use HasFactory;' után ):

```php
protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('user_id', '=', $this->getAttribute('user_id'))
            ->where('copy_id', '=', $this->getAttribute('copy_id'))
            ->where('start', '=', $this->getAttribute('start'));
        return $query;
    }
```

landings táblába:

```php
   // $table->id();
            // $table->timestamps();
            $table->primary(['user_id', 'copy_id', 'start']);
            $table->foreignId('user_id')->constraind("users");
            $table->foreignId('copy_id')->constraind("copies");
            $table->date('start')->default(now());
            $table->timestamps();
```

Ezután megint:

```shell
php artisan migrate:fresh
```

Database seeder:

```shell
User::factory(10)->create();
        Lending::factory(10)->create();
```

Majd ez:

```shell
php artisan migrate:fresh --seed
```
