<?php 
//Este archivo mostrará el producto y contendrá un form
//para cambiar la cantidad a agregar al carrito

//Revisar que el ID esté especificada en el URL
if (isset($_GET['id'])){
    //Preparar declaración y ejecutar para prevenir inyección SQL
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);

    //Fetch producto desde la BD y retornar el resultado como arreglo
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    //Verifica que el producto exista
    if (!$product){
        //Muestra un error simple so el ID del producto no existe
        die('No existe el producto');
    }
}else {
    //Error si el ID no se especifica
    die('El producto no existe');
}
?>

<?=template_header('Product')?>

<section class="hero is-info">
    <div class="hero-body">
      <div class="container">
        <h1 class="title has-text-centered	">
            Producto
        </h1>
      </div>
    </div>
</section>
<div class="section">
    <div class="container container-grid2 is-vcentered">
            <img src="imgs/<?=$product['img']?>" width="500" height="500" alt="<?=$product['name']?>">
            <div>
                <h1 class="title"><?=$product['name']?></h1>
                <span class="subtitle">
                    &dollar;<?=$product['price']?>
                    <?php if ($product['rrp'] > 0): ?>
                    <span class="rrp">&dollar;<?=$product['rrp']?></span>
                    <?php endif; ?>
                </span>
                <form action="index.php?page=cart" method="post">
                    <input class="input mt-4" type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                    <input type="hidden" name="product_id" value="<?=$product['id']?>">
                    <button class="button mt-4 is-fullwidth is-info is-outlined" type="submit">Agregar al carrito</button>
                </form>
                <div class="description">
                    <?=$product['desc']?>
                </div>
            </div>
    </div>
</div>

<?=template_footer()?>