<?php
include("header.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <?php
        if(Id == "") echo "<title>Add Category</title>";
        elseif(Id == "e") echo "<title>Update Category</title>";
        //elseif(Id == "d") echo "<title>Delete Category</title>";
        //else echo "<title>View Category</title>";
        ?>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="AlertMessage.css" rel="stylesheet" type="text/css">
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
            $SQL = "SELECT * FROM tblcategory WHERE catId = '".$_GET['Id']."'";
            $Result = mysqli_query($Link,$SQL);
            if(mysqli_num_rows($Result) > 0)
                $row = mysqli_fetch_array($Result);
        }
        if($_POST['btnUpdate'])
        {
            /*if($_POST['txtId'] == "" || $_POST['txtName'] == "" || $_POST['txtUnit'] == "")
            {
                echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
            }
            else
            {*/ 
                $UpdateCat = "UPDATE tblcategory SET catName = '".strtoupper(trim($_POST['txtName']))."',
                        unit = '".trim($_POST['txtUnit'])."',
                        WHERE catId = '".strtoupper(trim($_POST['txtId']))."'";

                $UpdateCatResult = mysqli_query($Link, $UpdateCat);

                if($UpdateCatResult)
                {
                    $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Category info Update success.");
                    //echo "<script>alert('Record updated successfully'); location='Category.php';</script>";
                }
                else
                {
                    $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Category info Update failed.");
                    //echo "<script>alert('Record updated failure'); location='$PHP_SELF';</script>";
                }
            //}
        }
        else if($_POST['btnAdd'])
        {
            if($_POST['txtId'] == "" || $_POST['txtName'] == "" || $_POST['txtUnit'] == "")
            {
                $_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"Please fill up all fields.");
                //echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
            }
            else
            {
                $ChkCatIdSQL = "SELECT catId FROM tblcategory WHERE catId ='".strtoupper(trim($_POST['txtId']))."'";
                $ChkCatIdResult = mysqli_query($Link,$ChkCatIdSQL);
                if(mysqli_num_rows($ChkCatIdResult) > 0){
                    $_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"This Category Id has been registered.");
                }
                else
                {
                    $AddCatSQL = "INSERT INTO tblcategory (catId,catName,unit) 
                    VALUES ('".strtoupper(trim($_POST['txtId']))."','".strtoupper(trim($_POST['txtName']))."','".trim($_POST['txtUnit'])."')";

                    $AddCatResult = mysqli_query($Link,$AddCatSQL);

                    if($AddCatResult)
                    {
                        $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Category add success.");
                        //echo "<script>alert('Record added successfully'); location='Category.php';</script>";
                    }
                    else
                    {
                        $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Category add failed.");
                        //echo "<script>alert('Record added failure'); location='$PHP_SELF';</script>";
                    }
                }
                
            }
        }
        //else{
?>
            <div id="bottomDiv" class="animate-bottom">
            <form name="myForm" action="" method="post">
                <table align="center" border="0" width="400px" height="380px" style="margin-top:15px;margin-bottom:10px">
                <tr>
                    <th colspan="2" style="background-color:cornflowerblue;font-size:20px;color:azure;"><center>Category Info</center></th>
                </tr>
                <tr>
                    <td>Category Id :</td>
                    <td><input type="text" name="txtId" placeholder="" value="<?php if($_GET['Id'] != "") echo $row['catId']; ?>" <?php if($_GET['Id'] != "") echo "readonly"; ?> required>
                    </td>
                </tr>
                <tr>
                    <td>Category Name :</td>
                    <td><input type="text" name="txtName" placeholder="" value="<?php if($_GET['Id'] != "") echo $row['catName']; ?>" required></td>
                </tr>
                <tr>
                    <td>Quantity Unit :</td>
                    <td><input type="text" name="txtUnit" placeholder="" value="<?php if($_GET['Id'] != "") echo $row['unit']; ?>" required></td>
                </tr>
				<tr>
                    <td colspan=7 align="center" style="border:0px">
                    <?php
                        if($_GET['Id'] == "e")
                            echo "<input type='submit' name='btnUpdate' class='btn btn-primary' value='Update' style='margin:5px;padding:5px'>";
                        elseif($_GET['Id'] == "")
                            echo "<input type='submit' class='btn btn-primary' name='btnAdd' value='Add' style='margin:5px;padding:5px'>";
                    ?>
                        <input type="reset" class="btn btn-outline-primary" name="btnReset" style="margin:5px;padding:5px" value="Reset" onClick="Reset()">
                    </td>
                </tr>
                </table>
	       </form>
        </div>
<?php
            //SQL Success Message
            if(!empty($_SESSION['SUCCESS'])){
        ?>
                <div class="alert info">
                  <span class="closebtn" onclick="var div = this.parentElement;
            div.style.opacity = '0';
            setTimeout(function(){ div.style.display = 'none'; }, 500);">&times;</span>  
          <strong><?php echo $_SESSION['SUCCESS'][0]; ?></strong> <?php echo $_SESSION['SUCCESS'][1]; ?></div>";
<?php
        unset($_SESSION['SUCCESS']);
    }
              //SQL Warning Message
            if(!empty($_SESSION['WARN'])){
    ?>
                <div class="alert warning">
                  <span class="closebtn" onclick="var div = this.parentElement;
                    div.style.opacity = '0';
                    setTimeout(function(){ div.style.display = 'none'; }, 500);">&times;</span>  
                  <strong><?php echo $_SESSION['WARN'][0]; ?></strong> <?php echo $_SESSION['WARN'][1]; ?></div>
    <?php
                  unset($_SESSION['WARN']);
            }
            //SQL Error Message
            if(!empty($_SESSION['ERR'])){
?>
                <div class="alert">
                  <span class="closebtn" onclick="var div = this.parentElement;
                    div.style.opacity = '0';
                    setTimeout(function(){ div.style.display = 'none'; }, 500);">&times;</span>  
                  <strong><?php echo $_SESSION['SUCCESS'][0]; ?></strong> <?php echo $_SESSION['SUCCESS'][1]; ?></div>";
<?php
                  unset($_SESSION['ERR']);
            } 
        //} 
    } else echo "<script>alert('Please login in first.');location='index.php';</script>";
?>	
</body>
</html>