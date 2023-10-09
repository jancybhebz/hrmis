<?php 
/* 
File Name: Section.php (class folder)
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
Date of Revision: October 15, 2003
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
class Section
{

var $strSectionCode;
var $strDivisionCode;
var $strSectionName;
var $strSectionHead;
var $strSectionHeadTitle;

   function section() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addSection($strEmpNmbr, $t_strSectionCode, $t_strDivisionCode, $t_strSectionName, $t_strEmpNumber, $t_strSectionHead, $t_strSectionHeadTitle, $Submit)   //Add section
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblSection (sectionCode, divisionCode, sectionName, empNumber, sectionHead, sectionHeadTitle) VALUES ('$t_strSectionCode', '$t_strDivisionCode', '$t_strSectionName', '$t_strEmpNumber',  '$t_strSectionHead', '$t_strSectionHeadTitle')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Section not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editSection($strEmpNmbr, $t_strSectionCode, $t_strDivisionCode, $t_strSectionName, $t_strEmpNumber, $t_strSectionHead, $t_strSectionHeadTitle, $Submit, $t_strOldSectionCode) //edit section
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblSection WHERE sectionCode='$t_strSectionCode' and sectionName='$t_strSectionName'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{   			  
			   $t_strSectionCode=$row['sectionCode'];
			   $t_strDivisionCode=$row['divisionCode'];
			   $t_strEmpNumber=$row['empNumber'];
			   $t_strSectionName=$row['sectionName'];
			   $t_strSectionHead=$row['sectionHead'];
			   $t_strSectionHeadTitle=$row['sectionHeadTitle'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblSection SET sectionCode='$t_strSectionCode', divisionCode='$t_strDivisionCode', sectionName='$t_strSectionName', empNumber= '$t_strEmpNumber', sectionHead='$t_strSectionHead', sectionHeadTitle='$t_strSectionHeadTitle' WHERE sectionCode='$t_strOldSectionCode'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Section not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteSection($strEmpNmbr, $t_strSectionCode, $t_strDivisionCode, $t_strSectionName, $t_strEmpNumber, $t_strSectionHead, $t_strSectionHeadTitle, $Submit) //Delete section
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblSection WHERE sectionCode='$t_strSectionCode' AND divisionCode='$t_strDivisionCode'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewSection($strEmpNmbr, $t_strSectionCode, $t_strDivisionCode, $t_strSectionName, $t_strEmpNumber, $t_strSectionHead, $t_strSectionHeadTitle) //View list of section
    {
	     $viewResults = mysql_query("SELECT * FROM tblSection");
	     if (!$row=mysql_fetch_array($viewResults))
		 {
		    echo "Database is empty";
		 } else {
			 $t_strSectionCode=$row['sectionCode'];
			 $t_strDivisionCode=$row['divisionCode'];
			 $t_strEmpNumber=$row['empNumber'];
			 $t_strSectionName=$row['sectionName'];
			 $t_strSectionHead=$row['sectionHead'];
			 $t_strSectionHeadTitle=$row['sectionHeadTitle'];
			 echo "<table width=\"99%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr class=\"alterrow\"><td width=\"10%\">SECTION CODE</td>";
			 echo "<td width=\"11%\">DIVISION CODE</td>";
			 echo "<td width=\"21%\">SECTION NAME</td>";
			 echo "<td width=\"12%\">EMPLOYEE NUMBER</td>";
			 echo "<td width=\"14%\">SECTION HEAD</td>";
			 echo "<td width=\"17%\">SECTION HEAD TITLE</td>";
			 echo "<td colspan=\"2\">&nbsp;</td></tr>";
			 echo "<tr><td colspan=\"8\">&nbsp;</td></tr>";
			 do 
			 {
				$t_strSectionCode=$row['sectionCode'];
				$t_strDivisionCode=$row['divisionCode'];
			 	$t_strEmpNumber=$row['empNumber'];
				$t_strSectionName=$row['sectionName'];
				$t_strSectionHead=$row['sectionHead'];
				$t_strSectionHeadTitle=$row['sectionHeadTitle'];
				echo "<tr class=\"border\">";
				echo "<td>" . $row['sectionCode'] . "</td>";
				echo "<td>" . $row['divisionCode'] . "</td>";
				echo "<td>" . $row['sectionName'] . "</td>";
				echo "<td>" . $row['empNumber'] . "</td>";
				echo "<td>" . $row['sectionHead'] . "</td>";
				echo "<td>" . $row['sectionHeadTitle'] . "</td>";
				echo "<td width=\"7%\"><a href=\"Section.php?strEmpNmbr=$strEmpNmbr&t_strSectionCode=$t_strSectionCode&t_strSectionHead=$t_strSectionHead&t_strDivisionCode=$t_strDivisionCode&t_strSectionName=$t_strSectionName&t_strSectionHeadTitle=$t_strSectionHeadTitle&t_strEmpNumber=$t_strEmpNumber&Submit=Edit\">Edit</a></td>";
				echo "<td width=\"8%\"><a href=\"Section.php?strEmpNmbr=$strEmpNmbr&t_strSectionCode=$t_strSectionCode&t_strDivisionCode=$t_strDivisionCode&t_strSectionName=$t_strSectionName&t_strSectionHead=$t_strSectionHead&t_strSectionHeadTitle=$t_strSectionHeadTitle&t_strEmpNumber=$t_strEmpNumber&Submit=Delete\">Delete</a></td></tr>";
			}  while ($row = mysql_fetch_array($viewResults)); 
			 echo "<tr><td colspan=\"8\">&nbsp;</td></tr></table>";
		 }
	}
	
	function comboEmpNumber($strEmpNmbr, $t_strEmpNumber)
	{

		$result = mysql_query ("SELECT tblEmpPersonal.empNumber, tblEmpPosition.statusOfAppointment 
								FROM tblEmpPersonal 
									INNER JOIN tblEmpPosition
										ON tblEmpPersonal.empNumber = tblEmpPosition.empNumber
								WHERE tblEmpPosition.statusOfAppointment = 'In-Service'
									ORDER BY tblEmpPersonal.empNumber ASC");

		if ($row = mysql_fetch_array($result)) {
		do {
			if ($t_strEmpNumber == $row["empNumber"])
			{
				print "<OPTION VALUE=\"".strtoupper($row["empNumber"])."\" selected>".strtoupper($row["empNumber"])."\r";
			}
		  print "<OPTION VALUE=\"".strtoupper($row["empNumber"])."\">".strtoupper($row["empNumber"])."\r";
		} while($row = mysql_fetch_array($result));
		} else {print "no results!";}
		
	}

	function sectionHead($t_strEmpNumber)		//  section head
	{

		if (strlen($t_strEmpNumber) == 0)
		{
			$t_strEmpNumber = $this->strEmpNumber;
		}

				
		$objSectionHead = mysql_query("SELECT surname, firstname, middlename FROM tblEmpPersonal WHERE empNumber = '$t_strEmpNumber'");
		$row = mysql_fetch_array($objSectionHead);
		
		$strMiddleName = $row['middlename'];
		$t_strMiddle = substr($strMiddleName,0,1);
		$strPeriod = ".";
		$t_strMiddleInitial = $t_strMiddle . $strPeriod;
		if ($strMiddleName == "") {
		$t_strEmpName = $row["firstname"] . " " . $row['surname'];
		} else {
		$t_strEmpName = $row["firstname"] . " " . $t_strMiddleInitial  . " " . $row['surname'];
		}
		return $t_strEmpName;
		
	}

	
}	//  end class
?> 