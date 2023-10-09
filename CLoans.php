<?
session_start();
include("../hrmis/class/Security.php");
require("../hrmis/class/Deduction.php");
$objCompute = new Deduction;
$objCompute->setvar(array('strEmpNmbr'=>$strEmpNmbr, 'txtSearch'=>$txtSearch, 'optField'=>$optField, 'cboMonth'=>$cboMonth, 'cboYear'=>$cboYear)); //for maintain state
$arrEmpPersonal = $objCompute->checkGetEmpNmbr("Cashier", $txtSearch, $optField, $cboMonth, $cboYear, 1, $p);
?>
<script language="JavaScript" type="text/JavaScript">

var dtCh= "-";
var minYear=1900;
var maxYear=2100;

function isInteger(s){
	var i;
    for (i = 0; i < s.length; i++){   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag){
	var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++){   
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function daysInFebruary (year){
	// February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
}
function DaysArray(n) {
	for (var i = 1; i <= n; i++) {
		this[i] = 31
		if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
		if (i==2) {this[i] = 29}
   } 
   return this
}

function isDate(dtStr){
	var daysInMonth = DaysArray(12)
	var pos1=dtStr.indexOf(dtCh)
	var pos2=dtStr.indexOf(dtCh,pos1+1)
	var strYear=dtStr.substring(0,pos1)
	var strMonth=dtStr.substring(pos1+1,pos2)
	var strDay=dtStr.substring(pos2+1)
	//var strDay=dtStr.substring(0,pos1)
	//var strMonth=dtStr.substring(pos1+1,pos2)
	//var strYear=dtStr.substring(pos2+1)
	strYr=strYear
	if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
	if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
	for (var i = 1; i <= 3; i++) {
		if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
	}
	month=parseInt(strMonth)
	day=parseInt(strDay)
	year=parseInt(strYr)
	if (pos1==-1 || pos2==-1){
		alert("The date format should be : yyyy-mm-dd")
		return false
	}
	if (strMonth.length<1 || month<1 || month>12){
		alert("Please enter a valid month")
		return false
	}
	if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
		alert("Please enter a valid day")
		return false
	}
	if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
		alert("Please enter a valid 4 digit year between "+minYear+" and "+maxYear)
		return false
	}
	if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
		alert("Please enter a valid date")
		return false
	}
return true
}

