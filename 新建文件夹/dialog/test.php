<?php ?>
<input type="password" maxlength="6" id="dy" value=""/> </p>
<p> <input id="PostAction" onclick="trans();" class="btn btn-green" type="button" value="确认提交">
<script type="text/javascript">
function trans(tag){ 
	var s=document.getElementById("dy").value+document.getElementById("keyZ").value; 
	window.returnValue=s; 
	window.close(); 
	} 
</script>