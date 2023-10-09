
<!-- TWO STEPS TO INSTALL DYNAMIC INPUT:

  1.  Copy the coding into the HEAD of your HTML document
  2.  Add the last code into the BODY of your HTML document  -->

<!-- STEP ONE: Paste this code into the HEAD of your HTML document  -->

<HEAD>

<SCRIPT LANGUAGE="JavaScript">
<!-- Original:  Peter Hermus -->
<!-- Web Site:  http://come.to/speedpete -->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Begin
function createForm(number) {
data = "";    
inter = "'";
if (number < 16 && number > -1) {
for (i=1; i <= number; i++) {
if (i < 10) spaces="      ";
else spaces="    ";
data = data + "URL " + i + " :" + spaces
+ "<input type='text' size=10 name=" + inter
+ "url" + i + inter + "'><br>";
}
if (document.layers) {
document.layers.cust.document.write(data);
document.layers.cust.document.close();
}
else {
if (document.all) {
cust.innerHTML = data;
      }
   }
}
else {
window.alert("Please select up to 15 entries.");
   }
}
//  End -->
</script>
</HEAD>

<!-- STEP TWO: Copy this code into the BODY of your HTML document  -->

<BODY>

<center>
<form name=counter>
Number of URLs to enter:
<input type=text name=number size=5>
<input type=button value="Update" onClick="createForm(counter.number.value);">
</form>

<br>

<form name="webform">
<table border=0>
<tr valign=top>
<td>Name:</td>
<td><input type=text size=20 name=name onChange="msg(this.form)"></td>
</tr>

<tr><td colspan=2>

<!-- Placeholder for dynamic form contents -->
<span id=cust style="position:relative;"></span>

</td>
</tr>

<tr valign=top>
<td>Comments:</td>
<td><textarea name=comments cols=45 rows=5 wrap=virtual OnChange="msg(this.form)">
</textarea></td>
</tr>
<tr>
<td></td>
<td><input type=submit value="Send"></td>
</tr>
</table>
</form>
</center>

<p><center>
<font face="arial, helvetica" size="-2">Free JavaScripts provided<br>
by <a href="http://javascriptsource.com">The JavaScript Source</a></font>
</center><p>

<!-- Script Size:  1.95 KB -->