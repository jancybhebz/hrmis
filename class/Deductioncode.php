<?php 
/* 
File Name: Deductioncode.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view deduction code, description & type to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 06, 2003
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
class DeductionCode
{

var $strDeductionCode;
var $strDeductionDesc;
var $strDeductionType;

   function deductionCode() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addDeductionCode($strEmpNmbr, $t_strDeductionCode, $t_strDeductionDesc, $t_strDeductionAbb, $t_strDeductionType, $Submit) //Add deduction code, description and type
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblDeduction (deductionCode, deductionAbb, deductionDesc, deductionType) VALUES ('$t_strDeductionCode', '$t_strDeductionAbb',  '$t_strDeductionDesc', '$t_strDeductionType')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Deduction code, description and type not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editDeductionCode($strEmpNmbr, $t_strDeductionCode, $t_strDeductionAbb, $t_strDeductionDesc, $t_strDeductionType, $Submit, $t_strOldDeductionCode) //edit deduction code, description and type
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblDeduction WHERE deductionCode='$t_strDeductionCode' AND deductionAbb='$t_strDeductionAbb', AND  deductionDesc='$t_strDeductionDesc'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strDeductionCode=$row['deductionCode'];
			   $t_strDeductionAbb=$row['deductionAbb'];
			   $t_strDeductionDesc=$row['deductionDesc'];
			   $t_strDeductionType=$row['deductionType'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblDeduction SET deductionCode='$t_strDeductionCode', deductionAbb='$t_strDeductionAbb', deductionDesc='$t_strDeductionDesc', deductionType='$t_strDeductionType' WHERE deductionCode='$t_strOldDeductionCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Deduction code, description and type not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteDeductionCode($strEmpNmbr, $t_strDeductionCode, $t_strDeductionAbb, $t_strDeductionDesc, $t_strDeductionType, $Submit) //Delete deduction code, description and Type
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblDeduction WHERE deductionCode='$t_strDeductionCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewDeductionCode($strEmpNmbr, $t_strDeductionCode, $t_strDeductionAbb, $t_strDeductionDesc, $t_strDeductionType) //View list of deduction code, description and type
    {
	     $viewResults = mysql_query("SELECT * FROM tblDeduction");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
			 $t_strDeductionCode=$row['deductionCode'];
			 $t_strDeductionAbb=$row['deductionAbb'];
			 $t_strDeductionDesc=$row['deductionDesc'];
			 $t_strDeductionType=$row['deductionType'];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr class=\"alterrow\"><td width=\"26%\">DEDUCTION CODE</td>";
			 echo "<td width=\"48%\">DEDUCTION DESCRIPTION</td>";
			 echo "<td>DEDUCTION TYPE</td></tr>";
			 echo "<tr><td colspan=\"3\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strDeductionCode=$row['deductionCode'];
			 	$t_strDeductionAbb=$row['deductionAbb'];				
				$t_strDeductionDesc=$row['deductionDesc'];
				$t_strDeductionType=$row['deductionType'];
			 echo "<tr class=\"border\"><td>" . $row['deductionCode'] . "</td>";
			 echo "<td>" . $row['deductionDesc'] . "</td>";
			 echo "<td width=\"26%\">" . $row['deductionType'] . "</td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
             echo "<tr><td colspan=\"3\">&nbsp;</td></tr></table>";
			}
	}
}
?> 