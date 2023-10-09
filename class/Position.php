<?php 
/* 
File Name: Position.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view project code and description to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: October 23, 2003
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

class Position
{

var $strPositionCode;
var $strPositionDesc;


   function position() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addPositionCode($strEmpNmbr, $t_strPositionCode, $t_strPositionAbb, $t_strPositionDesc, $Submit) //Add position code and description
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblPosition (positionCode, positionAbb, positionDesc) VALUES ('$t_strPositionCode', '$t_strPositionAbb', '$t_strPositionDesc')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Position code and description not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editPositionCode($strEmpNmbr, $t_strPositionCode, $t_strPositionAbb, $t_strPositionDesc, $Submit, $t_strOldPositionCode) //Add position code and description
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblPosition WHERE positionCode='$t_strPositionCode' and positionDesc='$t_strPositionDesc' AND positionAbb='$t_strPositionAbb'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strPositionCode=$row['t_strPositionCode'];
			   $t_strPositionDesc=$row['t_strPositionDesc'];
			   $t_strPositionAbb=$row['t_strPositionAbb'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblPosition SET positionCode='$t_strPositionCode', positionAbb='$t_strPositionAbb',  positionDesc='$t_strPositionDesc' WHERE positionCode='$t_strOldPositionCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Position code and description not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return; 
			 } 
	} 
} 

	function deletePositionCode($strEmpNmbr, $t_strPositionCode, $t_strPositionAbb, $t_strPositionDesc, $Submit) //Delete Position code and description
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblPosition WHERE positionCode='$t_strPositionCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	} 
	
	function viewPositionCode($strEmpNmbr, $t_strPositionCode, $t_strPositionAbb, $t_strPositionDesc) //View list of Position code and type
    {
	     $viewResults = mysql_query("SELECT * FROM tblPosition");
	     if ($row=mysql_fetch_array($viewResults)); 
		 {
		 $t_strPositionCode=$row["positionCode"];
		 $t_strPositionAbb=$row["positionAbb"];
		 $t_strPositionDesc=$row["positionDesc"];
		 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		 echo "<tr class=\"alterrow\">";
		 echo "<td width=\"32%\">POSITION CODE</td>";
		 echo "<td width=\"42%\">POSITION DESCRIPTION</td>";
		 echo "<td colspan=\"2\">&nbsp;</td></tr>";
		 echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
		 do 
		 {
			$t_strPositionCode=$row["positionCode"];
		 	$t_strPositionAbb=$row["positionAbb"];
			$t_strPositionDesc=$row["positionDesc"];
			echo "<tr class=\"border\">";
			echo "<td>" . $row["positionCode"] . "</td>";
			echo "<td>" . $row["positionDesc"] . "</td>";
			echo "<td width=\"13%\"><a href=\"Positioncode.php?strEmpNmbr=$strEmpNmbr&t_strPositionCode=$t_strPositionCode&t_strPositionAbb=$t_strPositionAbb&t_strPositionDesc=$t_strPositionDesc&Submit=Edit\">Edit</a></td>";
			echo "<td width=\"13%\"><a href=\"Positioncode.php?strEmpNmbr=$strEmpNmbr&t_strPositionCode=$t_strPositionCode&t_strPositionAbb=$t_strPositionAbb&t_strPositionDesc=$t_strPositionDesc&Submit=Delete\">Delete</a></td></tr>";
		 }  while ($row = mysql_fetch_array($viewResults)); 
		 	echo "<tr><td colspan=\"4\">&nbsp;</td></tr></table>";
        }
	} 
} 
?> 