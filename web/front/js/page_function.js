var HOST = '';
var SF_CULTURE = '';

function setHost(){
    HOST = "http://"+window.location.hostname+"/"+SF_CULTURE+"/";
}

function setBodyHeight(){
    var height = Math.max(
        $(document).height(),
        $(window).height(),
        document.documentElement.clientHeight);
    var main = $('.main-row');
    var black = $('.black-bottom');
    if (main.height()<=height){
        main.height(height);
        if (black.length>0){
            black.height(height);
        }
    }
    $('.designed').css('bottom', '0px');
}

function setCulture(){
    SF_CULTURE = $('#culture').html();
}

function startScroller(){
    $('#scroll-me, .scroll-me-news, .scroll-me-news-wide').jScrollPane({
        verticalDragMinHeight: 9,
        verticalDragMaxHeight: 9,
        scrollbarMargin:20
    });
}

$(document).ready(function(){
    
	function createLayer(obj, name){
		var layer = $('<div>', {
			id: name
		}).width(obj.width());
		layer.height(obj.height());
		var indicator = $('<div class=\"indicator\">').appendTo(layer);
		obj.append(layer);
	}
    
    function newsNavigation(){
        $('.next-news, .previous-news').live('click', function(event){
            event.preventDefault();
            var selected = $(this).attr('class').split(' ')[1].split('-')[1];
            var target = $(".content-news");

            $.ajax({
                type: "POST",
                url: HOST+"news/getNews",
                data: {page_id: selected},
                beforeSend: function(){
                    createLayer($('.news-cont'), 'layer');
                },
                success: function (data){
                    target.empty().html(data).fadeIn();
                    $('#layer').remove();
                    startScroller();
                }
            });
        });
    }
    
    function closeWindow(){
        $('.close-window').live('click', function(){
           $(this).parent().parent('.news-more-inside').hide();
        });
    }
    
    function showMore(){
        $('.news-more').live('click', function(){
           $(this).next('.news-more-inside').fadeIn(350);
           startScroller();
        });
        $('.news-title-more').live('click', function(){
           $(this).next('.rel').find('.news-more-inside').fadeIn(350);
           startScroller();
        });
        
    }
    
    function startScrollable(){
        $(".scrollable").scrollable({ vertical: true, mousewheel: true });
    }
    
    function startCalendarNavigation(){
        $('.next-month, .prev-month').live('click', function(){
            var date = $(this).attr('class').split(' ')[1].split('_')[1];
            var page_id = $(this).attr('class').split(' ')[2].split('-')[1];
            var target = $('#calendar');
            $.ajax({
                type: "POST",
                url: HOST+"program/getCalendar",
                data: {day: date, page: page_id},
                beforeSend: function(){
                    createLayer(target, 'layer_small');
                },
                success: function (data){
                    target.empty().html(data).fadeIn();
                    $('#layer_small').remove();
                }
            });
        });
    };
    
    function startCalendarPickDay(){
        $('.pick-day').live('click', function(){
            var date = $(this).attr('class').split(' ')[1].split('_')[1];
            var page_id = $(this).attr('class').split(' ')[2].split('-')[1];
            var target = $('.program-content-cont');
            $.ajax({
                type: "POST",
                url: HOST+"program/getDay",
                data: {day: date, page: page_id},
                beforeSend: function(){
                    createLayer(target, 'layer_program');
                },
                success: function (data){
                    target.empty().html(data).fadeIn();
                    $('#layer_program').remove();
                    startScrollable();
                }
            });
        });
    };
    
    function showSubMenu(){
        $('.menu-element').hover(function(){
            if (!$(this).find('subpages').hasClass('show-sub')){
                var sub = $(this).find('.subpages');
                if (sub.length>0){
                    sub.fadeIn();
                }
            }
            }, function(){
                if (!$(this).find('.subpages').hasClass('show-sub')){
                    var sub = $(this).find('.subpages');
                    if (sub.length>0){
                        sub.stop().fadeOut();
                    }
                }
            });
    };

    
    setCulture();
    setHost();
    newsNavigation();
    showMore();
    closeWindow();
    startScrollable();
    startCalendarNavigation();
    startCalendarPickDay();
    showSubMenu();
    setBodyHeight();
});

function startBackground(){
    if (typeof images != 'undefined'){
        $(images).each(function(){
            $('<img />')[0].src = this; 
        });
        var index = 0;
        $.backstretch(images[index], {speed: 750});
        setInterval(function() {
            index = (index >= images.length - 1) ? 0 : index + 1;
            $.backstretch(images[index]);
        }, 15000);
    }
}
    

$(window).load(function(){
    startScroller();
    startBackground();
    setBodyHeight();
});

$(window).resize(function(){
    setBodyHeight();
});

$(document).ready(function(){
			var x = $('.logobotones').css('background-color');
			$('.menu-hidden').css('background',x);
			
			$('#menuobligado').mouseover(function() {
				$('.slicknav_icon-bar', this).css('background-color', 'black');
				$('.slicknav_nav a',this).css('color', 'black');
				$('.logo-movil').attr('src',"../front/images/logo-negro.png");
				$('.slicknav_nav',this).css('display','block');
				$('#menuobligado2 .slicknav_nav').css('display','none');
				$('#menuobligado3 .slicknav_nav').css('display','none');
			});
				

			$('#menuobligado').mouseout(function() {
				$('.slicknav_icon-bar', this).css('background-color', 'white');
				$('.slicknav_nav a',this).css('color', 'white');
				$('.logo-movil').attr('src',"../front/images/logo.gif");
				$('.slicknav_nav',this).css('display','none');			
			});
			
			$('#menuobligado2').mouseover(function() {
				$('.slicknav_icon-bar', this).css('background-color', 'black');
				$('.slicknav_nav a',this).css('color', 'black');
				$('.slicknav_menutxt',this).css('color', 'black');
				$('.slicknav_nav',this).css('display','block');
				$('#menuobligado .slicknav_nav').css('display','none');
				$('#menuobligado3 .slicknav_nav').css('display','none');
				
			});
			$('#menuobligado2').mouseout(function() {
					$('.slicknav_icon-bar', this).css('background-color', 'white');
				$('.slicknav_nav a',this).css('color', 'white');
				$('.slicknav_menutxt',this).css('color', 'white');
				$('.slicknav_nav',this).css('display','none');		
				
			});
			$('#menuobligado3').mouseover(function() {
				$('.slicknav_icon-bar', this).css('background-color', 'black');
				$('.slicknav_nav a',this).css('color', 'black');
				$('h1',this).css('color', 'black');
				$('.slicknav_nav',this).css('display','block');
				$('#menuobligado .slicknav_nav').css('display','none');
				$('#menuobligado2 .slicknav_nav').css('display','none');
				
				
			});
			$('#menuobligado3').mouseout(function() {
				$('.slicknav_icon-bar', this).css('background-color', 'white');
				$('.slicknav_nav a',this).css('color', 'white');
				$('h1',this).css('color', 'white');
				$('.slicknav_nav',this).css('display','none');		
				
			});
			

});