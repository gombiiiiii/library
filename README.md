# 09.24 Backend óra

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
php artisan make modell Book -m
```

```shell
php artisan make modell Copy -m
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

film : id , title
users: id , name , email , passw
szerepel: id , film_id , user_id

szerepel mutat a users és film táblára (azok id-jére értelem szerűen)
