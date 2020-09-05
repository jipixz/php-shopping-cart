# Shopping cart in PHP, HTML and SQL
Simple shopping cart fetching products from database. 

The cart implements superglobal variable $_SESSION to save cart items, implements quantity detection if already added to cart and multiple pages in products page to show them.

Added Manager section where products are listed, can be added, deleted and add stock to a product.

Implementation technologies:
- PHP
- HTML5
- MariaDB 


How to implement:
>Last test with MariaDB 10.4.14, PHP 7.4.9, XAMPP 7.4.9, Bulma 0.9.0 and Font Awesome 5.7.1

Assuming we already instlled XAMPP:

1. Extract the zip file in __*htdocs*__ in your XAMPP folder.
2. Download test images from https://drive.google.com/file/d/10EvHG3FvxOeECWNgV6WvAilsgfddn4jr/view?usp=sharing and extract in the root folder of the project. The images path should be *{xampp_folder}/{project_root}/imgs*
3. Import the database with the __*database.sql*__ file in the project folder. The import steps may change depending how you installed your SQL tool. Normally you should create a database where to import the table and then import the database with *mysql -u root -p {database_name} < database.sql* command if your in CLI.
4. Configure __*functions.php*__ file to access your database. Just write your *password* and the *database name*, modify *user* and *host* if needed.
5. Finally just navigate to the project path in your browser address var, it should be like *localhost/{project_folder}/* the localhost could change if your not implementing the project locally.