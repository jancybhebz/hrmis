<?
session_start();
include("../hrmis/class/Security.php");

require("../hrmis/class/Compute.php");
$objCompute = new Compute;
$objCompute->setvar(array('strEmpNmbr'=>$strEmpNmbr, 'txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear)); //for maintain state
$arrEmpPersonal = $objCompute->checkGetEmpNmbr("Cashier", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p, $strLetter);
$info = $objCompute->viewInfo($arrEmpPersonal['empNumber']);
$taxCode = $info['taxStatCode'];
$dependents = $info['dependents'];
$objCompute->computeTotalDeduction($deductionTotal, $taxCode, $dependents);
$monthNow = date ("m", mktime(0,0,0,date("m") ,date("d") ,date("Y")));
$objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"lifeRetshare",$taxCode,$dependents,$info['lifeRetSwitch'], $cboMonth, $info['healthProvider']);
$objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"pagIbigshare",$taxCode,$dependents,$info['pagibigSwitch'], $cboMonth, $info['healthProvider']);
//$objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"itw",$taxCode,$dependents,"Y", $cboMonth, $info['healthProvider']);
?>
<script>
<!--
function MM_click()
{
//PAGIBIG
if ( window.document.myDeduct.chkDeduct1.checked == true ) {
	var Epagibig  = "<? echo $objCompute->computeDeduction($info['actualSalary'],"pagIbig",$taxCode,$dependents, $chkDeduct1) ?>";
	var Apagibig  = "<? echo $objCompute->computeDeduction($info['actualSalary'],"pagIbigshare",$taxCode,$dependents,$chkDeduct1) ?>";
	myDeduct.strDeduct3.value = Epagibig;
	myDeduct.strDeduct6.value = Apagibig; }
else {
   myDeduct.strDeduct3.value = 0;
   myDeduct.strDeduct6.value = 0; }

//PHILHEALTH  
if ( window.document.myDeduct.chkDeduct2.checked == true ) {
	var Ephilhealth  = "<? echo $objCompute->computeDeduction($info['actualSalary'],"philHealth",$taxCode,$dependents, $chkDeduct1) ?>";
	var Aphilhealth  = "<? echo $objCompute->computeDeduction($info['actualSalary'],"philHealth",$taxCode,$dependents,$chkDeduct1) ?>";
	myDeduct.strDeduct4.value = Ephilhealth;
	myDeduct.strDeduct7.value = Aphilhealth; }
else {
   myDeduct.strDeduct4.value = 0;
   myDeduct.strDeduct7.value = 0; }
   
//LIFERET  
if ( window.document.myDeduct.chkDeduct4.checked == true ) {
	var Eliferet  = "<? echo $objCompute->computeDeduction($info['actualSalary'],"lifeRet",$taxCode,$dependents, $chkDeduct1) ?>";
	var Aliferet  = "<? echo $objCompute->computeDeduction($info['actualSalary'],"lifeRetshare",$taxCode,$dependents,$chkDeduct1) ?>";
	myDeduct.strDeduct2.value = Eliferet;
	myDeduct.strDeduct5.value = Aliferet; }
else {
   myDeduct.strDeduct2.value = 0;
   myDeduct.strDeduct5.value = 0; }
   
//ITW
if ( window.document.myDeduct.chkDeduct3.checked == true ) {
	var tax  = "<? echo $objCompute->computeDeduction($info['actualSalary'],"itw",$taxCode,$dependents,$chkDeduct1 ) ?>";
	myDeduct.strDeduct1.value = tax; }
else {
  myDeduct.strDeduct1.value = 0;
}

}

function MM_clickbtn()
{

if ( window.document.myDeduct.Submit.value == 'Set' ) {
	var setbtn  = "Submit";
	window.document.myDeduct.Submit.value = setbtn; }
}

//-->
</script>
<html><!-- InstanceBegin template="/Templates/Cashier.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Human Resource Management Information System - HR Section</title>
<?
include("../hrmis/class/JSgeneral.php");
?>
<!-- InstanceEndEditable --> 
<!-- Design/Images Made By : Angelo Campos Evangelista  -->
<!-- Template Made By : Pearliezl Samoy Dy Tioco  -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/JavaScript">
<!-- onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"
 
