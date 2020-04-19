<?php
  include("header.php");
?><html>
<head>
  <title>Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css">
  <style>
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
    #topDiv {
      display: /*none*/;
      text-align: center;
    }

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
    function getQuarter(selectObject,selectMonth) {
      var quarter = selectObject.value;

      if(quarter == 1)
        var list = ["|","01|January","02|February","03|March"];
      else if(quarter == 2)
        var list = ["|","04|April","05|May","06|June"];
      else if(quarter == 3)
        var list = ["|","07|July","08|August","09|September"];
      else if(quarter == 4)
        var list = ["|","10|October","11|November","12|December"];

      selectMonth.innerHTML = "";
      for(var option in list)
      {
          var pair = list[option].split("|");
          var newOption = document.createElement("option");
          newOption.value = pair[0];
          newOption.innerHTML = pair[1];
          selectMonth.options.add(newOption);
      }
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
    
    $CurrentYear = date("Y");
    $MonthName = array("JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER");
?>
  <table name="" align="center" style="width:360;height:300;border:0px;">
    <tr height="60">
      <th colspan="2" style="background-color:cornflowerblue;font-size:20px;color:azure;"><center>Sales Report</center></th>
    </tr>
    <tr>
      <td style="text-align:right;width=100">Quarter : </td>
      <td><select name="selectQuarter" id="selectQuarter" onchange="getQuarter(this,selectMonth);" required>
              <option></option>
              <option value="1">Quarter 1</option>
              <option value="2">Quarter 2</option>
              <option value="3">Quarter 3</option>
              <option value="4">Quarter 4</option>
          </select></td>
    </tr>
    <tr>
      <td style="text-align:right">Month : </td>
      <td><select name="selectMonth" id="selectMonth">
              <option></option>
              <?php
                  $Quarter = $_COOKIE['Quarter'];
                  if($Quarter == 1)
                  {
                      echo "<option value='01'>January</option>";
                      echo "<option value='02'>February</option>";
                      echo "<option value='03'>March</option>";
                  }
                  else if($Quarter == 2)
                  {
                      echo "<option value='04'>April</option>";
                      echo "<option value='05'>May</option>";
                      echo "<option value='06'>June</option>";
                  }
                  else if($Quarter == 3)
                  {
                      echo "<option value='07'>July</option>";
                      echo "<option value='08'>August</option>";
                      echo "<option value='09'>September</option>";
                  }
                  else if($Quarter == 4)
                  {
                      echo "<option value='10'>October</option>";
                      echo "<option value='11'>November</option>";
                      echo "<option value='12'>December</option>";
                  }
              ?>
          </select></td>
    </tr>
    <tr>
      <td style="text-align:right">Year : </td>
      <td style="text-align:left">
        <select name="selectYear" id="selectYear">
              <option></option>
<?php //The year starts from the year of software development
      for($i = $CurrentYear ; $i > 2018 ; $i--)
      {
          echo "<option ";
          echo "value = '".$i."'";
          echo ">".$i."</option>";
      }
?>
        </select></td>
    </tr>
    <tr>
        <td style="text-align:right">Show : </td>
        <td> <input type="checkbox" >Top Sales Record
          <!--<select name="sltShowData" id="sltShowData">
                <option value="topCake">Top Selling Product</option>
                <option value="topSale">Top Sales Record</option>
          </select>-->
       </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center"><input type="submit" name="btnSubmit" id="btnSubmit" value="Submit"/></td>
    </tr>
  </table>
<?php
  }
?>
</body>

</html>