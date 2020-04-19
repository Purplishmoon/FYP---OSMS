<?php
include("header.php");
?>
<html>
<head>
  <link href="style.css" rel="stylesheet" type="text/css">
    <?php
    if(Id == "") echo"<title>Add Power Prescription</title>";
    elseif(Id != "") echo"<title>Update Power Prescription</title>";
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
    .btn.btn-primary {
      background: #3e64ff;
      border: 1px solid #3e64ff;
      color: #fff; }
    .btn.btn-primary.btn-link {
      background: transparent;
      color: #3e64ff;
      border: none;
      -webkit-box-shadow: none;
      box-shadow: none; }
      
    .btn-primary {
      color: #fff;
      background-color: #007bff;
      border-color: #007bff; }
    .btn-primary:hover {
      color: #fff;
      background-color: #0069d9;
      border-color: #0062cc; }
    .btn-primary:focus, .btn-primary.focus {
      -webkit-box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
      box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5); }
    .btn-primary.disabled, .btn-primary:disabled {
      color: #fff;
      background-color: #007bff;
      border-color: #007bff; }
    .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active,
    .show > .btn-primary.dropdown-toggle {
      color: #fff;
      background-color: #0062cc;
      border-color: #005cbf; }
    .btn-primary:not(:disabled):not(.disabled):active:focus, .btn-primary:not(:disabled):not(.disabled).active:focus,
    .show > .btn-primary.dropdown-toggle:focus {
        -webkit-box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5); }
    .btn-outline-primary {
      color: #007bff;
      border-color: #007bff; }
    .btn-outline-primary:hover {
      color: #fff;
      background-color: #007bff;
      border-color: #007bff; }
    .btn-outline-primary:focus, .btn-outline-primary.focus {
      -webkit-box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5); }
    .btn-outline-primary.disabled, .btn-outline-primary:disabled {
      color: #007bff;
      background-color: transparent; }
    .show > .btn-outline-primary.dropdown-toggle {
      color: #fff;
      background-color: #007bff;
      border-color: #007bff; }
    .btn-outline-primary:not(:disabled):not(.disabled):active:focus, .btn-outline-primary:not(:disabled):not(.disabled).active:focus,
    .show > .btn-outline-primary.dropdown-toggle:focus {
      -webkit-box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5); }
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
      
        $SQL = "SELECT * FROM tblpowerprescription WHERE custId = '".$_GET['CId']."'";
        $Result = mysqli_query($Link,$SQL);
        if(mysqli_num_rows($Result) > 0)
            $row = mysqli_fetch_array($Result);
      
        $CNameSQL = "SELECT custName FROM tblcustomer WHERE custId = '".$_GET['CId']."'";
        $CNameResult = mysqli_query($Link,$CNameSQL);
        if(mysqli_num_rows($CNameResult) > 0)
            $CNameRow = mysqli_fetch_array($CNameResult);
      
        if($_POST['btnUpdate'])
        {   //Check blank field
            if($_POST['txtVId'] == "" || $_POST['txtCId'] == "" || $_POST['txtOD_Sph'] == "" || $_POST['txtOD_Cyl'] == "" || $_POST['txtOD_Axis'] == "" ||  $_POST['txtOD_Prism'] == "" || $_POST['txtOD_Base'] == "" || $_POST['txtOS_Sph'] == "" || $_POST['txtOS_Cyl'] == "" || $_POST['txtOS_Axis'] == "" ||  $_POST['txtOS_Prism'] == "" || $_POST['txtOS_Base'] == "" || $_POST['txtOU'] == "" || $_POST['txtDate'] == "" || $_POST['txtEId'] == "")
            {
                $_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"Please fill up all fields.");
                //echo "<script>alert('Please fill in all blank field'); </script>"; //location='".$PHP_SELF."';
            }
            else
            {
                $EIdSQL = "SELECT empId FROM tblemployee WHERE empId = '".$_POST['txtEId']."'";
                $EIdResult = mysqli_query($Link, $EIdSQL);
                if(mysqli_num_rows($EIdResult) == 0)
                  echo "<script>alert('Employee Id is invalid!'); location='".$PHP_SELF."';</script>";             
                else
                {
                  $EIdRow = mysqli_fetch_array($EIdRow); 
                  if(strval($_POST['txtEId']) != strval($_SESSION['UserId']))
                    //echo "<script>alert('".$_POST['txtEId']." ".$_SESSION['UserId']."');</script>";
                    echo "<script>alert('The Employee Id is not related to logged in user!'); location='".$PHP_SELF."';</script>";
                  else
                  {
                    if($_POST['chkSingleVision'] == null || $_POST['chkSingleVision'] == false) $SingleVision = 0;
                      else $SingleVision = 1;
                    if($_POST['chkBifocal'] == null || $_POST['chkBifocal'] == false) $Bifocal = 0;
                      else $Bifocal = 1;
                    if($_POST['chkTrifocal'] == null || $_POST['chkTrifocal'] == false) $Trifocal = 0;
                      else $Trifocal = 1;
                    if($_POST['chkProgressive'] == null || $_POST['chkProgressive'] == false) $Progressive = 0;
                      else $Progressive = 1;
                    if($_POST['chkTrivex'] == null || $_POST['chkSingchkTrivexleVision'] == false) $Trivex = 0;
                      else $Trivex = 1;
                    if($_POST['chkHiIndex'] == null || $_POST['chkHiIndex'] == false) $HiIndex = 0;
                      else $HiIndex = 1;
                    if($_POST['chkARCoat'] == null || $_POST['chkARCoat'] == false) $ARCoat = 0;
                      else $ARCoat = 1;
                    if($_POST['chkPhotochromic'] == null || $_POST['chkPhotochromic'] == false) $Photochromic = 0;
                      else $Photochromic = 1;
                    if($_POST['chkTint'] == null || $_POST['chkTint'] == false) $Tint = 0;
                      else $Tint = 1;
                    if($_POST['chkPolarized'] == null || $_POST['chkPolarized'] == false) $Polarized = 0;
                      else $Polarized = 1;
                    if($_POST['chkPresbyopia'] == null || $_POST['chkPresbyopia'] == false) $Presbyopia = 0;
                      else $Presbyopia = 1;
                    if($_POST['chkGlaucoma'] == null || $_POST['chkGlaucoma'] == false) $Glaucoma = 0;
                      else $Glaucoma = 1;
                    
                    $UpdatePPSQL = "UPDATE tblpowerprescription SET OD_Sph = ".trim($_POST['txtOD_Sph']).",
                        OD_Cyl = ".trim($_POST['txtOD_Cyl']).",
                        OD_Axis = ".trim($_POST['txtOD_Axis']).",
                        OD_Prism = ".trim($_POST['txtOD_Prism']).",
                        OD_Base = ".trim($_POST['txtOD_Base']).",
                        OS_Sph = ".trim($_POST['txtOS_Sph']).",
                        OS_Cyl = ".trim($_POST['txtOS_Cyl']).",
                        OS_Axis = ".trim($_POST['txtOS_Axis']).",
                        OS_Prism = ".trim($_POST['txtOS_Prism']).",
                        OS_Base = ".trim($_POST['txtOS_Base']).",
                        OU = ".trim($_POST['txtOU']).",
                        singleVision = ".$SingleVision.",
                        bifocal = ".$Bifocal.",
                        trifocal = ".$Trifocal.",
                        progressive = ".$Progressive.",
                        trivex = ".$Trivex.",
                        hiIndex = ".$HiIndex.",
                        aRCoat = ".$ARCoat.",
                        photochromic = ".$Photochromic.",
                        tint = ".$Tint.",
                        polarized = ".$Polarized.",
                        presbyopia = ".$Presbyopia.",
                        glaucoma = ".$Glaucoma.",
                        date = '".trim($_POST['txtDate'])."',
                        createdBy = '".strtoupper(trim($_POST['txtEId']))."' 
                        WHERE vId = '".strtoupper(trim($_POST['txtVId']))."' AND custId = '".strtoupper(trim($_POST['txtCId']))."'";

                    //echo $UpdatePPSQL;
                    $UpdatePPResult = mysqli_query($Link, $UpdatePPSQL);

                    if($UpdatePPResult)
                        $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Prescription submit success.");
                        //echo "<script>alert('Record updated successfully'); location='PowerPrescription(Search).php'2;</script>";
                    else $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Prescription submit failed.");
                        //echo "<script>alert('Record updated failure'); location='".$PHP_SELF."';</script>";
                  }
                }  
            }
        }
        /*else if($_POST['btnAdd'])
        {
           
            if($_POST['txtVId'] == "" || $_POST['txtCId'] == "" || $_POST['txtOD_Sph'] == "" || $_POST['txtOD_Cyl'] == "" || $_POST['txtOD_Axis'] == "" ||  $_POST['txtOD_Prism'] == "" || $_POST['txtOD_Base'] == "" || $_POST['txtOS_Sph'] == "" || $_POST['txtOS_Cyl'] == "" || $_POST['txtOS_Axis'] == "" ||  $_POST['txtOS_Prism'] == "" || $_POST['txtOS_Base'] == "" || $_POST['txtOU'] == "" || $_POST['txtDate'] == "" || $_POST['txtEId'] == "")
            {
                echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
            }
            else
            {  
                 $AddPPSQL = "INSERT INTO tblpowerprescription(vId,custId,OD_Sph,OD_Cyl,OD_Axis,OD_Prism,OD_Base,OS_Sph,OS_Cyl,OS_Axis,OS_Prism,OS_Base,OU,singleVision,bifocal,trifocal,progressive,trivex,hiIndex,aRCoat,photochromic,tint,polarized,presbyopia,glaucoma,date,createdBy) VALUES ('".strtoupper(trim($_POST['txtVId']))."',
                 '".strtoupper(trim($_POST['txtCId']))."',
                ".trim($_POST['txtOD_Sph']).",
                ".trim($_POST['txtOD_Cyl']).",
                ".trim($_POST['txtOD_Axis']).",
                ".trim($_POST['txtOD_Prism']).",
                ".trim($_POST['txtOD_Base']).",
                ".trim($_POST['txtOS_Sph']).",
                ".trim($_POST['txtOS_Cyl']).",
                ".trim($_POST['txtOS_Axis']).",
                ".trim($_POST['txtOS_Prism']).",
                ".trim($_POST['txtOS_Base']).",
                ".trim($_POST['txtOU']).",
                ".trim($_POST['chkSingleVision']).",
                ".trim($_POST['chkBifocal']).",
                ".trim($_POST['chkTrifocal']).",
                ".trim($_POST['chkProgressive']).",
                ".trim($_POST['chkTrivex']).",
                ".trim($_POST['chkHiIndex']).",
                ".trim($_POST['chkARCoat']).",
                ".trim($_POST['chkPhotochromic']).",
                ".trim($_POST['chkTint']).",
                ".trim($_POST['chkPolarized']).",
                ".trim($_POST['chkPresbyopia']).",
                ".trim($_POST['chkGlaucoma']).",
                '".trim($_POST['txtDate'])."',
                '".strtoupper(trim($_POST['txtEId']))."')";

                $AddPPResult = mysqli_query($Link,$AddPPSQL);
                 //echo "<script>alert('".$_POST['txtId'].$_POST['txtName'].$_POST['rdoGender'].$_POST['txaAddress'].$_POST['sltCity'].$_POST['sltState'].$_POST['sltCountry'].$_POST['txtPostcode'].$_POST['txtTel'].$_POST['txtEmail']."');</script>";
                //echo "<script>alert('".$AddPPResult."');</script>"; 
                
                if($AddPPResult)
                    echo "<script>alert('Record added successfully'); location='PowerPrescription.php';</script>";
                else echo "<script>alert('Record added failure'); location='".$PHP_SELF."';</script>"; 
            }
        }*/
        /*else
        { */        
?>		
<div id="bottomDiv" class="animate-bottom">
<form name="myForm" action="" method="post">
    <table align="center" border="0" width="440" height="280">
  <?php
      /*if($first == true){
        //Auto generate custId
        $VIdSQL = "SELECT vId FROM tblpowerprescription ORDER BY vId DESC";
        $VIdResult = mysqli_query($Link,$VIdSQL);
        if(mysqli_num_rows($VIdResult) == 0)
          $NewCId = "C1";
        else{
          $VIdRow = mysqli_fetch_array($VIdResult);
          $LastVId = intval(substr($VIdRow['vId'], 1));
          $NewVId = "V".(1 + $LastVId);
        }
      }*/
  ?>
        <tr height="60"><th colspan="2" style="background-color:cornflowerblue;
          font-size:20px;color:azure;"><center>Prescription Info</center></th>
        </tr>
        <tr>
            <td>Customer Name :</td>
            <td><input type="text" name="txtName" size="28" value="<?php echo $CNameRow['custName']; ?>" readonly></td>
        </tr>
        <tr>
            <td width="180">Prescription Id :</td>
            <td><input type="text" name="txtVId" size="28" placeholder="System Id" value="<?php  echo $_GET['VId']; ?>" readonly></td>
        </tr>
        <tr>
            <td width="">Customer Id :</td>
            <td><input type="text" name="txtCId" size="28" placeholder="System Id" value="<?php echo $_GET['CId']; ?>" readonly></td>
        </tr>  
        <tr>
            <td>Date :</td>
            <td><input type="date" name="txtDate" value="<?php if($row['date'] != "0000-00-00") echo $row['date']; else echo date("Y-m-j");?>"></td>
        </tr>  
        <tr>
                <td>Created By :</td>
                <td><input type="text" name="txtEId" size="28" value="<?php if($row['createdBy'] != "N.A") echo $row['createdBy']; ?>" placeholder="Employee Id" required></td>
            </tr>  
    </table>
    <table align="center" width="840" height="370">
        <tr>
            <th colspan="7" height="60px" style="border:0px;background-color:cornflowerblue;
              font-size:20px;color:azure;"><center>Power Prescription</center></th>
        </tr>
        <tr align="center">
            <td width="110" height="67"></td>
            <td width="90" style="border:solid 1px black">SPHERE</td>
            <td width="90" style="border:solid 1px black">CYL</td>
            <td width="90" style="border:solid 1px black">AXIS</td>
            <td width="90" style="border:solid 1px black">PRISM</td>
            <td width="90" style="border:solid 1px black">BASE</td>
            <td rowspan="4" align="left" width="90px" style="border:0px;padding-left:5px">
                <u>Recommendation:</u>
                <input type="checkbox" name="chkSingleVision"<?php if($row['singleVision'] == true) echo " selected"; ?>>Single Vision<br/>
                <input type="checkbox" name="chkBifocal"<?php if($row['bifocal'] == true) echo " selected"; ?>>Bifocal<br/>
                <input type="checkbox" name="chkTrifocal"<?php if($row['trifocal'] == true) echo " selected"; ?>>Trifocal<br/>
                <input type="checkbox" name="chkProgressive"<?php if($row['progressive'] == true) echo " selected"; ?>>Progressive<br/>
                <input type="checkbox" name="chkPolycarbonate"<?php if($row['polycarbonate'] == true) echo " selected"; ?>>Polycarbonate<br/>
                <input type="checkbox" name="chkTrivex"<?php if($row['trivex'] == true) echo " selected"; ?>>Trivex<br/>
                <input type="checkbox" name="chkHiIndex"<?php if($row['hiIndex'] == true) echo " selected"; ?>>Hi-index<br/>
                <input type="checkbox" name="chkARCoat"<?php if($row['aRCoat'] == true) echo " selected"; ?>>AR Coat<br/>
                <input type="checkbox" name="chkPhotochromic"<?php if($row['photochromic'] == true) echo " selected"; ?>>Photochromic<br/>
                <input type="checkbox" name="chkTint"<?php if($row['tint'] == true) echo " selected"; ?>>Tint<br/>
                <input type="checkbox" name="chkPolarized"<?php if($row['polarized'] == true) echo " selected"; ?>>Polarized<br/>
                <input type="checkbox" name="chkPresbyopia"<?php if($row['presbyopia'] == true) echo " selected"; ?>>Presbyopia<br/>
                <input type="checkbox" name="chkGlaucoma"<?php if($row['glaucoma'] == true) echo " selected"; ?>>Glaucoma          
            </td>
        </tr>
        <tr align="center">
            <td height="72" style="border:solid 1px black">OS/Right Eye</td>
            <td style="border:solid 1px black"><input type="number" name="txtOD_Sph" min="-4.0" max="4.0" step="0.01" value="<?php echo $row['OD_Sph']; ?>"></td>
            <td style="border:solid 1px black"><input type="number" name="txtOD_Cyl" min="-4.0" max="4.0" step="0.01" value="<?php echo $row['OD_Cyl']; ?>"></td>
            <td style="border:solid 1px black"><input type="number" name="txtOD_Axis" min="-4.0" max="4.0" step="0.01" value="<?php echo $row['OD_Axis']; ?>"></td>
            <td style="border:solid 1px black"><input type="number" name="txtOD_Prism" min="-4.0" max="4.0" step="0.01" value="<?php echo $row['OD_Prism']; ?>"></td>
            <td style="border:solid 1px black"><input type="number" name="txtOD_Base" min="-4.0" max="4.0" step="0.01" value="<?php echo $row['OD_Base']; ?>"></td>
        </tr>
        <tr align="center">
            <td height="70" style="border:solid 1px black">OD/Left Eye</td>
            <td style="border:solid 1px black"><input type="number" name="txtOS_Sph" min="-4.0" max="4.0" step="0.01" value="<?php echo $row['OS_Sph']; ?>"></td>
            <td style="border:solid 1px black"><input type="number" name="txtOS_Cyl" min="-4.0" max="4.0" step="0.01" value="<?php echo $row['OS_Cyl']; ?>"></td>
            <td style="border:solid 1px black"><input type="number" name="txtOS_Axis" min="-4.0" max="4.0" step="0.01" value="<?php echo $row['OS_Axis']; ?>"></td>
            <td style="border:solid 1px black"><input type="number" name="txtOS_Prism" min="-4.0" max="4.0" step="0.01" value="<?php echo $row['OS_Prism']; ?>"></td>
            <td style="border:solid 1px black"><input type="number" name="txtOS_Base" min="-4.0" max="4.0" step="0.01" value="<?php echo $row['OS_Base']; ?>"></td>
        </tr>
        <tr align="center">
            <td height="78" style="border:solid 1px black">OU/Both Eye</td>
            <td style="border:solid 1px black"><input type="number" name="txtOU" min="-4.0" max="4.0" step="0.01" value="<?php echo $row['OU']; ?>"></td>
      </tr>
    </table>
    <hr style="background-color:cornflowerblue;border: 1px solid cornflowerblue;align:center;width:840px;">
    <table align="center">
        <tr>
            <td colspan=7 align="center" style="border:0px">
                <?php
                //if($_GET['Id'] != "")
                    echo "<input type='submit' class='btn btn-primary' name='btnUpdate' value='Update' style='margin:5px;padding:7px'>";
                /*elseif($_GET['Id'] == "")
                    echo "<input type='submit' class='btn btn-primary' name='btnAdd' value='Submit' style='margin:5px;padding:5px'>";*/
                ?>                     
                <input type="reset" class="btn btn-outline-primary" name="btnReset" style="margin:5px;padding:7px" value="Reset" >
                <input type="button" class="btn btn-outline-primary" name="btnBack" value="Back" style="margin:5px;padding:7px" onClick="window.history.back()">
            </td>
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
        //}
    }
    else echo "<script>alert('Please login in first.');location='index.php';</script>";
    ?>
</body>
</html>