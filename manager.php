<?php
//abrimos la sesión
session_start();
 
//Si la variable sesión está vacía
/*
if (!isset($_SESSION['admin'])) 
{
   // nos envía a la siguiente dirección en el caso de no poseer autorización 
   header("location:/coulbefinal-copia/home.php"); 
}
*/

include 'functions.php';
$pdo = pdo_connect_mysql();
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC');
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


$total_products = $pdo->query('SELECT*FROM products')->rowCount();
?>
<?=template_header('Products')?>


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
   <div class="field is-grouped pt-6 columns is-centered">
      <p class="control">
         <a class="button is-info" href="addproduct.php">
            Agregar producto
         </a>
      </p>
      <p class="control">
         <a class="button is-info" href="deleteproduct.php">
            Eliminar producto
         </a>
      </p>
      <p class="control">
         <a class="button is-info" href="addstock.php">
            Agregar stock
         </a>
      </p>
   </div>
    <div class="section">
      <table class="table is-fullwidth">
         <thead>
            <tr>
               <th>ID</th>
               <th>Nombre</th>
               <th>Descripción</th>
               <th>Precio</th>
               <th>RRP</th>
               <th>Cantidad</th>
               <th>IMG</th>
               <th>Añadido el</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($products as $product): ?>

            <tr>

               <td><?=$product['id']?></td>
               <td><?=$product['name']?></td>
               <td><?=$product['descr']?></td>
               <td><?=$product['price']?></td>
               <td><?=$product['rrp']?></td>
               <td><?=$product['quantity']?></td>
               <td><?=$product['img']?></td>
               <td><?=$product['date_added']?></td>

            </tr>   

            <?php endforeach; ?>
         </tbody>
      </table>
   </div>






<?=template_footer()?>