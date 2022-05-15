### University Projct - Web design
3rd Eye Bazaar
===

## Important

Since this website isn't meant to work online, you'll have to test it locally. And part of this process is to create a database to store info. Don't worry tho, everything will be explained. 

### Step 1 :
Using any basic DBMS ( for example phpMyAdmin ), create a new database. It's name, user name and password is left to you to choose. **Keep these somewhere, we'll use them later !**

### Step 2 :
With the **.sql** files stored in the **db** folder, you can import the configs ( including the **product** and **account** tables ) in your newly crteated database. According to your DBMS, the option to import configs to a database may vary. But in most cases, two options are available : 

- find the **Import from file** button and choose the **.sql** files
- copy-pasting the contents of the two **.sql** files into a SQL query field

### Step 3 :

- In the **database.php**, replace the dummy **[empty]** value by :
    - **DBURL** -> The URL of the database. If you're using either **LAMP** or **XAMPP** for example, the URL will be **"localhost"**
    - **DBUSR** -> A user name, created with the DBMS
    - **DBPWD** -> A password, also created with the DBMS
    - **DBNAM** -> The database's name
```php

<?php

define("DBURL","[empty]");

define("DBUSR","[empty]");

define("DBPWD","[empty]");

define("DBNAM","[empty]");

?>

```
If any of these variables isn't defined, an error will be shown when connecting to the **index.php** webpage.

## Regarding the .htaccess

In case of an error 404, 403 or 500, a custom page shoud be shown, these pages being respectively **404.php**, **403.php**, **500.php**. If a blank page is shown instead, please edit the **.htaccess** file with a **DIRECT** link to each of the aforementioned pages.

## Project's file tree

```

3rdEyeBazaar
│   README.md
│   .htaccess
|   trash.old
|
└───css -> css pages
|
└───ct -> messages sent from the "Contact Us" page
|
└───db -> config files for the database
|
└───ft -> fonts used in the project
|
└───im -> images used by the website
|   |
|   └───sk -> sketches used to create some images
|   |
|   └───tr -> archives and unused images
|
└───im-part -> images uploaded alongside the adds
|
└───vd -> videos used by the website

```
