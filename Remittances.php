<?
session_start();
include("../hrmis/class/Security.php");
require("../hrmis/class/Remittance.php");
$objCompute = new Remittance;
$objCompute->setvar(array('strEmpNmbr'=>$strEmpNmbr,'txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear)); //for maintain state
$arrEmpPersonal = $objCompute->checkGetEmpNmbr("Compensation", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p);
?>
<html><!-- InstanceBegin template="/Templates/Compensation.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!-- onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<link href="hrmis.css" rel="stylesheet" type="text/css">
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
<link href="hrmis.css" rel="stylesheet" type="text/css"> 
<link href="hrmis.css" rel="stylesheet" type="text/css">
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/personnel2.jpg','images/income2.jpg','images/remittances2.jpg','images/premiums_loans2.jpg','images/logout2.jpg','images/notificationover.jpg','images/201over.jpg','images/attendanceover.jpg','images/reportsover.jpg','images/librariesover.jpg','images/compensationclick.jpg','images/deductionsummary2.jpg')"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" height="420" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td valign="bottom"><table width="90%" border="0" cellpadding="0" cellspacing="0" id="tblModule">
              <tr>
                <td><img src="images/hrmodule.jpg" width="170" height="23"></td>
              </tr>
            </table></td>
          <td width="69%" valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0" id="tblSECTION">
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Officer" && $t_strAccessPermission == 123456) 
{
?>
                  <table width="80%" border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION" name="NOTIFICATION" width="96" height="29" border="0"></a></td>
                      <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="PROFILE" name="PROFILE" width="67" height="29" border="0"></a></td>
                      <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE" name="ATTENDANCE" width="88" height="29" border="0"></a></td>
                      <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS" name="REPORTS" width="60" height="29" border="0"></a></td>
                      <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES" name="LIBRARIES" width="67" height="29" border="0"></a></td>
                      <td><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION" name="COMPENSATION" width="104" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 16) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION2','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION2" name="NOTIFICATION2" width="96" height="29" border="0"></a></td>
                      <td><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION2','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION2" name="COMPENSATION2" width="104" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 26) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE3','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="PROFILE3" name="PROFILE3" width="67" height="29" border="0"></a></td>
                      <td><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION3','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION3" name="COMPENSATION3" width="104" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 36) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE4','','images/attendanceover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/attendance.jpg" alt="ATTENDANCE4" name="ATTENDANCE4" width="88" height="29" border="0"></a></td>
                      <td><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION4','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION4" name="COMPENSATION4" width="104" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 46) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS5','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS5" name="REPORTS5" width="60" height="29" border="0"></a></td>
                      <td><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION5','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION5" name="COMPENSATION5" width="104" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td valign="bottom"> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 56) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('LIBRARIES6','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES6" name="LIBRARIES6" width="67" height="29" border="0"></a></td>
                      <td><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION6','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION6" name="COMPENSATION6" width="104" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr>
                <td valign="bottom">
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 1 && $t_strUserPermission == "HR Assistant" && $t_strAccessPermission == 6) 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCOMPENSATION">
                    <tr> 
                      <td><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION61','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION6" name="COMPENSATION61" width="104" height="29" border="0" id="COMPENSATION61"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr>
                <td valign="bottom">
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                  <table width="80%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCOMPENSATIONCASHIER">
                    <tr> 
                      <td><a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('NOTIFICATION1','','images/notificationover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/notification.jpg" alt="NOTIFICATION" name="NOTIFICATION1" width="96" height="29" border="0" id="NOTIFICATION1"></a></td>
                      <td><a href="Personal201default.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PROFILE1','','images/201over.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/201.jpg" alt="PROFILE" name="PROFILE1" width="67" height="29" border="0" id="PROFILE1"></a></td>
                      <td><a href="Searchattendance.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('ATTENDANCE1','','images/attendanceover.jpg',1)"><img src="images/attendance.jpg" alt="ATTENDANCE" name="ATTENDANCE1" width="88" height="29" border="0" id="ATTENDANCE1"></a></td>
                      <td><a href="Report.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS1','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS" name="REPORTS1" width="60" height="29" border="0" id="REPORTS1"></a></td>
                      <td><a href="Holiday.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()"  onMouseOver="MM_swapImage('LIBRARIES1','','images/librariesover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/libraries.jpg" alt="LIBRARIES" name="LIBRARIES1" width="67" height="29" border="0" id="LIBRARIES1"></a></td>
                      <td><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()"  onMouseOver="MM_swapImage('COMPENSATION1','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION" name="COMPENSATION1" width="104" height="29" border="0" id="COMPENSATION1"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $arrEmpPersonal['firstname']  . "  " . $arrEmpPersonal['middlename'] . "  ". $arrEmpPersonal['surname']; ?></strong>. 
              You are currently working at the HR Module.</div></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="338" colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="16%" height="338"><table width="150" height="338" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td height="338" valign="top"><table width="100%" height="347" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="347" valign="top"> <table width="90%" height="338" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="113" valign="baseline"><form name="form1" method="post" action="<? $PHP_SELF; ?>">
                                      <input name="txtSearch" type="text" id="txtSearch" size="15" maxlength="30" value="<? echo $txtSearch;?>">
                                      <a href="Personnelinfo.php" onMouseOut="statusBar()" onFocus="statusBar()" onMouseOver="statusBar(); return true;" onClick="statusBar();"> 
                                      <input type="image" src="images/go.jpg" alt="Go" name="Go" width="19" height="17" border="0" align="absmiddle">
                                      </a> <br>
                                      <?
									  if($optField == "empNmbr" || $optField == "")
									  {
									  	echo "<input name='optField' type='radio' value='empNmbr' checked>";
									  }
									  else
									  {
									  	echo "<input name='optField' type='radio' value='empNmbr'>";
									  }
									  ?>
                                      Employee Number<br>
                                      <?
									  if($optField == "empName")
									  {
									  	echo "<input name='optField' type='radio' value='empName' checked>";
									  }
									  else
									  {
									  	echo "<input name='optField' type='radio' value='empName'>";
									  }
									  ?>
                                      Employee Name<br>
                                      Month 
                                      <select name="cboMonth" disabled size="1">
                                        <?
										$objCompute->comboMonth($cboMonth);
										?>
                                      </select>
                                      <br>
                                      Year&nbsp;&nbsp; 
                                      <select name="cboYear" disabled size="1">
                                        <?
										$objCompute->comboYear($cboYear);										
										?>
                                      </select>
                                      <br>
                                    </form></td>
                                </tr>
                                <tr> 
                                  <td height="222" valign="top"><table width="108" height="129" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td height="20"><a href="Personnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()"  onMouseOver="MM_swapImage('Image26','','images/personnel2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/personnel1.jpg" alt="Personnel Profile" name="Image26" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Employeeincome.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Income','','images/income2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/income.jpg" alt="Income" name="Income" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Employeedeductions.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('deductionsummary','','images/deductionsummary2.jpg',1)"><img src="images/deductionsummary.jpg" alt="deductionsummary" name="deductionsummary" width="108" height="29" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Loans.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Premiums_loans','','images/premiums_loans2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/premiums_loans.jpg" alt="Premiums Loans" name="Premiums_loans" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="Remittances.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Remittances','','images/remittances2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/remittances.jpg" alt="Remittances" name="Remittances" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
                              </td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="84%" valign="top"><table width="99%" height="339" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="337"><!-- InstanceBeginEditable name="BODY" --> 
                      <table width="99%" border="0" cellspacing="0" cellpadding="0"><form action="<?php $PHP_SELF; ?>" method="post" name="myRemit">
                          <tr> 
                            <td height="25" colspan="2"><p class="header">REMITTANCES</p></td>
                          </tr>
                          <tr> 
                            <td colspan="2"><table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" class="border">
                                <tr> 
                                  <td width="480" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                      <tr> 
                                        <td width="168" class="paragraph">Employee 
                                          Number : </td>
                                        <td width="310"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
                                          <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                          <input name="optField2" type="hidden" id="optField" value="<? echo $optField; ?>">
                                          <input name="t_strEmpNumber2" type="hidden" id="t_strEmpNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                          <input name="p" type="hidden" id="p" value="<? echo $p; ?>">
                                          </strong></td>
                                      </tr>
                                      <tr> 
                                        <td class="paragraph">Employee Name : 
                                        </td>
                                        <td><strong>&nbsp;<? echo $arrEmpPersonal['surname']  . ", " . $arrEmpPersonal['firstname'] . "  ". $arrEmpPersonal['middlename']; ?></strong></td>
                                      </tr>
                                      <tr> 
                                        <td class="paragraph">Division : </td>
                                        <td><strong>&nbsp;<? echo $arrEmpPersonal['divisionCode']; ?></strong></td>
                                      </tr>
                                    </table></td>
                                  <td width="72" bgcolor="#99CCFF"> <img src="Getdata.php?t_strEmpNumber=<? echo $arrEmpPersonal["empNumber"]; ?>"  width="70" height="70"></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td height="13" colspan="2"><span class="header">Employee 
                              share</span></td>
                          </tr>
                          <tr> 
                            <td height="13" colspan="2">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td colspan="2"><table width="84%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="17%" class="paragraph">Deduction:</td>
                                  <td width="10%"> <select name="deductionCode" size="1" class="tbtext" >
                                      <?
$objCompute->comboDeductCode($deductionCode);
?>
                                    </select> </td>
                                  <td width="25%" class="paragraph">Start Year:</td>
                                  <td width="10%"> <select name="sdeductYear" >
                                      <?
										$objCompute->comboYear($cboYear);										
										?>
                                    </select> </td>
                                  <td width="25%" class="paragraph">End Year</td>
                                  <td width="13%" class="paragraph"><div align="left"> 
                                      <select name="deductYear" >
                                        <?
										$objCompute->comboYear($cboYear);										
										?>
                                      </select>
                                      <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>">
                                    </div>
                                    <div align="left"> </div></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td colspan="2"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="12%">&nbsp;</td>
                                  <td width="20%">&nbsp;</td>
                                  <td width="22%">&nbsp;</td>
                                  <td width="25%">&nbsp;</td>
                                  <td width="21%">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td height="23" colspan="5"><div align="center"> 
                                        <input name="Submit" type="submit" id="Submit2" value="Search" onClick="go()">
                                    </div></td>
                                </tr>
                                <tr> 
                                  <td colspan="5">&nbsp; </td>
                                </tr>
                                <tr> 
                                  <td height="18" colspan="5"> 
                                    <?
								  $objCompute->addRemit($arrEmpPersonal["empNumber"], $deductionCode, $remitMonth, $remitYear, $remitAmount, $orNo, $orDate,$Submit, $sdeductYear, $deductYear, $deductMonth);
							
								  ?>
                                  </td>
                                </tr>
                              </table></td>
							  
							  <tr> 
                              <td height="13" colspan="2"><span class="header">EmployeR 
                                share</span></td>
                          </tr>
                          <tr> 
                            <td height="13" colspan="2">&nbsp;</td>
                          </tr>
                          <tr> 
                            <td colspan="2"><table width="84%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="17%" class="paragraph">Deduction:</td>
                                  <td width="10%"> <select name="contributeCode" size="1" class="tbtext" >
                                      <?
$objCompute->comboContributeCode($contributeCode);
?>
                                    </select> </td>
                                  <td width="25%" class="paragraph">Start Year:</td>
                                  <td width="10%"> <select name="sdeductYear1" >
                                      <?
										$objCompute->comboYear($cboYear);										
										?>
                                    </select> </td>
                                  <td width="25%" class="paragraph">End Year</td>
                                  <td width="13%" class="paragraph"><div align="left"> 
                                      <select name="deductYear1" >
                                        <?
										$objCompute->comboYear($cboYear);										
										?>
                                      </select>
                                      <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>">
                                    </div>
                                    <div align="left"> </div></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td colspan="2"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="12%">&nbsp;</td>
                                  <td width="20%">&nbsp;</td>
                                  <td width="22%">&nbsp;</td>
                                  <td width="25%">&nbsp;</td>
                                  <td width="21%">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td height="23" colspan="5"><div align="center"> 
                                        <input name="Submit1" type="submit" id="Submit1" value="Search" onClick="go()">
                                    </div></td>
                                </tr>
                                <tr> 
                                  <td colspan="5">&nbsp; </td>
                                </tr>
                                <tr> 
                                    <td height="18" colspan="5"> 
                                      <?
								  $objCompute->searchContribute($arrEmpPersonal["empNumber"], $contributeCode, $remitMonth, $remitYear, $remitAmount, $orNo, $orDate,$Submit1, $sdeductYear1, $deductYear1, $deductMonth);
							
								  ?>
                                    </td>
                                </tr>
                              </table></td> 
                          <tr> 
                            <td width="97%" height="13"> </td></form>
                        </table>
                        <p align="right"> 
                          <? $objCompute->output();?>
                        </p>
                        <!-- InstanceEndEditable --></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="12" colspan="2"><table width="100%" height="12" border="0" cellpadding="0" cellspacing="0" bgcolor="#002E7F" id="OUTERTBL4">
              <tr> 
                <td height="12"><div align="center"> 
                    <p class="login"><font color="#FFFFFF">Copyright &copy; 2003 
                      Department of Science and Technology</font></p>
                  </div></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
