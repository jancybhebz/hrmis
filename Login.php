<?php
require "../hrmis/class/Login.php";
$objConnection = new Login();

if (!empty($txtUsername)) {
  $strErrMsg = $objConnection->validate($txtUsername, $txtPassword);
}

?>

<html>
<head>
  <title>Human Resource Management Information System</title>
  <meta charset="iso-8859-1">
  <link href="login.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
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
              <img src="images/index_15.jpg" width="71" height="66">
              <img src="images/index_16.jpg" width="141" height="66">
            </td>
          </tr>
          <tr>
            <td bgcolor="#E9F3FE" class="errormsg">
              <table border="0" cellpadding="2" cellspacing="2">
                <tr>
                  <td class="errormsg"><?= $strErrMsg ?? '' ?></td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table width="100%" height="280" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE" id="INNERTBL">
                <tr>
                  <td class="login">
                    <form action="Login.php" method="get">
                      <table width="320" border="0" align="center" cellpadding="0" cellspacing="0" id="LOGINTBL">
                        <tr>
                          <td width="320">
                            <table width="100%" border=">
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
                      </table></td>
                  </tr>
                </table></form></td>
            </tr>
          </table></td>
      </tr>
      <tr> 
        <td><img src="images/index_17.jpg" width="43" height="35"><img src="images/index_18.jpg" width="72" height="35"><img src="images/index_19.jpg" width="106" height="35"><img src="images/index_20.jpg" width="135" height="35"><img src="images/index_21.jpg" width="127" height="35"><img src="images/index_22.jpg" width="83" height="35"><img src="images/index_23.jpg" width="71" height="35"><img src="images/index_24.jpg" width="141" height="35"></td>
      </tr>
    </table></td>
	</tr>
  <tr> 
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" id="INNERTBL3">
        <tr> 
          <td width="43"><img src="images/index_25.jpg" width="43" height="25"></td>
          <td width="682" height="25" bgcolor="#E9F3FE" class="COPYRIGHT"> </td>
          <td width="53"><img src="images/index_26.jpg" width="53" height="25"></td>
        </tr>
      </table></td>
  </tr>
</table>
</div>
</body>
</html> 