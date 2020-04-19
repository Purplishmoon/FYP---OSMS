<?php
	$Username = "username";
	$Password = "password";
	$Localhost = "localhost";
	//$Localhost = "http://www.myapps.com:3306";
	$dbName = "OSMSdb";
	//In this program, all SQL command will be written in big capital letter
	$Tables = array("CREATE TABLE tbluseraccount(userId VARCHAR(15) PRIMARY KEY,
										   userName VARCHAR(20),
										   accType VARCHAR(20),
										   password VARCHAR(50),
										   status CHAR(1))",
				    "CREATE TABLE tblcustomer(custId VARCHAR(15) PRIMARY KEY,
                                           phyId VARCHAR(16),
										   custName VARCHAR(30),
										   gender CHAR(1),
										   addr VARCHAR(50),
										   city VARCHAR(20),
										   state VARCHAR(20),
										   country VARCHAR(20),
										   postcode INT(5),
										   telNo VARCHAR(13),
										   email VARCHAR(40))",
					"CREATE TABLE tblemployee(empId VARCHAR(15) PRIMARY KEY,
                                           phyId VARCHAR(16),
										   empName VARCHAR(30),
										   gender CHAR(1),
										   DOB DATE,
										   addr VARCHAR(50),
										   city VARCHAR(20),
										   state VARCHAR(20),
										   country VARCHAR(20),
										   postcode INT(5),
										   telNo VARCHAR(13),
										   email VARCHAR(40),
                                           position VARCHAR(8))",
					"CREATE TABLE tbleducationlevel(empId VARCHAR(15) PRIMARY KEY,
										   institute VARCHAR(40),
										   level VARCHAR(7),
										   specialization VARCHAR(40),
										   graduatedDate DATE)",
					"CREATE TABLE tblworkexperience(empId VARCHAR(15) PRIMARY KEY,
										   organization VARCHAR(40),
										   pos VARCHAR(40),
										   workFromDate DATE,
										   endAtDate DATE)",
					"CREATE TABLE tblsupplier(suppId VARCHAR(15) PRIMARY KEY,
										   suppName VARCHAR(30),
										   addr VARCHAR(50),
										   city VARCHAR(20),
										   state VARCHAR(20),
										   country VARCHAR(20),
										   postcode INT(5),
										   telNo VARCHAR(13),
										   email VARCHAR(40),
										   salesmanName VARCHAR(30))",
					"CREATE TABLE tblproduct(productId VARCHAR(15) PRIMARY KEY,	
										   productName VARCHAR(30),
										   description VARCHAR(90),
										   brand VARCHAR(15),
										   category VARCHAR(10)",
					"CREATE TABLE tblcategory(catId VARCHAR(10) PRIMARY KEY,
										   catName VARCHAR(20)
                                           unit VARCHAR(20))",
                    "CREATE TABLE tblprodstat(pId VARCHAR(15) PRIMARY KEY,		
										   qty INT(5),
                                           oriPrice DOUBLE,
										   unitPrice DOUBLE)",
					"CREATE TABLE tblpowerprescription(vId VARCHAR(15) PRIMARY KEY,
										   custId VARCHAR(15) 
                                           OD_Sph DOUBLE,
										   OD_Cyl DOUBLE,
										   OD_Axis DOUBLE,
										   OD_Prism DOUBLE,
										   OD_Base DOUBLE,
										   OS_Sph DOUBLE,
										   OS_Cyl DOUBLE,
										   OS_Axis DOUBLE,
										   OS_Prism DOUBLE,
										   OS_Base DOUBLE,
										   OU DOUBLE,
										   singleVision BOOLEAN,
										   bifocal BOOLEAN,
										   trifocal BOOLEAN,
										   progressive BOOLEAN,
                                           polycarbonate BOOLEAN,
										   trivex BOOLEAN,
										   hiIndex BOOLEAN,
										   aRCoat BOOLEAN,
										   photochromic BOOLEAN,
										   tint BOOLEAN,
										   polarized BOOLEAN,
										   presbyopia VARCHAR(5),
										   glaucoma VARCHAR(5),
										   date DATE,
										   createdBy VARCHAR(15))",
					"CREATE TABLE tblsalesorder(orderId VARCHAR(15) PRIMARY KEY,
										   custId VARCHAR(15),
										   date DATE,
										   totalAmt DOUBLE)",
					"CREATE TABLE tblsalesorderitem(tId VARCHAR(18) PRIMARY KEY,
										   orderId VARCHAR(15),
										   productId VARCHAR(15),
										   qty INT)",
					"CREATE TABLE tblpurchasesorder(orderId VARCHAR(15) PRIMARY KEY,
										   empId VARCHAR(15),
										   supperId VARCHAR(15)
										   date DATE,
										   totalAmt DOUBLE)",
					"CREATE TABLE tblpurchasesorderitem(tId VARCHAR(18) PRIMARY KEY,
										   orderId VARCHAR(15),
										   productId VARCHAR(15),
										   qty INT,
										   unitPrice DOUBLE,
                                           status VARCCHAR)",
					"CREATE TABLE tblpurchasesreceived(tId VARCHAR(17) PRIMARY KEY,
										   orderId VARCHAR(15),
										   supplierId VARCHAR(15),
										   productId VARCHAR(15),
										   qty INT,
										   date DATE,
										   orderBy VARCHAR(15))",
					"CREATE TABLE tbluseraccount(userId VARCHAR(15) PRIMARY KEY,
										   userName VARCHAR(20),
										   accType VARCHAR(7),
										   password VARCHAR(30),
										   status CHAR)",
				    "CREATE TABLE tbllowstocklimit(pId VARCHAR(15) PRIMARY KEY,
										   qtyLimit INT)");
	/*AccType: ADMIN, EMP, CUST*/ /*Employee Type: Optician, Admin, Clerk*/
	$Link = mysqli_connect($Localhost,$Username,$Password)or die(mysqli_error()); //SQL connection
	if ($Link)
	{    //Check database whether existed
		if(!mysqli_select_db($Link,$dbName))
		{
			$SQL = "CREATE DATABASE ".$dbName;
			$Result = mysqli_query($Link, $SQL);	
		}
		mysqli_select_db($Link, $dbName);
		for($i = 0; $i < count($Tables); $i++)
		{
			mysqli_query($Link, $Tables[$i]);
			//Check Default User
			$AddSQL = "SELECT * FROM tbluseraccount WHERE userName = 'ONLYONE' AND password = '".md5(trim('gl@ss3s'))."'";//md5() -->encryption function				only can use A~Z, a~z, 0~9, @#$&%: in the password, can't use ^*()[]!—~'"{}
			$Result = mysqli_query($Link, $AddSQL);
			if (mysqli_num_rows($Result) > 0)	//if  data is exist
			{
				$AddResult = mysqli_query($Link, $AddSQL);
			}
			else
			{
				$AddSQL = "INSERT INTO tbluseraccount(userId,userName,accType,password,status) VALUES('E0', 'ONLYONE', 'ADMIN','".md5('gl@ss3s')."', 'A')";
				$AddResult = mysqli_query($Link, $AddSQL);	
                
                $AddAdminEmpInfoSQL = "INSERT INTO tblemployee(empId,phyId,empName,gender,DOB,addr,city,state,country,postcode,telNo,email,position) 
                VALUES('E0','123456-99-7890','Unknown','O','01/01/0001', 'Space','City','Land','Earth',999999,'888-88888888','onlyone@email.com','ADMIN')";
                $AddAdminEmpInfoResult = mysqli_query($Link, $AddAdminEmpInfoSQL);	
			}
		}
	}
	else
	{
		echo "Failing connect to the database server";
	}


?>