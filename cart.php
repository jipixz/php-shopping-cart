<?php
//La página de carrito de compras, enlistará todos los
//productos que sean añadidos al carrito, así como cantidades, precio total y subtotal.

//Si el usuario hace click en el botón de añadir en la página producto
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])){
    //Ajusta valor de las variables post par identificarlos fácilmente y que sea entero
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    //Prepara la sentencia SQL para revisar si existe
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_POST['product_id']]);

    //Fetch producto de la BD y retornar como arreglo
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    //Verificar si el producto existe
    if ($product && $quantity > 0){
        //El producto existe en la BD, ahora podemos crear o actualizar la variable sesión del carrito
        if (isset($_SESSION['cart']) && is_array($_SESSION{'cart'})){
            if (array_key_exists($product_id, $_SESSION['cart'])){

                //El producto existe en el carrito así que solo actualiza cantidad
                $_SESSION['cart'][$product_id] += $quantity;

            }else{

                //El producto no está en el carrito así que se añade
                $_SESSION['cart']{$product_id} += $quantity;

            }
        }else{

            //No hay productos en el carrito, añadirá el primero producto al carrito
            $_SESSION['cart'] = array($product_id => $quantity);
        
        }
    }

    

    //Prevenir el reenvío
    header('location: index.php?page=cart');
    exit;

}




//Remueve producto del carrito con el ID verificando que existe y en un número
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    
    //Remover el producto del carrito
    unset($_SESSION['cart'][$_GET['remove']]);

}



//Actualizar cantidades de productos en el carrito si el usuario hace click en update en la página del carrito
if (isset($_POST['update']) && isset($_SESSION['cart'])){

    //Ciclo en los datos post para actualizar las cantidades de cada producto en el carrito
    foreach($_POST as $k => $v){

        if (strpos($k, 'quantity') !== false && is_numeric($v)){
            
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;

            //Siempre hace validaciones
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0){

                //actualizar nueva cantidad
                $_SESSION['cart'][$id] = $quantity;

            }

        }

    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;

}




//Envía al usuario a la página de orden si hacen click en hacer pedido, también el carrito no debe estar vacío
if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])){

    header('Location: index.php?page=placeorder');
    exit;

}



//Checar la variable de sesión de los productos en el carrito
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;

//Si existen productos en el carrito
if($products_in_cart){

    //Hay productos en el carrito así que necesitamos seleccionar esos productos desde la BD
    //Productos en el arreglo del carrito a un arreglo de caracteres simbolo de pregunta, necesitamos la sentencia SQL que incluya IN (?,?,?,...etc)
    $array_to_question_marks = implode (',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');

    //Solo se necesita el arreglo de llaves, no los valores, las llaves son los IDs de los productos
    $stmt->execute(array_keys($products_in_cart));

    //Fetch los productos de la BD y retornar el resultado como arreglo
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //Calcular el subtotal
    foreach($products as $product){
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}
?>


<?=template_header('Cart')?>

<div class="cart content-wrapper">
    <section class="hero is-info">
        <div class="hero-body">
          <div class="container">
            <h1 class="title has-text-centered">
            Carrito de compra
            </h1>
          </div>
        </div>
    </section>
    <div class="container">
        <div class="section">
            <form action="index.php?page=cart" method="post">
                <table class="table table is-fullwidth">
                    <thead>
                        <tr>
                            <td colspan="2">Producto</td>
                            <td>Precio</td>
                            <td>Cantidad</td>
                            <td class="has-text-right">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($products as $product): ?>
                        <tr>
                            <td class="img">
                                <a href="index.php?page=product&id=<?=$product['id']?>">
                                    <img src="imgs/<?=$product['img']?>" width="50" height="50" alt="<?=$product['name']?>">
                                </a>
                            </td>
                            <td>
                                <a href="index.php?page=product&id=<?=$product['id']?>"><?=$product['name']?></a>
                                <br>
                                <a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove">Eliminar    </a>
                            </td>
                            <td class="price">&dollar;<?=$product['price']?></td>
                            <td class="quantity">
                                <input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                            </td>
                            <td class="has-text-right">&dollar;<?=$product['price'] * $products_in_cart[$product['id']]?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
                <div class="has-text-right">
                    <span class="text">Subtotal</span>
                    <span class="has-text-right">&dollar;<?=$subtotal?></span>
                </div>
                <div class="buttons mt-4 is-pulled-right">
                    <button class="button is-info" type="submit" value="Update" name="update">Actualizar</button>
                    <button class="button is-info" type="submit" value="Place Order" name="placeorder">Generar pedido</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?=template_footer()?>