var imgArray=document.getElementById('cmp_piclist').getElementsByTagName("li");
var imgLen=imgArray.length;
var wordArray=document.getElementById('cmp_wordlist').getElementsByTagName("li");
var num=0;
var oldNum=0;
var isScroll=false;
var scroll_t;
imgArray[0].style.display="block"
wordArray[0].style.display="block";

function scrollNext(){
	if(isScroll){
		var left1=imgArray[num].offsetLeft;
		var left2=imgArray[oldNum].offsetLeft;
		if(left1>=0)
		{
			imgArray[oldNum].style.display="none";
			wordArray[oldNum].style.display="none";
			wordArray[num].style.display="block";
			isScroll=false;
			clearTimeOut(scroll_t);
		}
		else
		{
		left1+=10;
		left2+=10;
		imgArray[num].style.left=left1+"px";
		imgArray[oldNum].style.left=left2+"px";
		}
		scroll_t = setTimeout("scrollNext()",10)
	}
}

function nextImg(){
	if(!isScroll){
	oldNum=num;
	num++;
	if(num==imgLen)
		num=0;
	
	imgArray[num].style.display="block";
	imgArray[num].style.left="-470px";
	isScroll=true;
	scroll_t = setTimeout("scrollNext()",10)
	}
}

function scrollPre(){
	if(isScroll){
		var left1=imgArray[num].offsetLeft;
		var left2=imgArray[oldNum].offsetLeft;
		if(left1<=0)
		{
			imgArray[oldNum].style.display="none";
			wordArray[oldNum].style.display="none";
			wordArray[num].style.display="block";
			isScroll=false;
			clearTimeOut(scroll_t);
		}
		else
		{
		left1-=10;
		left2-=10;
		imgArray[num].style.left=left1+"px";
		imgArray[oldNum].style.left=left2+"px";
		}
		scroll_t = setTimeout("scrollPre()",10)
	}
}

function preImg(){
	if(!isScroll){
	oldNum=num;
	if(num==0)
		num=imgLen-1;
	else
		num--;
		
	imgArray[num].style.display="block";
	imgArray[num].style.left="470px";
	isScroll=true;
	scroll_t = setTimeout("scrollPre()",10)
	}
}