<?
//getPics.php
include("../hrmis/class/Connect.php");
//include ("../lib/elements/ConnectDB/connectDB.php");
//include ("template2.php");
//include ("../user_header.php");
//if (!class_exists(auth))
//{
       // include ("..//auth.php");
//}
//include ("../authconfig.php");
//include ("../check.php");
//$username=$check["uname"];
$id=$id;
$action=$action;
?>
<html>
        <head>
                <title> Upload a File </title>
                <script type="text/javascript">
                <!--
                function CheckFileFormat(sFilePath, bSubmitPressed)
                {
                        if (sFilePath.replace(/\s/g, '') != '')
                        {
                            var iLastIndex = sFilePath.lastIndexOf('.', sFilePath.length - 1);
                      var sFileExtension = sFilePath.substr(iLastIndex + 1);
                      if ((sFileExtension != 'jpg') && (sFileExtension != 'gif') &&
                      (sFileExtension != 'jpeg'))                                {
                              window.alert('Please select a .jpg/.jpeg or .gif file.');
                         if (bSubmitPressed) return false;
                      }
                        }
                }
                //-->
                </script>
        </head>
        <body bgcolor="#FFFFFF">
                <form enctype="multipart/form-data" name="frmUploadFile"
                action="GrabPics.php?action=<? echo $action;?>" method="post"
                onSubmit="JavaScript:  return CheckFileFormat(this.fileUpload.value,
                true);">
   <table border="0" cellpadding="0" cellspacing="0"
   bordercolor="#111111" width="598">      <tr bgcolor="#336699">
         <td height="22"> <p style="margin-left: 10"><b><font
         face="Verdana" size="2" color="#FFFFFF">               Upload
         Picture</font></b> </td> <td height="22" align="right"><font
         color="#FFFFFF" size="1" face="Verdana, Arial, Helvetica,
         sans-serif"><strong>Logged            in user: <i><? echo
         $username;?></i></strong></font></td>
      </tr>
      <tr bgcolor="#CAE4FF">
         <td colspan="2"> <p style="margin-left: 10; margin-right:
         10"><font face="Verdana" size="2">               <input
         type="hidden" name="id" value="<? echo $id;?>">
               <br>
               Please select a picture from your local computer to upload
               to our               web server for saving in our
               database. Once you have chosen a picture,
               please click on the &quot;Upload this Picture&quot; button
               below.&nbsp;               &nbsp;<br>
               &nbsp;</font> </td>
      </tr>
      <tr>
         <td width="28%" bgcolor="#CAE4FF"> <p style="margin-left:
         10"><font face="Verdana" size="2">               Picture
         Location:</font> </td> <td width="72%" bgcolor="#CAE4FF"> <font
         face="Verdana" size="2">
            <input type="file" name="fileUpload" size="20"
            onChange="JavaScript: CheckFileFormat(this.value, false);">
                     </font> </td>
      </tr>
      <tr>
         <td width="28%" bgcolor="#CAE4FF"> <p style="margin-left:
         10"><font face="Verdana" size="2"><br>               <br>
               &nbsp;</font> </td>
         <td width="72%" bgcolor="#CAE4FF"> <font face="Verdana"
         size="2">
            <input type="submit" value="Upload this Picture"
            name="Submit" style="font-family: Verdana, Arial, Helvetica,
            sans-serif;                                        font-size: 10px; background-color: #FFFFFF;
            border: thin solid
                                        #006699; cursor: hand;">            </font> </td>
      </tr>
   </table>
                </form>
        </body>
</html>