function openPrint() {

	var strEmpNmbr = "<? echo $strEmpNmbr; ?>";
	var t_strUserLevel = "<? echo $t_strUserLevel; ?>";
	var t_strUserPermission = "<? echo $t_strUserPermission; ?>";
	var t_strAccessPermission = "<? echo $t_strAccessPermission; ?>";
	strPage = "Cashierindex.php?strEmpNmbr="+strEmpNmbr+"&t_strUserLevel="+t_strUserLevel+"&t_strUserPermission="+t_strUserPermission+"&t_strAccessPermission="+t_strAccessPermission;
	window.open(strPage, '_blank','toolbar=no,location=no,directories=no,status=0,menubar=0,scrollbars=1,resizable=0,width=960,height=625');

}

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

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/remittances2.jpg','images/personnel2.jpg','images/income2.jpg','images/logout2.jpg','images/otherbenefits2.jpg','images/premiums_loans2.jpg','images/compensationclick.jpg','images/updateover.jpg','images/reportsover.jpg','images/deductionsummary2.jpg','images/notificationover.jpg','images/taxdetails2.jpg'); history.forward()" onContextMenu="return false"><div align="center"> 
<table width="778" border="0" cellpadding="0" cellspacing="0" id="OUTERTBL">
  <tr> 
    <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" id="INNERTBL">
        <tr> 
          <td width="41%" valign="bottom"><table width="90%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/compensmodule.jpg" width="211" height="23"></td>
              </tr>
            </table></td>
          <td valign="bottom"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td valign="bottom"><table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Officer" && $t_strAccessPermission == "0123") 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCASHIER">
                    <tr> 
                      <td height="29"><a href="CNotification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('notification','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="notification" name="notification" width="96" height="29" border="0"></a><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION" name="COMPENSATION" width="104" height="29" border="0"></a></td>
                      <td><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE1','','images/updateover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/update.jpg" alt="UPDATE1" name="UPDATE1" width="60" height="28" border="0"></a></td>
                      <td><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS1','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS1" width="60" height="29" border="0"></a></td>
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
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Assistant" && $t_strAccessPermission == "01") 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCASHIER">
                    <tr> 
                      <td height="29"><a href="CNotification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('notification23','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="notification2" name="notification23" width="96" height="29" border="0"></a><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION4','','images/compensationclick.jpg',1); statusBar(); return true" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION" name="COMPENSATION4" width="104" height="29" border="0" id="COMPENSATION4"></a></td>
                      <td>&nbsp;</td>
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
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Assistant" && $t_strAccessPermission == "12") 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCOMPENSATIONUPDATE">
                    <tr> 
                      <td><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION2','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION2" name="COMPENSATION2" width="104" height="29" border="0"></a></td>
                      <td><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE','','images/updateover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/update.jpg" alt="UPDATE" name="UPDATE" width="60" height="28" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 2 && $t_strUserPermission == "Cashier Assistant" && $t_strAccessPermission == "13") 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblCOMPENSATIONREPORTS">
                    <tr> 
                      <td><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION3','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION3" name="COMPENSATION3" width="104" height="29" border="0"></a></td>
                      <td><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS3','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS3" name="REPORTS3" width="60" height="29" border="0"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
              <tr> 
                <td> 
                  <?   //  HR module for notification templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == "1234567") 
{
?>
                  <table width="20%" border="0" align="right" cellpadding="0" cellspacing="0" id="tblHRCASHIERMODULE">
                    <tr> 
                      <td height="29"><a href="CNotification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('notification3','','images/notificationover.jpg',1)"><img src="images/notification.jpg" alt="notification3" name="notification3" width="96" height="29" border="0"></a><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('COMPENSATION1','','images/compensationclick.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/compensationclick.jpg" alt="COMPENSATION" name="COMPENSATION1" width="104" height="29" border="0" id="COMPENSATION1"></a></td>
                      <td><a href="CDeductionupdate.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('UPDATE11','','images/updateover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/update.jpg" alt="UPDATE1" name="UPDATE11" width="60" height="28" border="0" id="UPDATE11"></a></td>
                      <td><a href="CMonthlyreport.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('REPORTS11','','images/reportsover.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/reports.jpg" alt="REPORTS1" name="REPORTS11" width="60" height="29" border="0" id="REPORTS11"></a></td>
                    </tr>
                  </table>
                  <? } ?>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr bgcolor="#E9F3FE"> 
          <td height="8" colspan="2"><div align="center">Welcome <strong><? echo $_SESSION['strLoginName']; ?></strong>. 
              You are currently working at the Cashier Module.</div></td>
        </tr>
        <tr valign="top" bgcolor="#E9F3FE"> 
          <td height="350" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="16%" height="411"><table width="150" height="406" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9F3FE">
                    <tr> 
                      <td height="406" valign="top"><table width="100%" height="403" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="403" valign="top"> <table width="90%" height="403" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="NAVTBL">
                                <tr> 
                                  <td height="113" valign="baseline"><form name="form1" method="post">
                                      <input name="txtSearch" type="text" size="15" maxlength="30" value="<? echo $txtSearch;?>">
                                      <a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>" onMouseOut="statusBar()" onFocus="statusBar()" onMouseOver="statusBar(); return true;" onClick="statusBar();">
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
                                      <select name="cboMonth" size="1">
                                        <?
										$objCompute->comboMonth($cboMonth);
										?>
                                      </select>
                                      <br>
                                      Year&nbsp;&nbsp; 
                                      <select name="cboYear" size="1">
                                        <?
										$objCompute->comboYear($cboYear);										
										?>
                                      </select>
                                      <br>
                                    </form></td>
                                </tr>
                                <tr> 
                                  <td height="290" valign="top"><table width="108" height="150" border="0" align="center" cellpadding="0" cellspacing="0" id="NAVTBL">
                                      <tr> 
                                        <td height="20"><a href="CPersonnelinfo.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch; ?>&optField=<? echo $optField; ?>&cboMonth=<? echo $cboMonth; ?>&cboYear=<? echo $cboYear; ?>&p=<? echo $p; ?>&strLetter=<? echo $strLetter; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('PersonnelProfile','','images/personnel2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/personnel1.jpg" alt="Personnel Profile" name="PersonnelProfile" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="CEmployeeincome.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Income','','images/income2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/income.jpg" alt="Income" name="Income" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="CEmployeebenefits.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch; ?>&optField=<? echo $optField; ?>&cboMonth=<? echo $cboMonth; ?>&cboYear=<? echo $cboYear; ?>&p=<? echo $p; ?>&strLetter=<? echo $strLetter; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('otherbenefits','','images/otherbenefits2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/otherbenefits.jpg" alt="otherbenefits" name="otherbenefits" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="CEmployeedeductions.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch; ?>&optField=<? echo $optField; ?>&cboMonth=<? echo $cboMonth; ?>&cboYear=<? echo $cboYear; ?>&p=<? echo $p; ?>&strLetter=<? echo $strLetter; ?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('deductionsummary','','images/deductionsummary2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/deductionsummary.jpg" alt="deductionsummary" name="deductionsummary" width="108" height="29" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="CLoans.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Premiums/Loans','','images/premiums_loans2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/premiums_loans.jpg" alt="Premiums/Loans" name="Premiums/Loans" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="10"><a href="CRemittances.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('Remittances','','images/remittances2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/remittances.jpg" alt="Remittances" name="Remittances" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td height="10"><a href="CTaxdetails.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&txtSearch=<? echo $txtSearch?>&optField=<? echo $optField?>&cboMonth=<? echo $cboMonth?>&cboYear=<? echo $cboYear?>&p=<? echo $p?>&strLetter=<? echo $strLetter?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('TaxDetails','','images/taxdetails2.jpg',1)"><img src="images/taxdetails.jpg" alt="TaxDetails" name="TaxDetails" width="108" height="20" border="0"></a></td>
                                      </tr>
                                      <tr> 
                                        <td height="20"><a href="index.php" onMouseOut="MM_swapImgRestore(); statusBar()" onFocus="statusBar()" onMouseOver="MM_swapImage('logout','','images/logout2.jpg',1); statusBar(); return true;" onClick="statusBar();"><img src="images/logout.jpg" alt="logout" name="logout" width="108" height="20" border="0"></a></td>
                                      </tr>
                                    </table>
                                    <table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr> 
                                        <td> 
                                          <?   //  Cashier module for update templates 
$objHRResult = mysql_query("SELECT * FROM tblEmpAccount	WHERE empNumber = '$strEmpNmbr' ");
$arrHRResult = mysql_fetch_array($objHRResult); 
$t_strUserLevel=$arrHRResult['userLevel'];
$t_strUserPermission=$arrHRResult['userPermission'];
$t_strAccessPermission=$arrHRResult['accessPermission'];
if ($t_strUserLevel == 12 && $t_strUserPermission == "HR&Cashier Officer" && $t_strAccessPermission == 1234567) 
{
?>
                                          <a href="Notification.php?strEmpNmbr=<? echo $strEmpNmbr; ?>&t_strUserLevel=<? echo $t_strUserLevel; ?>&t_strUserPermission=<? echo $t_strUserPermission; ?>&t_strAccessPermission=<? echo $t_strAccessPermission; ?>" onMouseOver="statusBar(); return true;" onClick="statusBar();" onMouseUp="statusBar()" onFocus="statusBar()"><img src="images/gotohr.jpg" alt="Back to HR Module" width="93" height="28" border="0"></a> 
                                          <? } ?>
                                        </td>
                                      </tr>
                                    </table> 
                                    <table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr> 
                                        <td><a href="javascript:openPrint()"><img src="images/howto.jpg" width="78" height="21" border="0"></a></td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                              </table>
                              
                            </td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
                <td width="84%" valign="top"><table width="99%" height="406" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODYTBL">
                    <tr> 
                      <td height="406"><!-- InstanceBeginEditable name="BODY" --> 
                        <table width="99%" border="0" cellspacing="0" cellpadding="0">
                         
                          <tr>
                            <td height="286"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td height="25" colspan="3" class="header"><p>DEDUCTIONS</p></td>
                                </tr>
                                <tr> 
                                  <td colspan="3"><table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" class="border">
                                      <tr> 
                                        <td width="480" height="73"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#99CCFF">
                                            <tr> 
                                              <td width="168" class="paragraph">Employee 
                                                Number : </td>
                                              <td width="310"><strong>&nbsp;<? echo $arrEmpPersonal['empNumber']; ?> 
                                                <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                                <input name="optField" type="hidden" id="optField" value="<? echo $optField; ?>">
                                                <input name="t_strEmpNumber" type="hidden" id="t_strEmpNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                                <input name="p" type="hidden" id="p" value="<? echo $p; ?>">
                                                </strong></td>
                                            </tr>
                                            <tr> 
                                              <td class="paragraph">Employee Name 
                                                : </td>
                                              <td><strong>&nbsp;<? echo $arrEmpPersonal['surname']  . ", " . $arrEmpPersonal['firstname'] . "  ". $arrEmpPersonal['middlename']; ?></strong></td>
                                            </tr>
                                            <tr> 
                                              <td class="paragraph">Division : 
                                              </td>
                                              <td><strong>&nbsp;<? echo $arrEmpPersonal['divisionCode']; ?></strong></td>
                                            </tr>
                                          </table></td>
                                        <td width="72" bgcolor="#99CCFF"> <img src="Getdata.php?t_strEmpNumber=<? echo $arrEmpPersonal["empNumber"]; ?>"  width="70" height="70"></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td height="92" colspan="3"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td height="93" ><table width="100%" height="83" border="0" cellpadding="0" cellspacing="0">
                                            <tr> 
                                              <td colspan="2" class="header">Employee 
                                                Share</td>
                                            </tr>
                                            <tr> 
                                              <td width="62%" class="paragraph">Life 
                                                Retirement</td>
                                              <td width="38%"><input name="strDeduct" type="text" class="tbtext" readonly value="<? echo $objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"lifeRet",$taxCode,$dependents, $info['lifeRetSwitch'], $cboMonth, $info['healthProvider']); ?>"></td>
                                            </tr>
                                            <tr> 
                                              <td height="19" class="paragraph">PAG-IBIG 
                                                Premium</td>
                                              <td><input name="strDeduct" type="text" class="tbtext" readonly value="<? echo $objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"pagIbig",$taxCode,$dependents, $info['pagibigSwitch'], $cboMonth, $info['healthProvider']); ?>"></td>
                                            </tr>
                                            <tr> 
                                              <td height="23" class="paragraph">PhilHealth 
                                                Premium</td>
                                              <td><input name="strDeduct" type="text" class="tbtext" readonly value="<? echo $objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"philHealth",$taxCode,$dependents, $info['philhealthSwitch'], $cboMonth, $info['healthProvider']); ?>"></td>
                                            </tr>
                                          </table></td>
                                        <td><table width="100%" height="98" border="0" cellpadding="0" cellspacing="0">
                                            <tr> 
                                              <td colspan="2" class="header">Government 
                                                Share</td>
                                            </tr>
                                            <tr> 
                                              <td width="46%" height="19" class="paragraph">Life 
                                                Retirement</td>
                                              <td width="54%"><input name="strDeduct" type="text" class="tbtext" readonly value="<? echo $objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"lifeRetshare",$taxCode,$dependents,$info['lifeRetSwitch'], $cboMonth, $info['healthProvider']); ?>"></td>
                                            </tr>
                                            <tr> 
                                              <td height="22" class="paragraph">PAG-IBIG</td>
                                              <td><input name="strDeduct" type="text" class="tbtext" readonly value="<? echo $objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"pagIbigshare",$taxCode,$dependents,$info['pagibigSwitch'], $cboMonth, $info['healthProvider']); ?>"></td>
                                            </tr>
                                            <tr> 
                                              <td height="21" class="paragraph"> 
                                                PhilHealth</td>
                                              <td><input name="strDeduct" type="text" class="tbtext" readonly value="<? echo $objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"philHealth",$taxCode,$dependents,$info['philhealthSwitch'], $cboMonth, $info['healthProvider']); ?>" > 
                                              </td>
                                            </tr>
                                            <tr> 
                                              <td height="16" colspan="2" class="paragraph"><div align="left"> 
                                                </div></td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <form action="<?php $PHP_SELF; ?>" method="get" name="myDeduct">
                                  <? if($Submit == "Set")
								{ ?>
                                  <tr> 
                                    <td width="30%" height="17" class="paragraph"> <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>"> 
                                      <input name="p" type="hidden" value="<? echo $p; ?>"> 
                                      <input name="t_strEmpNumber" type="hidden" value="<? echo $arrEmpPersonal["empNumber"]; ?>"> 
                                      <input name="optField" type="hidden" value="<? echo $optField; ?>"> 
                                      <input name="txtSearch" type="hidden" value="<? echo $txtSearch; ?>">
                                      ITW </td>
                                    <td width="20%"><div align="right"> 
                                        <input name="strDeduct2" type="text" class="tbtext" >
                                      </div></td>
                                    <td width="49%"><input type="submit" name="Submit" value="Submit"></td>
                                  </tr>
                                  <? } else  {
 								   ?>
                                  <tr>
                                    <td width="30%" class="paragraph"> <input name="strEmpNmbr" type="hidden" id="strEmpNmbr2" value="<? echo $strEmpNmbr; ?>"> 
                                      <input name="p" type="hidden" id="p" value="<? echo $p; ?>"> 
                                      <input name="t_strEmpNumber" type="hidden" id="t_strEmpNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>"> 
                                      <input name="optField" type="hidden" id="optField" value="<? echo $optField; ?>"> 
                                      <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                      ITW </td>
                                    <td width="20%"><div align="right"> 
                                        <input name="strDeduct1" type="text" class="tbtext" readonly value="<? echo $objCompute->viewITW($arrEmpPersonal["empNumber"], $strDeduct1) ?>">
                                      </div></td>
                                    <td width="49%"> 
                                      <input type="submit" name="Submit" value="Compute"> 
                                      <input type="submit" name="Submit" value="Set">
                                      <? $objCompute->computeDeduction($arrEmpPersonal["empNumber"], $info['actualSalary'],"itw",$taxCode,$dependents,"Y", $cboMonth, $info['healthProvider']);?>
                                      <? $objCompute->computeITW($strEmpNmbr, $arrEmpPersonal["empNumber"], $Submit, $strDeduct1, $p, $txtSearch, $strDeduct2, $t_strEmpNumber, $optField); ?>
                                    </td>
                                  </tr>
                                  <? } ?>
                                </form>
                                <tr> 
                                  <td height="58" colspan="3"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                      <tr> 
                                        <td width="53%" height="63"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr> 
                                              <td colspan="2" class="header">&nbsp;</td>
                                            </tr>
                                            <tr> 
                                              <td colspan="2" class="header"><div align="right"> 
                                                </div></td>
                                            </tr>
                                            <tr> 
                                              <td colspan="2" class="header">Contributions/LoANS</td>
                                            </tr>
                                            <? $objCompute->getDeduction($arrEmpPersonal["empNumber"]); ?>
                                          </table></td>
                                        <td width="47%"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="paragraph">
                                            <tr> 
                                              <td width="100%" class="checkbutton">&nbsp;</td>
                                            </tr>
                                          </table></td>
                                      </tr>
                                    </table></td>
                                </tr>
                                <tr> 
                                  <td colspan="3">&nbsp;</td>
                                </tr>
                                <tr> 
                                  <td colspan="3"><div align="right"> 
                                      <? $objCompute->output();?>
                                    </div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table>
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
