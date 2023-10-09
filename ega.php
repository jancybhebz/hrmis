<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<script >

<!-- Begin
nextfield = "box4"; // name of first box on page
netscape = "";
ver = navigator.appVersion; len = ver.length;
for(iln = 0; iln < len; iln++) if (ver.charAt(iln) == "(") break;
netscape = (ver.charAt(iln+1).toUpperCase() != "C");

function keyDown(DnEvents) { // handles keypress
// determines whether Netscape or Internet Explorer
k = (netscape) ? DnEvents.which : window.event.keyCode;
if (k == 13) { // enter key pressed
if (nextfield == 'done') return true; // submit, we finished all fields
else { // we're not done yet, send focus to next box
eval('document.frmEmpNumber.' + nextfield + '.focus()');
return false;
      }
   }
}
document.onkeydown = keyDown; // work together to analyze keystrokes
if (netscape) document.captureEvents(Event.KEYDOWN|Event.KEYUP);
//  End -->
</script>
<body>
<form name=yourform>
Box 4: <input type=text name=box4 onFocus="nextfield ='done';"><br>
<input type=submit name=done value="Submit">
</form>

</body>
</html>
