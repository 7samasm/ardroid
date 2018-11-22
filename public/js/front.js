$(function() {
	"use strict";
	$('time.timeago').timeago();
	/*search============================*/
    var form = $('.search-block form');
	$('.menu-logo-search > .fa-search').click (function(){
       screen.width > 450 ? form.width(260) : form.width(160);
        form.css('transition','0.3s');
	});
	$('.search-block form i').click (function(){
        form.css('transition','0s');
        form.width(0);
	});
	/*-------*/
	$('.search-block form input').on('focus', function () {
        $(this).addClass('border-red');
        $(this).prev('div').css('color','rgb(40, 53, 147)');
		$(this).prev('div').animate({
			bottom : '33px'
		},200);
    }).on('blur',function () {
        if ($(this).val() === '')
        {
            $(this).removeClass('border-red');
            $(this).prev('div').css('color','#999');
            $(this).prev().animate({
                bottom: '15px'
            }, 200);
            return;
        }
        $(this).addClass('border-red');
    });
	/*side-nav============================*/
	var sideNav = $('#side-nav'),
		shadow  = $('#shadow');
	$('#hamberger').click (function(){
		sideNav.css('margin-right','0');
		shadow.css('width','100%');
        shadow.css('background-color','rgba(0,0,0,.5)');
		screen.width < 450 ? sideNav.css('margin-right','-90px') : '';
	});
    shadow.click (function(){
        sideNav.css('margin-right','-300px');
		$(this).width(0);
		$(this).css('background-color','rgba(0,0,0,0)');
	});
	/*=====dropdown menu===================*/
	$('nav > div:last-child > span').click (function(){
        $('#dropDown').fadeToggle(150);
        $(this).css('color','#fff');
	});
	/*=====================================*/
	$(window).resize (function(){

        $('.card-block p > span ').css('maxHeight',$('.card-block p').height() - 20);

        /* ======================= control nav li =========*/
        var li  = $('nav > ul > li.j-selctor'),
        	ul = $('#dropDown');

        li.each(function () {
        	if ($(this).offset().top > 80)
        	{
        		ul.prepend('<li><a href="/index/section/' + $(this).text() + '">' + $(this).text() + '</a></li>');
        		$(this).removeClass('j-selctor');
        	}
        });

        ul.children().each(function () {
        	if ($('nav > ul').find($("li:contains("+ $(this).text() + ")")).offset().top == 80 )
        	{
        		$(this).hide();
        	}else {
        		$(this).show();
        	}
        });

        /* ======================= control nav li =========*/

	}).resize();
	/*=====================================*/
	// add
	var cardBlock = $('.card-block');
    cardBlock.eq(0).css('transform','scale(1)');
    if ($(window).width() > 500)
    {
    	cardBlock.eq(1).css('transform','scale(1)');
    }
    //on scroll
    $(window).on('scroll',function () {

        var wst = $(window).scrollTop();

		$('.col-card').each(function () {
		    var os = $(this).offset().top;
            //console.log(wst,os,$(this).children());
            if(wst > os)
			{
				if ($(window).width() > 500)
				{
					$(this).next().next().children().addClass('card-scale');
				}
				else
				{
					$(this).next().children().addClass('card-scale');
				}
			}
			else
			{
				$(this).next().next().children().removeClass('card-scale');
			}
        })
    });
    //on scroll
	var a     = $('nav > ul > li > a ,nav > div > a'),
		panel = $('.panel'),
		attr  = panel.attr('section');
	if (attr != null)
	{
		$(a).each(function () {

			if ($(this).text() == attr)
			{
				$(this).css('color','#fff');
			}
		});
	}


});
