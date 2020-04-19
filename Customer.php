<?php
include("header.php");
?>
<html>
<head>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="AlertMessage.css" rel="stylesheet" type="text/css">
    <?php
    if(Id == "") echo"<title>Add Customer</title>";
    elseif(Id == "e") echo"<title>Update Customer</title>";
    //elseif(Id == "d") echo"<title>Delete Customer</title>";
    //elseif(Id == "v") echo "<title>View Customer</title>";
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
    if($_SESSION['LoginStatus'] == true)
    {
        echo "<div id='topDiv' class='animate-top'>";
        include("menu.php");
        echo "<div style='font-size:14px;text-align:right;margin-right:5%;margin-top:5px;'>Logged in as : ";
        echo $_SESSION['UserName']." (".$_SESSION['AccType'].")";
        echo "</div></div>";
        if($_GET['Id'] != "")
        {
            $SQL = "SELECT * FROM tblcustomer WHERE custId = '".$_GET['Id']."'";
            $Result = mysqli_query($Link,$SQL);
            if(mysqli_num_rows($Result) > 0)
                $row = mysqli_fetch_array($Result);
            
        }
        if($_POST['btnUpdate'])
        {
            if($_POST['txtCId'] == "" || $_POST['txtId'] == "" || $_POST['txtName'] == "" || $_POST['rdoGender'] == "" ||  $_POST['txaAddress'] == "" ||
               $_POST['txtPostcode'] == "" || $_POST['txtCity'] == "" || $_POST['txtState'] == "" || 
                $_POST['sltCountry'] == "" || $_POST['txtTel'] == "" || $_POST['txtEmail'] == "")
            {
                $_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"Please fill up all fields.");
                //echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
            }
            else
            {
                $UpdateCust = "UPDATE tblcustomer SET custName = '".strtoupper(trim($_POST['txtName']))."',
                        gender = '".strtoupper(trim($_POST['rdoGender']))."',
                        addr = '".strtoupper(trim($_POST['txaAddress']))."',
                        city = '".strtoupper(trim($_POST['txtCity']))."',
                        state = '".strtoupper(trim($_POST['txtState']))."',
                        country = '".strtoupper(trim($_POST['sltCountry']))."',
                        postcode = ".trim($_POST['txtPostcode']).",
                        telNo = '".trim($_POST['txtTel'])."',
                        email = '".strtolower(trim($_POST['txtEmail']))."'
                        WHERE custId = '".strtoupper(trim($_POST['txtCId']))."' AND phyId = '".strtoupper(trim($_POST['txtId']))."'";

                //echo $UpdateCust;
                $UpdateCustResult = mysqli_query($Link, $UpdateCust);

                if($UpdateCustResult)
                    $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Customer info update success.");
                else $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Customer info update failed.");
                    /*echo "<script>alert('Record updated successfully'); location='Customer.php';</script>";
                else echo "<script>alert('Record updated failure'); location='".$PHP_SELF."';</script>";*/
            //}
        }
        else if($_POST['btnAdd'])
        {
            if($_POST['txtCId'] == "" || $_POST['txtId'] == "" || $_POST['txtName'] == "" || $_POST['rdoGender'] == "" || $_POST['txaAddress'] == "" ||
                $_POST['txtPostcode'] == "" || $_POST['txtCity'] == "" || $_POST['txtState'] == "" || 
                $_POST['sltCountry'] == "" || $_POST['txtTel'] == "" || $_POST['txtEmail'] == "")	
            {
                $_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"Please fill up all fields.");
                //echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";          
            }
            else
            {  
                //Check Existed Customer Id
                $ChkCIdSQL = "SELECT custId FROM tblcustomer WHERE custId = '".$_POST['txtId']."'";
                $ChkCIdResult = mysqli_query($Link,$ChkCIdSQL);
                if(mysqli_num_rows($ChkCIdResult) > 0){
                    $_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"This Customer Id has been registered.");
                }
                else
                {
                     $AddCustSQL = "INSERT INTO tblcustomer (custId,phyId,custName,gender,addr,city,state,country,postcode,telNo,email) 
                    VALUES ('".strtoupper(trim($_POST['txtCId']))."',
                    '".strtoupper(trim($_POST['txtId']))."',
                    '".strtoupper(trim($_POST['txtName']))."',
                    '".strtoupper(trim($_POST['rdoGender']))."',
                    '".strtoupper(trim($_POST['txaAddress']))."',
                    '".strtoupper(trim($_POST['txtCity']))."',
                    '".strtoupper(trim($_POST['txtState']))."',
                    '".strtoupper(trim($_POST['sltCountry']))."',
                    ".trim($_POST['txtPostcode']).",
                    '".trim($_POST['txtTel'])."',
                    '".strtolower(trim($_POST['txtEmail']))."')";

                    $AddPPSQL = "INSERT INTO tblpowerprescription(vId,custId,OD_Sph,OD_Cyl,OD_Axis,OD_Prism,OD_Base,OS_Sph,OS_Cyl,OS_Axis,OS_Prism,OS_Base,OU,singleVision,bifocal,trifocal,progressive,trivex,hiIndex,aRCoat,photochromic,tint,polarized,presbyopia,glaucoma,date,createdBy) VALUES ('".strtoupper(trim($_POST['txtVId']))."',
                     '".strtoupper(trim($_POST['txtCId']))."',
                    0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0, FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,FALSE,'00/00/0000','".strtoupper(trim(N.A))."')";

                    $AddCustResult = mysqli_query($Link,$AddCustSQL);
                    $AddPPResult = mysqli_query($Link,$AddPPSQL);                
                    if($AddCustResult && $AddPPResult)
                        //echo "<script>alert('Record added successfully'); location='Customer.php';</script>";
                        $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Customer register success.");
                    else $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Customer register failed.");
                        //echo "<script>alert('Record added failure'); location='".$PHP_SELF."';</script>"; 
                    //}
                }
        }
