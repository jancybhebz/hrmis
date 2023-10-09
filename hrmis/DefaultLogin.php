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

if(strlen($txtUsername) !=0)
{
	$strErrMsg=$objConnection->validate($txtUsername, $txtPassword);
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
<!--
function fullwindow()
{
	//var strErr = "<? echo $strErrMsg?>";
	//var strLink = "http://"+"<? echo $SERVER_NAME.$_SESSION['userAccntFile']?>";
	//if(strErr.length == 0)
	//{

//		poppedwin=window.open(strLink,'_blank','fullscreen,scrollbars');

/*		poppedwin=window.open(strLink,'_blank');
		mainwindow = window.self; 
		mainwindow.opener = window.self; 
		mainwindow.close(); 
		poppedwin.focus(); 
*/
		
		//window.location = strLink;
//		window.location = "www.google.com";
//		window.open("www.google.com",'_blank','fullscreen,scrollbars');
	//}
}
//-->
</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onContextMenu="return false" onLoad="history.forward(); document.all.txtUsername.focus();fullwindow();">
<div align="center">
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERBL">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="INNERTBL1">
        <tr>
            <td><img src="images/index_01.jpg" width="43" height="13"><img src="images/index_02.jpg" width="72" height="13"><img src="images/index_03.jpg" width="106" height="13"><img src="images/index_04.jpg" width="135" height="13"><img src="images/index_05.jpg" width="127" height="13"><img src="images/index_06.jpg" width="83" height="13"><img src="images/index_07.jpg" width="71" height="13"><img src="images/index_08.jpg" width="141" height="13"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="INNERTBL2">
          <tr> 
            <td><img src="images/index_09.jpg" width="43" height="66"><img src="images/index_10.jpg" width="72" height="66"><img src="images/index_11.jpg" width="106" height="66"><img src="images/index_12.jpg" width="135" height="66"><img src="images/index_13.jpg" width="127" height="66"><img src="images/index_14.jpg" width="83" height="66"><img src="images/index_15.jpg" width="71" height="66"><img src="images/index_16.jpg" width="141" height="66"></td>
          </tr>
		  <tr><td bgcolor="#E9F3FE" class="errormsg"><table border="0" width='100%' cellpadding="2" cellspacing="2"><tr><td class="errormsg" align="center"><? echo $strErrMsg; ?></td></tr></table></td></tr>
          <tr> 
            <td><table width="100%" height="280" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE" id="INNERTBL">
                <tr> 
                  <td class="login"><form action="DefaultLogin.php" method="post"><table width="320" border="0" align="center" cellpadding="0" cellspacing="0" id="LOGINTBL">
                      <tr> 
                        <td width="320"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td><img src="images/top.jpg" alt="top" width="321" height="22"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td height="112"><table width="100%" height="112" border="0" cellpadding="0" cellspacing="0">
                            <tr> 
                              <td width="5" height="112"><img src="images/side.jpg" alt="side" width="5" height="112"></td>
                              <td width="304" valign="middle" bgcolor="#003366"><table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" id="TEXTBOXTBL">
                                    <tr> 
                                      <td width="39%" valign="baseline"><div align="right"> 
                                          <p class="login">Username : </p>
                                        </div></td>
                                      <td width="61%"> <input name="txtUsername" type="text" size="20" maxlength="15" value="<? echo $txtUsername;?>"> 
                                      </td>
                                    </tr>
                                    <tr> 
                                      <td height="23" valign="baseline"><div align="right"><span class="login">Password</span> 
                                          : </div></td>
                                      <td> <input name="txtPassword" type="password" size="20" maxlength="10"> 
                                      </td>
                                    </tr>
                                </table></td>
                              <td width="11"><img src="images/side2.jpg" alt="side2" width="12" height="112"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr> 
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="40%" height="18" rowspan="2"><img src="images/leftbottom.jpg" alt="leftbottom" width="127" height="44"></td>
                              <td width="19%"><input type="image" src="images/login.jpg"></td>
                              <td width="41%" rowspan="2"><img src="images/rightbottom.jpg" alt="rightbottom" width="125" height="44"></td>
                            </tr>
                            <tr> 
                              <td><img src="images/middlebottom.jpg" alt="middlebottom" width="68" height="15"></td>
                            </tr>
                          </table></td>
                      </tr>
					  <tr>
                          <td height="25"></td>
                        </tr>
                    </table>
                      <p class="errormsg">&nbsp;</p>
                    </form></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td><table width="778" border="1" cellpadding="1" cellspacing="0" bordercolor="#FF9600" bgcolor="#002E7F" id="OUTERTBL4">
                <tr> 
                  <td height="15"><div align="center"> 
                      <p class="login"><font color="#FFFFFF">Copyright &copy; 
                        2003 Department of Science and Technology</font></p>
                    </div></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
  </tr>
</table>
</div>
</body>
</html>
