<?php
include"header.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <meta http-equiv="X-UA-Compatible" content = "ie=edge">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;display=swap" rel="stylesheet">
		
		<script type="text/javascript" src="/FYP - OSMS/js/main.js"></script>
		<script type="text/javascript" src="/FYP - OSMS/js/bootstrap.min.js"></script>
		<!--<script type="text/javascript" src="/FYP - OSMS/js/aos.js"></script>
		<script type="text/javascript" src="/FYP - OSMS/js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="/FYP - OSMS/js/jquery.magnific-popup.min.js"></script>
		<script type="text/javascript" src="/FYP - OSMS/js/jquery.min.js"></script>
		<script type="text/javascript" src="/FYP - OSMS/js/jquery.stellar.min.js"></script>
		<script type="text/javascript" src="/FYP - OSMS/js/jquery.waypoints.min.js"></script>
		<script type="text/javascript" src="/FYP - OSMS/js/jquery-3.2.1.min.js"></script>
		<script type="text/javascript" src="/FYP - OSMS/js/jquery-migrate-3.0.1.min.js"></script>
		<script type="text/javascript" src="/FYP - OSMS/js/moment-with-locales.min.js"></script>
		<script type="text/javascript" src="/FYP - OSMS/js/popper.min.js"></script>
		<script type="text/javascript" src="/FYP - OSMS/js/scrollax.min.js"></script>-->
		
		<!--<link type="text/css" rel="stylesheet" href="/FYP - OSMS/js/text-hide.css">
		<link rel="stylesheet" href="/FYP - OSMS/js/open-iconic-bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="/FYP - OSMS/css/animate.css">
        <link type="text/css" rel="stylesheet" href="/FYP - OSMS/css/owl.theme.default.min.css">
        <link type="text/css" rel="stylesheet" href="/FYP - OSMS/css/magnific-popup.css">
        <link type="text/css" rel="stylesheet" href="/FYP - OSMS/css/aos.css">-->
        <!--<link type="text/css" rel="stylesheet" href="/FYP - OSMS/css/ionicons.min.css">-->
        <!--<link type="text/css" rel="stylesheet" href="/FYP - OSMS/css/bootstrap-datetimepicker.min.css">-->
        <!--<link type="text/css" rel="stylesheet" href="/FYP - OSMS/css/flaticon.css">-->
		<!--<link type="text/css" rel="stylesheet" href="/FYP - OSMS/css/icomoon.css">-->       
		<!-- <link type="text/css" rel="stylesheet" href="/FYP - OSMS/css/style.css">-->
		<!--<link type="text/css" rel="stylesheet" href="/FYP - OSMS/css/bootstrap/bootstrap-grid.css">
		<link type="text/css" rel="stylesheet" href="/FYP - OSMS/css/bootstrap/bootstrap-reboot.css">-->
		<title>Sales Order</title>
        <style>       
            .animate-bottom {
              position: relative;
              -webkit-animation-name: animatebottom;
              -webkit-animation-duration: 1s;
              animation-name: animatebottom;
              animation-duration: 1s
            }

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

            @-webkit-keyframes animatebottom {
              from { bottom:-100px; opacity:0 } 
              to { bottom:0px; opacity:1 }
            }

            @keyframes animatebottom { 
              from{ bottom:-100px; opacity:0 } 
              to{ bottom:0px; opacity:1 }
            }

            #topDiv {
              display: /*none*/;
              text-align: center;
            }

            #bottomDiv {
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
    			padding: 5px;
    			font-size: 15px;
    			font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
            }
            td .item{
                text-align: center;
            }
            tr .item{
                margin-bottom: 10px;
            }
			.cod {
				font-size: 18px;
			}
        </style>
        <link href="style.css" rel="stylesheet" type="text/css">
		<script type="application/javascript">
			
		</script>
