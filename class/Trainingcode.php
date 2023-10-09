<?php 
/* 
File Name: Trainingcode.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
To add, edit, delete and view leave code & type to database.
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
class TrainingCode
{

var $strTrainingCode;
var $strTrainingTitle;

   function trainingCode() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addTrainingCode($strEmpNmbr, $t_strUserLevel, $t_strTrainingCode, $t_strTrainingTitle, $Submit) //Add training code and title
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblTraining (trainingCode, trainingTitle) VALUES ('$t_strTrainingCode', '$t_strTrainingTitle')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Training code and title not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editTrainingCode($strEmpNmbr, $t_strTrainingCode, $t_strTrainingTitle, $Submit, $t_strOldTrainingCode) //Add training code and title
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblTraining WHERE trainingCode='$t_strTrainingCode' and trainingTitle='$t_strTrainingTitle'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_strTrainingCode=$row['trainingCode'];
			   $t_strTrainingTitle=$row['trainingTitle'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblTraining SET trainingCode='$t_strTrainingCode', trainingTitle='$t_strTrainingTitle' WHERE trainingCode='$t_strOldTrainingCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Training code and title not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteTrainingCode($strEmpNmbr, $t_strTrainingCode, $t_strTrainingTitle, $Submit) //Delete training code and title
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblTraining WHERE trainingCode='$t_strTrainingCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewTrainingCode($strEmpNmbr, $t_strTrainingCode, $t_strTrainingTitle) //View list of training code and title
    {
	     $viewResults = mysql_query("SELECT * FROM tblTraining");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {
			 $t_strTrainingCode=$row["trainingCode"];
			 $t_strTrainingTitle=$row["trainingTitle"];
			 echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\">";
			 echo "<td width=\"21%\">TRAINING CODE</td>";
			 echo "<td width=\"59%\">TRAINING TITLE</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strTrainingCode=$row["trainingCode"];
				$t_strTrainingTitle=$row["trainingTitle"];
				echo "<tr class=\"border\"><td>" . $row['trainingCode'] . "</td>";
				echo "<td>" . $row['trainingTitle'] . "</td>";
				echo "<td width=\"10%\"><a href=\"Trainingcode.php?strEmpNmbr=$strEmpNmbr&t_strTrainingCode=$t_strTrainingCode&t_strTrainingTitle=$t_strTrainingTitle&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"10%\"><a href=\"Trainingcode.php?strEmpNmbr=$strEmpNmbr&t_strTrainingCode=$t_strTrainingCode&t_strTrainingTitle=$t_strTrainingTitle&Submit=Delete\">Delete</a></td></tr>";
			 }  while ($row = mysql_fetch_array($viewResults)); 
				echo "<tr><td colspan=\"4\">&nbsp;</td></tr></table>";
		 }
	}
}
?> 