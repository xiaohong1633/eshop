/*
 * jQuery�����autoimg
 * 	�汾��v1.1
 *  ʱ�䣺2010-8-31
 *  ���ߣ��ɷ�
 *  QQ��276230416
 *  ��ַ��http://www.ffasp.com
 *  
 +--------------------------------------------------------------------
 *ʹ��˵����
 *1.�����֧��һ��ҳ����ʹ��
 *2.htmlģ������
	<div class="autoimg">
	  <div class="parentdiv"><img src="" /> </div>
	  <ul class="imglist">
		<li><img src="image/1/0.jpg" /></li>
		<li><img src="image/1/1.jpg" /></li>
		<li><img src="image/1/2.jpg" /></li>
	  </ul>
	  <div class="clearboth"></div>
	</div>
 *3.�ο���ʽ[��ʾ����index.html]	
	<style type="text/css">
	.parentdiv {
		position:relative;
		overflow:hidden;
		height:300px;
		width:300px;
		border:1px solid #000;
		float:left;
	}
	.imglist {
		width:270px;
		float:left
	}
	.imglist li {
		width:80px;
		height:80px;
		overflow:hidden;
		float:left;
		margin:5px;
	}
	.imglist li img {
		width:80px
	}
	.clearboth {
		clear:both
	}
	</style>
 +--------------------------------------------------------------------
 */
jQuery.fn.autoimg = function(G){
	
	var interval = new Array();
	var ord = new Array();
	var first=true;
	var D = {
		delay:4,//�õ�Ƭ�л���ʱ
		loadingImgSrc:"loading.gif"
	};
	$.extend(D,G)

	//��ʼ������
	$.init = function(el,i){
	var framediv,frameimg,firstimg,i,f;
		framediv = $(el).children("div").eq(0);
		//frameimg = framediv.children("img");
		frameimg = $("<img />");
		frameimg.attr("src",D.loadingImgSrc);
		firstimg = $(el).children("ul").find("img").eq(0);
		imgwrap =  $(el).children("ul").children("li");
		//+--------------------------------------------------		
		imgMargins = $.imgCenter({"w": framediv.width() ,"h":framediv.height()},{"w":64,"h":64});
		frameimg.css({width:64,height:64,marginLeft:imgMargins.l,marginTop:imgMargins.t})
		framediv.html(frameimg);
		//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		framediv.loadthumb({parentDiv:framediv,frameimg:frameimg,img:firstimg});
		$.imgSlide(el,i);
	} 
 	//�Զ������л�ͼƬ�б�
	$.imgSlide = function(el,i){
		ord[i] = 1;
		interval[i] = setInterval(function(){$.interval(el,i,ord[i])},D.delay*1000);
	}

	$.interval = function(el,i,j){
		var framediv,frameimg,firstimg;
		var imgSrc,imgLength,i;
	
		framediv = $(el).children("div");
		frameimg = framediv.children("img");
		firstimg = $(el).children("ul").find("img").eq(0);
		imgwrap =  $(el).children("ul").children("li");
	
		imgLength = imgwrap.size();
		if(j>=imgLength){j=0};
		if(j < imgLength){
			framediv.loadthumb({parentDiv:framediv,frameimg:frameimg,img:imgwrap.find("img").eq(j)});
		}
		if(j<imgLength){
			ord[i]=j+1;
		}else{ord[i]=0;};
	}
	//ͼƬԤ����
	jQuery.fn.loadthumb = function(D) {
		var imgTmp,imgDem,imgMargins;
		D = $.extend({
			 parentDiv : {},
			 img:{},
			 frameimg : {}
		},D);
		D.frameimg.hide();
		imgTmp = new Image();
		$(imgTmp).load(function(){
			imgDem = {};
			imgDem.w  = imgTmp.width;
			imgDem.h  = imgTmp.height;
			imgDem = $.imgResize({"w":D.parentDiv.width() ,"h": D.parentDiv.height()},{"w":imgDem.w,"h":imgDem.h});
			imgMargins = $.imgCenter({"w": D.parentDiv.width() ,"h": D.parentDiv.height()},{"w":imgDem.w,"h":imgDem.h});
			D.frameimg.css({width:imgDem.w,height:imgDem.h,marginLeft:imgMargins.l,marginTop:imgMargins.t})
					  .attr("src",D.img.attr("src"))
					  .fadeIn("slow");
		}).attr("src",D.img.attr("src"));//.attr("src",options.src)Ҫ����load���棬
		
	}
	
	//����ͼƬ��ȣ��߶Ȳ�� ( parentDem�Ǹ�Ԫ�أ�imgDem��ͼƬ )
	jQuery.imgResize = function(parentDem,imgDem){
		if(imgDem.w>0 && imgDem.h>0){
			var rate = (parentDem.w/imgDem.w < parentDem.h/imgDem.h)?parentDem.w/imgDem.w:parentDem.h/imgDem.h;
			//��� ָ���߶�/ͼƬ�߶�  С��  ָ�����/ͼƬ��� ��  ��ô�����ǵı����� ȡ ָ���߶�/ͼƬ�߶ȡ�
			//��� ָ���߶�/ͼƬ�߶�  ����  ָ�����/ͼƬ��� ��  ��ô�����ǵı����� ȡ ָ�����/ͼƬ��ȡ�
			if(rate <= 1){   
				imgDem.w = imgDem.w*rate; //ͼƬ�µĿ�� = ��� * ������
			}else{//  �������������1�����µĿ�ȵ�����ǰ�Ŀ�ȡ�
				imgDem.w = imgDem.w;
			}
			if(rate <= 1){   
				imgDem.h = imgDem.h*rate;
			}
			else{
				imgDem.h = imgDem.h;
			}
		}	
		return imgDem;
	}
	//ʹͼƬ�ڸ�Ԫ����ˮƽ����ֱ���У�( parentDem�Ǹ�Ԫ�أ�imgDem��ͼƬ )
	jQuery.imgCenter = function(parentDem,imgDem){
		var left = (parentDem.w - imgDem.w)*0.5;
		var top = (parentDem.h - imgDem.h)*0.5;
		return { "l": left , "t": top};
	}
	//ͼƬ�б������ͣЧ��
	jQuery.imgHover = function(el,i){
		var framediv,frameimg,firstimg;
		var imgSrc,imgLength,i;
	
		framediv = $(el).children("div");
		frameimg = framediv.children("img");
		firstimg = $(el).children("ul").find("img").eq(0);
		imgwrap =  $(el).children("ul").children("li");
	
		$(el).children("ul").children("li").hover(
			function(){
				framediv.loadthumb({parentDiv:framediv,frameimg:frameimg,img:$(this).find("img")})	;
				clearInterval(interval[i]);
			},function(){
				ord[i] = $(el).children("ul").children("li").index($(this))+1;
				interval[i] = setInterval(function(){$.interval(el,i,ord[i])},D.delay*1000);				
			});
	}

	$(this).each(function(i){
		$.init(this,i);
		$.imgHover(this,i);
	});
};