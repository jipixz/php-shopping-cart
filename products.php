<?php
//Este archivo será para mostrar todos los productos


//Cantidad de productos por página
$num_products_on_each_page = 8;

$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;

//Seleccionar productos por fecha
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT ?,?');

//bindValue nos permitirá usar integer en la declaración SQL, necesitamos usar para LIMIT
$stmt->bindValue(1, ($current_page -1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();

//Ftech productos de la BD y retornar resultado en un array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Obtener numero total de prodcutos
$total_products = $pdo->query('SELECT*FROM products')->rowCount();
?>

<?=template_header('Products')?>

<div class="products content-wrapper">
    <section class="hero is-info">
        <div class="hero-body">
          <div class="container">
            <h1 class="title has-text-centered">
                Productos
            </h1>
            <h2 class="subtitle has-text-centered">
                <?=$total_products?> Productos
            </h2>
          </div>
        </div>
    </section>
    <div class="section">
        <div class="container container-grid">
            <?php foreach($products as $product): ?>
            <a href="index.php?page=product&id=<?=$product['id']?>">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-128x128">
                            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media-content">
                            <p class="title is-4"><?=$product['name']?></p>
                            <p class="subtitle is-6">
                                &dollar;<?=$product['price']?>
                                <?php if ($product['rrp']>0): ?>
                                <span class="rrp">&dollar;<?=$product['rrp']?></span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <div class="container pt-6">
            <?php if ($current_page > 1): ?>
            <a class="button is-info" href="index.php?page=products&p=<?=$current_page-1?>">Ant</a>
            <?php endif; ?>
            <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($products)) : ?>
            <a class="button is-info" href="index.php?page=products&p=<?=$current_page+1?>">Sig</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?=template_footer()?>