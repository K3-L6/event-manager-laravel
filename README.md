# Event Manager - OJT Project

## Introduction
During our on-the-job training, we were given a task to manage a upcoming event. To make an event more efficient and better, My team decided to develop an Event Management System that will handle and automate the recording of guest and attendance upon arriving for the event. The Event Management System is a system that can handle single event
from the registering of the guest up to the sub-event, record attendance then generate report.

## Screenshots
![ScreenShot](https://photos.app.goo.gl/RFhafGr7OZDSwxoA3)


## Installing
1) Install xampp with php 7.0 up
2) Install composer
3) Download and extract this project in xampp\htdocs
4) Rename .env.example to .env
5) Create a database in xampp (any name)
6) Open .env and change DB_DATABASE equals to your database name
7) Change DB_USERNAME according to your xampp credentials (Username: Root is the default username for xampp)
8) Change DB_PASSWORD according to your xampp credentials (Password: (empty) is the default password for xampp)
9) Run CMD and go to the this project path
10) Type "composer install" and press enter to download necessary extensions that the web application needs
11) Type "npm install" and press enter to download necessary extensions that the web application needs
12) Type "php artisan key:generate" and press enter to generate key for your web application
13) Type "php artisan migrate:refresh --seed" and press enter to create all table in your database and setup default datas
14) Go to vendor\laravel\framework\src\illuminate\Foundation\Auth\ and open AuthenticatesUser.php
15) Find the username function and change the "return 'email';" to "return 'username';"
16) Run your server by going to the root of your project via CMD and typing "php artisan serve", alternatively you can create your own virtual server using this document root : C:/xampp/htdocs/your-project-name/public
17) Defaults Username: goldenaurum, Password: password

## Built With
* Laravel
* Bootstrap 4
* Bootstrap 4 Material Admin (Template) 
* RFID Input Reader

## Team
* John Kenneth Lising 
* Christian Montemayor
* Erd Rico Manalo

## Acknowledgments
* Golden Aurum System Solutions Inc.


