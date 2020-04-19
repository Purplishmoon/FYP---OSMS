<?php
include("header.php");
?>
<html>
<head>
<?php
    if(Id == "e") echo"<title>Update Supplier</title>";
    elseif(Id == "d") echo"<title>Delete Supplier</title>";
    elseif(Id == "") echo "<title>View Supplier</title>";
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
        table#myForm {
            border-collapse: collapse;   
        }
        #myForm tr {
            background-color: #eee;
            border-top: 1px solid #bbb;
        }
        #myForm tr:hover {
            background-color: #ccc;
        }
        #myForm th {
            /*background-color: #fff;*/
        }
        #myForm th, #myForm td {
            padding: 3px 5px;
        }
        #myForm td:hover {
            /*cursor: pointer;*/
        }
</style>
<script>
    function Reset(){
         document.getElementById("myForm").reset();
    }
</script>
<body>
<?php
if($_SESSION['LoginStatus'] == true)
{
    echo "<div id='topDiv' class='animate-top'>";
    include("menu.php");
    echo "<div style='font-size:14px;text-align:right;margin-right:5%;margin-top:5px;'>Logged in as : ";
    echo $_SESSION['UserName']." (".$_SESSION['AccType'].")";
    echo "</div></div>";
    
    if($_POST['btnDelete'])
    {
			while(list($key, $val) = each($_POST))	
			{
				if($key != "btnDelete" && $key != "chkAll")
				{
					echo $key."<br>";
					$DelSupp = "DELETE FROM tblsupplier WHERE suppId = '".$key."'";	
				
					$DelSuppResult = mysqli_query($Link,$DelSupp);
				
					if($DelSuppResult)
						echo "<script>alert('Record deleted');</script>";
                    else echo "<script>alert('Record delete failed');</script>";
				}
                else if($key == "chkAll")
                {
                    $DelSupp = "DELETE FROM tblsupplier";
                    
                    $DelSuppResult = mysqli_query($Link,$DelSupp);
                    
                    if($DelSupp)
						echo "<script>alert('Record deleted');</script>";
                    else echo "<script>alert('Record delete failed');</script>";
                }
			}
		}
    else if($_POST['btnSearch'])
    {
			$SQL = "SELECT * FROM tblsupplier WHERE ";
			
			if(trim($_POST['sltSId']) != "")
				$SQL .= "tblsupplier.suppId LIKE '%".strtoupper(trim($_POST['sltSId']))."%' AND ";	
				
			if(trim($_POST['txtName']) != "")
				$SQL .= "tblsupplier.suppName LIKE '%".strtoupper(trim($_POST['txtName']))."%' AND ";	
				
			/*if(trim($_POST['txtCity']) != "")
				$SQL .= "tblsupplier.city LIKE '%".strtoupper(trim($_POST['txtCity']))."%' AND ";	*/
				
			$SQL .= "ORDER BY suppName";
            $SQL = str_replace("WHERE ORDER", "ORDER", $SQL);
			$SQL = str_replace("AND ORDER", "ORDER", $SQL);
			//echo $SQL;
			$Result = mysqli_query($Link,$SQL);
        
            echo "<a href='Supplier(Search).php' style='margin-top:60px;margin-left:160px'><input type='button' name='btnBack' style='padding:10px' value='Back'></a><br><br>";
        
			if(mysqli_num_rows($Result) > 0)
			{
				if($_GET['Id'] == "d")
				?>
                <form name="" method="post" action="">
                <table id="myForm" name="myForm" width="900px" border="1" align="center" style="margin-top:20px;align:center">
                    <tr height="50px"><th colspan="6" style="background-color:cornflowerblue;
              font-size:20px;color:azure;"><center>Supplier Info Result</center></th></tr>
 					<tr>
    					<td>No</td>
                        <?php
						if($_GET['Id'] == "d")
						echo "<td><input type='checkbox' name='".$row['suppId']."'></td>";
						?>
    					<td>Supplier Name</td>
    					<td>Supplier Id</td>
    					<td>Salesperson Name</td>
                        <td>Tel No.</td>
  					</tr>
  				<?php
				
  				for($i = 0; $i < mysqli_num_rows($Result); $i++)
  				{
					$row = mysqli_fetch_array($Result);
                    
                    if($_GET['Id'] == 'e'){
                        //echo "<a href='Supplier.php?Id=".$row['suppId']."'>";
                        echo "<tr>";
	  					echo "<td><a href='Supplier.php?Id=".$row['suppId']."'>".($i+1)."</a></td>";
						
						echo "<td><a href='Supplier.php?Id=".$row['suppId']."'>".$row['suppName']."</a></td>";

						echo "<td><a href='Supplier.php?Id=".$row['suppId']."'>".$row['suppId']."</a></td>";
						echo "<td>".ucwords(strtolower($row['salesmanName']))."</td>";
                        echo "<td>".$row['telNo']."</td>";
	 				    echo "</tr>";
                        //echo"</a>";
                    }
                    else{
                        echo "<tr>";
	  					echo "<td>".($i+1)."</td>";
						if($_GET['Id'] == "d")
						echo "<td><input type=\"checkbox\" name=\"".$row['suppId']."\"></td>";
						echo "<td>";
						//if($_GET['Id'] == 'e')
							//echo "<a href=\"Employee.php?Id=".$row['userId']."\">".$row['suppName']."</a>";
						//else if($_GET['Id'] == 'v' || $_GET['Id'] == 'd')
						    echo $row['suppName'];
						echo "</td>";
						echo "<td>".$row['suppId']."</td>";
						echo "<td>".ucwords(strtolower($row['salesmanName']))."</td>";
                        echo "<td>".$row['telNo']."</td>";
	 				    echo "</tr>";
                    }
                }
                if($_GET['Id'] == 'd')
                echo "<tr><td colspan=\"6\" align='center'><input type=\"submit\" name=\"btnDelete\" style='margin-top:5px;margin-bottom:5px;padding:7px;font-size:16px' value=\"Delete\"></td></tr>";
            }
            else echo "<p><center><h1>No Record Found</h1></center></p>";
           
            ?>
            </table>
            <?php
            if($_GET['Id'] == "d")
            ?>
            </form>
            <?php
        }
    else
    {
    ?>
        <div id="bottomDiv" class="animate-bottom">
        <form method="post" action="">
        <table width="500" height="292" border="0" align="center" style="margin-top:15px;margin-bottom:10px">
        <tbody>
        <tr><th colspan="2" style="background-color:cornflowerblue;
              font-size:20px;
              color:azure;">Supplier Info Filter</th></tr>
        <tr>
            <td>Supplier Name:</td>
            <td>
            <input type="text" name="txtName" id="txtName"></td>
        </tr>
        <tr>
            <td width="200px">Supplier Id:</td>
            <td width="300px">
                <select name="sltSId">
                    <option value=""></option>
                <?php
                    $SIdSQL = "SELECT suppId FROM tblsupplier";
                    $SIdSQLResult = mysqli_query($Link,$SIdSQL);
                    //$SIdRow = mysqli_fetch_array($SIdSQLResult);
                    if(mysqli_num_rows($SIdSQLResult) > 0){
                        for($i = 0; $i < mysqli_num_rows($SIdSQLResult); $i++)
                        {
                            $SIdRow = mysqli_fetch_array($SIdSQLResult);
                            echo "<option value='".$SIdRow['suppId']."'>".$SIdRow['suppId']."</option>";
                        }
                    }
                    else echo "<option value=''>No Record Found</option>";
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
              <input name="btnSearch" type="submit" id="btnSearch" style="padding:10px;font-size:18px" value="Search">
            </td>
        </tr>
      </tbody></table>
      </form>
    </div>
      <?php
    }
}
	else echo "<script>alert('Please login in first.');location='index.php';</script>";
?>
    <script>
        $(document).ready(function() {
        //JQuery table row click function
        $('#myForm tr').click(function() {
            var href = $(this).find("a").attr("href");
            if(href) {
                window.location = href;
            }
        });
        });
    </script>
</body>
</html>