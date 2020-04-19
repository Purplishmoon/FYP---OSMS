<?php
include("header.php");
?>
<html>
<head>
<?php
    if(Id == "e") echo"<title>Update Category</title>";
    if(Id == "d") echo"<title>Delete Category</title>";
    elseif(Id == "") echo "<title>View Cayegory</title>";
?>
<!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"/>-->
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
    table#myForm {
        border-collapse: collapse;   
    }
    #myForm tr {
        background-color: #eee;
        border-top: 1px solid #fff;
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
</head>
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
?>
    <script>
        var dChk = window.confirm('Are you sure to delete the selected data?');
        if(dChk == true){
    <?php
        while(list($key, $val) = each($_POST))	
        {
            if($key != "btnDelete" && $key != "chkAll")
            {
                echo $key."<br>";
                $DelCat = "DELETE FROM tblcategory WHERE catId = '".$key."'";				
                $DelCatResult = mysqli_query($Link,$DelCat);

                if($DelCatResult)
                    $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Category info deleted.");
                    //echo "<script>alert('Record deleted');</script>";
                else $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Category info delete failed.");
            }
            else if($key == "chkAll")
            {
                $DelCat = "DELETE FROM tblcategory";
                $DelCatResult = mysqli_query($Link,$DelCat);

                if($DelCatResult)
                    $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Category info deleted.");
                    //echo "<script>alert('Record deleted');</script>";
                else $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Category info delete failed.");
            }
        }
?>
        }
        else <?php echo "location = '".$PHP_SELF."';"; ?>
    </script>
<?php
    }
    else if($_POST['btnSearch'])
    {
        $SQL = "SELECT * FROM tblcategory WHERE ";

        if(trim($_POST['sltId']) != "")
            $SQL .= "tblcategory.catId LIKE '%".strtoupper(trim($_POST['sltId']))."%' AND ";	

        if(trim($_POST['txtName']) != "")
            $SQL .= "tblcategory.catName LIKE '%".strtoupper(trim($_POST['txtName']))."%' AND ";		

        $SQL .= "ORDER BY catName";
        $SQL = str_replace("WHERE ORDER", "ORDER", $SQL);
        $SQL = str_replace("AND ORDER", "ORDER", $SQL);

        $Result = mysqli_query($Link,$SQL);

        if(mysqli_num_rows($Result) > 0)
        {
            if($_GET['Id'] == "d")
            ?>
            <form name="" method="post" action="">
            <table align="center" width="600px" style="" border="1"><!--class="table table-hover"-->
                <tr style="border-left:0px;border-right:0px;height:50px" align="center"><th align="center" colspan="4" style="background-color:cornflowerblue;
              font-size:20px;
              color:azure;" height="60px">Category Info Result</th></tr>
                <tr style="height:40px;">
                    <td style="padding-left:4px">No</td>
                    <?php
                    if($_GET['Id'] == "d")
                    echo "<td align='center'><input type='checkbox' name='".$row['Id']."'></td>";
                    ?>
                    <td style="padding-left:4px">Category Id</td>
                    <td style="padding-left:4px">Category Name</td>
                </tr>
            <?php

            for($i = 0; $i < mysqli_num_rows($Result); $i++)
            {
                $row = mysqli_fetch_array($Result);

                if($_GET['Id'] == 'e'){

                    echo "<tr style='height:40px'>";
                    echo "<td style='padding-left:4px'><a href=\"Category.php?Id=".$row['catId']."\">".($i+1)."</a></td>";
                    echo "<td style='padding-left:4px'><a href=\"Category.php?Id=".$row['catId']."\">".$row['catId']."</a></td>";     
                    echo "<td style='padding-left:4px'><a href=\"Category.php?Id=".$row['catId']."\">".$row['catName']."</a></td>";
                    echo "</tr>";
                }
                else{
                    echo "<tr style='height:40px'>";
                    echo "<td style='padding-left:4px'>".($i+1)."</td>";
                    if($_GET['Id'] == "d")
                    echo "<td align='center'><input type='checkbox' name='".$row['catId']."'></td>";
                    echo "<td style='padding-left:4px'>".$row['catId']."</td>";
                    echo "<td style='padding-left:4px'>".$row['catName']."</td>";
                    echo "</tr>";
                }
            }

            if($_GET['Id'] == 'd')
                echo "<tr><td colspan='4' align='center'><input type='submit' name='btnDelete' style='padding:10px;font-size:16px;margin-top:2px;margin-bottom:2px;' value='Delete'></td></tr>";
        }
        else echo "<p><center><h3>No Record Found</h3></center></p>";
        ?>
        </table>
        <?php
        echo "<center><input type='button' name='btnBack' class='btn btn-primary' value='Back' style='margin-top:20px;margin-left:80px;padding:7px' onclick='window.history.back();'></center>";
        
        if($_GET['Id'] == "d"){
        ?>
        </form>
<?php
        }
    } 
    else
    {
?>
    <div id="bottomDiv" class="animate-bottom">
        <form name="myForm" method="post" action="">
            <table width="450px" height="240px" border="0" align="center" style="margin-top:20px">
            <tbody>
                <tr><th style="background-color:cornflowerblue;
              font-size:20px;
              color:azure;" height="60px" colspan="2"><center>Category Filter</center></th></tr>
                <tr>
                    <td>Category Name:</td>
                    <td><input type="text" name="txtName" id="txtName"></td>
                </tr>
                    <td width="200px">Category Id:</td>
                    <td width="250px">
                        <select name="sltCat" id="sltCat">
                            <option value=""></option>
                        <?php
                            $CatSQL = "SELECT * FROM tblcategory ORDER BY catId";
                            $CatResult = mysqli_query($Link,$CatSQL);

                            if ( mysqli_num_rows($CatResult) > 0 )
                            {
                                for ( $c = 0 ; $c < mysqli_num_rows($CatResult) ; $c++ )
                                {
                                    $CatRow = mysqli_fetch_array($CatResult);
                                    echo "<option ";
                                    echo "value='".$CatRow['catId']."'>".ucwords(strtolower($CatRow['catName']))."</option>";
                                }
                            }
                        ?> 
                        </select>
                    </td>
            </tr>           
            <tr>
                <td colspan="2" align="center">
                <?php 
                  echo "<input name='btnSearch' type='submit' class='btn btn-primary' id='btnSearch' style='padding:10px;' value='Search' />";
                ?>
                    <input type="button" name="btnBack" value="Back" class='btn btn-outline-primary' style="padding:10px" onClick="window.history.back()">
                </td>
            </tr>
          </tbody></table>
      </form>
    </div>
<?php
    }
}
else echo "<script>alert('Please login in first.'); location='index.php';</script>";
?>
<script>
    
    $(document).ready(function() {
    //jQuery table row click function
    $('#myForm tr').click(function() {
        var href = $(this).find("a").attr("href");
        if(href) {
            window.location = href;
        }
    });
</script>
</body>
</html>