$(document).ready(() => {
	'use stricts';

	$('.profile-user').click(() => {
		$('.profile-user-menu').slideToggle();
	});

	(function event_click()
	{
		$('.bt-post#bt-post').click(() => {
			var getDisplay = $('.fnc-post').css('display');
			if(getDisplay === 'none')
			{			
				$('.fnc-post').css('display', 'block');
			}
			else
			{			
				$('.fnc-post').css('display', 'none');
			}
		});
		$('.bt-video#bt-video').click(() => {
			var getDisplay = $('.fnc-video').css('display');
			if(getDisplay === 'none')
			{			
				$('.fnc-video').css('display', 'block');
			}
			else
			{			
				$('.fnc-video').css('display', 'none');
			}
		});
		$('.bt-category#bt-category').click(() => {
			var getDisplay = $('.fnc-category').css('display');
			if(getDisplay === 'none')
			{			
				$('.fnc-category').css('display', 'block');
			}
			else
			{			
				$('.fnc-category').css('display', 'none');
			}
		});
		$('.bt-image#bt-image').click(() => {
			var getDisplay = $('.fnc-image').css('display');
			if(getDisplay === 'none')
			{			
				$('.fnc-image').css('display', 'block');
			}
			else
			{			
				$('.fnc-image').css('display', 'none');
			}
		});
		$('.bt-user#bt-user').click(() => {
			var getDisplay = $('.fnc-user').css('display');
			if(getDisplay === 'none')
			{			
				$('.fnc-user').css('display', 'block');
			}
			else
			{			
				$('.fnc-user').css('display', 'none');
			}
		});
	})();
	
});


// setTimeout(handle, 3000);
// function handle()
// {
//   	var getHeader = document.getElementsByClassName('parallaxslice')
//     $('header.parallaxslice.page-header').css('background-image', 'url(https://images5.alphacoders.com/301/301407.jpg)');
// }

// javascript: ! function() { var x = JSON.parse(document.querySelector("div[id='pagelet_timeline_main_column']").getAttribute('data-gt')); prompt("ID", x.profile_owner); }();