<?php
//Mensaje básico que será desplegado al usuario cuando
//hagan una orden en la página del carrito

function placeorder_submit(){

  if (isset($_SESSION['cart'])){

      $cartArray = $_SESSION['cart'];

      foreach ($cartArray as $id => $quantity) {
      
        $pdo = pdo_connect_mysql();  
        $stmt = $pdo->prepare("UPDATE products SET quantity = quantity - '$quantity' WHERE id = '$id'");
        $stmt->execute();
        
      }
      session_unset();
      return 0; 

  }else{

    header('Refresh: 5 ; URL=index.php');
    return 1;

  }
}


  

?>
<?=template_header('Place Order')?>

<?php if (placeorder_submit() == 0):?>
<section class="hero is-info">
    <div class="hero-body">
      <div class="container">
        <h1 class="title has-text-centered	">
        Tu orden ha sido correcta
        </h1>
        <h2 class="subtitle has-text-centered">
            Te contactaremos via email para el pago.
        </h2>
      </div>
    </div>
</section>
<?php elseif(placeorder_submit() == 1):?>
  <section class="hero is-info">
    <div class="hero-body">
      <div class="container">
        <h1 class="title has-text-centered	">
          Tu orden no ha podido ser procesada
        </h1>
        <h2 class="subtitle has-text-centered">
            No tienes artículos elegidos en el carrito. Serás redirigo en unos segundos...
        </h2>
      </div>
    </div>
</section>
<?php else: ?>
  <section class="hero is-info">
    <div class="hero-body">
      <div class="container">
        <h1 class="title has-text-centered	">
          Tu orden no ha podido ser procesada
        </h1>
        <h2 class="subtitle has-text-centered">
            ERROR DESCONOCIDO
        </h2>
      </div>
    </div>
</section>
<?php endif; ?>
<?=template_footer()?>  