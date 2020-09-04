<?php 
//Este archivo será la página principal, contiene una
//imagen y 4 productos agregados recientemente

//Recuperar los últimos 4 productos añadidos
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>

    <section class="hero is-info">
        <div class="hero-body">
          <div class="container">
            <h1 class="title has-text-centered	">
                Productos
            </h1>
            <h2 class="subtitle has-text-centered	">
                Productos agregados recientemente
            </h2>
          </div>
        </div>
    </section>
    <div class="section">
        <div class="container container-grid">
            <?php foreach($recently_added_products as $product): ?>
            <a href="index.php?page=product&id=<?=$product['id']?>">
                <div class="card is-vcentered">
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
    </div>

<?=template_footer()?>