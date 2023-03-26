<?php include_once('db_connect.php');

if(isset($_REQUEST['action']) and $_REQUEST['action']=="addDataRow"){
    $count=$_REQUEST['count'];




    ?>


    <tr>

        <td><input class="itemRow" type="checkbox"></td>
        <td>
            <select name="productId[]" id="productId_<?php echo $count ?>" class="form-control selectpicker" data-live-search="true" data-size="10" required="required">

                <?php
                $result =   $con->query("SELECT * FROM products");
                while($val  =   $result->fetch_assoc()){
                    ?>
                    <option value="<?php echo $val['product_id']?>" data-subtext="(<?php echo $val['product_name']?>)"><?php echo mb_strtoupper($val['product_name'],'UTF-8')?></option>
                <?php }?>
            </select>
        </td>

        <td><input type="number" name="quantity[]" id="quantity_<?php echo $count ?>" class="form-control quantity" placeholder="0" required="required"></td>

        <td><input type="number" name="price[]" id="price_<?php echo $count ?>"   class="form-control price" placeholder="0" ></td>
        <td><input type="number" name="total[]"  id="total_<?php echo $count ?>" class="form-control total" placeholder="0" readonly></td>

        <td align="center" class="text-danger"><button type="button" data-toggle="tooltip" data-placement="right" title="Click To Remove" onclick="if(confirm('Are you sure to remove?')){$(this).closest('tr').remove();}" class="btn btn-danger"><i class="fa fa-fw fa-trash-alt"></i></button></td>

    </tr>
<?php

}

