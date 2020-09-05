<?php
include 'functions.php';
$pdo = pdo_connect_mysql();



if(isset($_POST['add_product'])){

    $name       = $_POST["name"];
    $descr      = $_POST["descr"];
    $price      = $_POST["price"];
    $rrp        = $_POST["rrp"];
    $quantity   = $_POST["quantity"];
    $img        = $_POST["img"];

    //Funcion para agregar un producto a la BD
    $stmt = $pdo->prepare("INSERT INTO 
                            products (
                                name, 
                                descr, 
                                price, 
                                rrp, 
                                quantity, 
                                img
                            )
                            VALUES (
                                '$name', 
                                '$descr', 
                                '$price', 
                                '$rrp', 
                                '$quantity', 
                                '$img'
                            )"
                            );
    $stmt -> execute();
    header('Location: manager.php');

}

if(isset($_POST['delete_product'])){

    $id         = $_POST["id"];
    
    $stmt = $pdo -> prepare("SELECT 1
                            FROM products
                            WHERE id = '$id'");
    //var_dump((array) $stmt);
    $stmt->execute();


    if ($stmt->rowCount() == 0){

        echo('No existe el producto');

    } else {

        //Funcion para agregar un producto a la BD
        $stmt = $pdo->prepare("DELETE FROM 
                                products 
                                WHERE   
                                id = '$id'   
                            ");
                            //var_dump ((array) $stmt);
        $stmt->execute();
        header('Location: manager.php');

    }

}

if(isset($_POST['add_stock'])){

    $id         = $_POST["id"];
    $quantity   = $_POST["quantity"];

    $stmt = $pdo -> prepare("SELECT 1
    FROM products
    WHERE id = '$id'");
    //var_dump((array) $stmt);
    $stmt->execute();



    if ($stmt->rowCount() == 0){

        echo('No existe el producto');

    } else {

        $stmt = $pdo->prepare("UPDATE 
                                products
                                SET 
                                    quantity = '$quantity'
                                WHERE 
                                    id='$id'
                                "
                                );
                                //var_dump ((array) $stmt);
        $stmt->execute();                         
        header('Location: manager.php');

    }

}
