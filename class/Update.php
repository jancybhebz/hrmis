<?
/* 
File Name: Update.php
----------------------------------------------------------------------
Purpose of this file: 
Class Update
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: JDG
----------------------------------------------------------------------
Date of Revision: November 14, 2003
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

class Update 
{

	function Update()
		{
			include("../hrmis/class/Connect.php");   //the dbase connection
				
		}
		
	function updateRecords()
		{
			switch ($sysRecord) 
			{
			
			case "remittance"	: $result = "SELECT * FROM tblEmpDeduction WHERE deductionCode='$deductionCode'";
								  $sqlresult = mysql_query($result) or die (mysql_error());
								  if($row = mysql_fetch_array($sqlresult))     {
		    						do {
										$empNumber=$row['empNumber'];		
			   							$deductionCode=$row['deductionCode'];				
										$amortization=$row['amortization'];															
											
										if ($sysList == "allEmp") {
											$results = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, amortization, deductMonth, deductYear, orNumber, orDate) 
														VALUES ('$empNumber', '$deductionCode', '$amortization', '$deductMonth', '$deductYear', '$orNo', '$orDate')";
											mysql_query($results) or die (mysql_error());	
											}
										elseif ($sysList == "oneEMP") {
											$results = "INSERT INTO tblEmpDeductRemit (empNumber, deductionCode, amortization, deductMonth, deductYear, orNumber, orDate) 
														VALUES ('$empNumber', '$deductionCode', '$amortization', '$deductMonth', '$deductYear', '$orNo', '$orDate')
														WHERE $empNumber='$empNumber'";
											mysql_query($results) or die (mysql_error());	
											} 
										
										} 
										while($row=mysql_fetch_array($sqlresult)); }
								
			case "subsistence"	: $result = "SELECT * FROM tblIncomeDetails WHERE incomeCode='$incomeCode'";
								  $sqlresult = mysql_query($result) or die (mysql_error());
								  if($row = mysql_fetch_array($sqlresult))     {
		    						do {
										$empNumber=$row['empNumber'];		
			   							$incomeCode=$row['incomeCode'];				
										$incomeAmount=$row['incomeAmount'];
										
										if ($sysList == "allEmp") {
											$results = "INSERT INTO tblEmpDeductRemit (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empNumber', '$incomeCode', '$incomeAmount', '$deductMonth', '$deductYear')";
											mysql_query($results) or die (mysql_error());	
											}
										elseif ($sysList == "oneEMP") {
											$results = "INSERT INTO tblEmpDeductRemit (empNumber, incomeCode, incomeAmount, incomeMonth, incomeYear) 
														VALUES ('$empNumber', '$incomeCode', '$incomeAmount', '$deductMonth', '$deductYear')
														WHERE $empNumber='$empNumber'";
											mysql_query($results) or die (mysql_error());	
											} 
										
										} 
									
									while($row=mysql_fetch_array($sqlresult)); }	
			
			default				: break;
			
			} 
		
		}
		
	function comboEmpList($strEmpList, $strEmpNumber)
	{
		$objEmpList = mysql_query("SELECT concat(surname,' , ',firstname) as fullname, empNumber FROM tblEmpPersonal ORDER BY surname");
		
		while($row= mysql_fetch_array($objEmpList))
		{
			$strEmpNumber = $row["empNumber"];
			$strEmpList = $row["fullname"];
			echo "<option value='$strEmpList'>$strEmpList</option>";
			
		}
		
	}

}




?>