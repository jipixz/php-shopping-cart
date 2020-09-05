<?php 
//Este archivo contiene todas las funciones
//que se necesitan para el carrito

function pdo_connect_mysql(){

    //Datos de la base de datos local
    $DATABASE_HOST = 'localhost';   
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = '';

    try{
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    }catch (PDOException $exception) {
        //Si existe algún error con la conección el script se detiene y muestra el error
        die ('Error al conectar con la base de datos');
    }
}


function pdo_connect_mysql_user(){

    //Datos de la base de datos local
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = 'jipixz';
    $DATABASE_NAME = 'practicausuarios';

    try{
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    }catch (PDOException $exception) {
        //Si existe algún error con la conección el script se detiene y muestra el error
        die ('Error al conectar con la base de datos');
    }
}


//Plantilla de la cabecera
function template_header($title){
// Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″ />
            <title>$title</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <header>
                <nav class="navbar is-dark">
                    <div class="navbar-start">
                        <a class="navbar-item">Carrito de Compras</a>
                        <a class="navbar-item" href="index.php">Home</a>
                        <a class="navbar-item" href="index.php?page=products">Productos</a>
                        <div class="link-icons">
                            <a class="navbar-item" >
                                <a class="fas fa-shopping-cart" href="index.php?page=cart"></a>
                                <span>$num_items_in_cart</span>
                            </a>
                        </div>
                    </div>
                    <div class="navbar-end">
                        <div class="navbar-item">
                            <div class="buttons">
                                <a class="button is-info" href="manager.php"> 
                                    <strong>Manager</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <main id="wrapper">
EOT;
            }

            //Plantilla de pie de pagina
            function template_footer(){
echo <<<EOT
            </main>
            <footer class="footer">
                <div class="content has-text-centered">
                    <p>&copy; Carrito de Compras</p>
                </div>
            </footer>
            <script src="script.js"></script>
        </body>
    </html>
EOT;
}
?>