</head>
    <body>
	<div class="container-fluid px-md-0">
				<div class="row no-gutters">
					<div class="col-md-12">
						<nav class="navbar navbar-expand-lg navbar-light bg-primary">
						  <a class="navbar-brand" href="index.php">OSMS</a>
						  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
						    <span class="oi oi-menu"></span>
						  </button>

						  <div class="collapse navbar-collapse" id="navbarsExample03">
						    <ul class="navbar-nav mr-auto">
						      <li class="nav-item d-flex">
						        <a class="nav-link d-flex align-items-center dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onMouseOver="">Customer</a>
							    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          <a class="dropdown-item" href="#">Register</a>
						          <a class="dropdown-item" href="#">Edit</a>
						          <!--<div class="dropdown-divider"></div>-->
						          <a class="dropdown-item" href="#">View</a>
						        </div>
								  
							<li class="nav-item df-elx dropdown">
						        <a class="nav-link d-flex align-items-center dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onMouseOver="">
						          Dropdown
						        </a>
						        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          <a class="dropdown-item" href="#">Action</a>
						          <a class="dropdown-item" href="#">Another action</a>
						          <!--<div class="dropdown-divider"></div>-->
						          <a class="dropdown-item" href="#">Something else here</a>
						        </div>
						      </li>	  

						      </li>
						      <li class="nav-item d-flexm">
						        <a class="nav-link d-flex align-items-center dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Employee</a>
								  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          <a class="dropdown-item" href="#">Register</a>
						          <a class="dropdown-item" href="#">Edit</a>
						          <!--<div class="dropdown-divider"></div>-->
						          <a class="dropdown-item" href="#">View</a>
						        </div>
						      </li>
							  <ul class="nav-item d-flex dropdown">
								  <a class="nav-link d-flex align-items-center dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Supplier</a>
					  		  		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<li><a class="dropdown-item" href="AddSupplier.php">Register</a></li>
										<li><a class="dropdown-item" href="#">Edit</a></li>
										<li><a class="dropdown-item" href="#">View</a></li>
						          		
						          		
						          		<!--<div class="dropdown-divider"></div>-->
						          		
						        	</div>
						      </ul>
						      <li class="nav-item d-flex">
						        <a class="nav-link d-flex align-items-center dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Product</a>
					  		  		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          		<a class="dropdown-item" href="#">Register</a>
						          		<a class="dropdown-item" href="#">Edit</a>
						          		<!--<div class="dropdown-divider"></div>-->
						          		<a class="dropdown-item" href="#">View</a>
						       		</div>
						      </li>
							  <li class="nav-item d-flex">
						        <a class="nav-link d-flex align-items-center dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sales</a>
					  		  		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						          		<a class="dropdown-item" href="#">Add</a>
						          		<a class="dropdown-item" href="#">Edit</a>
						          		<!--<div class="dropdown-divider"></div>-->
						          		<a class="dropdown-item" href="#">View</a>
						        	</div>
						      </li>
						    </ul>
						    <!--<form class="form-inline my-2 my-lg-0">
						      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
						      <button class="btn btn-warning my-2 my-sm-0" type="submit">Search</button>
						    </form>-->
						  </div>
					  </nav>
					</div>
				</div>
	</div>
	<?php 
		$d = 1;
		if($d){
	?>
	
        <form action="" method="post">
        <table align="left" border="0" width="317" height="300" padding="20px" bgcolor="#E9FCFF" bordercolordark="#D4E4F5">
			<!-------------------------Data Section------------------------->
            <tr bgcolor="">
                <td width="311">Order : <font class="cod"><?php echo""; ?>R20191120081302</font></td>
                <!--<td width="100"><input type="text" name="txtOrderId" placeholder="" value="" readonly></td>-->
            </tr>
            <tr bgcolor="">
                <td style="border-right:2px">Customer : <?php echo"";?> <font class="cod" placeholder="customer name">
			  <?php echo""; ?>Jenny Wise</font></td>
                <!--<td><input type="text" name="txtCustId"  value=""></td>-->  
            </tr>
            <tr bgcolor="">
                    <td>Date : <?php echo"";?><font class="cod" placeholder=""><?php echo""; ?>20/11/2019</font></td>
                <!--<td><input type="date" name="dt" value="" ></td>-->

            </tr>
            <?php /*?><tr bgcolor="">
                <td>Created by : <?php echo"br/";?><font class="cod" placeholder="Jonathan"><?php echo""; ?></font></td>
                <!--<td><input type="text" name="txtEmpName" placeholder="" value="Jonathan" readonly></td>-->
            </tr><?php */?>
            <tr bgcolor="">
                <!--<td class="item" colspan="2">
                    <input type="button" name="btnSubmit" value="Confirm" style="margin-right:10px;padding:5px">
                    <input type="button" name="btnCancel" value="Cancel" style="margin-left:10px;padding:5px">
                </td>-->
            </tr>
			<!-------------------------/Data Section------------------------->
			<!-------------------------Order Item------------------------->
		  <tr>
				<td class="item">
					<div name="dvItem1" margin="5px" class="blockquote">
						<?php echo"
								<h6>Frame Name</h6>
								<h5>$49.99</h5>
								<button type='button' class='btn btn-primary btn-fab btn-round' style='font-size:14px;weight:bold' position='static'>+</button>
								<font name='fntQty0'>1</font>
								<button type='button' class='btn btn-primary btn-fab btn-round' style='font-size:14px;weight:bold'>-</button>
								"; 
						?>
					</div>
					<div name="dvItem2" margin="5px" class="blockquote">
						<?php echo"
								<h6>Frame Name</h6>
								<h5>$12.99</h5>
								<button type='button' class='btn btn-primary btn-fab btn-round' style='font-size:14px;weight:bold' position='static'>+</button>
								<font name='fntQty0'>2</font>
								<button type='button' class='btn btn-primary btn-fab btn-round' style='font-size:14px;weight:bold'>-</button>
								"; 
						?>
					</div>
				</td>
			</tr>
			<!-------------------------/Order Item------------------------->
			<tr>
		  	  <td><h3 name="lblTAmt" style="align-content: flex-start"><?php echo"$62.80"; ?></h3></td>
		  </tr>
			<tr>
				<td>
					<button type="button" name="btnSubmit" class="btn btn-primary btn-round" style="margin-bottom: 5px">Confirm</button>
				  	<button type="button" name="btnCancel" class="btn btn-primary btn-round" style="margin-bottom: 5px">Cancel</button>
				</td>
			</tr>
        </table>
			
        <table width="60%" align="right" style="position:static">
			<tr>
				<td></td>
	</tr>
			<tr>
				<td><div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text" style="width:auto">
                   <img src="Search.png" name="btnSearch" width="24px" height="24px" onClick="">
                  </span></div>
                <input type="text" class="form-control" placeholder="With Material Icons">
              </div>
            </div></td>
			</tr>
			<tr>
				<td><img src="Resource/Black Brown Plastic.webp" alt="Thumbnail Image" class="img-raised rounded img-fluid image"></td>
				<td><img src="Resource/Wood Neutral.webp" alt="Thumbnail Image" class="img-raised rounded img-fluid image"></td>
				<td><img src="Resource/Women Vintage Black-Gold.jpg" alt="Thumbnail Image" class="img-raised rounded img-fluid image"></td>
			</tr>
			<tr>
				<td><img src="Resource/Cutie Pink Rose-Gold.jpg" alt="Thumbnail Image" class="img-raised rounded img-fluid image"></td>
			  <td><img src="Resource/Tag TR90 Women Vintage.jpg.webp" alt="Thumbnail Image" class="img-raised rounded img-fluid image"></td>
				<td><img src="Resource/LYCZZ Women Transparent Ultralight.jpg" alt="Thumbnail Image" class="img-raised rounded img-fluid image"></td>
			</tr>
			
           <!-- <tr align="center">
                <td class="item">Id</td>
                <td class="item">Product</td>
                <td class="item">Quantity</td>
                <td class="item">Unit Price</td>
                <td><div position="static"></div></td>
          </tr>
            <tr class="item">
                <td align="center"><input type="text" name="txtPId" placeholder="Enter Id here"></td>
                <td align="center"><input type="text" name="txtPName" placeholder="" value="" readonly></td>
                <td align="center"><input type="number" name="txtQty" placeholder="" style="width:50px"></td>
                <td align="center"><input type="text" name="txtUPrice" placeholder="" style="width:100px"></td>
            </tr>
            <tr>
                <td align="center"><input type="text" name="txtPId" placeholder="Enter Id here"></td>
                <td align="center"><input type="text" name="txtPName" placeholder="" value="" readonly></td>
                <td align="center"><input type="number" name="txtQty" placeholder="" style="width:50px"></td>
                <td align="center"><input type="text" name="txtUPrice" placeholder="" style="width:100px"></td>
            </tr>
            <tr>
                <td align="center"><input type="text" name="txtPId" placeholder="Enter Id here"></td>
                <td align="center"><input type="text" name="txtPName" placeholder="" value="" readonly></td>
                <td align="center"><input type="number" name="txtQty" placeholder="" style="width:50px"></td>
                <td align="center"><input type="text" name="txtUPrice" placeholder="" style="width:100px"></td>
            </tr>
            <tr colspan="4">
                <td align="center">
                    <input type="button" name="btnPlus" value="+" style="margin-right:20x;padding:6px">
                    <input type="button" name="btnMinus" value="-" style="margin-left:20px;padding:6px">
                </td>
            </tr>
			
    <tr>
      <td class="item" align="right"><input type="text" name="txtAmt" placeholder=""></td>
            </tr>-->
            
<?php		}
			echo"
          </table>
    </form>";
?>
    </body>
</html>