<?php
include ("db_connect.php");
if(isset($_POST["query"]))
{
    $output = '';
    $query = "SELECT * FROM products WHERE product_name LIKE '%".$_POST["query"]."%'";
    $result = mysqli_query($con, $query);
    $output = '<ul class="list-unstyled">';
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            $output .= '<li>'.$row["product_name"].'</li>';
        }
    }
    else
    {
        $output .= '<li>Item Not Found</li>';
    }
    $output .= '</ul>';
    echo $output;
}
?>