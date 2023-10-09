<?php 
/* 
File Name: Incomecode.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view income code & description to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 10, 2003
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
class Income
{

var $strIncomeCode;
var $strIncomeDesc;

   function income() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addIncome($strEmpNmbr, $t_strIncomeCode, $t_strIncomeAbb, $t_strIncomeDesc, $Submit) //Add income code and description
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblIncome (incomeCode, incomeAbb, incomeDesc) VALUES ('$t_strIncomeCode', '$t_strIncomeAbb', '$t_strIncomeDesc')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Income code and description not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editIncome($strEmpNmbr, $t_strIncomeCode, $t_strIncomeAbb, $t_strIncomeDesc, $Submit, $t_strOldIncomeCode) //Add income code and description
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblIncome WHERE incomeCode='$t_strIncomeCode' AND incomeAbb='$t_strIncomeAbb' AND  incomeDesc='$t_strIncomeDesc'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strIncomeCode=$row['incomeCode'];
			   $t_strIncomeAbb=$row['incomeAbb'];
			   $t_strIncomeDesc=$row['incomeDesc'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblIncome SET incomeCode='$t_strIncomeCode', incomeAbb='$t_strIncomeAbb',  incomeDesc='$t_strIncomeDesc' WHERE incomeCode='$t_strOldIncomeCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Income code and description not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteIncome($strEmpNmbr, $t_strIncomeCode, $t_strIncomeAbb, $t_strIncomeDesc, $Submit) //Delete income code and description
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblIncome WHERE incomeCode='$t_strIncomeCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewIncome($strEmpNmbr, $t_strIncomeCode, $t_strIncomeAbb, $t_strIncomeDesc) //View list of income code and description
    {
	     $viewResults = mysql_query("SELECT * FROM tblIncome");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {
			 $t_strIncomeCode=$row["incomeCode"];
			 $t_strIncomeAbb=$row['incomeAbb'];
			 $t_strIncomeDesc=$row["incomeDesc"];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\"><td width=\"18%\">INCOME CODE</td>";
			 echo "<td width=\"36%\">INCOME ABBREVIATION</td>";
			 echo "<td width=\"46%\">INCOME DESCRIPTION</td></tr>";
			 echo "<tr><td>&nbsp;</td><td colspan=\"2\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strIncomeCode=$row["incomeCode"];
			 	$t_strIncomeAbb=$row['incomeAbb'];
				$t_strIncomeDesc=$row["incomeDesc"];
				echo "<tr class=\"border\"><td>" . $row['incomeCode'] . "</td>";
				echo "<td>" . $row['incomeAbb'] . "</td>";
				echo "<td>" . $row['incomeDesc'] . "</td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
			 echo "<tr><td colspan=\"3\">&nbsp;</td></tr></table>";
         }
	}
}
?> 