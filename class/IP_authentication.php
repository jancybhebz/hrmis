<?
/* 
File Name: Login.php
----------------------------------------------------------------------
Purpose of this file: 
Class login
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: JDG
----------------------------------------------------------------------
Date of Revision: July 15, 2003
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


   $accept = array ("202", "90", "141", "0");
   $remote = explode(".", $REMOTE_ADDR);
   $match = 1; 
   for($i = 0; $i < sizeof($accept); $i++) {
     if($remote[$i] != $accept[$i]) {
       $match = 0;
     }
   }
  if($match) {
   
  } else {
    echo "<h2>Access Forbidden</h2>";
    exit;
  }
?>