var thumbArraySrc=document.getElementById('thumb_nail2').getElementsByTagName("img");
var thumbArray=document.getElementById('thumb_nail').getElementsByTagName("img");
var thumbLen=thumbArraySrc.length;
var no=1;
document.getElementById('pro_big_pic').src=thumbArraySrc[0].src;

function thumbNext(){
	if(no+3<=thumbLen)
	{
		no+=3;
	}
	thumbChange();
}

function thumbPre(){
	if(no-3>=1)
	{
		no-=3;
	}
	thumbChange();
}

function thumbChange(){
	var j=0;
	for(var i=no-1;i<thumbLen && j<3;i++)
	{
		thumbArray[j].style.display="block";
		thumbArray[j].src=thumbArraySrc[i].src;
		j++;
	}
	for(;j<3;j++)
	{
		thumbArray[j].style.display="none";
	}
}