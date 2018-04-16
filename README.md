# Event Manager - OJT Project

## Introduction
During our on-the-job training, we were given a task to manage a upcoming event. To make an event more efficient and better, my team decided to develop an Event Manager that will handle and automate the recording of guest and attendance upon arriving for the event. The Event Manager can handle single event
from the registration of the guest and generating identification badge up to the sub-events information and recording of attendance using rfid input reader then generate report.

## Screenshots
![login](https://user-images.githubusercontent.com/32229808/38839639-3e846278-420e-11e8-874d-f0e5b67ad7fc.png)
![main](https://user-images.githubusercontent.com/32229808/38839680-6e092dee-420e-11e8-8a94-7cf681a181a2.png)
![admin - dashboard](https://user-images.githubusercontent.com/32229808/38839728-a1f118e2-420e-11e8-95fa-53b1d24389fc.png)
![admin - event](https://user-images.githubusercontent.com/32229808/38839748-bf2618b8-420e-11e8-8156-ad39ec17cf15.png)
![admin - event - logging](https://user-images.githubusercontent.com/32229808/38839772-d8876244-420e-11e8-8a51-7b895a26844a.png)
![admin - guest](https://user-images.githubusercontent.com/32229808/38839829-164881e4-420f-11e8-8a2b-583af5830080.png)

[Click Me For More Screenshots](https://photos.app.goo.gl/zWJBbRYMelL3B1n53)

## Getting Started
1) Rename .env.example to .env
2) Create a database in xampp (any name)
3) Open .env and change DB_DATABASE equals to your database name
4) Change DB_USERNAME according to your xampp credentials (Username: Root is the default username for xampp)
5) Change DB_PASSWORD according to your xampp credentials (Password: (empty) is the default password for xampp)
6) Run CMD and go to the this project path
7) Type "composer install" and press enter to download necessary extensions that the web application needs
8) Type "npm install" and press enter to download necessary extensions that the web application needs
9) Type "php artisan key:generate" and press enter to generate key for your web application
10) Type "php artisan migrate:refresh --seed" and press enter to create all table in your database and setup default datas
11) Go to vendor\laravel\framework\src\illuminate\Foundation\Auth\ and open AuthenticatesUser.php
12) Find the username function and change the "return 'email';" to "return 'username';"
13) Run your server by going to the root of your project via CMD and typing "php artisan serve"
14) Defaults Username: goldenaurum, Password: password

*NOTE*
You can create your own virtual server using this document root : C:/xampp/htdocs/your-project-name/public

## Prerequisites
* Xampp with php 7.0 up
* Composer
* A copy of this project in your htdocs folder

## Built With
* [Laravel](https://github.com/laravel/laravel) - php framework used
* [Bootstrap 4](https://github.com/twbs/bootstrap/tree/v4-dev) - css framework
* [Bootstrap 4 Material Admin](https://bootstrapious.com/p/admin-template) - dashboard template 
* RFID Input Reader - hardware used (any brand)

## Authors
* **John Kenneth LIsing** - Lead programmer
* **Christian Montemayor** - Programmer and design
* **Erd Rico Manalo** - Documentation and design

## Acknowledgments
* Golden Aurum System Solutions Inc.


