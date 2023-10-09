<?php
/* 
File Name: DefaultLogin.php 
----------------------------------------------------------------------
Purpose of this file: 
Login page
----------------------------------------------------------------------
Program Name: Human Resource Management Information System
----------------------------------------------------------------------
Description of the Program:
HRMIS uses PHP and MySQL.
----------------------------------------------------------------------
Author: Brian Jill DG. Sarandi
----------------------------------------------------------------------
Date of Revision: July 15, 2004
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
require("../hrmis/class/Login.php");
$objConnection = new Login;

if(strlen($_POST['txtUsername']) !=0)
{
    $strErrMsg = $objConnection->validate($_POST['txtUsername'], $_POST['txtPassword']);
}
else
{
    $strErrMsg = " ";
}
?>
<html>
<head>
    <title>Human Resource Management Information System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="login.css" rel="stylesheet" type="text/css">
    <script>
    function fullwindow()
    {
        //var strErr = "<?php echo $strErrMsg ?>";
        //var strLink = "http://"+"<?php echo $_SERVER['SERVER_NAME'].$_SESSION['userAccntFile'] ?>";
        //if(strErr.length == 0)
        //{
            //poppedwin=window.open(strLink,'_blank','fullscreen,scrollbars');
            /*  poppedwin=window.open(strLink,'_blank');
            mainwindow = window.self; 
            mainwindow.opener = window.self; 
            mainwindow.close(); 
            poppedwin.focus(); 
            */
            //window.location = strLink;
            //window.location = "www.google.com";
            //window.open("www.google.com",'_blank','fullscreen,scrollbars');
        //}
    }
    </script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onContextMenu="return false" onLoad="history.forward(); document.all.txtUsername.focus();fullwindow();">
    <div align="center">
        <table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERBL">
            <tr>
                <td>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="INNERTBL1">
                        <tr>
                            <td>
                                <img src="images/index_01.jpg" width="43" height="13">
                                <img src="images/index_02.jpg" width="72" height="13">
                                <img src="images/index_03.jpg" width="106" height="13">
                                <img src="images/index_04.jpg" width="135" height="13">
                                <img src="images/index_05.jpg" width="127" height="13">
                                <img src="images/index_06.jpg" width="83" height="13">
                                <img src="images/index_07.jpg" width="71" height="13">
                                <img src="images/index_08.jpg" width="141" height="13">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" id="INNERTBL2">
                        <tr> 
                            <td>
                                <img src="images/index_09.jpg" width="43" height="66">
                                <img src="images/index_10.jpg" width="72" height="66">
                                <img src="images/index_11.jpg" width="106" height="66">
                                <img src="images/index_12.jpg" width="135" height="66">
                                <img src="images/index_13.jpg" width="127" height="66">
                                <img src="images/index_14.jpg" width="83" height="66">
                                <img src="images/index_15.jpg">
						        </td>
                  </tr>
                  <tr> 
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr> 
                          <td><img src="images/bottom.jpg" alt="bottom" width="321" height="22"></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></form></td>
            </tr>
          </table></td>
      </tr>
      <tr> 
        <td><img src="images/index_17.jpg" width="43" height="68"><img src="images/index_18.jpg" width="72" height="68"><img src="images/index_19.jpg" width="106" height="68"><img src="images/index_20.jpg" width="135" height="68"><img src="images/index_21.jpg" width="127" height="68"><img src="images/index_22.jpg" width="83" height="68"><img src="images/index_23.jpg" width="71" height="68"><img src="images/index_24.jpg" width="141" height="68"></td>
      </tr>
    </table></td>
	  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="INNERTBL3">
        <tr>
          <td><img src="images/index_25.jpg" width="43" height="45"><img src="images/index_26.jpg" width="72" height="45"><img src="images/index_27.jpg" width="106" height="45"><img src="images/index_28.jpg" width="135" height="45"><img src="images/index_29.jpg" width="127" height="45"><img src="images/index_30.jpg" width="83" height="45"><img src="images/index_31.jpg" width="71" height="45"><img src="images/index_32.jpg" width="141" height="45"></td>
        </tr>
      </table></td>
  </tr>
</table>
</div>
</body>
</html> 	