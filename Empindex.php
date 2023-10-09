<html>
<head>
<title>Human Resource Management System How-to</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<!------------------start content script------------------------>

<style type="text/css">

#divControl{ position:absolute; width:503; font-family:arial; left:10px; top:124px; font-size:10pt; visibility:hidden}

#divControl2{position:absolute; width:200; font-family:arial; left:868px; top:300px; font-size:10pt}
#divControl3{position:absolute; width:200; font-family:arial; left:50; top:150; font-size:10pt}
#divControl4{position:absolute; width:200; font-family:arial; left:100; top:50; font-size:10pt}
#divControl5{position:absolute; width:200; font-family:arial; left:50; top:300; font-size:10pt}

#divCont{position:absolute; top:126px; left:315px; clip:rect(0,550,1450,0); height:0; width:550}
.clScroll{position:absolute; top:0; font-size:10pt; left:0; font-family:arial; visibility:hidden}\
//all.clsMenuItemNS{font: bold x-small Verdana; color: white; text-decoration: none;}
//.clsMenuItemIE{text-decoration: none; font: bold xx-small Verdana; color: FFFFFF; cursor: hand;}


</style>

<script type="text/javascript" language="JavaScript">

function checkBrowser(){
	this.ver=navigator.appVersion
	this.dom=document.getElementById?1:0
	this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom)?1:0;
	this.ie4=(document.all && !this.dom)?1:0;
	this.ns5=(this.dom && parseInt(this.ver) >= 5) ?1:0;
	this.ns4=(document.layers && !this.dom)?1:0;
	this.bw=(this.ie5 || this.ie4 || this.ns4 || this.ns5)
	return this
}

bw=new checkBrowser()
timSpeed=75

contHeight=100

function makeScrollObj(obj,nest){
	nest=(!nest) ? '':'document.'+nest+'.'										
	this.el=bw.dom?document.getElementById(obj):bw.ie4?document.all[obj]:bw.ns4?eval(nest+'document.'+obj):0;
  	this.css=bw.dom?document.getElementById(obj).style:bw.ie4?document.all[obj].style:bw.ns4?eval(nest+'document.'+obj):0;		
	this.height=bw.ns4?this.css.document.height:this.el.offsetHeight
	this.top=b_gettop										
	return this
}

function b_gettop(){
	var gleft=(bw.ns4 || bw.ns5) ? eval(this.css.top):eval(this.css.pixelTop);
	return gleft;
}

var scrollTim;
var active=0;

function scroll(speed){
	clearTimeout(scrollTim)
	way=speed>0?1:0
	if((!way && oScroll[active].top()>-oScroll[active].height+contHeight) || (oScroll[active].top()<0 && way)){
		oScroll[active].css.top=oScroll[active].top()+speed
		scrollTim=setTimeout("scroll("+speed+")",timSpeed)
	}
}

function noScroll(){
	clearTimeout(scrollTim)
}

function changeActive(num){
	oScroll[active].css.visibility='hidden'
	active=num
	oScroll[active].css.top=0
	oScroll[active].css.visibility='visible'
}

function scrollInit(){
	oScroll=new Array()
	oScroll[0]=new	makeScrollObj('divScroll1','divCont')
	oScroll[1]=new	makeScrollObj('divScroll2','divCont')
	oScroll[2]=new	makeScrollObj('divScroll3','divCont')
	oScroll[3]=new	makeScrollObj('divScroll4','divCont')
	oScroll[4]=new	makeScrollObj('divScroll5','divCont')
 	oScroll[5]=new	makeScrollObj('divScroll6','divCont')
 	oScroll[6]=new	makeScrollObj('divScroll7','divCont')
 	oScroll[7]=new	makeScrollObj('divScroll8','divCont')
	oScroll[8]=new	makeScrollObj('divScroll9','divCont')
	oScroll[9]=new	makeScrollObj('divScroll10','divCont')
	oScroll[10]=new	makeScrollObj('divScroll11','divCont')
	oScroll[11]=new	makeScrollObj('divScroll12','divCont')
	oScroll[12]=new	makeScrollObj('divScroll13','divCont')
	oScroll[13]=new	makeScrollObj('divScroll14','divCont')
	oScroll[14]=new	makeScrollObj('divScroll15','divCont')
	oScroll[15]=new	makeScrollObj('divScroll16','divCont')
	oScroll[16]=new	makeScrollObj('divScroll17','divCont')
	oScroll[17]=new	makeScrollObj('divScroll18','divCont')
	oScroll[18]=new	makeScrollObj('divScroll19','divCont')
	oScroll[19]=new	makeScrollObj('divScroll20','divCont')
	oScroll[20]=new	makeScrollObj('divScroll21','divCont')
	oScroll[21]=new	makeScrollObj('divScroll22','divCont')
	oScroll[22]=new	makeScrollObj('divScroll23','divCont')
	oScroll[23]=new	makeScrollObj('divScroll24','divCont')
	oScroll[24]=new	makeScrollObj('divScroll25','divCont')
	oScroll[25]=new	makeScrollObj('divScroll26','divCont')
	oScroll[26]=new	makeScrollObj('divScroll27','divCont')
	oScroll[27]=new	makeScrollObj('divScroll28','divCont')
	oScroll[28]=new	makeScrollObj('divScroll29','divCont')
	oScroll[29]=new	makeScrollObj('divScroll30','divCont')


	oScroll[0].css.visibility='visible'
	oControl=new makeScrollObj('divControl')
	oControl.css.visibility='visible'
}

