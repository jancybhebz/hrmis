<?php 
/* 
File Name: Division.php (class folder)
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
class Division
{

var $strDivisionCode;
var $strDivisionName;
var $strProjectCode;
var $strDivisionHead;
var $strDivisionHeadTitle;

   function division() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addDivision($strEmpNmbr, $t_strDivisionCode, $t_strDivisionName, $t_strProjectCode, $t_strEmpNumber, $t_strDivisionHead, $t_strDivisionHeadTitle, $Submit)   //Add division
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblDivision (divisionCode, divisionName, projectCode, empNumber, divisionHead, divisionHeadTitle) VALUES ('$t_strDivisionCode', '$t_strDivisionName', '$t_strProjectCode', '$t_strEmpNumber', '$t_strDivisionHead', '$t_strDivisionHeadTitle')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Division not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editDivision($strEmpNmbr, $t_strDivisionCode, $t_strDivisionName, $t_strProjectCode, $t_strEmpNumber, $t_strDivisionHead, $t_strDivisionHeadTitle, $Submit, $t_strOldDivisionCode, $t_strOldProjectCode) //edit division
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblDivision WHERE divisionCode='$t_strDivisionCode' and divisionName='$t_strDivisionName'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			   $t_strDivisionCode=$row['divisionCode'];
			   $t_strDivisionName=$row['divisionName'];
			   $t_strProjectCode=$row['projectCode'];
			   $t_strEmpNumber=$row['empNumber'];
			   $t_strDivisionHead=$row['divisionHead'];
			   $t_strDivisionHeadTitle=$row['divisionHeadTitle'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == 'Submit'){ 
			 $updateResults = "UPDATE tblDivision SET divisionCode='$t_strDivisionCode', divisionName='$t_strDivisionName', projectCode='$t_strProjectCode', empNumber='$t_strEmpNumber', divisionHead='$t_strDivisionHead', divisionHeadTitle='$t_strDivisionHeadTitle' WHERE divisionCode='$t_strOldDivisionCode' and projectCode='$t_strOldProjectCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Division not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteDivision($strEmpNmbr, $t_strDivisionCode, $t_strDivisionName, $t_strProjectCode, $t_strEmpNumber, $t_strDivisionHead, $t_strDivisionHeadTitle, $Submit) //Delete division
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblDivision WHERE divisionCode='$t_strDivisionCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewDivision($strEmpNmbr, $t_strDivisionCode, $t_strDivisionName, $t_strProjectCode, $t_strEmpNumber, $t_strDivisionHead, $t_strDivisionHeadTitle) //View list of division
    {
	     $viewResults = mysql_query("SELECT * FROM tblDivision");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "database is empty";
		 } else {
			 $t_strDivisionCode=$row['divisionCode'];
			 $t_strDivisionName=$row['divisionName'];
			 $t_strProjectCode=$row['projectCode'];
			 $t_strEmpNumber=$row['empNumber'];
			 $t_strDivisionHead=$row['divisionHead'];
			 $t_strDivisionHeadTitle=$row['divisionHeadTitle'];
			 echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\"><td width=\"11%\">DIVISION CODE</td>";
			 echo "<td width=\"18%\">DIVISION NAME</td>";
			 echo "<td width=\"12%\">PROJECT CODE</td>";
			 echo "<td width=\"12%\">EMPLOYEE NUMBER</td>";
			 echo "<td width=\"16%\">DIVISION HEAD</td>";
			 echo "<td width=\"17%\">DIVISION HEAD TITLE</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"8\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strDivisionCode=$row['divisionCode'];
				$t_strDivisionName=$row['divisionName'];
				$t_strProjectCode=$row['projectCode'];
			 	$t_strEmpNumber=$row['empNumber'];
				$t_strDivisionHead=$row['divisionHead'];
				$t_strDivisionHeadTitle=$row['divisionHeadTitle'];
				echo "<tr class=\"border\"><td>" . $row['divisionCode'] . "</td>";
				echo "<td>" . $row['divisionName'] . "</td>";
				echo "<td>" . $row['projectCode'] . "</td>";
				echo "<td>" . $row['empNumber'] . "</td>";
				echo "<td>" . $row['divisionHead'] . "</td>";
				echo "<td>" . $row['divisionHeadTitle'] . "</td>";
				echo "<td width=\"7%\"><a href=\"Division.php?strEmpNmbr=$strEmpNmbr&t_strDivisionCode=$t_strDivisionCode&t_strDivisionName=$t_strDivisionName&t_strProjectCode=$t_strProjectCode&t_strEmpNumber=$t_strEmpNumber&t_strDivisionHead=$t_strDivisionHead&t_strDivisionHeadTitle=$t_strDivisionHeadTitle&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"7%\"><a href=\"Division.php?strEmpNmbr=$strEmpNmbr&t_strDivisionCode=$t_strDivisionCode&t_strDivisionName=$t_strDivisionName&t_strProjectCode=$t_strProjectCode&t_strEmpNumber=$t_strEmpNumber&t_strDivisionHead=$t_strDivisionHead&t_strDivisionHeadTitle=$t_strDivisionHeadTitle&Submit=Delete\">Delete</a></td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
			 echo "<tr><td colspan=\"8\">&nbsp;</td></tr></table>";
        }
	}
	
	function comboEmpNumber($t_strEmpNumber)
	{
	
		$result = mysql_query ("SELECT * FROM tblEmpPersonal ORDER BY empNumber ASC");
		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strEmpNumber == $row["empNumber"])
			{
				print "<OPTION VALUE=\"".$row["empNumber"]."\" selected>".$row["empNumber"]."\r";
			}
		  print "<OPTION VALUE=\"".$row["empNumber"]."\">".$row["empNumber"]."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
		
	}
	
	function comboProjectCode($t_strProjectCode)
	{
	
		$result = mysql_query ("SELECT * FROM tblProject");
		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strProjectCode == $row["projectCode"])
			{
				print "<OPTION VALUE=\"".$row["projectCode"]."\" selected>".$row["projectDesc"]."\r";
			}
		  print "<OPTION VALUE=\"".$row["projectCode"]."\">".$row["projectDesc"]."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
		
	}
	
	function divisionHead($t_strEmpNumber)   //  Division Head
	{

		if (strlen($t_strEmpNumber) == 0)
		{
			$t_strEmpNumber = $this->strEmpNumber;
		}

		$objDivisionHead = mysql_query("SELECT surname, firstname, middlename FROM tblEmpPersonal WHERE empNumber = '$t_strEmpNumber' ");
		$row = mysql_fetch_array($objDivisionHead);
		$t_strName = $row['firstname'] . " " . $row['middlename'] . " " . $row['surname'];
		return $t_strName;
		
	}

	
}	//  end class
?> 