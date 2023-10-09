<?
/* 
File Name: Contact.php (class folder)
----------------------------------------------------------------------
Purpose of this file: 
Class Deduction
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Pearliezl S. Dy Tioco
----------------------------------------------------------------------
Date of Revision: February 23, 2003
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
require("../hrmis/class/General.php");
class Contact extends General
{


		
	function contact()
	{
		include("../hrmis/class/Connect.php");   //the dbase connection
	}
	
	function addContact($strEmpNmbr, $t_strAgencyCode, $t_strAgency, $t_strSurname, $t_strFirstname, $t_strMiddleInitial, $t_strTitle, $t_strPosition, $t_strAddress, $t_intTelephone, $t_strEmail, $Submit, $t_strOldAgencyCode) //Add contact
   {
		
		switch ($Submit) { 
			case "ADD"    :	$results = "INSERT INTO tblContact (agencyCode, agency, firstname, middleInitial, surname, title, position, address, phone, email) 
										VALUES ('$t_strAgencyCode', '$t_strAgency', '$t_strSurname', '$t_strFirstname', '$t_strMiddleInitial', '$t_strTitle', '$t_strPosition', '$t_strAddress', '$t_intTelephone', '$t_strEmail')";
		 				   	mysql_query($results) or die (mysql_error());
						   	if(!$results) {
	     				   	echo "<b>Contact not added:</b> ", mysql_error(); 
		    			   	exit; } 
						    //if($results) { return 1; }
						   	break;
						   
			case "Edit"   :	$editresults = "SELECT * FROM tblContact WHERE agencyCode='$t_strAgencyCode'";							   
		    			    $editResults = mysql_query($editresults) or die (mysql_error());
						  	if($row = mysql_fetch_array($editResults))     {
		    					do {		
			   						$t_strOldAgencyCode=$row['agencyCode'];
			   						$t_strAgency=$row['agency'];
			   						$t_strSurname=$row['surname'];
			   						$t_strFirstname=$row['firstname'];
			   						$t_strMiddleInitial=$row['middleInitial'];
			   						$t_strTitle=$row['title'];
			   						$t_strPosition=$row['position'];
									$t_strAddress=$row['address'];
			   						$t_intTelephone=$row['phone'];
			   						$t_strEmail=$row['email'];
									} 
								while($row=mysql_fetch_array($editResults)); }
						   	break;
						   								
			case "Submit" :	$updateResults = "UPDATE tblContact SET agencyCode='$t_strAgencyCode', agency='$t_strAgency', surname='$t_strSurname', firstname='$t_strFirstname', middleInitial='$t_strMiddleInitial', title='$t_strTitle', position='$t_strPosition', address='$t_strAddress', phone='$t_intTelephone', email='$t_strEmail' WHERE agencyCode='$t_strOldAgencyCode' ";
			 				$modifyResults = mysql_query($updateResults);
							
							if(!$modifyResults) { 
								echo "<b>Employee contract not modify:</b> ", mysql_error(); 
								exit; 			} 
			 				if($modifyResults)  { return 1; }
							break; 
							
			case "Delete":	return 1 ; break;
							
			case "OK" 	:	$delete = "DELETE FROM tblContact WHERE agencyCode='$t_strAgencyCode'";  
	      					$del = mysql_query($delete);

							break;
			
			default       : break;				
			}
	}
	
	function viewContact($strEmpNmbr) // view employee contact list
    {
	     $viewResults = mysql_query("SELECT * FROM tblContact");
		 if(!$row = mysql_fetch_array($viewResults))
		 { 
		 echo "Empty";
		 }
		 else
		 { 		 
		 	do{
			$t_strAgencyCode=$row['agencyCode'];
			$t_strAgency=$row['agency'];
			$t_strSurname=$row['surname'];
			$t_strFirstname=$row['firstname'];
			$t_strMiddleInitial=$row['middleInitial'];
			$t_strTitle=$row['title'];
			$t_strPosition=$row['position'];
			$t_strAddress=$row['address'];
			$t_intTelephone=$row['phone'];
			$t_strEmail=$row['email'];			
			echo "<table width=\"90%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			echo "<tr class=\"alterrow\"><td width=\"72%\">&nbsp;</td><td width=\"14%\">&nbsp;</td>";
			echo "<td width=\"14%\">&nbsp;</td></tr>";
        	echo "<tr><td><div align=\"center\">"; 
            echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
            echo "<tr><td class=\"titlebar\">" . $row['agency'] . "</td></tr>";
            echo "<tr><td class=\"titlebar\">" . $row['agencyCode'] . "</td></tr>";
            echo "<tr><td class=\"titlebar\">" . $row['title'] . " " . $row['firstname'] . " " . $row['middleInitial'] . ". " . $row['surname'] ."</td></tr>";
            echo "<tr><td class=\"titlebar\">" . $row['position'] . "</td></tr>";
            echo "<tr><td class=\"titlebar\">" . $row['address'] . "</td></tr>";
            echo "<tr><td class=\"titlebar\">" . $row['phone'] . "</td></tr>";
            echo "<tr><td class=\"titlebar\">" . $row['email'] . "</td></tr></table></div></td>";
            echo "<td><div align=\"center\"><table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
            echo "<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>";
            echo "<tr><td><div align=\"center\"><a href=\"Contact.php?strEmpNmbr=$strEmpNmbr&t_strAgencyCode=$t_strAgencyCode&t_strAgency=$t_strAgency&t_strSurname=$t_strSurname&t_strFirstname=$t_strFirstname&t_strMiddleInitial=$t_strMiddleInitial&t_strTitle=$t_strTitle&t_strPosition=$t_strPosition&t_strAddress=$t_strAddress&t_intTelephone=$t_intTelephone&t_strEmail=$t_strEmail&Submit=Edit\">Edit</a></div></td></tr>";
            echo "<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr></table></div></td><td><div align=\"center\">"; 
            echo "<table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
            echo "<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>";
            echo "<tr><td><div align=\"center\"><a href=\"Contact.php?strEmpNmbr=$strEmpNmbr&t_strAgencyCode=$t_strAgencyCode&t_strAgency=$t_strAgency&t_strSurname=$t_strSurname&t_strFirstname=$t_strFirstname&t_strMiddleInitial=$t_strMiddleInitial&t_strTitle=$t_strTitle&t_strPosition=$t_strPosition&t_strAddress=$t_strAddress&t_intTelephone=$t_intTelephone&t_strEmail=$t_strEmail&Submit=Delete\">Delete</a></div></td></tr>";
            echo "<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td>";
			echo "</tr></table></div></td></tr></table>";		 
			}  while ($row = mysql_fetch_array($viewResults)); 
		} 
	}		

}		
?>