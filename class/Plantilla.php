<?php 
/* 
File Name: Plantilla.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view plantilla to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 14, 2003
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
class Plantilla
{

var $strItemNumber;
var $strPositionCode;
var $intAuthSalary;
var $intSalaryGrade;


   function plantilla() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addPlantilla($strEmpNmbr, $t_strItemNumber, $t_strPositionCode, $t_intAuthSalary, $t_intAuthSalaryYear, $t_intSalaryGrade, $t_intStepNumber, $Submit)   //Add plantilla
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblPlantilla (itemNumber, positionCode, authorizeSalary, authorizeSalaryYear, salaryGrade, stepNumber) VALUES ('$t_strItemNumber', '$t_strPositionCode', '$t_intAuthSalary', '$t_intAuthSalaryYear', '$t_intSalaryGrade', '$t_intStepNumber')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Plantilla not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editPlantilla($strEmpNmbr, $t_strItemNumber, $t_strPositionCode, $t_intAuthSalary, $t_intAuthSalaryYear, $t_intSalaryGrade, $t_intStepNumber, $Submit, $t_strOldItemNumber) //Modify plantilla
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblPlantilla WHERE itemNumber='$t_strItemNumber' and positionCode='$t_strPositionCode'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			   $t_strItemNumber=$row['itemNumber'];
			   $t_strPositionCode=$row['positionCode'];
			   $t_intAuthSalary=$row['authorizeSalary'];
			   $t_intAuthSalaryYear=$row['authorizeSalaryYear'];
			   $t_intSalaryGrade=$row['salaryGrade'];
			   $t_intStepNumber=$row['stepNumber'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblPlantilla SET itemNumber='$t_strItemNumber', positionCode='$t_strPositionCode', authorizeSalary='$t_intAuthSalary', authorizeSalaryYear='$t_intAuthSalaryYear', salaryGrade='$t_intSalaryGrade', stepNumber='$t_intStepNumber' WHERE itemNumber='$t_strOldItemNumber'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Plantilla modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deletePlantilla($strEmpNmbr, $t_strItemNumber, $t_strPositionCode, $t_intAuthSalary, $t_intAuthSalaryYear, $t_intSalaryGrade, $t_intStepNumber, $Submit) //Delete plantilla
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblPlantilla WHERE itemNumber='$t_strItemNumber'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewPlantilla($strEmpNmbr, $t_strItemNumber, $t_strPositionCode, $t_intAuthSalary,$t_intAuthSalaryYear, $t_intSalaryGrade, $t_intStepNumber) //View list of plantilla
    {
	     $viewResults = mysql_query("SELECT * FROM tblPlantilla");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {	
			 $t_strItemNumber=$row['itemNumber'];
			 $t_strPositionCode=$row['positionCode'];
			 $t_intAuthSalary=$row['authorizeSalary'];
			 $t_intAuthSalaryYear=$row['authorizeSalaryYear'];
			 $t_intSalaryGrade=$row['salaryGrade'];
			 $t_intStepNumber=$row['stepNumber'];
			 echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\"><td width=\"20%\" height=\"18\">ITEM NUMBER</td>";
			 echo "<td width=\"12%\">POSITION CODE</td>";
			 echo "<td width=\"20%\">AUTHORIZED SALARY (month)</td>";
			 echo "<td width=\"20%\">AUTHORIZED SALARY (year)</td>";
			 echo "<td width=\"12%\">SALARY GRADE</td>";
			 echo "<td width=\"10%\">STEP NUMBER</td>";	// stepNumber
			 echo "<td width=\"8%\">&nbsp;</td>";
			 echo "<td width=\"8%\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"8\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strItemNumber=$row['itemNumber'];
				$t_strPositionCode=$row['positionCode'];
				$t_intAuthSalary=$row['authorizeSalary'];
			    $t_intAuthSalaryYear=$row['authorizeSalaryYear'];
				$t_intSalaryGrade=$row['salaryGrade'];
				$t_intStepNumber=$row['stepNumber'];
				echo "<tr class=\"border\"><td>" . $row['itemNumber'] . "</td>";
				echo "<td>" . $row['positionCode'] . "</td>";
				echo "<td>" . $row['authorizeSalary'] . "</td>";
				echo "<td>" . $row['authorizeSalaryYear'] . "</td>";
				echo "<td>" . $row['salaryGrade'] . "</td>";
				echo "<td>" . $row['stepNumber'] . "</td>";
				echo "<td><a href=\"Plantilla.php?strEmpNmbr=$strEmpNmbr&t_strItemNumber=$t_strItemNumber&t_strPositionCode=$t_strPositionCode&t_intAuthSalary=$t_intAuthSalary&t_intSalaryGrade=$t_intSalaryGrade&t_intStepNumber=$t_intStepNumber&Submit=Edit\">Edit</a></td>";
				echo "<td><a href=\"Plantilla.php?strEmpNmbr=$strEmpNmbr&t_strItemNumber=$t_strItemNumber&t_strPositionCode=$t_strPositionCode&t_intAuthSalary=$t_intAuthSalary&t_intAuthSalaryYear=$t_intAuthSalaryYear&t_intSalaryGrade=$t_intSalaryGrade&t_intStepNumber=$t_intStepNumber&Submit=Delete\">Delete</a></td></tr></tr>";		 
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td colspan=\"8\">&nbsp;</td></tr></table>";
			}
	}
	
	function comboStepNumber($strEmpNmbr, $t_intStepNumber)			//  Salary Grade
	{
		$result = mysql_query ("SELECT distinct stepNumber FROM tblSalarySched ORDER BY stepNumber ASC");

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_intStepNumber == $row["stepNumber"])
			{
				print "<OPTION VALUE=\"".($row["stepNumber"])."\" selected>".($row["stepNumber"])."\r";
			}
		  print "<OPTION VALUE=\"".($row["stepNumber"])."\">".($row["stepNumber"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}

	}

	function comboSalaryGrade($strEmpNmbr, $t_intSalaryGrade)			//  Salary Grade
	{
		$result = mysql_query ("SELECT distinct salaryGradeNumber FROM tblSalarySched ORDER BY salaryGradeNumber ASC");

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_intSalaryGrade == $row["salaryGradeNumber"])
			{
				print "<OPTION VALUE=\"".($row["salaryGradeNumber"])."\" selected>".($row["salaryGradeNumber"])."\r";
			}
		  print "<OPTION VALUE=\"".($row["salaryGradeNumber"])."\">".($row["salaryGradeNumber"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}

	}

	function authorizeSalary($t_intSalaryGrade, $t_intStepNumber)		//  Authorize Salary
	{

		if (strlen($t_intSalaryGrade) == 0)
		{
			$t_intSalaryGrade = $this->intSalaryGrade;
		}
				
		if (strlen($t_intStepNumber) == 0)
		{
			$t_intStepNumber = $this->intStepNumber;
		}

		$objAuthorizeSalary = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = '$t_intSalaryGrade' AND stepNumber = '$t_intStepNumber'");
		$row = mysql_fetch_array($objAuthorizeSalary);
		return $row["actualSalary"];
		
	}

	function authorizeSalaryYear($t_intSalaryGrade, $t_intStepNumber)		//  Authorize Salary per year
	{

		if (strlen($t_intSalaryGrade) == 0)
		{
			$t_intSalaryGrade = $this->intSalaryGrade;
		}
				
		if (strlen($t_intStepNumber) == 0)
		{
			$t_intStepNumber = $this->intStepNumber;
		}

		$objAuthorizeSalary = mysql_query("SELECT * FROM tblSalarySched WHERE salaryGradeNumber = '$t_intSalaryGrade' AND stepNumber = '$t_intStepNumber'");
		$row = mysql_fetch_array($objAuthorizeSalary);
		$t_intAuthSalaryMonth = $row['actualSalary'];
		$t_intAuthSalaryYear = $t_intAuthSalaryMonth * 12;
		return $t_intAuthSalaryYear;
		
	}

	function stepNumber($t_intSalaryGrade)		//  Step Number
	{

		if (strlen($t_intSalaryGrade) == 0)
		{
			$t_intSalaryGrade = $this->intSalaryGrade;
		}
				
		$objStepNumber = mysql_query("SELECT stepNumber FROM tblSalarySched WHERE stepNumber GROUP BY stepNumber");
		$row = mysql_fetch_array($objStepNumber);
		return $row["stepNumber"];
		
	}

	function comboPositionCode($strEmpNmbr, $t_strPositionCode)
	{
		$objPositionCode = mysql_query("SELECT * FROM tblPosition ORDER BY positionDesc ASC");
		if ($row = mysql_fetch_array($objPositionCode)) {
			do {
				if ($t_strPositionCode == $row["positionCode"])
				{
					print "<OPTION VALUE=\"".strtoupper($row["positionCode"])."\" selected>".strtoupper($row["positionDesc"])."\r";
				}
		  	print "<OPTION VALUE=\"".strtoupper($row["positionCode"])."\">".strtoupper($row["positionDesc"])."\r";
			} while($row = mysql_fetch_array($objPositionCode));
		} else {print "no results!";}	
	}

}   //  end class
?> 