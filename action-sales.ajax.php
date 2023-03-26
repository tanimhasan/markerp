<?php include_once('db_connect.php');

if (isset($_REQUEST['action']) and $_REQUEST['action'] == "addDataRow") {
    $count = $_REQUEST['count'];

    $product_id = $_REQUEST['product_id'];


    ?>


    <tr>

        <td><input class="itemRow" type="checkbox"></td>


        <?php
        $result = $con->query("SELECT * FROM products WHERE product_id='$product_id'");
        while ($val = $result->fetch_assoc()) {
            ?>


            <input type="hidden" name="productId[]" id="productId_<?php echo $count ?>"
                       class="form-control quantity" value="<?php echo $val['product_id'] ?>" max="<?php echo $val['product_stock'] ?>">


            <td>

            <input type="text" name="productName[]" id="productName_<?php echo $count ?>" class="form-control quantity"
                   value="<?php echo $val['product_name'] ?>" readonly></td>


            <td><input type="number" name="quantity[]" id="quantity_<?php echo $count ?>" class="form-control quantity"
                       placeholder="0" required="required"></td>

            <td><input readonly type="number" name="buy_price[]" id="buy_price_<?php echo $count ?>" class="form-control price"
                       value="<?php echo $val['product_buy_price']; ?>" </td>

            <td><input type="number" name="price[]" id="price_<?php echo $count ?>" class="form-control price"
                       value="<?php echo $val['product_sell_price']; ?>"</td>
            <td><input type="number" name="total[]" id="total_<?php echo $count ?>" class="form-control total"
                       placeholder="0" readonly></td>

            <td align="center" class="text-danger">
                <button type="button" data-toggle="tooltip" data-placement="right" title="Click To Remove"
                        onclick="if(confirm('Are you sure to remove?')){$(this).closest('tr').remove(); calculateTotal()}"
                        class="btn btn-danger"><i class="fa fa-fw fa-trash-alt"></i></button>
            </td>

        <?php } ?>
    </tr>
    <?php

}

