<?php 
/* 
File Name: Signatory.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view salary schedule to database.
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: February 20, 2003
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
class Signatory
{


   function signatory() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
		
   function addSignatory($strEmpNmbr, $t_strDesignation, $t_strSignatory, $t_strSignatoryTitle, $Submit) //add signatory
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblSignatory (designation, signatory, signatoryTitle) VALUES ('$t_strDesignation', '$t_strSignatory', '$t_strSignatoryTitle')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Signatory not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}

	function editSignatory($strEmpNmbr, $t_strDesignation, $t_strSignatory, $t_strSignatoryTitle, $Submit, $t_strOldDesignation) //edit signatory
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblSignatory WHERE designation='$t_strDesignation'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
				$t_strDesignation=$row['designation'];
			   	$t_strSignatory=$row['signatory'];
			   	$t_strSignatoryTitle=$row['signatoryTitle'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == 'Submit'){ 
			 $updateResults = "UPDATE tblSignatory SET designation='$t_strDesignation', signatory='$t_strSignatory', signatoryTitle='$t_strSignatoryTitle' WHERE designation='$t_strOldDesignation'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Signatory not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}
	
	function viewSignatory($strEmpNmbr, $t_strSignatory, $t_strSignatoryTitle) //View list of signatory
    {
	     $viewResults = mysql_query("SELECT * FROM tblSignatory");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
			 $t_strDesignation=$row['designation'];
			 $t_strSignatory=$row['signatory'];
			 $t_strSignatoryTitle=$row['signatoryTitle'];
			 echo "<table width=\"99%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\"><td width=\"20%\">DESIGNATION</td>";
			 echo "<td width=\"33%\">SIGNATORY</td>";
			 echo "<td width=\"37%\">SIGNATORY TITLE</td>";
			 echo "<td width=\"10%\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";        
			 do 
			 {
			   	$t_strDesignation=$row['designation'];
			   	$t_strSignatory=$row['signatory'];
			   	$t_strSignatoryTitle=$row['signatoryTitle'];
				echo "<tr class=\"border\"><td>" . $row['designation'] . "</td>";
				echo "<td>" . $row['signatory'] . "</td>";
				echo "<td>" . $row['signatoryTitle'] . "</td>";
				echo "<td><a href=\"Signatory.php?strEmpNmbr=$strEmpNmbr&t_strDesignation=$t_strDesignation&t_strSignatory=$t_strSignatory&t_strSignatoryTitle=$t_strSignatoryTitle&Submit=Edit\">Edit</a></td>"; 
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td colspan=\"4\">&nbsp;</td></tr></table>";        
			}
	}
}
?> 