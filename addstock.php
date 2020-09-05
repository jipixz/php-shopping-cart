<?php
include 'managerfunctions.php';
?>
<?=template_header('Añadir stock')?>

<div class="columns is-centered">
    <div class="column is-half">
        <form action="managerfunctions.php" method="post">
            <div class="field">
                <label class="label">ID del producto</label>
                <div class="control">
                  <input class="input" type="name" name="id" required>
                </div>
              </div>
              <div class="field">
                <label class="label">Stock a añadir</label>
                <div class="control">
                  <input class="textarea" type="descr" name="quantity" required>
                </div>
              </div>
              <input class="button is-info" type="submit" value="Submit" name="add_stock">
        </form>
    </div>
</div>

<?=template_footer()?>