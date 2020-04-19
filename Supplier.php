<?php
include("header.php");
?>
<html>
    <head>
	<?php
		if(Id == "e") echo "<title>Update Supplier</title>";
		else echo "<title>Add Supplier</title>";
    ?>
        <style>
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
        </style>
		<script>
            function Reset(){
                document.getElementById("myForm").reset();
            }
		</script>
    </head>
    <body>
		<?php
		if($_SESSION['LoginStatus'] == true){
			 echo "<div id='topDiv' class='animate-top'>";
            include("menu.php");
            echo "<div style='font-size:14px;text-align:right;margin-right:5%;margin-top:5px;'>Logged in as : ";
            echo $_SESSION['UserName']." (".$_SESSION['AccType'].")";
            echo "</div></div>";
            
			if($_GET['Id'] != "")
			{
				$SQL = "SELECT * FROM tblsupplier WHERE suppId = '".$_GET['Id']."'";
				$Result = mysqli_query($Link,$SQL);
				if(mysqli_num_rows($Result) > 0)
					$row = mysqli_fetch_array($Result);
			}
			if($_POST['btnUpdate'])
        	{
				if($_POST['txtComId'] == "" || $_POST['txtComName'] == "" || 
				   $_POST['txaAddress'] == "" || $_POST['txtCity'] == "" || $_POST['txtState'] == "" || $_POST['sltCountry'] == "" ||
					$_POST['txtPostcode'] == ""|| $_POST['txtTel'] == "" || $_POST['txtEmail'] == "" || $_POST['txtSalesmanName'] == "")	
				{
					echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
				}
				else
				{
					$UpdateSupp = "UPDATE tblsupplier SET suppName = '".strtoupper(trim($_POST['txtComName']))."',
							addr = '".strtoupper(trim($_POST['txaAddress']))."',
							city = '".strtoupper(trim($_POST['txtCity']))."',
							state = '".strtoupper(trim($_POST['txtState']))."',
							country = '".strtoupper(trim($_POST['sltCountry']))."',
							postcode = ".trim($_POST['txtPostcode']).",
							telNo = '".trim($_POST['txtTel'])."',
							email = '".strtolower(trim($_POST['txtEmail']))."',
							salesmanName = '".strtoupper(trim($_POST['txtSalesmanName']))."' 
                            WHERE suppId = '".strtoupper(trim($_POST['txtComId']))."'";
			
					$UpdateSuppResult = mysqli_query($Link, $UpdateSupp);
					
					if($UpdateSuppResult)
						echo "<script>alert('Record updated successfully'); location='Supplier.php'</script>";
					else echo "<script>alert('Record updated failure'); location='".$PHP_SELF."'</script>";
				}
			}
            else if($_POST['btnAdd'])
            {
                if($_POST['txtComId'] == "" || $_POST['txtComName'] == "" || 
				   $_POST['txaAddress'] == "" || $_POST['txtCity'] == "" || $_POST['txtState'] == "" || $_POST['sltCountry'] == "" ||
					$_POST['txtPostcode'] == ""|| $_POST['txtTel'] == "" || $_POST['txtEmail'] == "" || $_POST['txtSalesmanName'] == "")	
                {
                    echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
                }
                else
                {
                    $AddSuppSQL = "INSERT INTO tblsupplier (suppId,suppName,addr,city,state,country,postcode,telNo,email,salesmanName) 
                    VALUES ('".strtoupper(trim($_POST['txtComId']))."',
                    '".strtoupper(trim($_POST['txtComName']))."',
                    '".strtoupper(trim($_POST['txaAddress']))."',
                    '".strtoupper(trim($_POST['txtCity']))."',
                    '".strtoupper(trim($_POST['txtState']))."',
                    '".strtoupper(trim($_POST['sltCountry']))."',
					'".strtoupper(trim($_POST['txtPostcode']))."',
                    '".strtoupper(trim($_POST['txtTel']))."',
					'".strtolower(trim($_POST['txtEmail']))."',
                    '".strtoupper(trim($_POST['txtSalesmanName']))."')";

                    $AddSuppResult = mysqli_query($Link,$AddSuppSQL);
                    //echo $c = $AddSuppSQL;
					//echo $v = mysqli_fetch_array($AddSuppResult);
					if($AddSuppResult)
                        echo "<script>alert('Record added successfully'); location='Supplier.php';</script>";
                    else echo "<script>alert('Record added failure'); location='$PHP_SELF';</script>";
                }
			}
			
		?>
        <form name="myForm" action="" method="post">
            <table align="center" border="0" width="500px" height="600px" style="margin-top:15px;margin-bottom:10px">
                <tr><th colspan="2" style="background-color:cornflowerblue;
              font-size:20px;
              color:azure;"><center>Supplier Info</center></th></tr>
                <tr>
                    <td width="200px">Supplier Id :</td>
                    <td><input type="text" name="txtComId" placeholder="" size="24" value="<?php if($_GET['Id'] != "") echo $row['suppId']; ?>" <?php if($_GET['Id'] != "") echo" readonly"; ?>></td>
                </tr>
                <tr>
                    <td>Supplier Name :</td>
                    <td><input type="text" name="txtComName" size="24" value="<?php if($_GET['Id'] != "") echo $row['suppName']; ?>"></td>
                </tr>
                <tr>
                    <th colspan="2" style="background-color:cornflowerblue;
              font-size:20px;
              color:azure;"><center>Contact</center></th>
                </tr>
                <tr>
                    <td>Address :</td>
                    <td><textarea name="txaAddress"  rows="4" cols="24" value=""><?php if($_GET['Id'] != "") echo $row['addr']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Postcode :</td>
                    <td><input type="text" name="txtPostcode" size="24" value="<?php if($_GET['Id'] != "") echo $row['postcode']; ?>"></td>
                </tr>
                <tr>
                    <td>City :</td>
                    <td>
                        <input type="text" name="txtCity" placeholder="" size="24" value="<?php if($_GET['Id'] != "") echo $row['suppId']; ?>">
					</td>
                </tr>
                <tr>
                    <td>State :</td>
                    <td>
                        <input type="text" name="txtState" placeholder="" size="24" value="<?php if($_GET['Id'] != "") echo $row['suppId']; ?>">
                    </td>
                </tr>
				<tr>
                    <td>Country :</td>
                    <td><select name="sltCountry">
						<option value="">Please select option</option>
                <?php
                        $FileName="CountriesList.txt";
                        $FileHandler = fopen($FileName, 'r') or die("can't open file");
                        $city = fread($FileHandler, filesize($FileName));
                        $getCity = explode("\n", $city);
                        sort($getCity);
                        for($n = 0; $n < count($getCity); $n++)
                        {
                            echo "<option ";
                            if($_GET['Id'] == "" || $_GET['Id'] == "e")
                            {
                                if( ucwords(strtolower($row['country'])) == ucwords(strtolower($getCity[$n])) )
                                    echo "selected ";
                            }
                            echo "value=\"".$getCity[$n]."\">".$getCity[$n]."</option>";
                        }
                        fclose($FileHandler); 
                ?>
						</select>
					</td>
                </tr>       
                <tr>
                    <td>Tel No. :</td>
                    <td><input type="text" name="txtTel" placeholder="999-9999999" size="24" value="<?php if($_GET['Id'] != "") echo $row['telNo']; ?>"></td>
                </tr>
                <tr>
                    <td>E-mail :</td>
                    <td><input type="text" name="txtEmail" size="24" value="<?php if($_GET['Id'] != "") echo $row['email']; ?>"></td>
                </tr>
                <tr>
                    <td>Person In Charge :</td>
                    <td><input type="text" name="txtSalesmanName" size="24" value="<?php if($_GET['Id'] != "") echo $row['salesmanName']; ?>"></td>
                </tr>
                <tr>
                    <td colspan=2 align="center" style="border:0px">
                    <?php
                        if($_GET['Id'] != "")
                            echo "<input type='submit' name='btnUpdate' value='Update' style='margin:5px;padding:5px'>";
                        elseif($_GET['Id'] == "")
                            echo "<input type='submit' name='btnAdd' value='Add' style='margin:5px;padding:5px'>";
                    ?>
                        <input type="reset" name="btnReset" style="margin:5px;padding:5px" value="Reset" OnClick="Reset()">
                    </td>
                </tr>
            </table>
        </form>
	<?php
			
	}
	else echo "<script>alert('Please login in first.');location='index.php';</script>";
	?>
    </body>
</html>