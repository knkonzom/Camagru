Camagru Documentation

Camagru is the first Web Project at WeThinkCode. It is an image editing and sharing platform similar to Instagram.

The requirements for the project:
* HTML, CSS
* PHP
* MAMP/XAMPP
* MySQL
  
To begin:

Download project source code from repository:
Use Git to clone repository to desktop.

Download MAMP/XAMPP from the Bitnami page.
Once downloaded, install software.
Begin servers in the app interface if servers aren't running.
Copy cloned Camagru repository to the apache2\htdocs folder, which is located in the installation path of MAMP/XAMPP.

Open browser and go to URL http://localhost:8080/Camagru
The website should be up and running.

To check that the site is running well, navigate to phpMyAdmin folder http://localhost:8080/phpmyadmin. Once logged into the management system, go to databases and verify the creation of a Camagru database.
File Structure & Code Breakdown

Database Management Systems (DBMS):
* MySQL
* phpMyAdmin
Server:
* PHP
Client:
* HTML & CSS
* JavaScript

File Structure:

    config:
    * database.php
    * setup.php

    functions:
    * php_user_functions.php
    * webcam.js

    gallery_images:
    * [images from gallery]

    images:
    * [images]

    includes:
    * activate.inc.php
    * comments.inc.php
    * activate.inc.php
    * comments_notification.inc.php
    * delete_img.inc.php
    * forgotten_password.inc.php
    * image_save.inc.php
    * login.inc.php
    * signup.inc.php
    * update.inc.php
    stickers:
    * frame1.png - frame13.png

   root folder files:

    * author
    * comments.php
    * editor.php
    * footer.php
    * forgotten_password.php
    * gallery.php
    * header.php
    * index.php
    * profile.php
    * signup.php
    * style.css
    * update.php
    * update_password.php



Running Camagru

Start Web Server:
* Launch MAMP/XAMPP, start all servers.
* Open browser & navigate to http://localhost:8080/Camagru. You will find the landing page.
Create, verify and login to account:
* Enter your credentials here, wait for verification email once complete. Once received verification email, click on the link and verify your account. Once verified, navigate to Login page.
