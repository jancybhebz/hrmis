<?php 
/* 
File Name: Dailyquote.php (class folder)
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
Date of Revision: May 06, 2004
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
include("../hrmis/class/General.php");
class DailyQuote extends General
{

   function dailyQuote() 
   {
      include("../hrmis/class/Connect.php");   //the dbase connection
   }
	
   function addDailyQuote($strEmpNmbr, $t_dtmDay, $t_strDailyQuote, $Submit) //Add daily quote
   {
      if ($Submit == 'ADD')
	  {
	     $results = "INSERT INTO tblDailyQuote (day, quote) VALUES ('$t_dtmDay', '$t_strDailyQuote')";
		 mysql_query($results) or die (mysql_error());
	     if(!$results) 
	     { 
            echo "<b>Daily Quote not added:</b> ", mysql_error(); 
		    exit; 
	     } 
	     if($results) 
	     { 
		    return 1; 
	     } 
	  }
	}
	
	function editDailyQuote($strEmpNmbr, $t_dtmDay, $t_strDailyQuote, $Submit, $t_dtmOldDay) //edit daily quote
    {
      if ($Submit == 'Edit')
	  {
	     $results = mysql_query("SELECT * FROM tblDailyQuote WHERE day = '$t_dtmDay'");
		 if($row = mysql_fetch_array($results))
		 {
		    do 
			{
			   $t_dtmDay=$row['day'];
			   $t_strDailyQuote=$row['quote'];
			}  while($row=mysql_fetch_array($results));
		}
	}
	elseif ($Submit == "Submit"){ 
			 $updateResults = "UPDATE tblDailyQuote SET day = '$t_dtmDay', quote = '$t_strDailyQuote' WHERE day = '$t_dtmOldDay'";
			 $modifyResults = mysql_query($updateResults);
			 if(!$modifyResults) 
			 { 
				echo "<b>Daily Quote not modify:</b> ", mysql_error(); 
				exit; 
			 } 
			 if($modifyResults) 
			 { 
				return 1; 
			 } 
	} 
}

	function deleteDailyQuote($strEmpNmbr, $t_dtmDay, $t_strDailyQuote, $Submit)   //delete daily quote
   	{
	   if ($Submit == 'Delete') 
	   {
	   		 return 1;
	   }
	   elseif ($Submit == 'OK')
	   {
	      $delete = "DELETE FROM tblDailyQuote WHERE day = '$t_dtmDay'";   //Delete Record from Database
	      $del = mysql_query($delete);
	   }
	}
	
	function viewDailyQuote($strEmpNmbr)   //view daily quote
    {
	     $strSQL = mysql_query("SELECT * FROM tblDailyQuote order by day");

	     if (!$row = mysql_fetch_array($strSQL))
		 {
		    echo "Database is empty";
		 } else {
			   $t_dtmDay=$row['day'];
			   $t_strDailyQuote=$row['quote'];
			 echo "<table width=\"100%\" border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			 echo "<tr><td class=\"alterrow\">Day</td>";
             echo "<td colspan=\"3\" class=\"alterrow\">Daily Quote</td></tr>";
             echo "<tr><td colspan=\"4\">&nbsp;</td></tr>";
			 do 
			 {
			   $t_dtmDay=$row['day'];
			   $t_strDailyQuote=$row['quote'];
			echo "<tr class=\"td\">";
            echo "<td width=\"11%\">" . $row['day'] . "</td>";
            echo "<td width=\"73%\">" . $row['quote'] . "</td>";
            echo "<td width=\"8%\"><a href=\"Dailyquote.php?strEmpNmbr=$strEmpNmbr&t_dtmDay=$t_dtmDay&t_strDailyQuote=$t_strDailyQuote&Submit=Edit\">Edit</a></td>";
			echo "<td width=\"8%\"><a href=\"Dailyquote.php?strEmpNmbr=$strEmpNmbr&t_dtmDay=$t_dtmDay&t_strDailyQuote=$t_strDailyQuote&Submit=Delete\">Delete</a></td></tr>";
			}  while ($row = mysql_fetch_array($strSQL)); 
				echo "<tr><td colspan=\"4\">&nbsp;</td></tr></table>";
         }
		 
	}
	
}
?> 