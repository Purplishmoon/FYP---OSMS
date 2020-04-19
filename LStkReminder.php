<?php
//include("header.php");

$ChkLowStkSQL = "SELECT tblprodstat.pId,tblproduct.productName,tblprodstat.qty,oriPrice FROM tblproduct,tblprodstat,tbllowstocklimit WHERE tblproduct.productId = tblprodstat.pId AND tblprodstat.pId = tbllowstocklimit.pId AND tblprodstat.qty <= tbllowstocklimit.qtyLimit ORDER BY productName ASC";
$ChkLowStkResult = mysqli_query($Link,$ChkLowStkSQL);
if(mysqli_num_rows($ChkLowStkResult) > 0){
    echo "<script>
        var myWindow = window.open('', 'Low Stock Reminder', 'width=600,height=500');
        myWindow.document.write('<p>Attention! The stock of below has low quantity, should be resupplied:</p><table align=\"center\" style=\"width:740px;height:160px;margin-bottom:10px;\" cellpadding=\"10px\"><tr><th colspan=\"4\" style=\"background-color:cornflowerblue;font-size:20px;color:azure;\"><center>Low Stock Product</center></th></tr><tr align=\"center\"><td width=\"30px\">No. </td><td width=\"120px\">Product Name :</td><td width=\"100px\">Product Id :</td><td width=\"80px\">Stock Quantity :</td><td style=\"width:100px\">Cost Price :</td></tr>";           
    for($i = 0; $i < mysqli_num_rows($ChkLowStkResult); ++$i){
        $LowProdRow = mysqli_fetch_array($ChkLowStkResult);
        //if($LowProdRow['qty'] <= $LowProdRow['qtyLimit']){
            echo "<tr>";
            echo "<td>".($i + 1)."</td>";
            echo "<td>".$LowProdRow['productName']."</td>";
            echo "<td>".$LowProdRow['productId']."</td>";
            echo "<td>".$LowProdRow['qty']."</td>";
            echo "<td>".$LowProdRow['oriPrice']."</td>";
            echo "</tr>";
        //}
    }
        echo "</table><br><br><br><a href=\"PurchasesOrder.php\">Go To Purchases Order</a>' </script>";
}
?>
