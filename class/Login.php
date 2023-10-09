<?
/* 
File Name: Login.php
----------------------------------------------------------------------
Purpose of this file: 
Class login
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: July 15, 2004
----------------------------------------------------------------------
Copyright Notice:
Copyright (C) 2003 by the Department of Science and Technology
----------------------------------------------------------------------
LICENSE:
This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License (GPL) as published 
by the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version. This program is distributed in the 
hope that it will be useful, but WITHOUT ANY WARRANTY; without even the 
implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
See the GNU General Public License for more details.
To read the license please visit http://www.gnu.org/copyleft/gpl.html
 ----------------------------------------------------------------------
*/
session_start();
ini_set("session.gc_maxlifetime","600");
$_SESSION['strLoginName'] = '';
$_SESSION['alreadyLogIn'] = '';
$_SESSION['userAccntFile'] = '';

class Login {
  public function __construct() {
    include("../hrmis/class/Connect.php"); // the dbase connection
    $_SESSION['alreadyLogIn'] = '';
  }

  public function validate($t_strUname, $t_strPword) {
    $conn = new mysqli("localhost", "my_user", "my_password", "my_db");
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT tblEmpAccount.*, tblEmpPersonal.surname, tblEmpPersonal.firstname, tblEmpPersonal.middlename FROM `tblEmpAccount` INNER JOIN tblEmpPersonal ON tblEmpAccount.empNumber = tblEmpPersonal.empNumber WHERE tblEmpAccount.userName = '$t_strUname' AND tblEmpAccount.userPassword = '$t_strPword'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
      return "We're Sorry, You have entered invalid information. Please re-enter your Username and Password.";
    } else {
      $arrEmployee = $result->fetch_assoc();
      $strLevel = $arrEmployee["userLevel"];
      if (strlen($strLevel) > 1) {
        $strLevel = substr($strLevel, 0, 1);
      }
      $strEmpNmbr = $arrEmployee["empNumber"];
      $_SESSION['strLoginName'] = $arrEmployee["firstname"]." ".$arrEmployee["middlename"]." ".$arrEmployee["surname"];

      if ($arrEmployee["userPermission"] != "HR Assistant" && $arrEmployee["userPermission"] != "Cashier Assistant") {
        switch ($strLevel) {
          case 1:
            $_SESSION['alreadyLogIn'] = 1;
            $_SESSION['userAccntFile'] = 'Notification.php?strEmpNmbr='.$strEmpNmbr;
            break;
          case 2:
            $_SESSION['alreadyLogIn'] = 1;
            $_SESSION['userAccntFile'] = 'CNotification.php?strEmpNmbr='.$strEmpNmbr;
            break;
          case 3:
            $_SESSION['alreadyLogIn'] = 1;
            $_SESSION['userAccntFile'] = 'Chiefinformation.php?strEmpNmbr='.$strEmpNmbr;
            break;
          case 4:
            $_SESSION['alreadyLogIn'] = 1;
            $_SESSION['userAccntFile'] = 'Directorinformation.php?strEmpNmbr='.$strEmpNmbr;
            break;
          case 5:
            $_SESSION['alreadyLogIn'] = 1;
            $_SESSION['userAccntFile'] = 'Employeeinformation.php?strEmpNmbr='.$strEmpNmbr;
            break;
        }
      } else {
        if ($arrEmployee["userPermission"] == "HR Assistant") {
          $strAccessPrmssn = substr($arrEmployee["accessPermission"],0,1);
          switch ($strAccessPrmssn) {
            case 1:
              $_SESSION['alreadyLogIn'] = 1;
              $_SESSION['userAccntFile'] = 'Notification.php?strEmpNmbr='.$strEmpNmbr;
              break;
            case 2:
              $_SESSION['alreadyLogIn'] = 1;
              $_SESSION['userAccntFile'] = 'Personal201default.php?strEmpNmbr='.$strEmpNmbr;
              break;
			  ?>

<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
<div class="container">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
		<h1>Login</h1>
		<hr>
		<div class="form-control <?php echo (!empty($username_err)) ? 'error' : ''; ?>">
			<label for="username">Username</label>
			<input type="text" placeholder="Enter Username" name="username" id="username" value="<?php echo $username; ?>">
			<span class="error-message"><?php echo $username_err; ?></span>
		</div>
		<div class="form-control <?php echo (!empty($password_err)) ? 'error' : ''; ?>">
			<label for="password">Password</label>
			<input type="password" placeholder="Enter Password" name="password" id="password">
			<span class="error-message"><?php echo $password_err; ?></span>
		</div>
		<div class="form-control">
			<button type="submit" class="button">Login</button>
		</div>
	</form>
</div>
</body>
</html>