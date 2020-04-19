<?php
include("header.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <meta http-equiv="X-UA-Compatible" content = "ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="AlertMessage.css" rel="stylesheet" type="text/css">
    <?php
    if(Id == "") echo "<title>Add Employee</title>";
    elseif(Id == "e") echo "<title>Update Employee</title>";
    //else echo "<title>View Employee</title>";
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
        td{
            grid-column-gap: 10px;
            column-gap: 10px;
        }
        td{
            font-size: 18px;
        }
    </style>
    <script>
      var count = 1;
      var count2 = 1;

      function Reset(){
          document.getElementById("myForm").reset();
      }

      function plusEducation()
      {
          var table = document.getElementById("tblEducation");
          var row = table.insertRow(-1);
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          var cell4 = row.insertCell(3);
          var cell5 = row.insertCell(4);
          count++;

          cell1.innerHTML = count + ".";
          cell2.innerHTML = "<input type='text' name='txtInstitute" + count + "' id='institution" + count + "' size='24' placeholder='Institution'/>";
          cell3.innerHTML = "<select name='sltLevel" + count + "' id='sltLevel" + count + "'>" +
                                      "<option>Please select option</option>" +
                                      "<option value='Second'>Secondary</option>" +
                                      "<option value='Diploma'>Diploma</option>" +
                                      "<option value='Degree'>Degree</option>" +
                                      "<option value='Master'>Master</option>" +
                                      "<option value='PhD'>PhD</option>" +
                                  "</select>";
          cell4.innerHTML = "<input type='text' name='txtSpecialization" + count + "' id='specialization" + count + "' size='24' placeholder='Specialization'/>";
          cell5.innerHTML = "<input type='date' name='txtGraduatedDate" + count + "' size='10' id='graduateYr" + count + "' />";

          document.getElementById("counterEdu").value = count;
      }

      function minusEducation()
      {
          var table = document.getElementById("tblEducation");
          var counter = document.getElementById("counterEdu");
          var row = table.deleteRow(-1);

          if ( count != 1 )
              count--;

          document.getElementById("counterEdu").value = count;
      }

      function plusWork()
      {
          var table = document.getElementById("tblWork");
          var row = table.insertRow(-1);
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          var cell4 = row.insertCell(3);
          var cell5 = row.insertCell(4);
          var cell6 = row.insertCell(5);

          count2++;

          cell1.innerHTML = count2 + ".";
          cell2.innerHTML = "<input type='text' name='txtComName" + count2 + "' id='company" + count2 + "' size='24' placeholder='Company'/>";
          cell3.innerHTML = "<input type='text' name='txtpos" + count2 + "' id='position" + count2 + "' size='24' placeholder='Position'/>";
          cell4.innerHTML = "<input type='date' name='dtWF" + count2 + "' size='' id='dtWF" + count2 + "' />";
          cell5.innerHTML = "-";
          cell6.innerHTML = "<input type='date' name='dtEA" + count2 + "' size='' id='dtEA" + count2 + "'/>";

          document.getElementById("counterWork").value = count2;
      }

      function minusWork()
      {
          var table = document.getElementById("tblWork");
          var row = table.deleteRow(-1);

          if ( count2 != 1 )
              count2--;

          document.getElementById("counterWork").value = count2;
      }

      function test()
      {
          window.alert('hello world');
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
            $SQL = "SELECT * FROM tblemployee WHERE empId = '".$_GET['Id']."'";
            $Result = mysqli_query($Link,$SQL);
            if(mysqli_num_rows($Result) > 0)
                $row = mysqli_fetch_array($Result);
        }
        if($_POST['btnUpdate'])
        {
            if($_POST['txtEId'] == "" || $_POST['txtId'] == "" || $_POST['txtName'] == "" || $_POST['rdoGender'] == "" || $_POST['txtDOB'] == "" || $_POST['txaAddress'] == "" || $_POST['sltCountry'] == "" || $_POST['txtCity'] == "" || $_POST['txtState'] == "" || $_POST['txtPostcode'] == ""|| $_POST['txtTel'] == "" || $_POST['txtEmail'] == "" || $_POST['sltJobPos'])	
            {
                $_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"Please fillup all fields.");
                //echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
            }
            else
            {
                $UpdateEmp = "UPDATE tblemployee SET empName = '".strtoupper(trim($_POST['txtName']))."',
                        gender = '".strtoupper(trim($_POST['rdoGender']))."',
                        DOB = '".strtoupper(trim($_POST['txtDOB']))."',
                        addr = '".strtoupper(trim($_POST['txaAddress']))."',
                        city = '".strtoupper(trim($_POST['sltCity']))."',
                        state = '".strtoupper(trim($_POST['sltState']))."',
                        country = '".strtoupper(trim($_POST['sltCountry']))."',
                        postcode = '".strtoupper(trim($_POST['txtPostcode']))."',
                        telNo = '".strtoupper(trim($_POST['txtTel']))."',
                        email = '".strtolower(trim($_POST['txtEmail']))."',
                        position = '".strtoupper(trim($_POST['sltJobPos']))."'
                        WHERE empId = '".strtoupper(trim($_POST['txtEId']))."' AND phyId = '".strtoupper(trim($_POST['txtId']))."'";

                for ( $i = 1 ; $i <= $_POST['counterEdu'] ; $i++ )
                {
                    $level = "sltLevel".$i;
                    $institution = 'txtInstitute'.$i;
                    $specialization = "txtSpecialization".$i;
                    $graduateDate = "txtGraduatedDate".$i;

                    $UpdateEduSQL = "UPDATE tbleducationlevel SET institute = '".strtoupper(trim($_POST['$institute']))."',
                                    level = '".strtoupper(trim($_POST['$level']))."',
                                    specialization = '".strtoupper(trim($_POST['$specialization']))."',
                                    graduatedDate = '".strtolower(trim($_POST['$graduateDate']))."'
                                    WHERE empId = '".strtoupper(trim($_POST['txtId']))."'";

                    $UpdateEduResult = mysqli_query($Link,$AddEduSQL);
                }

                for ( $j = 1 ; $j <= $_POST['counterWork'] ; $j++ )
                {
                    $company = "txtComName".$j;
                    $position = "txtPos".$j;
                    $fromDate = "dtWF".$j;
                    $toDate = "dtEA".$j;

                    $UpdateWrkExpSQL = "UPDATE tblworkexperience SET organization = '".strtoupper(trim($_POST['$company']))."',
                                      pos = '".strtoupper(trim($_POST['$position']))."',
                                      workFromDate = '".strtoupper(trim($_POST['$fromYr']))."',
                                      endAtDate = '".strtoupper(trim($_POST['$toDate']))."'
                                      WHERE empId = '".strtoupper(trim($_POST['txtId']))."'";

                    $UpdateWrkExpResult = mysql_query($AddWrkExpSQL,$Link);
                }

                $UpdateEmpResult = mysqli_query($Link, $UpdateEmp);
                $UpdateEduResult = mysqli_query($Link, $UpdateEdu);
                $UpdateWrkExpResult = mysqli_query($Link, $UpdateWrkExp);

                if($UpdateEmpResult && $UpdateEduResult && $UpdateWrkExpResult)
                    $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Employee info update success.");
                    //echo "<script>alert('Update successfully'); location='Employee.php'</script>";
                else $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Employee info update failed.");
                    //echo "<script>alert('Update failure'); location='".$PHP_SELF."'</script>";
            }
        }
        else if($_POST['btnAdd'])
        { 
            if($_POST['txtEId'] == "" || $_POST['txtId'] == "" || $_POST['txtName'] == "" || $_POST['rdoGender'] == "" || $_POST['txtDOB'] == "" || 
                $_POST['txaAddress'] == "" || $_POST['sltCountry'] == "" || $_POST['txtCity'] == "" || $_POST['txtState'] == "" || 
                $_POST['txtPostcode'] == "" || $_POST['txtTel'] == "" || $_POST['txtEmail'] == "" || $_POST['sltJobPos'] == "")	
            {
                $_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"Please fillup all fields.");
                //echo "<script>alert('Please fill in all blank field'); location='".$PHP_SELF."';</script>";
            }
            else
            {
                $ChkEIdSQL = "SELECT empId FROM tblemployee WHERE custId = '".$_POST['txtId']."'";
                $ChkEIdResult = mysqli_query($Link,$ChkEIdSQL);
                if(mysqli_num_rows($ChkEIdResult) > 0){
                    $_SESSION['WARN'] = array('0'=>"Warning!", '1'=>"This Employee Id has been registered.");
                }
                else
                {
                    $AddEmpSQL = "INSERT INTO tblemployee (empId,phyId,empName,gender,DOB,addr,city,state,country,postcode,telNo,email,position) 
                    VALUES ('".strtoupper(trim($_POST['txtEId']))."',
                    '".strtoupper(trim($_POST['txtId']))."',
                    '".strtoupper(trim($_POST['txtName']))."',
                    '".strtoupper(trim($_POST['rdoGender']))."',
                    '".trim($_POST['txtDOB'])."',
                    '".strtoupper(trim($_POST['txaAddress']))."',
                    '".strtoupper(trim($_POST['txtCity']))."',
                    '".strtoupper(trim($_POST['txtState']))."',
                    '".strtoupper(trim($_POST['sltCountry']))."',
                    '".trim($_POST['txtPostcode'])."',
                    '".trim($_POST['txtTel'])."',
                    '".strtolower(trim($_POST['txtEmail']))."',
                    '".strtoupper(trim($_POST['sltJobPos']))."')";

                    //echo "<script>alert('".$AddEmpSQL."');</script>";
                   // echo $AddEmpSQL."<br>";


                    for ( $i = 0 ; $i <= $_POST['counterEdu'] ; $i++ )
                    {
                        $eLevel = "sltLevel".$i;
                        //echo $_POST['$eLevel'];
                        $level = strtoupper(trim($_POST["$eLevel"]));
                        $institution = 'txtInstitute'.$i;
                        $specialization = "txtSpecialization".$i;
                        $graduateyear = "txtGraduateDate".$i;

                        $AddEduSQL = "INSERT INTO tbleducationlevel (empId,institute,level,specialization,graduatedDate) 
                                        VALUES ('".strtoupper(trim($_POST['txtId']))."',
                                        '".strtoupper(trim($_POST["$institution"]))."',
                                        '".$level."',
                                        '".strtoupper(trim($_POST["$specialization"]))."',
                                        '".trim($_POST["$graduateyear"])."')";

                        $AddEduResult = mysqli_query($Link,$AddEduSQL);
                    }
                    //echo "<script>alert('".$AddEduSQL."');</script>";
                    //echo $AddEduSQL."<br>";
                    for ( $j = 0 ; $j <= $_POST['counterWork'] ; $j++ )
                    {
                        $company = "txtComName".$j;
                        $position = "txtPos".$j;
                        $fromYr = "dtWF".$j;
                        $toYr = "dtEA".$j;

                        $AddWrkExpSQL = "INSERT INTO tblworkexperience (empId,organization,pos,workFromDate,endAtDate) 
                                          VALUES ('".strtoupper(trim($_POST['txtId']))."',
                                          '".strtoupper(trim($_POST["$company"]))."',
                                          '".strtoupper(trim($_POST["$position"]))."',
                                          '".trim($_POST["$fromYr"])."',
                                          '".trim($_POST["$toYr"])."')";

                        $AddWrkExpResult = mysqli_query($Link,$AddWrkExpSQL);
                    }
                    //echo $AddWrkExpSQL."<br>";
                    //echo "<script>alert('".$AddWrkExpSQL."');</script>";

                    $AddEmpResult = mysqli_query($Link,$AddEmpSQL);
                    $AddEduResult = mysqli_query($Link,$AddEduSQL);
                    $AddWrkExpResult = mysqli_query($Link,$AddWrkExpSQL);

                    if($AddEmpResult || $AddEduResult || $AddWrkExpResult)
                    {
                        $_SESSION['SUCCESS'] = array('0'=>"Info!", '1'=>"Employee register success.");
                        //echo "<script>alert('Record added successfully'); location='Employee.php';</script>";
                    }
                    else
                    {
                        $_SESSION['ERR'] = array('0'=>"Error!", '1'=>"Employee register failed.");
                        //echo "<script>alert('Record added failure'); location='$PHP_SELF';</script>";
                    }
            }
            }
        }
      //Auto generate empId
      $EIdSQL = "SELECT empId FROM tblemployee ORDER BY empId DESC";
      $EIdResult = mysqli_query($Link,$EIdSQL);
      if(mysqli_num_rows($EIdResult) == 0)
        $NewEId = "E1";
      else{
        $EIdRow = mysqli_fetch_array($EIdResult);
        $LastEId = intval(substr($EIdRow['empId'], 1));
        $NewEId = "E".(1 + $LastEId);
      }
