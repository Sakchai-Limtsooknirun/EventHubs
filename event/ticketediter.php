<html>
<head>
<script language="javascript" type="text/javascript">

function incrementCount() {
	document.frm.count.value = parseInt(document.frm.count.value) + 1;
	addTextBox();
}

function decCount() {
	document.frm.count.value = parseInt(document.frm.count.value) - 1;
	removeTextBox();
}

function addTextBox() {
	var form = document.frm;
	form.appendChild(document.createElement('div')).innerHTML = "<table width=\\"40&#37;\\">"
		+ "<tr><td>Name</td><td><input type=\\"text\\" name=\\"txt\\"></td></tr>"
		+ "</table>";
}

function removeTextBox() {
	var form = document.frm;
	if (form.lastChild.nodeName.toLowerCase() == 'div')
		form.removeChild(form.lastChild);
}

</script>

<body>
<table width="40%" border="1">
<form name="frm">
<tr>
<td>Name: </td>
<td><input type="text" name="count" value="0" readonly ></td>
<td><INPUT type="button" value="ADD" name="add" onClick="incrementCount()"></td>
<td><INPUT type="button" value="Remove" name="remove" onClick="decCount()"></td>
</tr>
</table>
</form>
</body>
</html>