onload=scrollInit;

</script>

<!------------------end content script-------------------------->

</head>

<base target = "main">

<div id="divControl2" style="width: 30; height: 36">
<p align="center">
<a href="#" target="_self" onmouseover="scroll(5)" onmouseout="noScroll()">
    <img src="images/go_up.gif" border="0" width="18" height="22"></a>
    <a href="#" target="_self" onmouseover="scroll(-5)" onmouseout="noScroll()">
    <img src="images/go_down.gif" border="0" width="18" height="22"></a>&nbsp;
</div>


<div id="divControl4" style="width: 611; height: 74">
</div>

<style>

A:link {text-decoration:none; color:#FFCC00; }
A:visited {text-decoration:none; color:#CC3300; }
A:hover	{text-decoration:underline; color:#CC3300 }

</style>

<body bgcolor="#99CCFF" text="#FFFFFF" link="#444AFC" vlink="#444AFC" alink="#444AFC">

	<center>

    <table id="INNERTBL1" cellSpacing="0" cellPadding="0" width="779" border="0">
      <tr>
        <td width="780">
        <p align="center"><font color="#000099">
        <img src="images/index_01.jpg" width="43" height="13"><img src="images/index_02.jpg" width="72" height="13"><img src="images/index_03.jpg" width="106" height="13"><img src="images/index_04.jpg" width="135" height="13"><img src="images/index_05.jpg" width="127" height="13"><img src="images/index_06.jpg" width="83" height="13"><img src="images/index_07.jpg" width="71" height="13"><img src="images/index_08.jpg" width="141" height="13"></font></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td>
    <table id="INNERTBL2" cellSpacing="0" cellPadding="0" width="778" border="0">
      <tr>
        <td width="778"><font color="#000099">
        <img src="images/index_09.jpg" width="43" height="66"><img src="images/index_10.jpg" width="72" height="66"><img src="images/index_11.jpg" width="106" height="66"><img src="images/index_12.jpg" width="135" height="66"><img src="images/index_13.jpg" width="127" height="66"><img src="images/index_14.jpg" width="83" height="66"><img src="images/index_15.jpg" width="71" height="66"><img src="images/index_16.jpg" width="141" height="66"></font></td>
      </tr>
    </table>
	</center>
    




<!-------------freeze----------------------->

<script language="JavaScript1.2">

if (document.all)
document.body.style.cssText="background: url(back_aging.jpg) no-repeat fixed center center"

</script>

<!---------------end freeze------------------------------->



<!------------------------------------start calling content script--------------->

<div id="divControl" style="width: 305; height: 685">

	<p align="left" dir="ltr">&nbsp;
	<p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
    
      <b><font color="#CC3300" face="Trebuchet MS"><a href="#" target="_self" onclick="changeActive(0)">
      <font size="4" color="#CC3300">EMPLOYEE MODULE</font></a></font></b><font size="4" color="#CC3300">
      </font>
      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">&nbsp;<!--msimagelist--><table border="0" cellpadding="0" cellspacing="0" width="100%">
      <!--msimagelist--><tr>
        <!--msimagelist--><td valign="baseline" width="42">
        <img src="images/point.png" width="7" height="6" hspace="17" alt="bullet"></td>
        <td valign="top" width="100%"><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <b><font color="#FF6600" face="Trebuchet MS" size="2">201 Section</font></b><!--msimagelist--></td>
      </tr>
      <!--msimagelist--></table>
      
      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" size="2"> 
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(1)"><font color="#000099">- to view Personal Information</font></a></font><font color="#000099"></font>
      </font>
      
      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" face="Trebuchet MS" size="2"> <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(2)"><font color="#000099">- to view Family Background</font></a></font><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      
      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" face="Trebuchet MS" size="2"> <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(3)"><font color="#000099">- to view Educational Background</font></a></font><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">

      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" face="Trebuchet MS" size="2"> <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(4)"><font color="#000099">- to view Examinations</font></a></font><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">

      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" face="Trebuchet MS" size="2"> <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(5)"><font color="#000099">- to view Work Experience</font></a></font><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">

	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" face="Trebuchet MS" size="2"> <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(6)"><font color="#000099">- to view Voluntary Works</font></a></font><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">

		
      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" face="Trebuchet MS" size="2"> <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(7)"><font color="#000099">- to view Trainings</font></a></font><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">

      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" face="Trebuchet MS" size="2"> <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(8)"><font color="#000099">- to view Other Information</font></a></font><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">

	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" face="Trebuchet MS" size="2"> <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(9)"><font color="#000099">- to view Position Details</font></a><font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      
      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" face="Trebuchet MS" size="2"> <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(10)"><font color="#000099">- to exit system</font></a></font><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" face="Trebuchet MS" size="2"> <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 

      <!--msimagelist--><table border="0" cellpadding="0" cellspacing="0" width="100%">
      <!--msimagelist--><tr>
        <!--msimagelist--><td valign="baseline" width="42">
        <img src="images/point.png" width="7" height="6" hspace="17" alt="bullet"></td>
        <td valign="top" width="100%"><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <b><font color="#FF6600" face="Trebuchet MS" size="2">Attendance Section</font></b><!--msimagelist--></td>
      </tr>
      <!--msimagelist--></table>
      
      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" face="Trebuchet MS" size="2"> <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(11)"><font color="#000099">- to view Attendance Record</font></a></font><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font face="Trebuchet MS" color="#000099" size="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font>
    <!--msimagelist--><table border="0" cellpadding="0" cellspacing="0" width="100%">
      <!--msimagelist--><tr>
        <!--msimagelist--><td valign="baseline" width="42">
        <img src="images/point.png" width="7" height="6" hspace="17" alt="bullet"></td>
        <td valign="top" width="100%">
      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <b>
      <font color="#FF6600" face="Trebuchet MS" size="2">Request Section</font></b><!--msimagelist--></td>
      </tr>
      <!--msimagelist--></table>
      
	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(12)"><font color="#000099">- to submit Official Business Request</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      
	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(13)"><font color="#000099">- to submit Leave Request</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      
	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(14)"><font color="#000099">- to request Travel Order</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      
	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(15)"><font color="#000099">- to request which 201 Info to update</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      
 	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(16)"><font color="#000099">- to request to update Profile Info</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      
 	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(17)"><font color="#000099">- to request to update Educ. Attnmnt Info</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      
 	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(18)"><font color="#000099">- to request to update Trainings Info</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      
 	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(19)"><font color="#000099">- to request to update Examinations Info</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      
	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(20)"><font color="#000099">- to request to update Children Info</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      
	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(21)"><font color="#000099">- to request to update CTC Info</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      
 	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(22)"><font color="#000099">- to request to update References Info</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      
  	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(23)"><font color="#000099">- to submit requests for Reports</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
     
     <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(24)"><font color="#000099">- to request for DTR Reports</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
     
     <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(25)"><font color="#000099">- to request for Remittances Reports</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
     
     <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(26)"><font color="#000099">- to request for Payslip Reports</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
     
     <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(27)"><font color="#000099">- to request for CEC Reports</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
     
      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      <a href="#" target="_self" onclick="changeActive(28)"><font color="#000099">- to exit system</font></a><p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      &nbsp;<!--msimagelist--><table border="0" cellpadding="0" cellspacing="0" width="100%">
      <!--msimagelist--><tr>
        <!--msimagelist--><td valign="baseline" width="42">
        <img src="images/point.png" width="7" height="6" hspace="17" alt="bullet"></td>
        <td valign="top" width="100%">
      <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <b><font color="#FF6600" face="Trebuchet MS" size="2">Notification Section</font></b></li><!--msimagelist--></td>
      </tr>
      <!--msimagelist--></table>
      
	  <p align="left" dir="ltr" style="margin-top: 0; margin-bottom: 0">
      <font color="#000099" face="Trebuchet MS" size="2"> <font color="#000099">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </font> 
      </font> 
      <a href="#" target="_self" onclick="changeActive(29)"><font color="#000099">- to view request status </font></a>
    <font color="#000099"></font></font><p align="left" dir="ltr"><font color="#000099">
	<br><br>
	&nbsp;</font></div>    <div id="divCont"> 
      <div id="divScroll1" class="clScroll" style="width: 548; height: 350"> 
        <center>
          <b><font color="#000099" face="Trebuchet MS" size = "4"> Employee Module 
          </font></b>
        </center>
        <p align="center"> <img border="0" src="images/empimg1.jpg" width="548" height="350"> 
          <center>
            <b><font color="#000099" face="Trebuchet MS" size = "2">This is the 
            default interface of an employee module. This module is composed of 
            four(4) sections namely: 201, Attendance, Request and Notifications 
            Section</font></b>
          </center>
      </div>
      <div id="divScroll2" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Viewing Personal Information</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg2.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2"> Click the Personal Information button to view personal information of employees.</font></b></center>
	</div>

	<div id="divScroll3" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4"> Viewing Family Background Information</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg3.jpg" width="548" height="498">		
 	<center><b><font color="#000099" face="Trebuchet MS" size = "2"> Click the Family Background button to view family background of employees which consists of information about parents, spouse and children.</font></b></center>
	</div>

	<div id="divScroll4" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4"> Viewing Educational Background</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg4.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2"> Click the Education button to view educational attainment of employees.</font></b></center>
    </font>
	</div>

	<div id="divScroll5" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4"> Viewing Examinations Taken</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg5.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2"> Click the Examinations button to view examinations taken by the employee.</font></b></center>
    </font>
	</div>

	<div id="divScroll6" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Viewing Work Experience</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg6.jpg" width="548" height="350">	
	<center><b><font color="#000099" face="Trebuchet MS" size = "2"> Click the Work Experience button to view the work experiences of employees including the private agencies they have been engaged in.</font></b></center>
    </font>
	</div>

	<div id="divScroll7" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Viewing Voluntary Works</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg7.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2"> Click the Voluntary Works button to view involvement of employees in civic, non-government, people and voluntary organizations.</font></b></center>
    </font>
	</div>
	
	<div id="divScroll8" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Viewing Trainings</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg8.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2"> Click the Trainings button to view trainings attended by the employee.</font></b></center>
    </font>
	</div>

	<div id="divScroll9" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Viewing Other Information</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg9.jpg" width="548" height="626">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2"> Click the Other Information button to view information about skills, recognitions, membership in organizations, legal information, character reference and pledge details.</font></b></center>
    </font></div>

	<div id="divScroll10" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Viewing Position Details</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg10.jpg" width="548" height="500">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2"> Click the Position Details button to view position details and optional policy loans available for the employee.</font></b></center>
	
    <div id="divScroll11" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">To Exit System</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg19.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Click Logout button to exit system.</font></b></center>
		
	<div id="divScroll12" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Viewing Attendance Record</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg11.jpg" width="548" height="492">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">To view Daily Time Record, an employee shall choose the month and year of the attendance record he wants to view. After clicking the Submit button, the system will display his attendance record on the screen.</font></b></center>
	
	<div id="divScroll13" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Submitting Official Business Request</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg13.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Click Submit button after inputting the OB request details to submit request to the Division Chief.
	</font></b></center>
	
	<div id="divScroll14" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Submitting Leave Request</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg14.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2"> Click the Submit button after selecting a type of leave from the dropdown menu and inputting the details of the leave selected to submit request to the Division Chief.</font></b></center>
	
	<div id="divScroll15" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Submitting Travel Order Request</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg15.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Click the Submit button after inputting the travel order details to submit request to the Division Chief.</font></b></center>
	
	<div id="divScroll16" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">201 Update Request</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg16.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Select from the dropdown menu which personal data you want to be updated by the HR Officer. The type of profile that can be updated are the following: Profile, Educational Attainment, Trainings, Examinations, Children, Community Tax Certificate and References.</font></b></center>

	<div id="divScroll17" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Update Profile Info Request</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg23.jpg" width="548" height="521">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Selecting Profile from the dropdown menu directs user to a blank form where the user can input the updated data. Click Submit button to submit request to the HR Officer.</font></b></center>

	<div id="divScroll18" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Update Educational Attainment Info Request</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg24.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Selecting Educational Attainment from the dropdown menu directs user to a blank form where the user can input the updated data. Click Submit button to submit request to the HR Officer.</font></b></center>

	<div id="divScroll19" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Update Training Info Request</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg25.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Selecting Training from the dropdown menu directs user to a blank form where the user can input the updated data. Click Submit button to submit request to the HR Officer.</font></b></center>

	<div id="divScroll20" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Update Examinations Info Request</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg26.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Selecting Examinations from the dropdown menu directs user to a blank form where the user can input the updated data. Click Submit button to submit request to the HR Officer.</font></b></center>

	<div id="divScroll21" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Update Children Info Request</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg27.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Selecting Children from the dropdown menu directs user to a blank form where the user can input the updated data. Click Submit button to submit request to the HR Officer.</font></b></center>

	<div id="divScroll22" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Update CTC Info Request</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg28.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Selecting Community Tax Certificate from the dropdown menu directs user to a blank form where the user can input the updated data. Click Submit button to submit request to the HR Officer.</font></b></center>

	<div id="divScroll23" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Update References Info Request</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg29.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Selecting References from the dropdown menu directs user to a blank form where the user can input the updated data. Click Submit button to submit request to the HR Officer.</font></b></center>

	
	<div id="divScroll24" class="clScroll" style="width: 548; height: 350">
	<center><p><b><font color="#000099" face="Trebuchet MS" size = "4">Submitting Request for Report</font></b></p></center>
	<p align="center">
	<img border="0" src="images/empimg17.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Click Submit button after selecting a type of report from the dropdown menu and inputting the details of the report selected to submit report request to the HR Officer. The employee may select from the following type of reports namely: DTR, Payslips, Remittances and CEC.</font></b></center>
	
	
	<div id="divScroll25" class="clScroll" style="width: 548; height: 350">
	<center><p><b><font color="#000099" face="Trebuchet MS" size = "4">Submitting Request for DTR Report</font></b></p></center>
	<p align="center">
	<img border="0" src="images/empimg30.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Selecting Daily Time Record from the dropdown menu directs the user to a form where the user can imput the month and year of the report he wants to request.</font></b></center>
	
	<div id="divScroll26" class="clScroll" style="width: 548; height: 350">
	<center><p><b><font color="#000099" face="Trebuchet MS" size = "4">Submitting Request for Remittances Report</font></b></p></center>
	<p align="center">
	<img border="0" src="images/empimg31.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Selecting Remittances from the dropdown menu directs the user to a form where the user can imput the month and year of the report he wants to request.</font></b></center>
	
	<div id="divScroll27" class="clScroll" style="width: 548; height: 350">
	<center><p><b><font color="#000099" face="Trebuchet MS" size = "4">Submitting Request for Payslip Report</font></b></p></center>
	<p align="center">
	<img border="0" src="images/empimg32.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Selecting Payslip from the dropdown menu directs the user to a form where the user can imput the month and year of the report he wants to request.</font></b></center>
	
	<div id="divScroll28" class="clScroll" style="width: 548; height: 350">
	<center><p><b><font color="#000099" face="Trebuchet MS" size = "4">Submitting Request for CEC Report</font></b></p></center>
	<p align="center">
	<img border="0" src="images/empimg33.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Selecting Certificate of Compensation from the dropdown menu directs the user to a form where the user can imput the month and year of the report he wants to request.</font></b></center>
	
	
	<div id="divScroll29" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">To Exit System</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg21.jpg" width="548" height="350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Click Logout button to exit system.</font></b></center>

	<div id="divScroll30" class="clScroll" style="width: 548; height: 350">
	<center><b><font color="#000099" face="Trebuchet MS" size = "4">Viewing Status of Request</font></b></center>
	<p align="center">
	<img border="0" src="images/empimg22.jpg" width="548" height="400">
	<center><b><font color="#000099" face="Trebuchet MS" size = "2">Click Notification Section to view status of request(s).</font></b></center>
 
      
    
    </font>
	</div>
</div>
</font>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!------------------------------------end calling content script----------------->
</body>
</html>