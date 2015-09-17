<html>
<head>
<script type="text/javascript">
function onClick(){ 
	var k = showModalDialog( 
	"test.php", 
	"newwindow",
	"dialogHeight:200px; 
	dialogWidth:400px; 
	toolbar:no;
	menubar:no;
	scrollbars:no;
	resizable:no; 
	location:no;
	status:no;
	left:100px; 
	top:100px;"); 唉还有两个属性不记得， 去百度下吧 。 
	//K是窗口回传的值 
	//判断 k 
	if(k!=null&&typeof(k)!=undefined){ 
	.....................ok 
	} 
	} 

</script>
</head>
<body>
hello world
</body>
</html>


