<?php 
/* 
File Name: Incomeadditional.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view additional income to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: November 03, 2003
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
class Incomeadditional
{

var $strAddIncomeCode;
var $strAddIncomeDesc;
var $strFixedAmount;

   function incomeAdditional() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addAdditionalIncome($strEmpNmbr, $t_strAddIncomeCode, $t_strAddIncomeDesc, $t_intFixedAmount, $Submit) //Add additional income code, description and amount
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblAddIncome (addIncomeCode, addIncomeDesc, fixedAmount) VALUES ('$t_strAddIncomeCode', '$t_strAddIncomeDesc', '$t_intFixedAmount')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Additional Income code, description and amount not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editAdditionalIncome($strEmpNmbr, $t_strAddIncomeCode, $t_strAddIncomeDesc, $t_intFixedAmount, $Submit,  $t_strOldAddIncomeCode) //Add additional income code, description and amount
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblAddIncome WHERE addIncomeCode='$t_strAddIncomeCode' and addIncomeDesc='$t_strAddIncomeDesc'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strAddIncomeCode=$row['addIncomeCode'];
			   $t_strAddIncomeDesc=$row['addIncomeDesc'];
			   $t_intFixedAmount=$row['fixedAmount'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblAddIncome SET addIncomeCode='$t_strAddIncomeCode', addIncomeDesc='$t_strAddIncomeDesc', fixedAmount='$t_intFixedAmount' WHERE addIncomeCode='$t_strOldAddIncomeCode'";
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

	function deleteAdditionalIncome($strEmpNmbr, $t_strAddIncomeCode, $t_strAddIncomeDesc, $t_intFixedAmount, $Submit) //Delete additional income code, description and amount
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblAddIncome WHERE addIncomeCode='$t_strAddIncomeCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewAdditionalIncome($strEmpNmbr, $t_strAddIncomeCode, $t_strAddIncomeDesc, $t_intFixedAmount) //View list of additional income code, description and amount
    {
	     $viewResults = mysql_query("SELECT * FROM tblAddIncome");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {
			 $t_strAddIncomeCode=$row["addIncomeCode"];
			 $t_strAddIncomeDesc=$row["addIncomeDesc"];
			 $t_intFixedAmount=$row["fixedAmount"];
			 echo "<table width=\"99%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\"><td width=\"22%\">ADD INCOME CODE</td>";
			 echo "<td width=\"38%\">ADD INCOME DESCRIPTION</td>";
			 echo "<td width=\"22%\">AMOUNT</td>";
			 echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strAddIncomeCode=$row["addIncomeCode"];
			    $t_strAddIncomeDesc=$row["addIncomeDesc"];
			    $t_intFixedAmount=$row["fixedAmount"];
				echo "<tr class=\"border\"><td>" . $row['addIncomeCode'] . "</td>";
				echo "<td>" . $row['addIncomeDesc'] . "</td>";
				echo "<td>" . $row['fixedAmount'] . "</td>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
				echo "</tr></table>";      
         }
	}
	
}
?> 