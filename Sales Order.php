<?php
include("header.php");
?>
<html>
    <head>
	<?php
		if($_GET['Id'] == "") echo "<title>Add Sales Order</title>";
		elseif($_GET['Id'] == "e") echo "<title>Update Sales Order</title>";
		//else echo "<title>View Sales Order</title>";
    ?>
        <style>     
            th{
                background-color: cornflowerblue;
                font-size: 20px;
                color: azure;
            }
            td .border{
                border: 2px solid dimgrey;
            }
            td{
                font-size: 18px
            }
        </style>
		<script>
            var count = 1;
            
            function Reset(){
                document.getElementById("myForm").reset();
            }
            
            function atest()
            {
                window.alert('hello world');
            }
            
            /*function plusSalesItem()
            {          
                var table = document.getElementById("SDTable");
                var row = table.insertRow(-1);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                //var cell5 = row.insertCell(4);

                count++;*/
                window.alert('ghooo');
               /* cell1.innerHTML = count + ".";
            <?php 
                /*$PIdSQL = "SELECT * FROM tblproduct";
                $PIdSQLResult = mysqli_query($Link,$PIdSQL);
                echo "cell2.innerHTML = '<select name='sltPId\" + count + \"' id='sltPId\" + count + \"'>";

                if(mysqli_num_rows($PIdSQLResult) > 0){
                    for($i = 0; $i < mysqli_num_rows($PIdSQLResult); $i++)
                    {
                        $PIdRow = mysqli_fetch_array($PIdSQLResult);
                        echo "<option value='".$PIdRow['productId']."'"; 
                        if($row['productId'] == $PIdRow['productId']) echo "selected";
                            echo " >".$PIdRow['productId']."</option>";
                    }
                }
                else echo "<option>No Record Found</option>";*/
                    echo "window.alert('ghjj');";
               // echo "</select>";
            ?>
                cell3.innerHTML = "<input type='number' id='txtQty" + count + "' name='txtQty" + count + "' min='0' max='50' value='<?php //if($_GET['Id'] != "") echo $row['qty']; ?>'>";

                cell4.innerHTML = "<input type='text' id='txtUntPrice" + count + "' name='txtUntPrice" + count + "' value='<?php if($_GET['Id'] != "") //echo $row['unitPrice']; ?>' <?php echo " readonly"; ?> >";
                echo "window.alert('ghjj')";
                document.getElementById("counterSItem").value = count;
            }*/
		
            function minusSalesItem()
            {
                var table = document.getElementById("SDTable");
                var counter = document.getElementById("counterSItem");
                var row = table.deleteRow(-1);

                if ( count != 1 )
                    count--;

                document.getElementById("counterSItem").value = count;
            }
        </script>
    </head>
    <body>
        
		<?php
		if($_SESSION['LoginStatus'] == true){
			include("menu.php");
			if($_GET['Id'] != "")
			{
				$SQL = "SELECT * FROM tblsalesorder WHERE orderId = '".$_GET['Id']."'";
				$Result = mysqli_query($Link,$SQL);
				if(mysqli_num_rows($Result) > 0)
					$row = mysqli_fetch_array($Result);
			}
			if($_POST['btnUpdate'])
        	{
				if($_POST['txtOrderId'] == "" || $_POST['sltCustId'] == "" || $_POST['txtDate'] == "" || $_POST['txtTAmt'] == "" || $_POST['sltPId'] == "" || $_POST['txtQty'] == "")
				{
					echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
				}
				else
				{
					$UpdateSalesOrder = "UPDATE tblsalesorder SET custId = '".strtoupper(trim($_POST['sltCustId']))."',
							date = '".strtoupper(trim($_POST['txtDate']))."',
							totalAmt = '".strtoupper(trim($_POST['txtTAmt']))."'
                            WHERE orderId = '".strtoupper(trim($_POST['txtOrderId']))."'";
			
                    $UpdateSalesOrderItem = "UPDATE tblsalesorderitem SET productId = '".strtoupper(trim($_POST['sltPId']))."',
							qty = '".strtoupper(trim($_POST['txtQty']))."',
							unitPrice = '".strtoupper(trim($_POST['txtUPrice']))."'
                            WHERE orderId = '".strtoupper(trim($_POST['txtOrderId']))."'";
			
					$UpdateSalesOrderResult = mysqli_query($Link, $UpdateSalesOrder);
                    $UpdateSalesOrderItemResult = mysqli_query($Link, $UpdateSalesOrderItem);
					
					if($UpdateSalesOrderResult && $UpdateSalesOrderItemResult)
                    {
                        echo "<script>alert('Sales Record updated successfully'); location='Sales Order.php';</script>";
                    }
                    else
                    {
                        echo "<script>alert('Sales Record added failure'); location='$PHP_SELF';</script>";
                    }
				}
			}
			else if($_POST['btnCheckOut'])
            {
                if($_POST['txtOrderId'] == "" || $_POST['sltCustId'] == "" || $_POST['txtDate'] == "" || $_POST['txtTAmt'] == "" || $_POST['sltPId'] == "" || $_POST['txtQty'] == "")	
                {
                    echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
                }
                else
                {
                    $AddSalesOrderSQL = "INSERT INTO tblsalesorder (orderId,custId,date,totalAmt) 
                    VALUES ('".strtoupper(trim($_POST['txtOrderId']))."',
					'".strtoupper(trim($_POST['sltCustId']))."',
                    '".strtoupper(trim($_POST['txtDate']))."',
                    '".strtoupper(trim($_POST['txtTAmt']))."')";

                    $AddSalesOrderItemSQL = "INSERT INTO tblsalesorderitem (orderId,productId,qty,unitPrice) 
                    VALUES ('".strtoupper(trim($_POST['txtOrderId']))."',
					'".strtoupper(trim($_POST['sltPId']))."',
                    '".strtoupper(trim($_POST['txtQty']))."',
                    '".strtoupper(trim($_POST['txtUPrice']))."')";
                    
                    $AddSalesOrderResult = mysqli_query($Link, $AddSalesOrderSQL);
                    $AddSalesOrderItemResult = mysqli_query($Link, $AddSalesOrderItemSQL);
					
					if($AddSalesOrderResult && $AddSalesOrderItemResult)
                    {
                        echo "<script>alert('Sales Record added successfully'); location='Sales Order.php';</script>";
                    }
                    else
                    {
                        echo "<script>alert('Sales Record added failure'); location='$PHP_SELF';</script>";
                    }
                }
			}
		?>
        <form name="myForm" id="myForm" action="" method="post">
            <!--<table align="center" border="0" width="360px" height="400px" style="margin-top:15px;margin-bottom:10px">
                <tr>
                    <th colspan="2"><center>Sales Info</center></th>
                </tr>
                <tr>
                    <td style="width:160px">Order Id :</td>
                    <td><input type="text" name="txtOrderId" placeholder="" value="<?php if($_GET['Id'] != "") echo $row['orderId']; ?>" <?php if($_GET['Id'] != "") echo "readonly"; ?>></td>
                </tr>
                <tr>
                    <td>Customer Id :</td>
                    <td>
                        <select name="sltCustId">
                            <option value="" selected>Please select Customer Id</option>
                    <?php
                        $CustSQL = "SELECT custId,custName FROM tblcustomer ORDER BY custId";
                        
                        $CustSQLResult = mysqli_query($Link,$CustSQL);
                        
                        if(mysqli_num_rows($CustSQLResult) > 0){
                            for($i = 0; $i < mysqli_num_rows($CustSQLResult); $i++)
                            {
                                echo $CustRow = mysqli_fetch_array($CustSQLResult);
                                echo "<option value='".$CustRow['custId']."'"; 
                                if($_GET['Id'] != "")if($row['custId'] == $CustRow['custId']) echo " selected";
                                echo " >".$CustRow['custId']."</option>";
                            }
                        }
                        else echo "<option>No record found</option>";
                    ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Date :</td>
                    <td><input type="datetime-local" name="txtDate" value="<?php if($_GET['Id'] != "") echo $row['date']; else date("Y m d"); ?>"></td>
                </tr>
				<tr>
					<td>Total Amount :</td>
					<td><input type="text" name="txtTAmt" value="<?php if($_GET['Id'] != "") echo $row['totalAmt']; ?>"></td>
				</tr>
            </table>-->
            <?php //$count = 0; ?>
            <table align="center" style="width:600px;height:160px;margin-bottom:10px;">
            <tr><th colspan="4">Sales Details</th></tr>
                <tr align="center">   
                   <td width="30px">No </td>
                    <td width="90px">Product Id :</td>
                    <td width="180px">Quantity on Hand :</td>
                    <td style="width:100px">Unit Price :</td>
                </tr>             
                <tr>
                    <td width="30px">1.</td>
                    <td width="200px">
                        <select name="sltPId0">
                            <option value=""></option>
                    <?php
                        $PIdSQL = "SELECT * FROM tblproduct";
						$PIdSQLResult = mysqli_query($Link,$PIdSQL);
						//$CustRow = mysql_fetch_array($CustSQLResult);
                        if(mysqli_num_rows($PIdSQLResult) > 0){
                            for($i = 0; $i < mysqli_num_rows($PIdSQLResult); $i++)
                            {
                                $PIdRow = mysqli_fetch_array($PIdSQLResult);
                                echo "<option value='".$PIdRow['productId']."'"; 
                                if($row['productId'] == $PIdRow['productId']) echo "selected";
                                echo " >".$PIdRow['productId']."</option>";
                            }
                        }
                        else echo "<option>No record found</option>";  
                    ?>                 
                        </select>
                    </td>                
                    
                    <td width="">
                        <input type="number" name="txtQty0" min="0" max="50" value="<?php if($_GET['Id'] != "") echo $row['qty']; ?>">
                    </td> 
                <!-- <td>Unit Price :</td> -->
                    <td width="">
                        <input type="text" name="txtUntPrice0" value="<?php if($_GET['Id'] != "") echo $row['unitPrice']; ?>" readonly>
                    </td> 
                </tr>
            </table>
            <table name="SDTable" id="SDTable" align="center" style="width:600px">
            </table>
            <!--<script>
                function atest()
            {
                window.alert('hello world');
            }
            </script>-->
            <table align="center" cellpadding="6" border="0">
                <tr >
                    <td align="center" border="0">
                        <input type="button" name="btnPlus" value="+"  id="btnPlus" onclick="atest()" /> <!--plusSalesItem() style="margin-right:20x;margin-top:10px;padding:7px"-->
                        <input type="button" name="btnMinus" value="-" style="margin-left:20px;margin-top:10px;padding:7px" id="btnMinus" onclick="minusSalesItem()" /><!--plusSalesItem()-->
                    </td>            
                </tr>
            </table>
            <!--<table align="center">
                <tr style="border-top:2px;">
                    <td colspan=7 align="center" style="border:0px;align:center;">
                    <?php
                    if($_GET['Id'] == "e")
                        echo "<input type='submit' name='btnUpdate' value='Update' style='margin:5px;padding:5px'>";
                    elseif($_GET['Id'] == "")
                        echo "<input type='submit' name='btnCheckOut' value='CheckOut' style='margin:5px;padding:5px'>";
                    ?>
                        <input type="reset" name="btnReset" style="margin:5px;padding:5px" value="Reset" onClick="Reset()"></td>
                </tr>
            </table>-->
            <div style="text-align:center;margin-bottom:4%">
                <br /><br />
                <input type="hidden" name="counterSItem" id="counterSItem" value=""/>
                <!--<input type="submit" name="btnAdd" id="btnAdd" value="Add"/>-->
            </div>
        </form>
		<?php
        }
        else echo"<script>alert('Please login in first.'); location='index.php';</script>";
		?>
    </body>
</html>