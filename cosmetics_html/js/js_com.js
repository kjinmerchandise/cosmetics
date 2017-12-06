$(document).ready(function(){

		/*로딩시 항상 맨 위로 이동*/
			$('html,body').animate({'scrollTop' : '0'}, 500);

 		/*header의 ham 클릭시 이동*/
	 		$('header span:nth-child(2)').click(function(){
	 			$('.ham').animate({'left' : 0} , 1000);
	 			$('.cover').animate({'opacity' : '1'} , 1000);

	 			$('.top').css('z-index' , '3');
	 			$('.top').css('display' , 'block');
	 			$('.cover').css('z-index' , '2');
	 			$('.cover').css('display' , 'block');
	 			$('header').css('z-index' , '1');
	 		});

 		/*ham 의 X 버튼 클릭시 이동*/
	 		$('.ham > img').click(function(){
	 			var ham_width = $('.ham').width();
	 			$('.ham').animate({'left' : -ham_width} , 1000)
	 			$('.cover').animate({'opacity' : '0'} , 1000)

	 			setTimeout(function(){
	 				$('header').css('z-index' , '2');
	 				$('.top').css('z-index' , '1');
	 				$('.top').css('display' , 'none');
	 				$('.cover').css('display' , 'none');
	 				$('.cover').css('z-index' , '0');
	 			},1000);
	 		});

	 		$('.cover').css('height' , $('body').height());

	 		

		/*하단 footer 영역 confirm terms of use 내용 펼치기*/
			$('footer ul li:nth-child(1)').click(function(){
					if($('footer ul li:nth-child(2)').css('display') == 'none'){
						$('footer ul li:nth-child(2)').slideDown();
						$('footer ul li:nth-child(2)').css('border-top' , '0');
					}else{
						$('footer ul li:nth-child(2)').slideUp();
					}

					$('html,body').animate({'scrollTop' : $(document).height()} , 1000);

				});
	 	});

	 	

	 	
	 		
