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
session_register('strLoginName');
session_register('alreadyLogIn');
session_register('userAccntFile');
class Login
{
		
	function login()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection
		$_SESSION['alreadyLogIn'] = '';
	}
	
	function validate($t_strUname, $t_strPword)   //validates the username password
	{
		$objRecordset = mysql_query("SELECT tblEmpAccount.*, tblEmpPersonal.surname, 
											tblEmpPersonal.firstname, tblEmpPersonal.middlename 
										FROM `tblEmpAccount` 
										INNER JOIN tblEmpPersonal 
											ON tblEmpAccount.empNumber = tblEmpPersonal.empNumber 
										WHERE tblEmpAccount.userName = '$t_strUname' 
											AND tblEmpAccount.userPassword = '$t_strPword'");

		if(!mysql_num_rows($objRecordset))   //username password is invalid
		{
			return "We're Sorry, You have entered invalid information. Please re-enter your Username and Password.";
		}
		else   //correct username password
		{
			$arrEmployee = mysql_fetch_array($objRecordset);   //get the user level
			
			$strLevel = $arrEmployee["userLevel"];
			
			if(strlen($strLevel) > 1)
			{
				$strLevel = substr($strLevel, 0, 1);
			}
			
			$strEmpNmbr = $arrEmployee["empNumber"];
			$_SESSION['strLoginName'] = $arrEmployee["firstname"]." ".$arrEmployee["middlename"]." ".$arrEmployee["surname"];
		
			if($arrEmployee["userPermission"] != "HR Assistant" && $arrEmployee["userPermission"] != "Cashier Assistant")
			{
				//echo "here";
				switch($strLevel)
				{
					case 1:   //HR
						$_SESSION['alreadyLogIn'] = 1;
//						$_SESSION['userAccntFile'] = '/hrmis/Notification.php?strEmpNmbr='.$strEmpNmbr;
						$_SESSION['userAccntFile'] = 'Notification.php?strEmpNmbr='.$strEmpNmbr;
						break;
					case 2:   //cashier
						$_SESSION['alreadyLogIn'] = 1;
//						$_SESSION['userAccntFile'] = '/hrmis/CPersonnelinfo.php?strEmpNmbr='.$strEmpNmbr;				
						$_SESSION['userAccntFile'] = 'CNotification.php?strEmpNmbr='.$strEmpNmbr;
						break;
					case 3:   //chief
						$_SESSION['alreadyLogIn'] = 1;
//						$_SESSION['userAccntFile'] = '/hrmis/Chiefinformation.php?strEmpNmbr='.$strEmpNmbr;				
						$_SESSION['userAccntFile'] = 'Chiefinformation.php?strEmpNmbr='.$strEmpNmbr;
						break;
					case 4:   //director
						$_SESSION['alreadyLogIn'] = 1;
//						$_SESSION['userAccntFile'] = '/hrmis/Directorinformation.php?strEmpNmbr='.$strEmpNmbr;
						$_SESSION['userAccntFile'] = 'Directorinformation.php?strEmpNmbr='.$strEmpNmbr;
						break;
					case 5:   //employee
						$_SESSION['alreadyLogIn'] = 1;
//						$_SESSION['userAccntFile'] = '/hrmis/Employeeinformation.php?strEmpNmbr='.$strEmpNmbr;
						$_SESSION['userAccntFile'] = 'Employeeinformation.php?strEmpNmbr='.$strEmpNmbr;
						break;				
					
				}
			}
			else
			{
				if($arrEmployee["userPermission"] == "HR Assistant")
				{
				
					$strAccessPrmssn = substr($arrEmployee["accessPermission"],0,1);
					switch($strAccessPrmssn)
					{
						case 1:   //HR
							$_SESSION['alreadyLogIn'] = 1;
//							$_SESSION['userAccntFile'] = '/hrmis/Notification.php?strEmpNmbr='.$strEmpNmbr;
							$_SESSION['userAccntFile'] = 'Notification.php?strEmpNmbr='.$strEmpNmbr;
							break;
						case 2:   //cashier
							$_SESSION['alreadyLogIn'] = 1;
//							$_SESSION['userAccntFile'] = '/hrmis/Personal201default.php?strEmpNmbr='.$strEmpNmbr;
							$_SESSION['userAccntFile'] = 'Personal201default.php?strEmpNmbr='.$strEmpNmbr;
							break;
						case 3:   //chief
							$_SESSION['alreadyLogIn'] = 1;
//							$_SESSION['userAccntFile'] = '/hrmis/Searchattendance.php?strEmpNmbr='.$strEmpNmbr;
							$_SESSION['userAccntFile'] = 'Searchattendance.php?strEmpNmbr='.$strEmpNmbr;
							break;
						case 4:   //director
							$_SESSION['alreadyLogIn'] = 1;
//							$_SESSION['userAccntFile'] = '/hrmis/Report.php?strEmpNmbr='.$strEmpNmbr;
							$_SESSION['userAccntFile'] = 'Report.php?strEmpNmbr='.$strEmpNmbr;
							break;
						case 5:   //employee
							$_SESSION['alreadyLogIn'] = 1;
//							$_SESSION['userAccntFile'] = '/hrmis/Holiday.php?strEmpNmbr='.$strEmpNmbr;
							$_SESSION['userAccntFile'] = 'Holiday.php?strEmpNmbr='.$strEmpNmbr;
							break;				
						case 6:   //HR&Cashier
							$_SESSION['alreadyLogIn'] = 1;
//							$_SESSION['userAccntFile'] = '/hrmis/Personnelinfo.php?strEmpNmbr='.$strEmpNmbr;
							$_SESSION['userAccntFile'] = 'Personnelinfo.php?strEmpNmbr='.$strEmpNmbr;
							break;
					}
				}
				elseif($arrEmployee["userPermission"] == "Cashier Assistant")
				{
					$strAccessPrmssn = substr($arrEmployee["accessPermission"],0,1);
					switch($strAccessPrmssn)
					{
						case 0:   //cashier
							$_SESSION['alreadyLogIn'] = 1;
//							$_SESSION['userAccntFile'] = '/hrmis/CPersonnelinfo.php?strEmpNmbr='.$strEmpNmbr;
							$_SESSION['userAccntFile'] = 'CNotification.php?strEmpNmbr='.$strEmpNmbr;
							break;
						case 1:   //cashier
							$_SESSION['alreadyLogIn'] = 1;
//							$_SESSION['userAccntFile'] = '/hrmis/CPersonnelinfo.php?strEmpNmbr='.$strEmpNmbr;
							$_SESSION['userAccntFile'] = 'CPersonnelinfo.php?strEmpNmbr='.$strEmpNmbr;
							break;
						case 2:   //cashier
							$_SESSION['alreadyLogIn'] = 1;
//							$_SESSION['userAccntFile'] = '/hrmis/CDeductionupdate.php?strEmpNmbr='.$strEmpNmbr;
							$_SESSION['userAccntFile'] = 'CDeductionupdate.php?strEmpNmbr='.$strEmpNmbr;
							break;
						case 3:   //cashier
							$_SESSION['alreadyLogIn'] = 1;
//							$_SESSION['userAccntFile'] = '/hrmis/CMonthlyreport.php?strEmpNmbr='.$strEmpNmbr;
							$_SESSION['userAccntFile'] = 'CMonthlyreport.php?strEmpNmbr='.$strEmpNmbr;				
							break;
					}					
				}				
			}
			
			header("Location:".$_SESSION['userAccntFile']);
		}	
	}
}
?>