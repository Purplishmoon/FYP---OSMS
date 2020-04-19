<?php
include("header.php");
?>
<html>
    <head>
      <link href="css/style.css" rel="stylesheet" type="text/css">
      <script src="/js/jquery-3.2.1.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<?php
		if($_GET['Id'] == "") echo "<title>Add Sales Order</title>";
		elseif($_GET['Id'] == "e") echo "<title>Update Sales Order</title>";
		//else echo "<title>View Sales Order</title>";
    ?>
      <style>     
        body{
            background-color: #fff;
        }

        /*.animate-bottom {
          position: relative;
          -webkit-animation-name: animatebottom;
          -webkit-animation-duration: 1s;
          animation-name: animatebottom;
          animation-duration: 1s
        }*/

        .animate-top {
          position: relative;
          -webkit-animation-name: animatetop;
          -webkit-animation-duration: 1s;
          animation-name: animatetop;
          animation-duration: 1s
        }

        @-webkit-keyframes animatetop {
          from { top:-100px; opacity:0 } 
          to { top:0px; opacity:1 }
        }

        @keyframes animatetop { 
          from{ top:-100px; opacity:0 } 
          to{ top:0px; opacity:1 }
        }

        /*@-webkit-keyframes animatebottom {
          from { bottom:-100px; opacity:0 } 
          to { bottom:0px; opacity:1 }
        }

        @keyframes animatebottom { 
          from{ bottom:-100px; opacity:0 } 
          to{ bottom:0px; opacity:1 }
        }*/

        #topDiv {
          display: /*none*/;
          text-align: center;
        }

        /*#bottomDiv {
          display: /*none*/;
        /*  text-align: center;
        }*/

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
          /*#myInput {
              box-sizing: border-box;
              background-image: url('searchicon.png');
              background-position: 14px 12px;
              background-repeat: no-repeat;
              font-size: 16px;
              padding: 14px 20px 12px 45px;
              border: none;
              border-bottom: 1px solid #ddd;
            }
            #myInput:focus {outline: 3px solid #ddd;}

            .dropdown {
              position: relative;
              display: inline-block;
            }
            .dropdown-content {
              display: none;
              position: absolute;
              background-color: #f6f6f6;
              min-width: 230px;
              overflow: auto;
              border: 1px solid #ddd;
              z-index: 1;
            }
            .dropdown-content a {
              color: black;
              padding: 12px 16px;
              text-decoration: none;
              display: block;
            }
            .dropdown a:hover {background-color: #ddd;}

            .show {display: block;}*/
        </style>
      <script type="text/javascript" charset="utf-8">
          var count = 1;

          function Reset(){
              document.getElementById("myForm").reset();
          }

          function plusSalesItem()
          {          
              count++;

              var table = document.getElementById("SDTable");
              var row = table.insertRow(-1);
              var cell1 = row.insertCell(0);
              var cell2 = row.insertCell(1);
              var cell3 = row.insertCell(2);
              var cell4 = row.insertCell(3);
              //var cell5 = row.insertCell(4);

              var h = 100 + "px";
              var w = 740 + "px";
              var w1 = 30 + "px";
              var w2 = 200 + "px";
              var w3 = 100 + "px";
              var w4 = 240 + "px";

              /*function copyField() {
                var x = document.getElementById("sltPId1").innerHTML;
                document.getElementById(("PIdField" + count)).innerHTML = x;
              }*/

              cell1.innerHTML = count + ".";

          <?php 
              //$PIdSQL = "SELECT * FROM tblproduct WHERE ";
              //$PIdSQLResult = mysqli_query($Link,$PIdSQL);
              //echo 'cell2.innerHTML = "<select name=\"sltPId" + count + "\" id=\"sltPId" + count + "\" />";';    
              
          ?>                
              //cell2.innerHTML = x;
              cell2.innerHTML = "<select name='sltPId" + count + "' id='sltPId" + count + "'><option>Please select Product Id</option><optgroup label='Product Name | Product Id | Stock Quantity'></optgroup>" + 
            "<?php $PIdSQL = "SELECT tblproduct.productId,tblproduct.productName,tblprodstat.qty FROM tblproduct,tblprodstat WHERE tblproduct.productId = tblprodstat.pId AND qty != 0"; $PIdSQLResult = mysqli_query($Link,$PIdSQL); if(mysqli_num_rows($PIdSQLResult) > 0){ for($i = 0; $i < mysqli_num_rows($PIdSQLResult); $i++) { $PIdRow = mysqli_fetch_array($PIdSQLResult); echo "<option value='".$PIdRow['productId']."' "; if($row['productId'] == $PIdRow['productId']) echo " selected"; echo ">".$PIdRow['productName']." | ".$PIdRow['productId']." | ".$PIdRow['qty']."</option>"; } } else echo "<option>No Record Found</option>"; ?>" + 
                  "</select>";
              //' => \", " => ", 
          <?php
              //' =>\", " => '
          ?>
              cell3.innerHTML = "<input type='number' id='txtQty" + count + "' name='txtQty" + count + "' class='Qt' size='5' min='1' max='' value='<?php if($_GET['Id'] != "") echo $row['qty']; else echo 1; ?>' required>";

              cell4.innerHTML = "<label>RM&nbsp;</label><input type='text' id='txtUntPrice" + count + "' name='txtUntPrice" + count + "' class='Pr' size='24' value='<?php if($_GET['Id'] != "") echo $row['unitPrice']; ?>' <?php //echo " readonly"; ?> >";

              //document.getElementById('container').style.width = tablewidth+"px";
              //document.getElementById('container').style.height = tableheight+"px";

              document.getElementById(row).style.height = h;
              document.getElementById(row).style.width = w;
              document.getElementById(cell1).style.width = w1;
              document.getElementById(cell2).style.width = w2;
              document.getElementById(cell3).style.width = w2;
              document.getElementById(cell4).style.width = w2;


              document.getElementById("counterSItem").value = count;

              //window.location.href="Sales Order.php?In=" + count;

              //document.cookie = "In = " + count;

              <?php 
              /*$In = $_GET["In"];

              //echo "document.writeln(count);";
              $In = $_COOKIE['In'];
              echo "window.alert('".$In."');";*/
              ?>
          }

          function minusSalesItem()
          {
              var table = document.getElementById("SDTable");
              var counter = document.getElementById("counterSItem");
              var row = table.deleteRow(-1);

              if ( count != 1 )
                  count--;

              document.getElementById("counterSItem").value = count;
          }

          //Retrieve #input2 and multiple with #input1 then live update to #answer text field 
          
        </script>
    </head>
    <body>
      <script>
        function chgPrice(ind){
          var PId = document.getElementById("sltPId" + ind).value;
          window.alert(PId);
          //document.cookie = "pid=" + PId + ";";
            //var PId = $('#sltPId' + count).val();
          
          //jQuery
          /*$.ajax({
            url: "Sales Order v2.php",
            method: "POST",
            data: { "PId": PId }
          })*/
          <?php 
            //echo "window.alert('".$_COOKIE['pid']."');";
            //$PId = $_COOKIE['pid'];
          //echo "window.alert(PId);";
          $PId = $_POST['PId'];
           echo "alert('".$PId."');";
            $UnitPriceSQL = "SELECT unitPrice FROM tblprodstat WHERE pId = '".$PId."'";
            $UnitPriceSQLResult = mysqli_query($Link,$UnitPriceSQL);
            $UPrice = mysqli_fetch_array($UnitPriceSQLResult);
          //echo $UPrice;
          ?>
          //window.alert('<?php  ?>');
          document.getElementById("txtUntPrice" + ind).innerHTML.value = <?php echo $UPrice; ?>;
        }
      </script>
		<?php
		if($_SESSION['LoginStatus'] == true){
            $step = 1;
            //top section
            echo "<div id='topDiv' class='animate-top'>";
            include("menu.php");
            echo "<div style='font-size:14px;text-align:right;margin-right:5%'>Logged in as : ";
            echo $_SESSION['UserName']." (".$_SESSION['AccType'].")";
            echo "</div></div>";
            //Set time zone
            date_default_timezone_set('Asia/Kuala_Lumpur');
            //echo date_default_timezone_get();
        
			if($_GET['Id'] != "")
			{
				$SQL = "SELECT * FROM tblsalesorder WHERE orderId = '".$_GET['Id']."'";
				$Result = mysqli_query($Link,$SQL);
				if(mysqli_num_rows($Result) > 0)
					$row = mysqli_fetch_array($Result);
			}
			if($_POST['btnUpdate'])
        	{
				if($_POST['txtOrderId'] == "" || $_POST['txtCustId'] == "" || $_POST['txtDate'] == "" || $_POST['txtTAmt'] == "" || $_POST['sltPId'] == "" || $_POST['txtQty'] == "")
				{
					echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
				}
				else
				{
					$UpdateSalesOrder = "UPDATE tblsalesorder SET custId = '".strtoupper(trim($_POST['sltCustId']))."',
							date = '".strtoupper(trim($_POST['txtDate']))."',
							totalAmt = '".strtoupper(trim($_POST['txtTAmt']))."'
                            WHERE orderId = '".strtoupper(trim($_POST['txtOrderId']))."'";
			
                    
                    /*$UpdateSalesOrderItem = "UPDATE tblsalesorderitem SET productId = '".strtoupper(trim($_POST['sltPId']))."',
							qty = '".strtoupper(trim($_POST['txtQty']))."',
							unitPrice = '".strtoupper(trim($_POST['txtUPrice']))."'
                            WHERE orderId = '".strtoupper(trim($_POST['txtOrderId']))."'";*/
			
					$UpdateSalesOrderResult = mysqli_query($Link, $UpdateSalesOrder);
                    //$UpdateSalesOrderItemResult = mysqli_query($Link, $UpdateSalesOrderItem);
                    
                    for ( $j = 1 ; $j <= $_POST['counterSItem'] ; $j++ )
                    {
                        $PId = "sltPId".$j;
                        $tId = $_POST['txtOrderId'];
                        if($j < 10) $tId .= "00".$j;
                        elseif($j < 100) $tId .= "0".$j;
                        else $tId .= $j;     
                        $qty = "txtQty".$j;

                        $AddSItemSQL = "UPDATE tblsalesorderitem SET productId = '".strtoupper(trim($PId))."',
                        qty = '".$qty."'
                        WHERE tId = '".$tId."' AND orderId = '".strtoupper(trim($_POST['txtOrderId']))."'";
                        $AddSItemResult = mysqli_query($Link,$AddSItemSQL);
                    }
					
					if($UpdateSalesOrderResult && $UpdateSalesOrderItemResult)
                        echo "<script>alert('Sales Record updated successfully'); location='Sales Order.php';</script>";
                    else echo "<script>alert('Sales Record added failure'); location='$PHP_SELF';</script>";
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

                    
                   /* $AddSalesOrderItemSQL = "INSERT INTO tblsalesorderitem (orderId,productId,qty,unitPrice) 
                    VALUES ('".strtoupper(trim($_POST['txtOrderId']))."',
					'".strtoupper(trim($_POST['sltPId']))."',
                    ".strtoupper(trim($_POST['txtQty'])).")";*/
                    
                    for ( $j = 1 ; $j <= $_POST['counterSItem'] ; $j++ )
                    {
                        $PId = "sltPId".$j;
                        $tId = $_POST['txtOrderId'];
                        if($j < 10) $tId .= "00".$j;
                        elseif($j < 100) $tId .= "0".$j;
                        else $tId .= $j;      
                        $qty = "txtQty".$j;

                        $AddSItemSQL = "INSERT INTO tblsalesorderitem(tId,orderId,productId,qty)
                                    VALUES('".strtoupper(trim($tId))."','".strtoupper(trim($_POST[$PId]))."',
                                    ".strtoupper(trim($_POST[$qty])).")";
                        $AddSItemResult = mysqli_query($Link,$AddSItemSQL);
                    }
                    
                    $AddSalesOrderResult = mysqli_query($Link, $AddSalesOrderSQL);
                    //$AddSalesOrderItemResult = mysqli_query($Link, $AddSalesOrderItemSQL);
					
					if($AddSalesOrderResult && $AddSalesOrderResult)
                        echo "<script>alert('Sales Record added successfully'); location='Sales Order.php';</script>";
                    else echo "<script>alert('Sales Record added failure'); location='$PHP_SELF';</script>";
                }
			}
            /*if($_POST['btnNext1']){
              
              $CIdSQL = "SELECT custId,custName FROM tblcustomer WHERE custId = '".$_POST['txtCId']."'";
				$CIdResult = mysqli_query($Link,$CIdSQL);
				if(mysqli_num_rows($CIdResult) > 0)
					$CIdRow = mysqli_fetch_array($CIdResult);
            }*/
            //echo "<script>alert('gg');</script>";
            //$chkCIdSQL = "SELECT custId,custName FROM tblcustomer ORDER BY custId";
          
		?>
        <!--Bottom section-->
    <div id="bottomDiv" class="animate-bottom">
        <form name="myForm" id="myForm" action="" method="post">
            <table align="center" border="0" width="450px" height="380px" style="margin-top:15px;margin-bottom:10px">
                <tr>
                    <th colspan="3" style="background-color:cornflowerblue;font-size:20px;color:azure;">
                      <center>Sales Order Info</center></th>
                </tr>
                <tr>
                    <td style="width:150px">Order Id :</td>
                    <td>
                    <?php
                        $orderId = "S".date("YmdHis");      
                    ?>
                        <input type="text" name="txtOrderId" placeholder="" size="24" value="<?php if($_GET['Id'] != "") echo $row['orderId']; else echo $orderId; ?>" <?php echo "readonly"; ?>>
                    </td>
                </tr>
              <?php if($_GET['Id'] == "e")
                    {
                      $CNameSQL = "SELECT custName FROM tblcustomer,tblsalesorder WHERE tblcustomer.custId = '".$row['custId']."' AND tblcustomer.custId = tblsalesorder.custId";
                      $CNameResult = mysqli_query($Link,$CNameSQL);
                      if(mysqli_num_rows($CNameResult) > 0)
                        $CNameRow = mysqli_fetch_array($CNameResult);
                    } 
              ?>
              <tr>
                <td >Customer Name :</td>
                <td>
                  <input type="text" name="txtCustName" id="txtCustName" size="24" value="<?php if($_GET['Id'] != "") echo $CNameRow['custName']; else echo $_GET['CName']; ?>" readonly required>
                </td>
              </tr>
              <tr>
                    <td>Customer Id :</td>
                    <td>
                       <input type="text" name="txtCustId" id="txtCustId" size="24" value="<?php if($_GET['Id'] != "") echo $row['custId']; else echo $_GET['CId']; ?>" readonly required>
                    </td>
                </tr>
              <tr>
                    <td>Date :</td>
                    <td><input class="" type="date" name="txtDate" size="24" value="<?php if($_GET['Id'] != "") echo $row['date']; else echo date("Y-m-j", time()); ?>" readonly /></td>
                </tr>
              <tr>
					<td>Total Amount :</td>
					<td><label>RM&nbsp;</label><input type="text" class="" name="txtTAmt" id="txtTAmt" placeholder="0.00" size="20" value="<?php if($_GET['Id'] != "") echo $row['totalAmt']; ?>"></td>
              </tr>
            <!-- Sales Detail section -->
            <table align="center" style="width:1000px;height:150px;margin-bottom:10px;" cellpadding="10px">
              <tbody>
                <tr><th colspan="4" style="background-color:cornflowerblue;font-size:20px;color:azure;"><center>Sales Details</center></th></tr>
                <tr align="center">   
                   <td width="30px">No. </td>
                    <td width="90px">Product Id :</td>
                    <td width="90px">Quantity :</td>
                    <td style="width:440px">Unit Price :</td>
                </tr>             
                <tr>
                    <td width="30px">1.</td>
                    <td id="PIdField" width="200px">
                        <select name="sltPId1" id="sltPId1" >
                            <option value="">Please select Product Id</option>
                          <optgroup label="Product Name | Product Id | Stock Quantity"></optgroup>
                    <?php
                        $PIdSQL = "SELECT tblproduct.productId,tblproduct.productName,tblprodstat.qty FROM tblproduct,tblprodstat WHERE tblproduct.productId = tblprodstat.pId AND qty != 0";
						$PIdSQLResult = mysqli_query($Link,$PIdSQL);
						//$CustRow = mysql_fetch_array($CustSQLResult);
                        if(mysqli_num_rows($PIdSQLResult) > 0){
                            for($i = 0; $i < mysqli_num_rows($PIdSQLResult); $i++)
                            {
                                $PIdRow = mysqli_fetch_array($PIdSQLResult);
                                echo "<option value='".$PIdRow['productId']."'"; 
                                if($row['productId'] == $PIdRow['productId']) echo "selected";?>>
                                <?php echo $PIdRow['productName']." | ".$PIdRow['productId']." | ".$PIdRow['qty']."</option>";
                            }
                        }
                        else echo "<option>No record found</option>";  
                    ?>                 
                        </select>
                    </td>                                   
                    <td width="50px">
                        <input type="number" name="txtQty1" id="txtQty1" class="Qt" min="1" max="" size="5" value="<?php if($_GET['Id'] != "") echo $row['qty']; else echo 1; ?>" required>
                    </td> 
                    <td width="440px">
                        <label>RM&nbsp;</label>
                        <input type="text" name="txtUntPrice1" id="txtUntPrice1" class="Pr" size="24" value="<?php if($_GET['Id'] != "") echo $row['unitPrice']; ?>" >
                  </td>
                </tr>
              </tbody>
            </table>
            <table name="SDTable" id="SDTable" align="center" style="width:1000px;" cellpadding="10px">
            </table>
            <table align="center" cellpadding="6" border="0">
                <tr>
                    <td align="center" border="0">
                        <input type="button" name="btnPlus" value=" + " class="btn btn-primary btn-fab btn-round"  style="margin-right:20x;margin-top:10px;padding:7px" id="btnPlus" onclick="plusSalesItem()" />
                        <input type="button" name="btnMinus" class="btn btn-primary btn-fab btn-round"  value=" - " style="margin-left:20px;margin-top:10px;padding:7px" id="btnMinus" onclick="minusSalesItem()" />
                    </td>            
                </tr>
            </table>
            <hr style="border: 1px solid cornflowerblue;align:center;width:300px;">
            <table align="center" style="margin-top:15px">
                <tr style="border-top:2px;">
                    <td colspan=7 align="center" style="border:0px;align:center;">
                    <?php
                    if($_GET['Id'] == "e")
                        echo "<input type='submit' class='btn btn-primary' name='btnUpdate' value='Update' style='margin:5px;padding:5px'>";
                    elseif($_GET['Id'] == "")
                        echo "<input type='submit' class='btn btn-primary' name='btnCheckOut' value='CheckOut' style='margin:5px;padding:5px'>";
                    ?>
                        <input type="reset" class="btn btn-outline-primary" name="btnReset" style="margin:5px;padding:5px" value="Reset" onClick="Reset()"></td>
                </tr>
            </table>
            <div style="text-align:center;margin-bottom:4%">
                <br/><br/>
                <input type="hidden" name="counterSItem" id="counterSItem" value=""/>
                <!--<input type="submit" name="btnAdd" id="btnAdd" value="Add"/>-->
            </div>
        </form>
        </div>
		<?php
        }
        else echo"<script>alert('Please login in first.'); location='index.php';</script>";
		?>
      
        <script>
            $(document).ready(function() {
              
                $('select').on('change', function() {
                   var PId = $(this).val();
                    document.cookie = "PId=" + PId;
                  //window.alert('PId');
                    //alert( $(this).find(":selected").val() );
                  <?php
                    $PId = $_COOKIE['PId'];
                    //echo "window.alert('".$PId."');";
                    $UPriceSQL = "SELECT unitPrice FROM tblprodstat WHERE pId = '".$PId."'";
                    $UPriceResult = mysqli_query($Link,$UPriceSQL);
					$UPriceRow = mysqli_fetch_array($UPriceResult);
                  ?>
                    //var uPrice = <?php //echo $PId; //$_COOKIE['PId']; ?>;
                    <?php echo "window.alert('".$UPriceRow['unitPrice']."');"; ?>
                    //window.alert('<?php echo "window.alert('".$PId."');"; ?>');
                   //var total = parseInt(input2) * parseInt($("#input1").val());
                    //window.alert('rt');
                   //$("#txtTAmt").val(total);    
                });
               /****Real time update price function****/
                /*$('select').on('change', function() {
                  window.alert( $(this).val() );
                  document.cookie = "PId=" + $(this).val();
                  <?php
                  //$PId = $_COOKIE['PId'];
                  //echo "window.alert('".$PId."');";
                  /*if (!empty($var)) {
                     echo $var;
                 }*/
                  //echo $UPriceSQL = "SELECT unitPrice FROM tblprodstat WHERE pId = '".$PId."'";
                  ?>
                });*/
                //$('number').on('keyup', function() {
                $("#txtUntPrice1").keyup(function() {
                  //window.alert($("#txtQty1").val());
                   var unitPrice = $(this).val();
                   var total = parseInt($("#txtQty1").val()) * parseFloat(unitPrice);

                   $("#txtTAmt").val(total);    
                });
                $("#txtUntPrice1").click(function() {
                  //window.alert('surprise');
                   var unitPrice = $(this).val();
                   var total = parseInt($("#txtQty1").val()) * parseFloat(unitPrice);

                   $("#txtTAmt").val(total);    
                });
              
                $("#txtQty1").keyup(function() {
                  //window.alert('surprise');
                   var qty = $(this).val();
                   var total = parseInt(qty) * parseInt($("#txtUntPrice1").val());

                   $("#txtTAmt").val(total);    
                });
                $("#txtQty1").click(function() {
                  //window.alert('surprise');
                   var qty = $(this).val();
                   var total = parseInt(qty) * parseInt($("#txtUntPrice1").val());

                   $("#txtTAmt").val(total);    
                });
              /****Real time update price function****/
                //myDropdown toggle display
                /*function showDropContent() {
                    window.alert('show');
                  document.getElementById("myDropdown").classList.toggle("show");
                }
                function hideDropContent() {
                    window.alert('hide');
                  document.getElementById("myDropdown").classList.toggle("show");
                }*/
                //#input text field search/filter
                /*function filterFunction() {
                  var input, filter, ul, li, a, i;
                  input = document.getElementById("myInput");
                  filter = input.value.toUpperCase();
                  div = document.getElementById("myDropdown");
                  a = div.getElementsByTagName("a");
                  for (i = 0; i < a.length; i++) {
                    txtValue = a[i].textContent || a[i].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                      a[i].style.display = "";
                    } else {
                      a[i].style.display = "none";
                    }
                  }
                }*/
            });
        </script>
<?php
        include("LStkReminder.php");
?>
    </body>
</html>