?>		
<div id="bottomDiv" class="animate-bottom">
<form name="myForm" action="" method="post">
  <table align="center" border="0" width="560" height="600">
  <?php
      //Auto generate custId
      $CIdSQL = "SELECT custId FROM tblcustomer ORDER BY custId DESC";
      $CIdResult = mysqli_query($Link,$CIdSQL);
      if(mysqli_num_rows($CIdResult) == 0)
        $NewCId = "C1";
      else{
        $CIdRow = mysqli_fetch_array($CIdResult);
        $LastCId = intval(substr($CIdRow['custId'], 1));
        $NewCId = "C".(1 + $LastCId);
      }
  ?>
        <tr><th colspan="2" style="background-color:cornflowerblue;
          font-size:20px;color:azure;"><center>Customer Info</center></th>
        </tr>
        <tr>
            <td width="200">Customer Id :</td>
            <td><input type="text" name="txtCId" placeholder="System Id" value="<?php if($_GET['Id'] != "") echo $row['custId']; else echo $NewCId;?>" readonly required></td>
        </tr>
        <tr>
            <td>Id / Passport :</td>
            <td><input type="text" name="txtId" placeholder="Physical Id" value="<?php if($_GET['Id'] != "") echo $row['phyId']; ?>" <?php if($_GET['Id'] != "") echo" readonly"; ?> required></td>
        </tr>
        <tr>
            <td>Name :</td>
            <td><input type="text" name="txtName" value="<?php if($_GET['Id'] != "") echo $row['custName']; ?>" required></td>
        </tr>
        <tr>
            <td>Gender :</td>
            <td><input type="radio" value="M" name="rdoGender" required <?php if($row['gender'] == "M") echo " checked"; ?>> Male 
                <input type="radio" value="F" name="rdoGender" <?php if($row['gender'] == "F") echo " checked"; ?>> Female</td>
        </tr>
        <tr><th colspan="2" style="background-color:cornflowerblue;
          font-size:20px;color:azure;"><center>Contact</center></th>
        </tr>
        <tr>
            <td>Address :</td>
            <td><textarea name="txaAddress" value="" required><?php if($_GET['Id'] != "") echo $row['addr']; ?></textarea></td>
        </tr>
        <tr>
            <td>Postcode :</td>
            <td><input type="text" name="txtPostcode" value="<?php if($_GET['Id'] != "") echo $row['postcode']; ?>" required></td>
        </tr>
        <tr>
            <td>City :</td>
            <td><input type="text" name="txtCity" value="<?php if($_GET['Id'] != "") echo $row['city']; ?>" required>
                <!--<select name="sltCity">
                <option value="">Please select option</option>
                <option <?php //if($row['city'] =="SIBU") echo "selected='selected'"; ?>>Sibu</option>
                <option <?php //if($row['city'] =="BINTULU") echo "selected='selected'"; ?>>Bintulu</option>
                <option <?php //if($row['city'] =="MIRI") echo "selected='selected'"; ?>>Miri</option>
                <option <?php //if($row['city'] =="KUCHING") echo "selected='selected'"; ?>>Kuching</option>
                <option <?php //if($row['city'] =="KUALA LUMPUR") echo "selected='selected'"; ?>>Kuala Lumpur</option>
                </select>-->
            </td>
        </tr>
        <tr>
            <td>State :</td>
            <td><input type="text" name="txtState" value="<?php if($_GET['Id'] != "") echo $row['state']; ?>"  required>
                <!--<select name="sltState">
                <option value="">Please select option</option>
                <option  <?php //if($row['state'] =="SARAWAK") echo "selected='selected'"; ?>>Sarawak</option>
                <option  <?php //if($row['state'] =="SABAH") echo "selected='selected'"; ?>>Sabah</option>
                <option  <?php //if($row['state'] =="SELANGOR") echo "selected='selected'"; ?>>Selangor</option>
                </select></td>-->
        </tr>
        <tr>
            <td>Country :</td>
            <td><select name="sltCountry" required>
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
            <td><input type="text" name="txtTel" placeholder="999-9999999" value="<?php if($_GET['Id'] != "") echo $row['telNo']; ?>" required></td>
        </tr>
        <tr>
                <td>E-mail :</td>
                <td><input type="email" name="txtEmail" value="<?php if($_GET['Id'] != "") echo $row['email']; ?>" required></td>
            </tr>
        <tr>
            <td colspan=7 align="center" style="border:0px">
                <?php
                if($_GET['Id'] != "")
                    echo "<input type='submit' class='btn btn-primary' name='btnUpdate' value='Update' style='margin:5px;padding:5px'>";
                elseif($_GET['Id'] == "")
                    echo "<input type='submit' class='btn btn-primary' name='btnAdd' value='Add' style='margin:5px;padding:5px'>";
                ?>                     
                <input type="reset" class="btn btn-outline-primary" name="btnReset" style="margin:5px;padding:5px" value="Reset" onClick="Reset()"></td>
        </tr>
    </table>
</form>
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
              <strong><?php echo $_SESSION['WARN'][0]; ?></strong> <?php echo $_SESSION['WARN'][1]; ?></div>";
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
              <strong><?php echo $_SESSION['ERR'][0]; ?></strong> <?php echo $_SESSION['ERR'][1]; ?></div>";
    <?php
            unset($_SESSION['ERR']);
        }
    ?>
</div>
    <?php
    } else echo "<script>alert('Please login in first.');location='index.php';</script>";
    ?>
<script>
    /*$("[type='radio']").on('click', function (e) {
    var previousValue = $(this).attr('previousValue');
    if (previousValue == 'true') {
        this.checked = false;
        $(this).attr('previousValue', this.checked);
    }
    else {
        this.checked = true;
        $(this).attr('previousValue', this.checked);
    }
});*/
</script>
</body>
</html>