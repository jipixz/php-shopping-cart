<?php
include 'managerfunctions.php';
?>
<?=template_header('Añadir producto')?>

<div class="columns is-centered">
    <div class="column is-half">
        <form action="managerfunctions.php" method="post">
            <div class="field">
                <label class="label">Name</label>
                <div class="control">
                  <input class="input" type="name" name="name" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Descripcion</label>
                <div class="control">
                  <input class="textarea" type="descr" name="descr">
                </div>
              </div>
              <div class="field">
                <label class="label">Precio</label>
                <div class="control">
                  <input class="input" type="price" name="price" required>
                </div>
              </div>
              <div class="field">
                <label class="label">RRP</label>
                <div class="control">
                  <input class="input" type="rrp" name="rrp" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Cantidad</label>
                <div class="control">
                  <input class="input" type="quantity" name="quantity" required>
                </div>
              </div>
              <div class="field">
                <label class="label">IMG</label>
                <div class="control">
                  <input class="input" type="img" name="img">
                </div>
              </div>
              <input class="button is-info" type="submit" value="Submit" name="add_product">
        </form>
    </div>
</div>

<?=template_footer()?>