?>
        <div id="bottomDiv" class="animate-bottom">
        <form name="myForm" action="" method="post">
            <table name="tblEmpInfo" align="center" border="0" width="600" height="900" style="margin-top:15px;margin-bottom:10px">
                <tr><th colspan="2" style="background-color:cornflowerblue;
              font-size:20px;color:azure;"><center>Employee Info</center></th>
                </tr>
                <tr>
                    <td width="240px">Employee Id :</td>
                    <td><input type="text" name="txtEId" placeholder="System Id" value="<?php if($_GET['Id'] != "") echo $row['empId']; else echo $NewEId;?>" readonly></td>
                </tr>
                <tr>
                    <td width="">Id / Passport :</td>
                    <td><input type="text" name="txtId" placeholder="Physical Id" value="<?php if($_GET['Id'] != "") echo $row['phyId']; ?>" <?php if($_GET['Id'] != "") echo" readonly"; ?>></td>
                </tr>
                <tr>
                    <td>Name :</td>
                    <td><input type="text" name="txtName" value="<?php if($_GET['Id'] != "") echo $row['empName']; ?>"></td>
                </tr>
                <tr>
                    <td>Gender :</td>
                    <td>
                        <toggle><input type="radio" value="M" name="rdoGender" <?php if($row['gender'] == "M") echo " checked"; ?>> Male 
                        <input type="radio" value="F" name="rdoGender" <?php if($row['gender'] == "F") echo " checked"; ?>> Female</toggle>
                    </td>
                </tr>
                <tr>
                    <td>Date of Birth :</td>
                    <td><input type="date" name="txtDOB" value="<?php if($_GET['Id'] != "") echo $row['DOB']; ?>"></td>
                </tr>
                <tr>
                    <td>Job Position :</td>
                    <td>
                        <select name="sltJobPos">
							<option value="">Please select option</option>
                            <option <?php if($row['pos'] =="ACCOUNTANT") echo "selected='selected'"; ?>>Accountant</option>
                            <option <?php if($row['pos'] =="CASHIER") echo "selected='selected'"; ?>>Cashier</option>
                            <option <?php if($row['pos'] =="CLERK") echo "selected='selected'"; ?>>Clerk</option>
                            <option <?php if($row['pos'] =="ITSUPPORT") echo "selected='selected'"; ?>>IT Support</option>     
                            <option <?php if($row['pos'] =="MANAGER") echo "selected='selected'"; ?>>Manager</option>
                            <option <?php if($row['pos'] =="OPTICIAN") echo "selected='selected'"; ?>>Optician</option>   
                        </select>
                    </td>
                </tr>
                <tr><th colspan="2" style="background-color:cornflowerblue;
              font-size:20px;color:azure;"><center>Contact</center></th>
                </tr>
                <tr>
                    <td>Address :</td>
                    <td><textarea name="txaAddress" rows="3" cols="26" value=""><?php if($_GET['Id'] != "") echo $row['addr']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Postcode :</td>
                    <td><input type="text" name="txtPostcode" value="<?php if($_GET['Id'] != "") echo $row['postcode']; ?>"></td>
                </tr>
                <tr>
                    <td>City :</td>
                    <td>
                        <input type="text" name="txtCity" value="<?php if($_GET['Id'] != "") echo $row['city']; ?>">
                        <!--<select name="sltCity">
						<option value="">Please select option</option>
						<option <?php ////if($row['city'] =="SIBU") echo "selected='selected'"; ?>>Sibu</option>
						<option <?php //if($row['city'] =="BINTULU") echo "selected='selected'"; ?>>Bintulu</option>
						<option <?php //if($row['city'] =="MIRI") echo "selected='selected'"; ?>>Miri</option>
						<option <?php //if($row['city'] =="KUCHING") echo "selected='selected'"; ?>>Kuching</option>
						<option <?php //if($row['city'] =="KUALA LUMPUR") echo "selected='selected'"; ?>>Kuala Lumpur</option>
						</select>-->
					</td>
                </tr>
                <tr>
                    <td>State :</td>
                    <td>
                        <input type="text" name="txtState" value="<?php if($_GET['Id'] != "") echo $row['state']; ?>">
                       <!-- <select name="sltState">
						<option value="">Please select option</option>
						<option  <?php //if($row['state'] =="SARAWAK") echo "selected='selected'"; ?>>Sarawak</option>
						<option  <?php //if($row['state'] =="SABAH") echo "selected='selected'"; ?>>Sabah</option>
						<option  <?php //if($row['state'] =="SELANGOR") echo "selected='selected'"; ?>>Selangor</option>
						</select>-->
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
                    <td><input type="text" name="txtTel" placeholder="999-9999999" value="<?php if($_GET['Id'] != "") echo $row['telNo']; ?>"></td>
                </tr>
                <tr>
                    <td>E-mail :</td>
                    <td><input type="email" name="txtEmail" value="<?php if($_GET['Id'] != "") echo $row['email']; ?>"></td>
                </tr>
            </table>
            <table style="margin-top:10px" align="center" border="0" width="900px" height="120">
                <tr height="60px">
                    <th colspan="7" style="background-color:cornflowerblue;
              font-size:20px;color:azure;"><center>Education Level</center></th>
                </tr>
                <tr><td width="10px" align="center"></td>
                    <td width="100px" align="center">Institution</td>
                    <td width="100px" align="center">Level</td>
                    <td width="100px" align="center">Specialization</td>
                    <td width="105px" align="center">Graduated Date</td>
                </tr>
            </table>
            <table style="margin-top:10px" align="center" border="0" width="720px" height="">
                <tr><td>1.</td>
                    <td><input type="text" name="txtInstitute0" value="<?php if($_GET['Id'] != "") echo $row['institute']; ?>" size='24' placeholder='Institution' required /></td>
                    <td><select class="" name="sltLevel0" required>
                            <option value="">Please select option</option>
							<option value="Secondary" <?php if($row['level'] =="SECOND") echo "selected='selected'"; ?> />Secondary</option>
                            <option value="Foundation" <?php if($row['level'] =="FOUNDATION") echo "selected='selected'"; ?> />Foundation</option>
	                        <option value="Diploma" <?php if($row['level'] =="DIPLOMA") echo "selected='selected'"; ?> />Diploma</option>
	                        <option value="Degree" <?php if($row['level'] =="DEGREE") echo "selected='selected'"; ?> />Degree</option>
                            <option value="Master" <?php if($row['level'] =="MASTER") echo "selected='selected'"; ?> />Master</option>
                            <option value="PhD" <?php if($row['level'] =="PHD") echo "selected='selected'"; ?> />PhD</option>
                        </select></td>
                    <td><input type="text" name="txtSpecialization0" value="<?php if($_GET['Id'] != "") echo $row['specialization']; ?>" size='24' placeholder='Specialization' /></td>
                    <td><input type="date" name="txtGraduateDate0" value="<?php if($_GET['Id'] != "") echo $row['graduatedDate']; ?>" required /></td>
                </tr>
            </table>
            <table name="tblEducation" id="tblEducation" style="margin-top:10px" align="center" border="0" width="900px" height="">
            </table>
            <table align="center" cellpadding="6" border="0">
                <tr>
                    <td align="center" colspan="">
                        <input type="button" class="btn btn-primary btn-fab btn-round" name="btnPlus" id="btnPlus" value=" + " style="margin-right:20x;padding:7px" onclick="plusEducation()" />       
                        <input type="button" class="btn btn-primary btn-fab btn-round" name="btnMinus" id="btnMinus" value=" - " style="margin-left:20px;padding:7px" onclick="minusEducation()" />
                    </td>
                </tr>
            </table>
            <table align="center" border="0" width="900" height="120px" style="padding:10px">
                <tr height="60px">
                    <th colspan="6" style="background-color:cornflowerblue;
              font-size:20px;color:azure;"><center>Working Experience</center></th>
                </tr>
                <tr align="center">
                    <td align="center"></td>
                    <td align="center">Organization</td>
                    <td align="center">Position</td>
                    <td align="center">Work From</td>
                    <td align="center"></td>
                    <td align="center">End At</td>
                </tr>
        </table>
        <table align="center" border="0" width="900" height="" style="padding:10px">
                <tr>
                    <td>1.</td>
                    <td><input type="text" name="txtComName0" placeholder="Company Name" value="<?php if($_GET['Id'] != "") echo $row['organization']; ?>" size='24' placeholder='Company' /></td> 
                    <td><input type="text" name="txtPos0" size='24' placeholder="Position" value="<?php if($_GET['Id'] != "") echo $row['pos']; ?>" /></td>
                    <td><input type="date" name="dtWF0" value="<?php if($_GET['Id'] != "") echo $row['workFromDate']; ?>" /></td>
                    <td align="center">-</td>
                    <td><input type="date" name="dtEA0" value="<?php if($_GET['Id'] != "") echo $row['workToDate']; ?>" /></td>
                </tr>
        </table>
        <table name="tblWork" id="tblWork" align="center" border="0" width="600" height="" style="padding:10px">
        </table>
        <table align="center" cellpadding="6" border="0">
            <tr>
                <td align="center" colspan="4">
                    <input type="button" class="btn btn-primary btn-fab btn-round" name="btnPlus" value=" + " style="margin-right:20x;padding:7px" id="btnPlus" onclick="plusWork()">
                    <input type="button" class="btn btn-primary btn-fab btn-round" name="btnMinus" value=" - " style="margin-left:20px;padding:7px" id="btnMinus" onclick="minusWork()">
                </td>
            </tr>
        </table>

        <center style="margin-top:15px;margin-bottom:20px">
            <?php
                if($_GET['Id'] == "e")
                    echo "<input type='submit' class='btn btn-primary' name='btnUpdate' value='Update' style='margin:5px;padding:5px'>";
                elseif($_GET['Id'] == "")
                    echo "<input type='submit' class='btn btn-primary' name='btnAdd' value='Add' style='margin:5px;padding:5px'>";
            ?>
            <input type="reset" class="btn btn-outline-primary" name="btnReset" style="margin:5px;padding:5px" value="Reset" onClick="Reset()">
        </center>

        <div style="text-align:center;margin-bottom:4%">
            <br /><br />
            <input type="hidden" name="counterEdu" id="counterEdu" value=""/>
            <input type="hidden" name="counterWork" id="counterWork" value=""/>
            <!--<input type="submit" name="btnAdd" id="btnAdd" value="Add"/>-->
        </div>
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
		}
		else echo "<script>alert('Please login in first.');location='index.php';</script>";
	?>
    </body>
</html>