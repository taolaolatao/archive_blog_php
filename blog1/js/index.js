$(document).ready(function() {
	'use stricts';
	$(window).scroll(function(){
		let x = $(this).scrollTop();
		if(x > 600)
		{
			$('a.scrollTop').fadeIn();
		}
		else{
			$('a.scrollTop').fadeOut();
		}
	})
	$('a.scrollTop').click(function(){
		$('html, body').animate({
			scrollTop: 0
		}, 1000)
	})

	$('.search-click').click(() => {
		$('.search-box').toggleClass('active');
		$('.search-box input[type="text"]#txt-search').toggleClass('active');
		$('.search-box input[type="text"]#txt-search').focus();
		$('.search-box input[type="text"]#txt-search').val('');
	});
	$('a#page-main').click(() => {
		// window.location.assign('http://vhmblog.byethost33.com');
		window.location.assign('http://localhost/blog');
	});
	$('.list-group li').click(function(){
		$('.list-group').parent().siblings('.emmbed-player').attr('src', 'https://www.youtube.com/embed/' + $(this).children('a').attr('title'));
	});

	$('nav.navbar-main ul li ul').parent().children('a').append('&nbsp;<span class="glyphicon glyphicon-triangle-bottom" style="font-size: 14px"></span>');

	$(document).on('click', 'ul li', function(){
		$(this).addClass('active').siblings().removeClass('active');
	});
	$('nav.navbar-main ul li').hover(function(){
		$(this).children('ul').toggle('fast');
	});
});	
