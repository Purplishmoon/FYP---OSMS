
<!--<link rel="stylesheet" type="text/css" href="css/menustyle.css">-->
<link rel="stylesheet" type="text/css" href="MenuStyle.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

<div class="dropdwn">
<nav>
<!--<img class="logo" src="" alt="OSMS">-->
<!--	<h3 class="logo" style='color:#F7F7F7'>OSMS</h3>-->
	<ul>
	<li><a href="homepage.php">Home</a></li>
	<!--Different user roles will see different function-->
	<?php
	if($_SESSION['AccType'] == "ADMIN")
	echo"
	<li><a href='#'>Customer <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li><a href='Customer.php'>Register</a></li>
			<li><a href='Customer(Search).php?Id=e'>Update Info</a></li>
			<li><a href='Customer(Search).php?'>Search</a></li>
            <li><a href='Customer(Search).php?Id=d'>Terminate</a></li>
		</ul>
	</li>";
	elseif($_SESSION['AccType'] == "EMP")
	echo"<li><a href='#'>Customer <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li><a href='Customer.php'>Register</a></li>
			<li><a href='Customer(Search).php'>Search</a></li>
		</ul>
	</li>";
	else echo"
	<li><a href='#'>Info <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li><a href='Customer(Search).php?Id='".$_SESSION['UserId']."'>Check</a></li>
			<li><a href='Customer.php?Id=".$_SESSION['UserId']."'>Update</a></li>
		</ul>
	</li>
	";
	?>
	<?php
	if($_SESSION['AccType'] == "ADMIN")
	echo"
	<li><a href='#'>Supplier <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li><a href='Supplier.php'>Register</a></li>
			<li><a href='Supplier(Search).php?Id=e'>Update Info</a></li>
			<li><a href='Supplier(Search).php'>Search</a></li>
            <li><a href='Supplier(Search).php?Id=d'>Terminate</a></li>
		</ul>
	</li>";
	elseif($_SESSION['AccType'] == "EMP")
	echo"
	<li><a href='#'>Supplier <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li><a href='Supplier.php'>Register</a></li>
			<li><a href='Supplier(Search).php'>Search</a></li>
		</ul>
	</li>";
	?>
	<?php
	if($_SESSION['AccType'] == "ADMIN")
	echo"
	<li><a href='#'>Employee <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li><a href='Employee.php'>Register</a></li>
			<li><a href='Employee(Search).php?Id=e'>Update Info</a></li>
			<li><a href='Employee(Search).php'>Search</a></li>
            <li><a href='Employee(Search).php?Id=d'>Terminate</a></li>
		</ul>
	</li>
	";
	elseif($_SESSION['AccType'] == "EMP")
	echo"
	<li><a href='#'>Employee <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li><a href='Employee(Search).php?Id='".$_SESSION['UserId']."'>Check</a></li>
			<li><a href='Employee.php?Id=".$_SESSION['UserId']."'>Update Info</a></li>
		</ul>
	</li>
	";
	?>
	<?php
	if($_SESSION['AccType'] == "ADMIN")
	echo"
	<li><a href='#'>Product <i class='fas fa-caret-down'></i> </a>
        <ul>       
            <li style='width:160px'><a href='#'>Product <i style='transform: rotate(-90deg);' class='fas fa-caret-down'></i> </a>
            <ul>
                <li><a href='Product.php'>Register</a></li>
                <li><a href='Product(Search).php?Id=e'>Update Info</a></li>
                <li><a href='Product(Search).php'>View Info</a></li>
                <li><a href='Product(Search).php?Id=d'>Terminate</a></li>
            </ul>
            </li>
            <li style='width:160px'><a href='#'>Status <i style='transform: rotate(-90deg);' class='fas fa-caret-down'></i> </a>
			<ul>
				<li><a href='Product Status(Search).php?Id=e'>Update</a></li>
				<li><a href='Product Status(Search).php'>View</a></li>
			</ul>
            </li>
			<li style='width:160px'><a href='#'>Category <i style='transform: rotate(-90deg);' class='fas fa-caret-down'></i> </a>
			<ul>
				<li><a href='Category.php'>Add</a></li>
				<li><a href='Category(Search).php?Id=e'>Update</a></li>
				<li><a href='Category(Search).php'>View</a></li>
                <li><a href='Category(Search).php?Id=d'>Delete</a></li>
			</ul>
            </li>
			<li style='width:160px'><a href='Product(Search).php?Id=sl'><h5 style='color:#F7F7F7'>Set Low Stock</h5></a></li><!--//width: 200px-->
		</ul>
	</li>
	";
	elseif($_SESSION['AccType'] == "EMP")
	echo"
	<li><a href='#'>Product <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li><a href='Product.php'>Register</a></li>
			<li><a href='Product(Search).php'>View Info</a></li>
            <li><a href='#'>Status <i style='transform: rotate(-90deg);' class='fas fa-caret-down'></i> </a>
			<ul>
				<li><a href='Product Status(Search).php?Id=e'>Update</a></li>
				<li><a href='Product Status(Search).php'>View</a></li>
			</ul>
            </li>
		</ul>
	</li>
	";
	?>
	<?php
	if($_SESSION['AccType'] == "ADMIN" || $_SESSION['AccType'] == "EMP")
	echo"
	<li><a href='#'>Service <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li><a href='PowerPrescription(Search).php?Id=e.php'>Vision Test</a></li>
            <li><a href='PowerPrescription(Search).php'>Search</a></li>
		</ul>
	</li>
	";
	?>
	<?php
	if($_SESSION['AccType'] == "ADMIN")
	echo"
	<li><a href='#'>Sales <i class='fas fa-caret-down'></i> </a>
		<ul>	
            <li><a href='Sales Order(Step1).php'>Add</a></li>
			<li><a href='Sales Order(Search).php?Id=e'>Update Info</a></li>
			<li><a href='Sales Order(Search).php'>Search</a></li>
            <li><a href='Sales Order(Search).php?Id=d'>Terminate</a></li>
		</ul>
        
	</li>
	";
	elseif($_SESSION['AccType'] == "EMP")
	echo"
	<li><a href='#'>Sales <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li><a href='Sales Order(Step1).php'>Add</a></li>
			<li><a href='Sales Order(Search).php'>Search</a></li>
		</ul>
	</li>
	";
	?>
	<?php
	if($_SESSION['AccType'] == "ADMIN")
	echo"
	<li><a href='#'>Purchases <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li style='width:160px'><a href='Purchases.php'>Add</a></li>
			<li style='width:160px'><a href='Purchases(Search).php?Id=e'>Update Info</a></li>
			<li style='width:160px'><a href='Purchases(Search).php'>Search</a></li>
            <li style='width:160px'><a href='Purchases(Search).php?Id=d'>Terminate</a></li>
			<li style='width:160px'><a href='#'><h5 style='color:#F7F7F7'>Receivation <i style='transform: rotate(-90deg);' class='fas fa-caret-down'></i> </h5></a>
			<ul>
				<li><a href='ProductReceival.php'>Add</a></li>
				<li><a href='ProductReceival(Search).php?Id=e'>Update Info</a></li>
				<li><a href='ProductReceival(Search).php'>Search</a></li>
                <li><a href='ProductReceival(Search).php?Id=d'>Terminate</a></li>
			</ul></li>
		</ul>
	</li>
	";
	elseif($_SESSION['AccType'] == "EMP")
	echo"
	<li><a href='#'>Purchases <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li><a href='Purchases.php'>Add</a></li>
			<li><a href='Purchases(Search).php'>Search</a></li>
			<li><a href='#'><h5 style='color:#F7F7F7'>Receivation <i style='transform: rotate(-90deg);' class='fas fa-caret-down'></i> </h5></a>
			<ul>
				<li><a href='ProductReceival.php'>Add</a></li>
				<li><a href='ProductReceival(Search).php'>Search</a></li>
			</ul></li>
		</ul>
	</li>
	";
	?>
    <?php
	if($_SESSION['AccType'] == "ADMIN")
	echo"
	<li><a href='#'>Report <i class='fas fa-caret-down'></i> </a>
		<ul>
            <li style='width:160px'><a href='Report.php'>Sales</a></li>     
			<li style='width:160px'><a href='Report(Stock).php'>Stock</a></li>
		</ul>
	</li>
	";
      /*<li style='width:160px'><a href='#'><h5 style='color:#F7F7F7'>Sales <i style='transform: rotate(-90deg);' class='fas fa-caret-down'></i> </h5></a>
			<ul>
				<li><a href='Report.php'>Daily</a></li>
				<li><a href='Report.php?Id=e'>Monthly</a></li>
				<li><a href='Report.php'>Annual</a></li>
			</ul>*/
	elseif($_SESSION['AccType'] == "EMP")
	echo"
	<li><a href='#'>Report <i class='fas fa-caret-down'></i> </a>
		<ul>
			<li><a href='Purchases.php'>Add</a></li>
			<li><a href='Purchases(Search).php'>Search</a></li>
			<li><a href='#'><h5 style='color:#F7F7F7'>Receivation <i style='transform: rotate(-90deg);' class='fas fa-caret-down'></i> </h5></a>
			<ul>
				<li><a href='ProductReceival.php'>Add</a></li>
				<li><a href='ProductReceival(Search).php'>Search</a></li>
			</ul></li>
		</ul>
	</li>
	";
	?>
	<?php
	if($_SESSION['AccType'] == "ADMIN")
	echo"
	<li><a href='#'>User Account <i class='fas fa-caret-down'></i> </a>
		<ul>
            <li><a href='User Account(Search).php?Id=".$_SESSION['UserId']."'>Check</a></li>
			<li><a href='User Account.php'>Add</a></li>
			<li><a href='User Account(Search).php?Id=e'>Update Info</a></li>
			<li><a href='User Account(Search).php'>Search</a></li>
            <li><a href='User Account(Search).php?Id=d'>Terminate</a></li>
		</ul>
	</li>
	";
    elseif($_SESSION['AccType'] == "ADMIN" || $_SESSION['AccType'] == "CUST")
    echo"
    <li><a href='#'>User Account <i class='fas fa-caret-down'></i></a>
      <ul>
            <li><a href='User Account(Search).php?Id=".$_SESSION['UserId']."'>Check</a></li>
      </ul>
    </li>
    ";
	?>	
	<!--<li><a href="#">Contact</a></li>-->
	<li><a href="index.php?Id=logout" style="background-color: #C70003">Logout</a></li>
	&nbsp;&nbsp;&nbsp;
</ul>
</nav>
</div>