function checkForm() {
 if (document.myDeduct.amortization.value == "")
 {
 	alert('Please input value for monthly amortization');
	return false
 }
 
 if (document.myDeduct.amortization.value <= "0")
 {
 	alert('The value for monthly amortization should be greater than 0');
	return false
 }
 
  if (document.myDeduct.amountGranted.value == "")
 {
 	alert('Please input value for amount granted');
	return false
 }
 
 if (document.myDeduct.amountGranted.value <= "0" )
 {
 	alert('The value for amount granted should be greater than 0');
	return false
 }
 
  if (document.myDeduct.amountGranted.value < document.myDeduct.amortization.value)
 {
 	alert('The value for amount granted should be greater than amortization');
	return false
 }
 
 if (isDate(document.myDeduct.voucherDate.value)==false)
 {
		document.myDeduct.voucherDate.focus()
		return false
 }
	
 if (isDate(document.myDeduct.dateGranted.value)==false)
 {
		document.myDeduct.dateGranted.focus()
		return false
 }
	
 if (isDate(document.myDeduct.actualStartDate.value)==false)
 {
		document.myDeduct.actualStartDate.focus()
		return false
 }
	
 if (isDate(document.myDeduct.actualEndDate.value)==false)
 {
		document.myDeduct.actualEndDate.focus()
		return false
 }
    return true
 
}
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
                            <td height="25" class="header"><p>PREMIUMS/LOANS</p></td>
                          </tr>
                          <tr> 
                            <td><table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" class="border">
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
                                            <input name="strEmpNmbr" type="hidden" value="<? echo $strEmpNmbr; ?>">
                                            </strong></td>
                                        </tr>
                                        <tr> 
                                          <td class="paragraph">Employee Name 
                                            : </td>
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
						  <form action="<?php $PHP_SELF; ?>" method="get" name="myDeduct" onSubmit="return checkForm()">
                          <tr> 
                            <td height="13"><hr></td>
                          </tr>
						   <?
								if($Submit2 == "Delete")
								{
								?>
                            <tr> 
                              
                            <td colspan="3" class="titlebar">Are you sure you 
                              want to delete this deduction??? 
                              <input name="deductionCode" type="hidden" id="deductionCode1" value="<? echo"$deductionCode"; ?>">
                              <input name="empNumber" type="hidden" id="empNumber" value="<? echo"$empNumber"; ?>">
                                <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>">
                                <strong> 
                                <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                <input name="p" type="hidden" id="p" value="<? echo $p; ?>">
                                <input name="optField" type="hidden" id="optField" value="<? echo $optField; ?>">
                                </strong> </td>
                            </tr>
                            <tr> 
                              <td colspan="3"><div align="center"> 
                                  <input type="submit" name="Submit2" value="OK">
                                  <input type="submit" name="Submit2" value="Cancel">
                                </div></td>
                            </tr>
						  <? } else  {
 								?>
                          <tr> 
                            <td height="80"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td width="24%" height="23" class="paragraph">Code : </td>
                                  <td width="29%"> <select name="deductionCode" size="1" class="tbtext">
<?
$objCompute->comboDeductCode($deductionCode);
?>
                                    </select>
									<input type="hidden" name="empNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>"> </td>
                                  <td width="20%" class="paragraph">Amount Granted 
                                    :</td>
                                  <td width="27%"><input type="text" name="amountGranted"></td>
                                </tr>
                                <tr> 
                                    <td class="paragraph"> Monthly Amortization 
                                      : </td>
                                  <td> <input type="text" name="amortization"> </td>
                                  <td class="paragraph">Date Granted : </td>
                                  <td><input type="text" name="dateGranted"></td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">Voucher Number : </td>
                                  <td> <input type="text" name="voucherNmbr"> </td>
                                  <td class="paragraph">Start Date : </td>
                                  <td><input type="text" name="actualStartDate"></td>
                                </tr>
                                <tr> 
                                  <td class="paragraph">Voucher Date : </td>
                                  <td> <input type="text" name="voucherDate"></td>
                                  <td class="paragraph">End Date : </td>
                                  <td><input type="text" name="actualEndDate">
                                      <input name="strEmpNmbr" type="hidden" id="strEmpNmbr" value="<? echo $strEmpNmbr; ?>">
                                      <strong> 
                                      <input type="hidden" name="empNumber" value="<? echo $arrEmpPersonal["empNumber"]; ?>">
                                      <input name="p" type="hidden" id="p" value="<? echo $p; ?>">
                                      <input name="txtSearch" type="hidden" id="txtSearch" value="<? echo $txtSearch; ?>">
                                      <input name="optField" type="hidden" id="optField" value="<? echo $optField; ?>">
                                      </strong> </td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr> 
                            <td>&nbsp;</td>
                          </tr>
                          <tr> 
                            <td height="25"><div align="center"> 
                                  <input name="Submit2" type="submit" id="Submit2" value="ADD">
                                  <input type="reset" name="Reset" value="Clear">
                              </div></td>
                         </tr>  <? } ?> </form>
                        </table>
						<table width="99%" height="36" border="0" cellpadding="0" cellspacing="0" bgcolor="#C1E2FF" id="BODY" dwcopytype="CopyTableCell">
                          <tr> 
                            <td width="80%" height="16" class="header"><p>&nbsp;</p></td>
                            <td width="6%" class="header">&nbsp;</td>
                            <td class="header">
                             
                            </td>
                          </tr>
                          <tr> 
                            <td height="18" colspan="3" valign="top"> <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr> 
                                  <td height="18"> 
                                    <?
								  $objCompute->addDeduction($strEmpNmbr, $empNumber, $deductionCode, $voucherNmbr, $voucherDate, $amountGranted, $dateGranted, $amortization, $actualStartDate, $actualEndDate, $Submit2, $p, $txtSearch, $optField);
								  //$objCompute->sumLoan($strEmpNmbr, $arrEmpPersonal["empNumber"], $p);
								  
								  $objCompute->viewDeduction($strEmpNmbr, $arrEmpPersonal["empNumber"], $p, $txtSearch, $optField);
								  ?>
                                  </td>
                                </tr>
                              </table>
                              <div align="center"></div>
                              <div align="center"></div>
                              <div align="center"></div></td>
                          </tr>
                        </table><br>
                        <div align="right"> <? $objCompute->output();?></div>
						<br>
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
