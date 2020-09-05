<?php
include 'managerfunctions.php';
?>
<?=template_header('Eliminar producto')?>

<div class="columns is-centered">
    <div class="column is-half">
        <form action="managerfunctions.php" method="post">
            <div class="field">
                <label class="label">ID del producto</label>
                <div class="control">
                  <input class="input" type="id" name="id" required> 
                </div>
              </div>
              <input class="button is-info" type="submit" value="Submit" name="delete_product">
        </form>
    </div>
</div>

<?=template_footer()?>