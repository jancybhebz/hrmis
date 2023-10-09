<?php 
/* 
File Name: Plantilladuties.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view plantilla duties to database.
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
class Plantilladuties
{

var $strItemNumber;
var $strItemDuties;

   function plantillaDuties() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addPlantillaDuties($strEmpNmbr, $t_strItemNumber, $t_strItemDuties, $Submit)   //Add plantilla duties
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblPlantillaDuties (itemNumber, itemDuties) VALUES ('$t_strItemNumber', '$t_strItemDuties')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Plantilla duties not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editPlantillaDuties($strEmpNmbr, $t_strItemNumber, $t_strItemDuties, $Submit, $t_strOldItemNumber) //Modify plantilla duties
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblPlantillaDuties WHERE itemNumber='$t_strItemNumber' and itemDuties='$t_strItemDuties'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			   $t_strItemNumber=$row['itemNumber'];
			   $t_strItemDuties=$row['itemDuties'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblPlantillaDuties SET itemNumber='$t_strItemNumber',  itemDuties='$t_strItemDuties' WHERE itemNumber='$t_strOldItemNumber'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Plantilla duties modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deletePlantillaDuties($strEmpNmbr, $t_strItemNumber, $t_strItemDuties, $Submit) //Delete plantilla duties
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblPlantillaDuties WHERE itemNumber='$t_strItemNumber'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewPlantillaDuties($strEmpNmbr, $t_strItemNumber, $t_strItemDuties) //View list of plantilla duties
    {
	     $viewResults = mysql_query("SELECT * FROM tblPlantillaDuties");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {	
			 $t_strItemNumber=$row['itemNumber'];
			 $t_strItemDuties=$row['itemDuties'];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
             echo "<tr class=\"alterrow\">";
			 echo "<td width=\"20%\">ITEM NUMBER</td>";
			 echo "<td width=\"58%\">ITEM DUTIES</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
			 do 
			 {
			    $t_strItemNumber=$row['itemNumber'];
			    $t_strItemDuties=$row['itemDuties'];
				echo "<tr class=\"border\"><td>" . $row['itemNumber'] . "</td>";
				echo "<td>" . $row['itemDuties'] . "</td>";
				echo "<td width=\"11%\"><a href=\"Plantilladuties.php?strEmpNmbr=$strEmpNmbr&t_strItemNumber=$t_strItemNumber&t_strItemDuties=$t_strItemDuties&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"11%\"><a href=\"Plantilladuties.php?strEmpNmbr=$strEmpNmbr&t_strItemNumber=$t_strItemNumber&t_strItemDuties=$t_strItemDuties&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
			 	echo "<tr><td colspan=\"4\">&nbsp;</td></tr></table>";
			}
	}
}
?> 