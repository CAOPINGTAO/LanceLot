$(function (){
	/*以下这是回到顶端的JS特效*/

	aa = null;	//判断值，判断回到顶端的按钮节点是否创建
	//给滚动条一个事件
	$(document).scroll(function (){

		window_h = $(window).height(); //计算出窗口的高
		window_w = $(window).width();	//计算出窗口的宽
		jx = (window_w/2)-490 >= 46;	//计算网页与窗口之间的距离是否大于46

		//当窗体的大小改变
		$(window).resize(function (){
			window_h = $(window).height();
			window_w = $(window).width();
			jx = (window_w/2)-490 >= 46;
			if (jx){
				$('#totop').css('right',(window_w/2)-490-46);
			}else {
				$('#totop').css('right',10);
			}
		});

		//得到文档上端超出可视区域的距离
		var h = $(document).scrollTop();

		if (h > 0 && aa == null){

			//将回到顶端的按钮动态插入到文档中
			$('body').append('<div id="totop"><a href="#"><img src="/LanceLot/Public/front/images/totop.gif" alt="回到顶端" title="回到顶端" /></a></div>');

			//判断宽度来实现按钮距离右边的距离
			if (jx){
				$('#totop').css('right',(window_w/2)-490-46);
			}else {
				$('#totop').css('right',10);
			}
		}

		//按钮渐入效果
		$('#totop').show(1000);
		aa = 1;

		//当文档的顶端没有超出可视范围的时候执行
		if (h == 0) {
			$('#totop').fadeOut(1000);	//渐出效果
			//$('#totop').remove();		//移除按钮			

		}
	});
});