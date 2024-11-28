/*document.addEventListener("DOMContentLoaded", function() {
function loadFonts () {
  if (sessionStorage.fontsLoaded) {
    document.documentElement.classList.add('fonts-loaded-2')
    return
  }

  if ('fonts' in document) {
    document.fonts.load('1em LatoSubset')
      .then(_ => {
        document.documentElement.classList.add('fonts-loaded-1')

        Promise.all([
          document.fonts.load('400 1em Lato'),
          document.fonts.load('700 1em Lato'),
          document.fonts.load('italic 1em Lato'),
          document.fonts.load('italic 700 1em Lato')
        ]).then(_ => {
          document.documentElement.classList.add('fonts-loaded-2')

          // Optimization for Repeat Views
          sessionStorage.fontsLoaded = true
        })
      })
  }
}
loadFonts();
});
*/


let init_blog_list_slider=function(node){
	(function($) {
		$(node).slick({
			lazyLoad: 'ondemand',
			dots: true,
			arrows: true,
			slidesToShow: 3,
			adaptiveHeight: true,
			responsive: [
				{
					breakpoint: 1024,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 1,
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						arrows: false,
					}
				},
			]
		});
	})( jQuery );
}
LazyM.lazy_init_blog_list_slider = function(){ init_blog_list_slider('.blog-list-slider');}



let init_review_slider = function(node){
	(function($) {
		$(node).slick({
			lazyLoad: 'ondemand',
			slidesToShow: 2,
			slidesToScroll: 2,
			arrows: true,
			swipe: false,
			adaptiveHeight: true,
			responsive: [
				{
				  breakpoint: 768,
				  settings: {
					slidesToShow: 1,
					swipe: true,
					slidesToScroll: 1,
					adaptiveHeight: true
				  }
				},
				{
					breakpoint: 479,
					settings: {
						arrows: false,
						slidesToShow: 1,
						slidesToScroll: 1,
						swipe: true,
						adaptiveHeight: true
					}
				}
			]
		});
		
		$(node).on('afterChange', function(event, slick, direction){
			var h = 0;
			$('.review_slider--container').css('height', 'auto');
			$('.review_slider--item.slick-active').each(function(){
				if($(this).outerHeight()>h) h = $(this).outerHeight();
			});
			$('.review_slider--container').css('height', h);
		});
	})( jQuery );
}
LazyM.lazy_init_review_slider = function(){ init_review_slider(".review_slider--container"); }


		
jQuery(document).ready(function ($) {
	if($(window).width()<=636)
		$(window).scroll(function(){
			var offset = $(window).scrollTop(),
				headerH = $('header').height();
			
			if(offset>200){
				$('body').addClass('fixed-menu');
				$('body').css('paddingTop', headerH);
				$('.totop').addClass('active');
			} else {
				$('body').removeClass('fixed-menu');
				$('body').css('paddingTop', 0);
				$('.totop').removeClass('active');
			}
		});
		
	var $tabs = $('.gid__more_tabs .gid__more_tab');
	$('.gid__more_tab').click(function(){
		let tab = $(this).data('tab'),
			n=$tabs.index(this);
			
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		$(this).closest('.gid').find('.gid__tab').hide();
		$(this).closest('.gid').find('.gid__tab[data-tab="'+tab+'"]').show();
		$(this).closest('.gid').find('.gid__dot').removeClass('active');
		$(this).closest('.gid').find('.gid__dots>.gid__dot:eq('+n+')').addClass('active');
	});
	$('.gid').each(function(){
		$(this).find('.gid__tabs>*:eq(0)').show();
		$(this).find('.gid__more_tabs>*:eq(0)').addClass('active');
	});
	$('.gid__accreditation').each(function(){
		var h = $(this).height();
		if(h>80.5){
			$(this).addClass('over');
			//$(this).text(h+' '+$(this).text());
		}
	});
	$('.gid__review').each(function(){
		var h = $(this).outerHeight();
		if(h>278){
			$(this).addClass('over');
		} else {
			$(this).addClass('not-over');
		}
	});
	var $dots = $('.gid__dots>.gid__dot');
	$('.gid__dot').click(function(){
		let n=$dots.index(this);
		console.log(n);
		$(this).closest('.gid').find('.gid__more_tabs>.gid__more_tab:eq('+n+')').click();
	});
	
	$('.school_copy').click(function(e){
		e.preventDefault();
		
		navigator.clipboard.writeText('КАНИКУЛЫ').then(function() {
		  alert('Промокод скопирован');
		}, function(err) {
		  console.error('Произошла ошибка при копировании текста: ', err);
		});
	});
	if($(window).width()<=1124){
		$('#menu-item-4136>ul').prepend($('#menu-item-4135'));
		$('#menu-item-4136>ul').prepend($('<li class="menu-item menu-item-type-taxonomy menu-item-object-category"><a href="/usloviya/"><span>Условия и правила</span></a></li>'));
		$('#menu-item-4139 span').text('Автопарк');
	}
	
	if($(window).width()<=480){
		$('.form__gates_wrapper').insertAfter($('.tours-wrap__title'));
		$('.form__pregates_duration').insertAfter($('.form__pregates_title'));
	}
	
	if($('body').hasClass('single-post')){
		var ids = '';
		$('.wp-block-image').each(function(){
			var img = $(this).find('img'),
				img_id = img.attr('class');
			
			ids += img_id+',';
		});
		
		console.log(ids);
		
		$.post(
			'/wp-admin/admin-ajax.php', 
			{
				action: 'img_caption', 
				ids: ids
			},
			function(data){
				var arr = JSON.parse(data);
				for (const [key, value] of Object.entries(arr)) {
					var caption = '';
					if(value){
						caption = value;
					}
					if($('.'+key).closest('figure').find('figcaption').length==0)
						$('<figcaption>'+caption+'</figcaption>').appendTo($('.'+key).closest('figure'));
				}
				
			}
		);
	}
	
	$('.int_mesta__item').each(function(){
		var w = $(this).width();
		$(this).css('height', w);
	});
	
	$('.faq__item').click(function(e){
	e.preventDefault();
	$(this).toggleClass('active')
});
	setTimeout(function(){
		$('#tours [data-order]').each(function(){
			var o = $(this).data('order')*1;
			console.log(o);
			
			$(this).insertBefore($('#tours>.content__tour:eq('+o+')'));
			
			var $all = $("[data-order="+o+"]");
			$all.not($all.eq(0)).remove();
		});
	},5000);
	if($(window).width()<768){
		/*$('#izuchayte_gorod').insertAfter($('h1'));
		$('#izuchayte_gorod h2').css('marginTop', 0);*/
		
		$('.gids__wrap').slick({
			dots: true,
			arrows: false,
			slidesToShow: 1,
			slidesToScroll: 1,
			adaptiveHeight: true
		});
	}
	if($('body').is('.home') && $(window).width()<768){
		$('.content__text--block:eq(0)').addClass('moved').css('marginTop', 30).insertAfter($('.content__tours'));
	}
	$('body').on('change', '[name="form_time"]', function(){
		$('.neva_form__radio_item').removeClass('active');
		$(this).parent().addClass('active');
	});
	$('body').on('change', '[name="form_pier"]', function(){
		var pier = $(this).val();
		$('[name="form_time"]').attr('checked', false).parent().hide();
		$('.neva_form__radio_item').removeClass('active');
		$('[data-pier='+pier+']').parent().show();
		
		if(pier == 1 || pier == '1')
			$('.neva_form__radio_item').show();
	});
	$('body').on('change', '.neva_form__timeinp', function(){
		var date = $(this).val(),
			id = $(this).data('id');
		$('.page-loader').show();
		$.post(
			'/wp-admin/admin-ajax.php', 
			{
				action: 'get_shedule_neva', 
				date: date,
				id: id
			},
			function(data){
				$('[name="form_pier"] option:not([value=1])').remove();
				$('.neva_form__radio_item').remove();
				$('.neva_form__note').remove();
				if(data){
					let resp = JSON.parse(data);
										
					for (const [key, value] of Object.entries(resp)) {
						let option = $('<option value="'+value.pier_id+'">'+value.pier_name+'</option>'),
							time = $('<label class="neva_form__radio_item"><input name="form_time" data-pier="'+value.pier_id+'" type="radio" value="'+value.neva_id+'"><span>'+value.fix_time+'</span></label>');
					
							$('[name="form_pier"]').append(option);
							$('.neva_form__radio').append(time);
					}
				} else {
					$('<p class="neva_form__note">На выбранную дату программ не найдено.</p>').insertBefore($('.neva_form__prices'));
				}
				$('.page-loader').hide();
			}
		);
	});
	$('.neva_form').change(function(){
		var sum = t_count = 0;
		$('.form__input--number').each(function(){
			var price = $(this).data('price')*1,
				count = $(this).val()*1;
			t_count += count;
			sum += price*count;
		});
		
		$('.t_count').text(t_count);
		$('.t_price').text(sum);
	});
	
	$('.neva_form .form__submit--buy').click(function(e){
		e.preventDefault();
		
		var fdata = $('.neva_form').serialize();
		
		if($('[name="form_time"]:checked').length == 0){
			alert('Выберите время экскурсии');
			e.preventDefault();
			return false;
		}
		var sum = t_count = 0;
		$('.form__input--number').each(function(){
			var price = $(this).data('price')*1,
				count = $(this).val()*1;
			t_count += count;
			sum += price*count;
		});
		if(!t_count){
			alert('Выберите билеты');
			e.preventDefault();
			return false;
		}
		$('.page-loader').show();
		$.post(
			'/wp-admin/admin-ajax.php', 
			fdata+'&action=order_neva',
			function(data){
				console.log(data);
				var obj = JSON.parse(data);
				$('.page-loader').hide();
				
				$('.neva_form').attr('action', obj.pay_url);
				/*console.log(obj.pay_url);*/
				$('.neva_form').submit();
			}
		);
	});
	
	
	if($('body').is('.postid-1343')){
		if($(window).width()<=968){
			$('#video_after_gates').insertAfter($('.content__info'));
			$('.single_tour__video_title').insertAfter($('.content__info'));
		} else {
			$('.single_tour__video_title').insertBefore($('.ng_tour_title'));
			$('#video_after_gates').insertBefore($('.ng_tour_title'));
		}
	}
	
	var arrs = ($('body').hasClass('single-tours'))?false:true;
	if(arrs)
		$('.review_slider--container').slick({
			lazyLoad: 'ondemand',
			slidesToShow: 2,
			slidesToScroll: 2,
			arrows: true,
			swipe: false,
			responsive: [
				{
				  breakpoint: 768,
				  settings: {
					arrows: arrs,
					slidesToShow: 1,
					swipe: true,
					slidesToScroll: 1,
					adaptiveHeight: true
				  }
				},
				{
					breakpoint: 479,
					settings: {
						arrows: false,
						slidesToShow: 1,
						slidesToScroll: 1,
						swipe: true,
						adaptiveHeight: true
					}
				}
			]
		});
	else
		$('.review_slider--container').each(function(){
			$(this).slick({
				lazyLoad: 'ondemand',
				slidesToShow: 2,
				slidesToScroll: 2,
				arrows: true,
				swipe: false,
				prevArrow: $(this).closest('.review_slider').prev().find('.arrs_btn-prev'),
				nextArrow: $(this).closest('.review_slider').prev().find('.arrs_btn-next'),
				responsive: [
					{
					  breakpoint: 768,
					  settings: {
						arrows: arrs,
						slidesToShow: 1,
						swipe: true,
						slidesToScroll: 1,
						adaptiveHeight: true
					  }
					},
					{
						breakpoint: 479,
						settings: {
							arrows: false,
							slidesToShow: 1,
							slidesToScroll: 1,
							swipe: true,
							adaptiveHeight: true
						}
					}
				]
			});
		});
function extension(name) {
	if(name && name != 'undefined'){
		var m = name.match(/\.([^.]+)$/)
		return m && m[1]
	} else {
		return false;
	}

}
	//if($(window).width()<=767){
		$('.stick').prependTo($('.content__left')).css('z-index', 99);
		$('.content__image-wrapper.slider-hero').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			adaptiveHeight: true,
			responsive: [
				{
					breakpoint: 481,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
						arrows: false,
					}
				}
			]
		});
	//}

$('.single-post a').each(function(){
	var src = $(this).attr('href'),
		ext = extension(src);

	if(ext && (ext=='jpg' || ext=='png' || ext=='webp' || ext=='jpeg')){
		$(this).attr('data-fancybox', 'gal');
	}
});

if($('#tours').is('[data-offset]')){
	if($(window).width()>766){
		//get_front_previews(-1);
		//$('<a href="#" class="show_more_front show_more_front-desc">Показать еще</a>').insertAfter($('#tours'));
		//$('body').on('click', '.show_more_front', function(e){
		//	e.preventDefault();
			//if(!$(this).hasClass('loading')){
		//		$(this).addClass('loading');
				get_front_previews(999);
		//	}
	//	});
	} else {
		//$('<a href="#" class="show_more_front">Показать еще</a>').insertAfter($('#tours'));
		//$('body').on('click', '.show_more_front', function(e){
		//	e.preventDefault();
		//	if(!$(this).hasClass('loading')){
		//		$(this).addClass('loading');
				get_front_previews(999);
		/*	}
		});*/
	}
}

function get_front_previews(count){
	let offset = $('[data-offset]').data('offset')*1;
	$.post(
		'/wp-admin/admin-ajax.php', 
		{
			action: 'get_front_previews', 
			count: count,
			offset: offset
		},
		function(data){
			$('#tours').append($(data));
			$('[data-offset]').data('offset', offset+count);
			$('.show_more_front').removeClass('loading');
			if(!data) $('.show_more_front').remove();
		}
	);
}

$('.reviews__show_more').click(function(e){
	e.preventDefault();
	$('.page-loader').show();

	var count = $('.content__review.review').length;

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: '/wp-admin/admin-ajax.php',
		data: {action: 'get_reviews', count:count},
		success: function (data) {
			if(data.content)
				$(data.content).insertBefore($('.reviews__show_more_wrapper'));
			if(data.all)
				$('.reviews__show_more_wrapper').remove();
			$('.page-loader').hide();
		},
	});
});
function timer_start(full_year,month, day, id_doc) {
    // Берём элемент для вывода таймера
    var timer_show = document.getElementById(id_doc);
    // Массив данных о времени
    var end_date = {
        "full_year": full_year, // Год
        "month": month, // Номер месяца
        "day": day, // День
        "hours": "00", // Час
        "minutes": "00", // Минуты
        "seconds": "00" // Секунды
    };
    // Строка для вывода времени
    var end_date_str = `${end_date.full_year}-${end_date.month}-${end_date.day}T${end_date.hours}:${end_date.minutes}:${end_date.seconds}`;





	    // Запуск интервала таймера
	    timer = setInterval(function () {
	        // Получение времени сейчас
	        var now = new Date();
	        // Получение заданного времени
	        var date = new Date(end_date_str);
	        // Вычисление разницы времени
	        //let ms_left = diffSubtract(now, date);
	        var ms_left = date - now;


	        // Если разница времени меньше или равна нулю
	        if (ms_left <= 0) { // То
	            // Выключаем интервал
	            clearInterval(timer);
	            // Выводим сообщение об окончание
	            //alert("Время закончилось");
	        } else { // Иначе
	            // Получаем время зависимую от разницы
	            var res = new Date(ms_left);
	            // Делаем строку для вывода
	            var str_timer = `${res.getUTCDate() - 1} дн. ${res.getUTCHours()} час. ${res.getUTCMinutes()} мин. ${res.getUTCSeconds()} сек.`;
	            // Выводим время
	    		console.log(str_timer);
	    		console.log(timer_show);
	            timer_show.innerHTML = str_timer;
	        }
	    }, 1000);


}

if ($('.endOfDate').length) {
	var id_doc = 'endCount',
	    endOfDate = $('.endOfDate'),
	    full_year = endOfDate.attr('data-full_year'),
	    month = endOfDate.attr('data-month'),
	    day = endOfDate.attr('data-day');

	timer_start(full_year,month, day, id_doc);
}
if ($('.endItemDate').length) {

	$('.endItemDate').each(function(e){
		var id_doc = $(this).find('.endItemCount').attr('id'),
		    full_year = $(this).attr('data-full_year'),
		    month = $(this).attr('data-month'),
		    day = $(this).attr('data-day');
			timer_start(full_year,month, day, id_doc);
	});


}



if ($('.fake_form_date').length) {
	$.datetimepicker.setLocale('ru');
	var startDate = $('.fake_form_date').val(),
		split = startDate.split('.'),
		trueDate = Date.parse(split[2]+'-'+split[1]+'-'+split[0]);
	console.log(split);
	console.log(Date.parse(split[2]+'-'+split[1]+'-'+split[0]));
	console.log(Date.parse('2024-09-21'));
	
	
	$('.fake_form_date').datetimepicker({
		timepicker: false,
		startDate: trueDate,
		format: 'd.m.Y',
		minDate: trueDate,
		onSelectDate: function(ct,$i){
			var day = ct.getDate()*1,
				month = ct.getMonth()*1+1,
				date;
			if(day<10){
				day = '0'+day;
			}
			if(month<10){
				month = '0'+month;
			}
			date = ct.getFullYear()+'-'+month+'-'+day;
			$('[name="form_date"]').val(date).change();
			$('[name="form_date"]').change();
			console.log('1: '+date);
			console.log('2: '+$('[name="form_date"]').val());
		}
	});
}

if ($('.tl-datapicker').length) {

	$('.tl-datapicker').datepicker({
	    minDate:new Date(),
	    onSelect: function (formattedDate, date, inst) {
	        if(!date){
	            $('.tl-datapicker--input').val('');
	        	$('.apply-filters-float-btn').hide();
	        	$('.tl-btn--default').removeClass('active');
	            return
	        }

	        $('.tl-datapicker--input').val(formattedDate)

	        $('.apply-filters-float-btn').show();
	        $('.tl-btn--default').addClass('active');

	    }
	})
	$('.tl-datapicker-month').datepicker({
	    minDate:new Date(),
	    onSelect: function (formattedDate, date, inst) {
	        let from = new Date(date)
	        let now = new Date()
	        console.log(date)
			// let date = new Date(year, month + 1, 0);
			// return date.getDate();

	        if(!date){
	            $('.tl-datapicker--input').val('');
	        	$('.apply-filters-float-btn').hide();
	        	$('.tl-btn--default').removeClass('active');
	            return
	        }
	        fromDay = from.getDate()<10?'0'+from.getDate():from.getDate()
	        fromMonth = (Number(from.getMonth())+1)<10? '0'+(Number(from.getMonth())+1): (Number(from.getMonth())+1)
	        fromYear = from.getFullYear()

	        nowDay = now.getDate()<10?'0'+now.getDate():now.getDate()
	        nowMonth = (Number(now.getMonth())+1)<10? '0'+(Number(now.getMonth())+1): (Number(now.getMonth())+1)
	        nowYear = now.getFullYear()

	        //toDay = from.getDate()<10 ? '0' + from.getDate() : from.getDate()


			var lastDayOfMonth = new Date(from.getFullYear(), from.getMonth()+1, 0);


	        toDay = lastDayOfMonth.getDate();

	        if(from.getMonth() < 11){
	            toMonth = (Number(from.getMonth())+2)<10? '0'+(Number(from.getMonth())+1): (Number(from.getMonth())+1)
	            toYear = from.getFullYear()
	        }
	        else{
	            toMonth = '01';
	            toYear = Number(from.getFullYear())
	        }

	        if(nowMonth == fromMonth){
	            from = ''+nowDay+'.'+nowMonth+'.'+nowYear
	            //from = ''+nowYear+'/'+nowMonth+'/'+nowDay
	        }
	        else{
	            from = ''+fromDay+'.'+fromMonth+'.'+fromYear
	            //from = ''+fromYear+'/'+fromMonth+'/'+fromDay
	        }

	        to = ''+toDay+'.'+toMonth+'.'+toYear
	        //to = ''+toYear+'/'+toMonth+'/'+toDay

	        $('.tl-datapicker--input').val(from+' - '+to);
	        $('.apply-filters-float-btn').show();
	        $('.tl-btn--default').addClass('active');

	    }
	})
	$('[data-clndr-toggle]').on('click', function (e){
	    e.preventDefault()
	    let id = $(this).data('clndr-toggle')
	    $('[data-clndr]').removeClass('active')
	    $('[data-clndr-toggle]').removeClass('active')
	    $(this).addClass('active')
	    $('[data-clndr="'+id+'"]').addClass('active')

	})
	$('.tl-btn--default, .apply-filters-float-btn').on('click', function(){
			var dates = $('.tl-datapicker--input').val();
			var datesspl = dates.toString().split( '-' );
			var arr = getBusinessDays(datesspl[0],datesspl[1]);

			window.location.href = window.location.origin + window.location.pathname + "?date=" + dates;
			// array2 = arr.toString().split( ',' ); // параметры функции
			// console.log(array2)
	});
	$('.mob .tl-datapicker--input').on('click', function() {
		$('.tl-dropdown--menu').toggleClass('active')
	})

}




	$('[name=20percent]').change(function(){
		updateSalePrice();
	});

	function updateSalePrice(){
		if($('[name=20percent]:checked').val()=='on'){
			var totalPrice = $('.t_price').text()*1,
				totalSalePrice = totalPrice*0.3;

			$('.total-sale_price_count').text(Math.round(totalSalePrice));
			$('.total-sale_price').show();
		} else {
			$('.total-sale_price').hide();
		}
	}






	// $('.content__filter--nolink').click(function(e){
	// 	e.preventDefault();
	// 	var cat = $(this).data('slug');
	// 	$('.content__filter--nolink').removeClass('active');
	// 	$(this).addClass('active');
	// 	$('.content__tour.tour').fadeOut();
	// 	$('.content__tour.tour.'+cat).fadeIn();

	// });

	$('.question-button').on('click', function(){
		$('.question-button').not(this).removeClass('active');
		$(this).toggleClass('active');
	})
	$(document).mouseup(function (e){ // событие клика по веб-документу
		var div = $(".question-button, .note"); // тут указываем ID элемента
		if (!div.is(e.target) // если клик был не по нашему блоку
		    && div.has(e.target).length === 0) { // и не по его дочерним элементам
			$('.question-button').removeClass('active');
		}
	});
	$(window).scroll(function () {
        if ($(this).scrollTop() > 500) {
            $('#scroller').fadeIn();
        } else {
            $('#scroller').fadeOut();
        }
    });
    $('#scroller').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });

	if($(window).width()<=1124) {
		$('.menu-item-has-children').append($('<a class="mob_menu_toggle" href="#"></a>'));

	}

		$('.menu-item-has-children').on('click', '>.mob_menu_toggle',  function (e) {


			winWidth = $(window).width()
			if(winWidth<=1124) {
				$('.menu-item-has-children span').each(function(){
					if(!$(this).text())
						$(this).remove();
				});

			/*if (e.target.closest('.menu-item-has-children:not(.menu-item-4222):not(.menu-item-14951)')) {
				$(this).find('> a:first-child').toggleClass('active');
				$(this).find('> span:first-child').toggleClass('active');
				$(this).find('> .sub-menu:last-child').slideToggle({
					duration: 0,
					easing: "easeOutQuad",
					start: function () {
						jQuery(this).css('display', 'flex');
					},
				})
				return false;
			}*/

			/*$(this).find('> a:first-child').toggleClass('active');
			$(this).find('> span:first-child').toggleClass('active');*/
			$(this).toggleClass('active');
			$(this).parent().find('> .sub-menu').slideToggle({
				duration: 0,
				easing: "easeOutQuad",
				start: function () {
					jQuery(this).css('display', 'flex');
				},
			})

			}

		});



    // $('.menu-item-has-children:not(.menu-item-4222):not(.menu-item-14951)').on('click', function(){
    // 	$(this).find('a').toggleClass('active');
    // 	$(this).find('.sub-menu').slideToggle()
    // });
    // $('.menu-item-4222').on('click', function(e){
	//
	// 	if (e.target.closest('.menu-item-has-children:not(.menu-item-4222)')) {
	// 		return false;
	// 	}
	//
	// 	console.log('Clicked!');
    // 	$(this).find('a').toggleClass('active');
    // 	$(this).find('.sub-menu').first().slideToggle({
	// 		  duration: 200,
	// 		  easing: "easeOutQuad",
	// 		  start: function() {
	// 		    jQuery(this).css('display','flex');
	// 		  },
	// 		})
    // });
    // $('.menu-item-14951').on('click', function(){
	// 	console.log('Clicked!');
    // 	$(this).find('a').toggleClass('active');
    // 	$(this).find('.sub-menu').first().slideToggle({
	// 		  duration: 200,
	// 		  easing: "easeOutQuad",
	// 		  start: function() {
	// 		    jQuery(this).css('display','flex');
	// 		  },
	// 		})
    // });





    // $('.menu-item-has-children:not(.menu-item-14951)').on('click', function(){
    // 	$(this).find('a').toggleClass('active');
    // 	$(this).find('.sub-menu').slideToggle()
    // });
    // $('.menu-item-14951').on('click', function(){
	// 	console.log('Clicked!');
    // 	$(this).find('a').toggleClass('active');
    // 	$(this).find('.sub-menu').first().slideToggle({
	// 		  duration: 200,
	// 		  easing: "easeOutQuad",
	// 		  start: function() {
	// 		    jQuery(this).css('display','flex');
	// 		  },
	// 		})
    // });

	function lazy(){
		var wTop = $(window).scrollTop(),
			wBot = $(window).scrollTop()+$(window).height(),
			wWidth = $(window).width(),
			k = 200;
		$('.lazy').each(function(){
			var src = $(this).data('src'),
				pos = $(this).offset().top,
				show = false;

			if ($(this).hasClass('for-have')){
				if(wWidth>768 && $(this).hasClass('for-pc'))
					show = true;
				else if(wWidth<=768 && $(this).hasClass('for-tablet') && wWidth>480)
					show = true;
				else if(wWidth<=480 && $(this).hasClass('for-mobile'))
					show = true;
			} else{
				show = true;
			}
			if((pos>=wTop-k) && (pos<=wBot+k) && show){
				$(this).attr('src', src);
			}
		});

		$('.lazy-bg').each(function(){
			var src = $(this).data('src'),
				pos = $(this).offset().top,
				show = false;

			if ($(this).hasClass('for-have')){
				if(wWidth>768 && $(this).hasClass('for-pc'))
					show = true;
				else if(wWidth<=768 && $(this).hasClass('for-tablet') && wWidth>480)
					show = true;
				else if(wWidth<=480 && $(this).hasClass('for-mobile'))
					show = true;
			} else{
				show = true;
			}
			if((pos>=wTop-k) && (pos<=wBot+k) && show){

				$(this).css('background-image', 'url('+src+')');
			}
		});
	}
	lazy();
	$(window).scroll(function(){
		lazy();
	});
	$(window).click(function(){
		lazy();
	});

	/*$('.content__filters').on('click', function (event) {
		if (event.target.classList.contains('content__filter')) {
			var filters = $('.content__filter');
			for (var i = 0; i < filters.length; i++) {
				if (event.target === filters[i]) {
					filters.eq(i).addClass('active');
					continue;
				}

				filters.eq(i).removeClass('active');
			}
		}
	});*/

$('.banner').addClass('loaded');

var sliderfunc = setInterval(function() {
	var count = $('.banner').length;
	if(count>1){
		let index = $('.slider-nav-item.active').index();
		let move = 0;
		if ( index == 0 ) {
			$('.slider-nav-item').eq(1).addClass('active').siblings().removeClass('active');
			move = 100;
		} else {
			$('.slider-nav-item').eq(0).addClass('active').siblings().removeClass('active');
			move = 0;
		}
		$('.banner').css('transform', 'translateX(-' + move + '%)');
	}
}, 10000);

$('.slider-nav-item').on('click', function() {
    $(this).addClass('active').siblings().removeClass('active');
    let index = $(this).index();
    let move = index * 100;
    $('.banner').css('transform', 'translateX(-' + move + '%)');
    clearInterval(sliderfunc);
});

// var headerOffsetY = $('.header__nav').offset().top;
// $(window).on('scroll', function () {
// 	if ($(this).scrollTop() > headerOffsetY) {
// 		$('.header').addClass('header--fixed');
// 	} else {
// 		$('.header').removeClass('header--fixed');
// 	}
// });

$('.header__button').click(function () {
	$(this).toggleClass('active');
	$('body').toggleClass('mobile-menu-active');
	$('.header__nav').slideToggle();
});


if ($("div").hasClass("options__tabs")) {

        $.getScript("/wp-content/themes/parus/js/mixitup.min.js")
        .done(function() {
            //console.log('mixitup загрузилась');

                var containerEl = $('.content__tours');
                var mixer = mixitup(containerEl, {});
            $('.options__tab').on('click', function(){
            	$('.options__tab').removeClass('active')
            	$(this).addClass('active')
            });

        })
        .fail(function() {
            console.log('mixitup не загрузилась');
        });
}
var slider = $('.slider-hero');
if (slider) {
	$(window).resize(function () {
		initSlider();
	});

	function initSlider() {
		var numberOfSlidesInRow = 4;
		// 		if ($(window).width() <= 576) {
		// 			numberOfSlidesInRow = 2;
		// 		} else if ($(window).width() <= 768) {
		// 			numberOfSlidesInRow = 3;
		// 		}

		var currentSlide = 0;
		//console.log(document.querySelector('.slider-hero').clientWidth)
		var sliderWidth = slider.width();
		slider.width(sliderWidth);

		var slidesNumber = $('.slider__images-inner').children().length - 1;

		if (slidesNumber <= numberOfSlidesInRow) {
			$('.slider__prev').hide();
			$('.slider__next').hide();
		}
		
		
		
		// 		else {
			var slideWidth =
				sliderWidth / numberOfSlidesInRow - (10 / numberOfSlidesInRow) * (numberOfSlidesInRow - 1);

			$('.slider__images-inner').width(slideWidth * slidesNumber + 10 * slidesNumber);
			$('.slider__images-inner').children().width(slideWidth);

			$('.slider__prev').click(prevSlide);
			$('.slider__next').click(nextSlide);

			var offset = slideWidth + 10;

			function changeSlide(slideId) {
				var currentOffset = -slideId * offset;
				$('.slider__images-inner').css('transform', 'translateX(' + currentOffset + 'px)');
			}

			function prevSlide() {
				/*if (currentSlide > 0) {
					currentSlide--;
				}*/
				$('.slider__images-inner').children().last().prependTo($('.slider__images-inner'));
				changeSlide(currentSlide);
			}

			function nextSlide() {
				/*if (currentSlide + numberOfSlidesInRow < slidesNumber) {
					currentSlide++;
				}*/
				$('.slider__images-inner').children().first().appendTo($('.slider__images-inner'));
				changeSlide(currentSlide);
			}
// 		}
	}

	initSlider();
}

// MODAL
$('.modal').on('click', function (event) {
	var modalClose = $('.modal__close');
	modalClose.each(function () {
		if (event.target == this) {
			$('.modal').hide();
			$('.modal__content--image').hide();
			$('.modal__content--callback').hide();
			$(document.body).css('overflow', 'visible');
		}
	});

	var modalCloseImg = $('.modal__close img');
	modalCloseImg.each(function () {
		if (event.target == this) {
			$('.modal').hide();
			$('.modal__content--image').hide();
			$('.modal__content--callback').hide();
			$(document.body).css('overflow', 'visible');
		}
	});

	var modalLink = $('.more_popup__filter');
	modalLink.each(function () {
		if (event.target == this) {
			 location=event.target.href;
		}
	});

	if (event.target === $('.modal')[0]) {
		$('.modal').hide();
		$('.modal__content--image').hide();
		$('.modal__content--callback').hide();
		$(document.body).css('overflow', 'visible');
	}
});

$(document.body).keydown(function (event) {
	if (event.key === 'Escape') {
		$('.modal').hide();
		$(document.body).css('overflow', 'visible');
	}
});

	function closeModal() {
		$('.modal').hide();
		$('.modal__content--image').hide();
		$('.modal__content--callback').hide();
		$(document.body).css('overflow', 'visible');
	}

	function openModal(jqueryElement, callback) {
		$(jqueryElement).show();
		$('.modal').fadeIn(700, function () {
			callback && callback();
		});
		$(document.body).css('overflow', 'hidden');
	}

	// MODAL - GROUP TOUR
	var modalImgs = $('.content__image-wrapper [modal-img-id]');
	var modalImgsNumber = modalImgs.length;
	var modalImgToOpenNum = 0;
	if (modalImgsNumber) {
		// var newModalImgs = modalImgs.clone().attr('style', '').attr('class', '');
		var newModalImgs = $('.modal-images-fullsize')
			.children()
			.clone()
			.attr('style', '')
			.attr('class', '');
		newModalImgs.not(newModalImgs[0]).hide();
		$('.modal__gallery').prepend(newModalImgs);

		$('[modal-img-id]').on('click', function () {
			modalImgToOpenNum = $(this).attr('modal-img-id');
			newModalImgs.show();
			newModalImgs.not(newModalImgs[modalImgToOpenNum]).hide();
			currentImgCounter = +modalImgToOpenNum;

			$('.modal__gallery img').each(function(){
				$(this).attr('src', $(this).data('src'));
			});

			if (currentImgCounter === 0) {
				$('.prev-img-button').css('opacity', '0.5');
				$('.next-img-button').css('opacity', '1');
			} else if (currentImgCounter === modalImgsNumber - 1) {
				$('.next-img-button').css('opacity', '0.5');
				$('.prev-img-button').css('opacity', '1');
			} else {
				$('.prev-img-button').css('opacity', '1');
				$('.next-img-button').css('opacity', '1');
			}

			openModal($('.modal__content--image'), function () {
				$('body').click(function (e) {
					// if(e.target)
					if (
						!e.target.getAttribute('src') &&
						e.target.getAttribute('class') !== 'next-img-button' &&
						e.target.getAttribute('class') !== 'prev-img-button'
					) {
						closeModal();
					}
				});
			});
		});

		var currentImgCounter = +modalImgToOpenNum;
		var active = false;

		function prevImg() {
			if (!active) {
				$('.next-img-button').css('opacity', '1');
				active = true;

				$(newModalImgs[currentImgCounter]).animate(
					{
						left: '100%',
					},
					300,
					function () {
						$(this).hide().css('left', '0');
						if (currentImgCounter === 0) {
							currentImgCounter = newModalImgs.length-1;
						} else {
							currentImgCounter--;
						}
						$(newModalImgs[currentImgCounter])
							.css('left', '-100%')
							.show()
							.animate(
								{
									left: 0,
								},
								300,
								function () {
									active = false;
								}
							);
					}
				);
			}
		}

		function nextImg() {
			if (!active) {
				active = true;

				$(newModalImgs[currentImgCounter]).animate(
					{
						left: '-100%',
					},
					300,
					function () {
						$(this).hide().css('left', '0');
						
						if (currentImgCounter === newModalImgs.length - 1) {
							currentImgCounter = 0;
						} else {
							currentImgCounter++;
						}

						$(newModalImgs[currentImgCounter])
							.css('left', '100%')
							.show()
							.animate(
								{
									left: 0,
								},
								300,
								function () {
									active = false;
								}
							);
					}
				);
			}
		}

		$('.prev-img-button').click(prevImg);
		$('.next-img-button').click(nextImg);
	}

	// MODAL - HEADER
	$('#header__callback').on('click', function (e) {
		e.preventDefault();
		openModal($('.modal__content--callback_clear'));
	});

	$('.content__filter-more').click(function(e){
		e.preventDefault();
		openModal($('.modal__content--more'));
	});
	
	$('.robo__hint').click(function(e){
		e.preventDefault();
		openModal($('.modal__content--robokassa'));
	});



	// Tickets plus/minus number
	$('.form__input-wrapper').each(function () {
		var spinner = jQuery(this);
		var input = spinner.find('.form__input--number');
		var btnUp = spinner.find('.form__number-up');
		var btnDown = spinner.find('.form__number-down');
		var min = input.attr('min');

		btnUp.click(function () {
			var oldValue = parseFloat(input.val());
			var newVal = oldValue + 1;

			spinner.find('input').val(newVal);
			spinner.find('input').trigger('input');
		});

		btnDown.click(function () {
			var oldValue = parseFloat(input.val());

			if (oldValue <= min) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue - 1;
			}

			spinner.find('input').val(newVal);
			spinner.find('input').trigger('input');
		});
	});
	function declOfNum(number, words) {
	    return words[(number % 100 > 4 && number % 100 < 20) ? 2 : [2, 0, 1, 1, 1, 2][(number % 10 < 5) ? Math.abs(number) % 10 : 5]];
	}

	// ORDER-FORM - SUM
	$('.form').on('input', function () {
		var totalAmount = 0;
		var totalCount = 0;
		$('.form__input--number').each(function () {
			var inputAmountContent = $(this).parent().next().text();
			var inputAmount = parseInt(inputAmountContent);

			var inputAmountMultiply = $(this).val() * inputAmount;

			totalCount+= Number($(this).val());
			totalAmount += inputAmountMultiply;
			if (Number($(this).val() > 0)) {
				$(this).parent('.form__input-wrapper').addClass('blue');
			} else {
				$(this).parent('.form__input-wrapper').removeClass('blue');
			}
		});

		var totalAmountField = $('.form__label--summary').find('.form__input');
		$('[name=promo]').keyup();
		$('[name=true_price]').val(totalAmount);
		$('.t_price').html(totalAmount);
		$('.t_count').html(totalCount);
		val = declOfNum(totalCount, ['билет', 'билета', 'билетов']);
		$('.tickets').html(val);
		totalAmountField.val(totalAmount);
		updateSalePrice();
	});

	if($(window).width()<501){
		$('.post_tours_slider').slick({
			dots: true,
			arrows: false,
			slidesToShow:1
		});
	}


	$('.form__select--tours').change(function () {
		var option = $('.form__select--tours option:selected');
		$('#order_form-page').data('crm', option.val());
		$('[name=sold_childs]')
			.parent()
			.parent()
			.find('.form__text--price')
			.text(option.data('price_childs') + ' руб.');
		$('[name=sold_school]')
			.parent()
			.parent()
			.find('.form__text--price')
			.text(option.data('price_school') + ' руб.');
		$('[name=sold_students]')
			.parent()
			.parent()
			.find('.form__text--price')
			.text(option.data('price_students') + ' руб.');
		$('[name=sold_adults]')
			.parent()
			.parent()
			.find('.form__text--price')
			.text(option.data('price_adults') + ' руб.');
		$('[name=sold_old]')
			.parent()
			.parent()
			.find('.form__text--price')
			.text(option.data('price_old') + ' руб.');

		$('[name=title]').val(option.text());
		$('[name=price_adults]').val(option.data('price_adults'));
		$('[name=price_childs]').val(option.data('price_childs'));
		$('[name=price_old]').val(option.data('price_old'));
		$('[name=price_school]').val(option.data('price_school'));
		uploadDates();
	});
	$('.form__select--tours').change();

	setTimeout(function(){
		/*$('.content__tour').each(function () {
			var id = $(this).data('crm-id'),
				card = $(this);
			jQuery.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				data: 'action=tour_fields&id=' + id,
				success: function (data) {
					var obj = eval('(' + data + ')');
					//card.find('#min_cost').text(obj.min_price + ' руб/чел');
					card.find('#count_tickets').text(obj.tickets);
				},
			});
		});*/
		var arrIds = '';
		$('.content__tour').each(function () {
			var id = $(this).data('crm-id'),
				wp_id = $(this).data('wp-id');
			if(id && id!='undefined')
				arrIds += wp_id+',';

			/*jQuery.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				data: 'action=tour_fields&id=' + id,
				success: function (data) {
					var obj = eval('(' + data + ')');
					//card.find('#min_cost').text(obj.min_price + ' руб/чел');
					card.find('#count_tickets').text(obj.tickets);
				},
			});*/
		});
		jQuery.ajax({
			type: 'POST',
			url: '/wp-admin/admin-ajax.php',
			data: 'action=tour_fields&ids=' + arrIds,
			success: function (data) {
				var obj = eval('(' + data + ')');
				
				for (const [key, value] of Object.entries(obj)) {
					$('[data-wp-id='+key+'] .count_tickets').text(value.tickets);
				}
			},
		});
				   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
					   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
					   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

				   ym(16828501, "init", {
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true,
						webvisor:true
				   });
if ($('#video_after_gates').length) {
						let videosrc = $('#video_after_gates').data('src');
						$('#video_after_gates').html('<iframe style="width: 100%;height: 440px;" src="' + videosrc + '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
					}
	       var count_scripts = 0;
			$(document).on('mousemove touchstart scroll', 'body', function(){


				if (++count_scripts < 2) {

					var rate_src = 'https://yandex.ru/sprav/widget/rating-badge/64817349525?type=rating';
							$('.ya_rate').each(function(){
								$(this).attr('src', rate_src).show();
							});
							$('.rate_block').each(function(){
								$(this).append($('<iframe src="https://yandex.ru/sprav/widget/rating-badge/64817349525?type=rating" width="150" height="50" frameborder="0"></iframe>'));
							});
							(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
					new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
					j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
					'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
					})(window,document,'script','dataLayer','GTM-N8Q34KX');

					


		    function handleIntersectioncatalogitemlist(entries) {
		      entries.map((entry) => {
		        if (entry.isIntersecting) { 
var node='<i class="icon">                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">                                <g clip-path="url(#clip0_2_41)">                                    <path d="M7.50002 13.9865C7.42414 13.9865 7.34829 13.9669 7.28032 13.9276C7.20649 13.885 5.45246 12.8666 3.67327 11.3321C2.61876 10.4227 1.777 9.52061 1.17144 8.65108C0.387805 7.52591 -0.00626644 6.44362 9.09643e-05 5.43426C0.00753236 4.25975 0.428205 3.1552 1.18471 2.32405C1.95398 1.4789 2.9806 1.01349 4.07551 1.01349C5.47874 1.01349 6.76168 1.79952 7.50005 3.0447C8.23841 1.79955 9.52135 1.01349 10.9246 1.01349C11.959 1.01349 12.9459 1.43343 13.7036 2.19597C14.5352 3.03277 15.0077 4.21513 14.9999 5.43983C14.9936 6.44743 14.5921 7.52808 13.8067 8.6517C13.1993 9.52079 12.3587 10.4224 11.3083 11.3316C9.53565 12.866 7.79422 13.8844 7.72094 13.927C7.65265 13.9666 7.57631 13.9865 7.50002 13.9865V13.9865Z" fill="#A5A5A5"></path>                                </g>                            </svg>                        </i>';
				if(!$(entry.target).find('.icon').length)
				entry.target.insertAdjacentHTML("afterbegin", node);//console.log(node);
		 		//entry.target.outerHTML='';
		        }
		      });
		    }

		    const catalogitemlist = document.querySelectorAll('.wish-btn');
		    const observercatalogitemlist = new IntersectionObserver(
		      handleIntersectioncatalogitemlist,
		      { rootMargin: "100px" }
		    );
		    catalogitemlist.forEach(catalogitem => observercatalogitemlist.observe(catalogitem));



					try {
						ym(16828501, 'getClientID', function(clientID) {
						  $('#clientID').val(clientID);
						});
					}
					catch (e) {
					   // инструкции для обработки ошибок
					   console.log('error' + e); // передать объект исключения обработчику ошибок
					}
				}
				/*$('#ya_frame').html('<iframe src="https://yandex.ru/sprav/widget/rating-badge/64817349525?type=rating" width="150" height="50" frameborder="0"></iframe>');*/
			});
			
	}, 4000);

	uploadDates();
	function uploadDates() {
		if ($('#order_form-page').data('crm')) {
			var id = $('#order_form-page').data('crm');
			//console.log(id);
			jQuery.ajax({
				type: 'POST',
				url: '/wp-admin/admin-ajax.php',
				data: 'action=tour_tickets&id=' + id,
				success: function (data) {

					var parsed = JSON.parse(data);
					 console.log(parsed.dates);
					/*parsed.dates = parsed.dates.sort(function(a, b) {
						return b.tickets - a.tickets;
					});*/
					console.log('parsed', parsed);
					window.dates = parsed;

					//window.dates = eval('(' + data + ')');
					$('#order_form-page [type=date]')
						.val(window.dates.min_date)
						.attr('min', window.dates.min_date)
						.attr('max', window.dates.max_date);
					$('#order_form-page [type=date]').change();
					
					let event = new Event("dates_loaded", {bubbles: true});
					document.dispatchEvent(event);
				},
			});

		}
	}

	$('#order_form-page [type=date]').change(function () {
		//console.log('dates' + window.dates.dates);
		var val = $(this).val(),
			options = '',
			options_mosk = '';
			options_nevs = '';
		console.log(window.dates);
		window.dates.dates.forEach((element) => {
			if (val == element.date) {
				if(element.time==element.a1){
					a = 'a1';
					options_mosk += '<div class="tickets_addr__item"'+
						'data-id="'+element.id+'" '+
						'data-crm="'+element.tour_id+'" '+
						'data-time="'+element.time+'" '+
						'data-ticks="'+element.tickets+'" '+
						'data-a="a1" '+
					'>'+element.time+'</div>';
				} else {
					a = 'a2';
				}
				
				if(!element.a1 || element.a1 =='undefined'){
					options_mosk += '<div class="tickets_addr__item"'+
						'data-id="'+element.id+'" '+
						'data-crm="'+element.tour_id+'" '+
						'data-time="'+element.time+'" '+
						'data-ticks="'+element.tickets+'" '+
						'data-a="a1" '+
					'>'+element.time+'</div>';
				}
				options +=
					'<option value="' +
					element.id +
					'" data-time="' +
					element.time +
					'" data-a1="' +
					element.a1 +
					'" data-a2="' +
					element.a2 +
					'" data-a="' +
						a +
					'" data-ticks="' +
					element.tickets +
					'">' +
					element.time +
					'</option>';

				if(element.a1 && element.a1!='undefined' && element.a1!=element.time){
					options +=
						'<option value="' +
						element.id +
						'" data-time="' +
						element.a1 +
						'" data-a1="' +
						element.a1 +
						'" data-a="' +
						'a1' +
						'" data-a2="' +
						element.a2 +
						'" data-ticks="' +
						element.tickets +
						'">' +
						element.a1 +
						'</option>';
						

				}

				if(element.a2 && element.a2!='undefined' && element.a2!=element.time){
					options +=
						'<option value="' +
						element.id +
						'" data-time="' +
						element.a2 +
						'" data-a1="' +
						element.a1 +
						'" data-a="' +
						'a2' +
						'" data-a2="' +
						element.a2 +
						'" data-ticks="' +
						element.tickets +
						'">' +
						element.a2 +
						'</option>';
						
						options_nevs += '<div class="tickets_addr__item"'+
						'data-id="'+element.id+'" '+
						'data-crm="'+element.tour_id+'" '+
						'data-time="'+element.a2+'" '+
						'data-ticks="'+element.tickets+'" '+
						'data-a="a2" '+
					'>'+element.a2+'</div>';
				}
			}
		});
		if(window.dates.dates[0].a1 == window.dates.dates[0].time)
			$('#a1').click();

		if(window.dates.dates[0].a2 == window.dates.dates[0].time)
			$('#a2').click();
		$('#addr_nevskiy .tickets_addr__items').html(options_nevs);
		$('#addr_moskovskiy .tickets_addr__items').html(options_mosk);
		$('#addr_moskovskiy .tickets_addr__items>*:eq(0)').click();
		
		if(!options_mosk){
			$('.tickets_addr__note').text('Нет билетов');
		}
		/*$('#order_form-page [name=trip]').html(options);
		$('#order_form-page [name=trip]').change();*/
		
	});
	$('.pay_info__item_title').click(function(){
		$(this).toggleClass('active');
	});
	
	$('body').on('click', '.tickets_addr__item', function(e){
		$('.tickets_addr__item').removeClass('active');
		$(this).addClass('active');
		
		var ticks = $(this).data('ticks'),
			note = $('<div class="tickets_addr__note"></div>'),
			a = $(this).data('a'),
			crm_id = $(this).data('crm'),
			t = $(this).data('time'),
			v = $(this).data('id');
			
		$('#'+a).click();
		
		$('[name="trip"]').val(v);
		console.log($('[name="trip"]').val());
		
		if($('[name=id_crm]').val() != crm_id){
			console.log('id crm changed');
			$('[name=id_crm]').val(crm_id);
			$('#order_form-page').data('crm', crm_id);
			$('#all-prices').addClass('loading');
			$.ajax({
				type : 'POST',
				url : "/wp-admin/admin-ajax.php",
				beforeSend : function( xhr ) {
					$('.submit_kp__btn').text('Загрузка...');
				},
				data : {
					action : 'get_current_prices',
					id: crm_id
				},
				success : function( data ){
					var j = JSON.parse(data);
					if(j.adult[1]){
						$('.form__p_vzroslie').text(j.adult[1]);
						$('.form__p_vzroslie').parent().next().text(j.adult[0]+' руб.');
						$('[name="price_adults"]').val(j.adult[1]);
					} else {
						$('.form__p_vzroslie').text(j.adult[0]);
						$('.form__p_vzroslie').parent().next().text('');
						$('[name="price_adults"]').val(j.adult[0]);
					}
					
					if(j.adult_i[1]){
						$('.form__p_vzroslie_inostrancy').text(j.adult_i[1]);
						$('.form__p_vzroslie_inostrancy').parent().next().text(j.adult_i[0]+' руб.');
						$('[name="price_adults_for"]').val(j.adult_i[1]);
					} else {
						$('.form__p_vzroslie_inostrancy').text(j.adult_i[0]);
						$('.form__p_vzroslie_inostrancy').parent().next().text('');
						$('[name="price_adults_for"]').val(j.adult_i[0]);
					}
					
					if(j.kid[1]){
						$('.form__p_doshkolniki').text(j.kid[1]);
						$('.form__p_doshkolniki').parent().next().text(j.kid[0]+' руб.');
						$('[name="price_childs"]').val(j.kid[1]);
					} else {
						$('.form__p_doshkolniki').text(j.kid[0]);
						$('.form__p_doshkolniki').parent().next().text('');
						$('[name="price_childs"]').val(j.kid[0]);
					}
					
					if(j.old[1]){
						$('.form__p_pensionery').text(j.old[1]);
						$('.form__p_pensionery').parent().next().text(j.old[0]+' руб.');
						$('[name="price_old"]').val(j.old[1]);
					} else {
						$('.form__p_pensionery').text(j.old[0]);
						$('.form__p_pensionery').parent().next().text('');
						$('[name="price_old"]').val(j.old[0]);
					}
					
					if(j.school[1]){
						$('.form__p_shkolniki').text(j.school[1]);
						$('.form__p_shkolniki').parent().next().text(j.school[0]+' руб.');
						$('[name="price_school"]').val(j.school[1]);
					} else {
						$('.form__p_shkolniki').text(j.school[0]);
						$('.form__p_shkolniki').parent().next().text('');
						$('[name="price_school"]').val(j.school[0]);
					}
					
					if(j.student[1]){
						$('.form__p_studenty').text(j.student[1]);
						$('.form__p_studenty').parent().next().text(j.student[0]+' руб.');
						$('[name="price_students"]').val(j.student[1]);
					} else {
						$('.form__p_studenty').text(j.student[0]);
						$('.form__p_studenty').parent().next().text('');
						$('[name="price_students"]').val(j.student[0]);
					}
					
					console.log(j);
					$('#all-prices').removeClass('loading');
				}
			});
		}
		
		$('.tickets_addr__note').remove();
		if (ticks) note.text('Осталось ' + ticks + ' билетов');
		else note.text('Нет билетов');
		$(this).parent().parent().append(note);
		
		$('#date_and_time').val(
			$('#order_form-page [type=date]').val() + ' ' + t
		);
	});

	/*$('#order_form-page').on('change', '[name=trip]', function(){
		var a = $("option:selected", this).data('a');
		//console.log(a);
		if(!$('[name=adr]:checked').is('#'+a))
			$('[name=adr]#'+a).click();
	});*/

	/*$('[name=adr]').change(function(){
		var a = $(this).attr('id');
		if(a!=$("[name=trip] option:selected").data('a')){
			$('[name=trip] option').each(function(){
				if($(this).data('a') == a){
					$(this).prop('selected', true);
					return false;
				}
			});
		}

		$('#date_and_time').val(
			$('#order_form-page [type=date]').val() + ' ' + $('[name=trip]').find('option:selected').text()
		);
		//console.log($(this).prop('selected', true).text())
	});*/

	/*$('#order_form-page [name=trip]').change(function () {
		var ticks = $(this).find('option:selected').data('ticks');
		if (ticks) $('.form__tickets-left').text('Осталось ' + ticks + ' бил.');
		else $('.form__tickets-left').text('На эту дату нет билетов');

		$('#date_and_time').val(
			$('#order_form-page [type=date]').val() + ' ' + $(this).find('option:selected').text()
		);
	});*/

	jQuery('.form__submit--buy').click(function (e) {
		var error = 0,
			btn = $(this);
		error = checkorderform();
		if (!error) {
			$('.page-loader').show();
			jQuery.post(
				'/wp-content/themes/parus/handler/buy_form.php',
				jQuery('#order_form-page').serialize(),
				function (response) {
					$('.page-loader').hide();
					var obj = JSON.parse(response);
					if (obj.result != 'ok') {
						return false;
					} else {
						if(btn.hasClass('single_form')){
							try {
							   yaCounter16828501.reachGoal('2headorder2');
							}
							catch (e) {
							   // инструкции для обработки ошибок
							   console.log(e); // передать объект исключения обработчику ошибок
							}

						}

						jQuery('#order_form-page').attr('action', obj.pay_url);
						jQuery('#order_form-page').submit();
						return true;
					}

				}
			);
			return false;
		}
		return false;
	});

 // tour slider
 //jQuery('.tours-slider').slick({
// slidesToShow: 1,
//	slidesToScroll: 1,
//	swipe: true,
  //       infinite: true,
 //	dots: true,
 //	arrows: false,
 //	autoplay: true,
 //	mobileFirst: true,

//  responsive: [
//   {
 //     breakpoint: 360,
 //     settings: "unslick"
  // }
 // ]

//});


// tour slider end



	jQuery('.form__submit--request').click(function (e) {
		var error = 0;
		e.preventDefault;
		error = checkorderformrequest();
		$('.form__label--summary').prepend('<img src="/wp-content/themes/parus/assets/images/Spinner-1s-200px.svg" alt="preloader" class="form__submit__preloader">');
		$('.form__submit__preloader').remove();

		if (!error) {
			$('.page-loader').show();
			jQuery.post(
				'/wp-content/themes/parus/handler/order_form.php',
				jQuery('#order_form-page').serialize(),
				function (response) {
					var obj = JSON.parse(response);
					if (!obj.success) return false;
						try {
						   yaCounter16828501.reachGoal('zayavka');
						}
						catch (e) {
						   // инструкции для обработки ошибок
						   console.log(e); // передать объект исключения обработчику ошибок
						}

					jQuery('#order_form-page').attr('action', obj.pay_url);
					//openModal($('.modal__content--success'));
					// openModal($('.modal__content--successreq'));
					$('.page-loader').hide();
					success_modal_block();					
					return true;
				}
			);
			return false;
		}
		return false;
	});

	jQuery('.form__number-up,.form__number-down').click(function(){
		var people_count = 0;
		jQuery('.form__input--number').each(function () {
			people_count += parseInt(jQuery(this).val());
		});
		console.log(people_count);
		if (people_count!=0)
			jQuery('.error_form_mes_time').remove();
		
		$('.neva_form').change();
	});
$(document).on('click','.form__input.alert', function() {
	$(this).removeClass('alert')
	$(this).next('.error_form_mes').remove()
})

	function checkorderform() {
		var ParForm = jQuery('#order_form-page'); //jQuery(this);
		console.log('checkorderform')
		$('.error_form_mes').remove();
		var phone = ParForm.find('[name=phone]').val();
		var name = ParForm.find('[name=name]').val();
		var mail = ParForm.find('[name=mail]').val();
		var people_count = 0;
		var error = 0;
		var rePhone = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
		var reMail = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
		var validPhone = rePhone.test(phone);
		var validMail = reMail.test(mail);
		jQuery('.form__input--number').each(function () {
			people_count += parseInt(jQuery(this).val());
		});

		if (people_count === 0) {
			/*jQuery('.tours-content__form-title')
				.append(
					
				);*/
				$('<div class="error_form_mes error_form_mes_time ch_count">Выберите кол-во билетов</div>').insertAfter(jQuery('.tours-content__form-title'));
			/*setTimeout(function () {
				jQuery('.error_form_mes_time').remove();
			}, 2000);*/
			error = 1;
		} else {
			jQuery('.error_form_mes_time.ch_count').remove();
		}
		if(!name){
			jQuery('.fio_field')
				.append(
					'<div class="error_form_mes error_form_mes_time fio">Заполните поле</div>'
				);
			jQuery('.fio_field input').addClass('alert');
			error = 1;
		} else {
			jQuery('.error_form_mes_time.fio').remove();
			jQuery('.fio_field input').removeClass('alert');
		}

		if(!phone){
			jQuery('.phones_field')
				.append(
					'<div class="error_form_mes error_form_mes_time phones">Заполните поле</div>'
				);
			jQuery('.phones_field input').addClass('alert');


			error = 1;
		} else if(!validPhone) {
			jQuery('.phones_field')
				.append(
					'<div class="error_form_mes error_form_mes_time phones">Введите корректный номер</div>'
				);
			jQuery('.phones_field input').addClass('alert');


			error = 1;
		} else {
			jQuery('.error_form_mes_time.phones').remove();
			jQuery('.phones_field input').removeClass('alert')
		}

		if(mail && !validMail){
			jQuery('.email_field')
				.append(
					'<div class="error_form_mes error_form_mes_time mail">Введите корректный E-mail</div>'
				);
			jQuery('.email_field input').addClass('alert');


			error = 1;
		} else {
			jQuery('.error_form_mes_time.mail').remove();
			jQuery('.email_field input').removeClass('alert')
		}


		if (!phone || !name || people_count === 0  || validPhone || (mail && !validMail)) {
			jQuery('html, body').animate({ scrollTop: $('#order_form-page').offset().top-50 }, 'slow');
		}

		/*if (!phone) {
			displayErrorField(ParForm.find('[name=phone]'), 'Веедите номер телефона');
			error = 1;
		}

		if (!name) {
			displayErrorField(ParForm.find('[name=name]'), 'Введите свое имя');
			error = 1;
			ParForm.find('[name=name]').focus();
		}*/
		return error;
	}
	function checkorderformrequest() {
		var ParForm = jQuery('#order_form-page'); //jQuery(this);
		console.log('checkorderformrequest')
		$('.error_form_mes').remove();
		var phone = ParForm.find('[name=phone]').val();
		var name = ParForm.find('[name=name]').val();
		var mail = ParForm.find('[name=mail]').val();
		//var people_count = 0;
		var error = 0;
		var rePhone = /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
		var reMail = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
		var validPhone = rePhone.test(phone);
		var validMail = reMail.test(mail);
		// jQuery('.form__input--number').each(function () {
		// 	people_count += parseInt(jQuery(this).val());
		// });

		// if (people_count === 0) {
		// 	jQuery('[name="sold_childs"]')
		// 		.parent()
		// 		.parent()
		// 		.append(
		// 			'<div class="error_form_mes error_form_mes_time ch_count">Выберите кол-во билетов</div>'
		// 		);
		// 	error = 1;
		// } else {
		// 	jQuery('.error_form_mes_time.ch_count').remove();
		// }
		if(!name){
			jQuery('.fio_field')
				.append(
					'<div class="error_form_mes error_form_mes_time fio">Заполните поле</div>'
				);
			jQuery('.fio_field input').addClass('alert');
			error = 1;
		} else {
			jQuery('.error_form_mes_time.fio').remove();
			jQuery('.fio_field input').removeClass('alert');
		}


		if(!phone){
			jQuery('.phones_field')
				.append(
					'<div class="error_form_mes error_form_mes_time phones">Заполните поле</div>'
				);
			jQuery('.phones_field input').addClass('alert');


			error = 1;
		} else if(!validPhone) {
			jQuery('.phones_field')
				.append(
					'<div class="error_form_mes error_form_mes_time phones">Введите корректный номер</div>'
				);
			jQuery('.phones_field input').addClass('alert');


			error = 1;
		} else {
			jQuery('.error_form_mes_time.phones').remove();
			jQuery('.phones_field input').removeClass('alert')
		}
		if(mail && !validMail){
			jQuery('.email_field')
				.append(
					'<div class="error_form_mes error_form_mes_time mail">Введите корректный E-mail</div>'
				);
			jQuery('.email_field input').addClass('alert');


			error = 1;
		} else {
			jQuery('.error_form_mes_time.mail').remove();
			jQuery('.email_field input').removeClass('alert')
		}


		// if (!phone || !name || people_count === 0  || validPhone || (mail && !validMail)) {
		// 	jQuery('html, body').animate({ scrollTop: $('#order_form-page').offset().top-50 }, 'slow');
		// }

		/*if (!phone) {
			displayErrorField(ParForm.find('[name=phone]'), 'Веедите номер телефона');
			error = 1;
		}

		if (!name) {
			displayErrorField(ParForm.find('[name=name]'), 'Введите свое имя');
			error = 1;
			ParForm.find('[name=name]').focus();
		}*/
		return error;
	}
	$('input').on('input invalid', function() {
	    this.setCustomValidity('')
	    if (this.validity.valueMissing) {
	      this.setCustomValidity("Нет значения")
	    }
	    if (this.validity.typeMismatch) {
	      this.setCustomValidity("Не соответствует типу")
	    }
	    if (this.validity.patternMismatch) {
	      this.setCustomValidity("Не соответствует паттерну")
	    }
	})
	$('.contact_form, .call_form').submit(function (e) {
        e.preventDefault();
        let thisForm = $(this);

		$(this).find('.form__footer').prepend('<img src="/wp-content/themes/parus/assets/images/Spinner-1s-200px.svg" alt="preloader" class="form__submit__preloader">');
        $.ajax({
            type: "POST",
            url: "/wp-content/themes/parus/handler/contact_form.php",
            data: $(this).serialize()
        }).done(function () {
			$('.form__submit__preloader').remove();
            $('.modal').hide();
            $(document.body).css('overflow', 'visible');
            if (thisForm.hasClass('contact_page')) {
						try {
                			yaCounter16828501.reachGoal('6feedback6');
						}
						catch (e) {
						   // инструкции для обработки ошибок
						   console.log(e); // передать объект исключения обработчику ошибок
						}
            }
            if (thisForm.hasClass('call_form')) {
						try {
                			yaCounter16828501.reachGoal('callback-head');
						}
						catch (e) {
						   // инструкции для обработки ошибок
						   console.log(e); // передать объект исключения обработчику ошибок
						}
            }
            if (thisForm.hasClass('indiv_form')) {
						try {
			                yaCounter16828501.reachGoal('send-tour');
						}
						catch (e) {
						   // инструкции для обработки ошибок
						   console.log(e); // передать объект исключения обработчику ошибок
						}
            }
            if (thisForm.hasClass('tour_form')) {
						try {
			                yaCounter16828501.reachGoal('send-form-indiv');
			                yaCounter16828501.reachGoal('zayavka');
						}
						catch (e) {
						   // инструкции для обработки ошибок
						   console.log(e); // передать объект исключения обработчику ошибок
						}
            }
            closeModal();
            // openModal($('.modal__content--success'));
			success_modal_block();
        });
        return false;

    });

	/*$('.content__filter').click(function () {
		var tag = $(this).data('slug');
		$('.content__tour').show().addClass('iseeyou');
		$('.content__tour:not(.' + tag + ')').hide().removeClass('iseeyou');
		$('.iseeyou').css('margin-right','10px');
		$('.iseeyou:eq(2)').css('margin-right','0');
	});*/

	$('.phoneWatsaap.mobileShow,.phoneWatsaap.pcShow ').click(function(){yaCounter16828501.reachGoal('click-wa');});

	/*$('#order_form-page').change(function(){
		console.log('formchange');
		$('[name=promo]').keyup();
	});*/
	
	var input = $( '[name=promo]' ), timeOut;
	input.on( 'keyup', function () {
		if(input.val()){
			$('.promo-loader').addClass('active');
			clearTimeout( timeOut );
			timeOut = setTimeout( myfunc, 2000, $( this ).val() );
			$('#promo_ok').hide();
		} else {
			$('.promo-loader').removeClass('active');
		}
	});
	input.on( 'keydown', function () {
		clearTimeout( timeOut );
	});
	input.on( 'change', function () {
		if(!input.val()){
			$('.promo-loader').removeClass('active');
			$('#promo_ok').hide();
		}
	});
	function myfunc( value ) {
		jQuery.post('/wp-content/themes/parus/handler/validate_promo.php', {
			promo: value,
			data: jQuery('#order_form-page').serialize()
		}, function (response) {
			if ('ok' in response && response.ok == true) {
				console.log(response);
				var discount=parseInt(response.minus);
				$('#discount').attr('data-fulldiscount',discount);
				
				var t_price = parseInt(jQuery('[name=amount]').val())-discount;
				$('[name=amount]').val(t_price);
				$('.t_price').html(t_price);

				jQuery('#promo_ok').text(' Промокод действителен, скидка '+ discount +' рублей.').show().css('color','green');
				jQuery('#promo')
						.prop('readonly', true);
				updateSalePrice();
			} else {
				if(response.msg&&response.msg!='undefined')
					jQuery('#promo_ok').text(response.msg).show().css('color','red');
				else
					jQuery('#promo_ok').text(' Промокод не действителен.').show().css('color','red');

			}
			$('.promo-loader').removeClass('active');
		});
	}

	/*promocode_timeout = 0;
	$('[name=promo]').keyup(function () {
		clearTimeout(promocode_timeout);

		if (!(jQuery(this).val()))
		{
			return;
		}
		promocode_timeout = setTimeout(function () {
			jQuery.post('/wp-content/themes/parus/handler/validate_promo.php', {
				promo: jQuery('[name=promo]').val(),
				data: jQuery('#order_form-page').serialize()
			}, function (response) {
				if ('ok' in response && response.ok == true)
				{
					console.log(response);
				var discount=parseInt(response.minus);
					$('#discount').attr('data-fulldiscount',discount);
					var t_price = parseInt(jQuery('[name=amount]').val())-discount;
					$('[name=amount]').val(t_price);
					$('.t_price').html(t_price);

					jQuery('#promo_ok').text(' Промокод действителен, скидка '+ discount +' рублей.').show().css('color','green');
					jQuery('#promo')
							.prop('readonly', true);
					updateSalePrice();
				}
				else
				{
					jQuery('#promo_ok').text(' Промокод не действителен.').show().css('color','red');

				}
				});
		}, 500);
	});*/


	// $(document).click(function(){
	// 	console.log($(".gate-3").width());
	// });

	$('.review_slider--img_href').fancybox();

	// if($('#features').length > 0 && $(window).width() <= 768) {
	// 	if($('#order_form-page').length > 0) {
	// 		$('#order_form-page').after($('#features'));
	// 	} else if($('#tours').length > 0) {
	// 		$('#tours').after($('#features'));
	// 	}
	// }


	$('body').on('click', '.btn-group', function(){
		$(this).toggleClass('open');
	});

	if ($("#rev_form").length){

		$('.kind_of_staff select').multiselect({
	        nonSelectedText: 'Выберите экскусовода',
	 		numberDisplayed: 7,
	     	nSelectedText: ' - Элменетов выбрано',
	     	onChange: function(element, checked) {
	     		if (element.data('val') == 'othergid') {
	     			$('.reviews_form .text-gid').toggleClass('hide');
	     			$('.btn-group').removeClass('open');
	     		}
	     		$('.btn-group').removeClass('open');
	        }
	    });
		$('.kind_of_exc select').multiselect({
	        nonSelectedText: 'Какую экскурсию вы посетили?',
	 		numberDisplayed: 7,
	     	nSelectedText: ' - Элменетов выбрано',
	     	onChange: function(element, checked) {
	     		if (element.data('val') == 'otherexcurs') {
	     			$('.reviews_form .text-excurs').toggleClass('hide');
	     			$('.btn-group').removeClass('open');
	     		}
	     		$('.btn-group').removeClass('open');
	        }
	    });
	}

    $('.popup-input').on('focus', function() {
        $(this).next().addClass('active');
    });
    $('.popup-input').focusout( function() {
        if ($(this).val() === '') {
            $(this).next().removeClass('active');
        }
    });

    $(document).click( function(e){
	    if ( !$(e.target).closest('.btn-group').length ) {
	        $('.btn-group').removeClass('open');
	    }
	});



   	//Загрузчик/манипулятор фото
    var filestoupload = [];
    function previewFiles() {

    	var preview = document.querySelector('#preview');
    	var files = document.querySelector('input[type=file]').files;

    	function readAndPreview(file) {

		    // Make sure `file.name` matches our extensions criteria
		    if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
		    	var reader = new FileReader();
				if(file.size>5242880){
					alert('Максимальный размер файла не может превышать 5Мб');
				} else {
					reader.addEventListener("load", function() {
						var image = new Image();
						var z = document.createElement('div');
						z.innerHTML = file.name;
						image.height = 100;
						image.title = file.name;
						image.src = this.result;
						filestoupload.push(this.result)
						var div= document.createElement('div');
						var divdel= document.createElement('div');
						divdel.className='delete'
						divdel.innerHTML='X'
						div.className='fileprew'
						div.appendChild(divdel);
						div.appendChild(z);
						preview.appendChild(div);
						console.log('files to upload: ', filestoupload.length)
						console.log('file.name: ', file.name)
						console.log('file.size: ', file.size)

					}, false);
					reader.readAsDataURL(file);
				}
		    }
		}

		if (files) {
			[].forEach.call(files, readAndPreview);

		}

	}

	$('body').on("click", ".delete", function() {

		index=$(this).index();
		console.log('удаляем файл: ',index)
		filestoupload.splice(index, 1);
		$(this).parent().remove();
		console.log('files to upload: ', filestoupload.length);

	});



	$('.reviews_form').submit(function (e) {
        e.preventDefault();
        let thisForm = $(this);
		var name = thisForm.find('[name=name]').val();
		formData = new FormData(thisForm.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
		console.log('filestoupload.length ' + filestoupload.length)

		formData.append("file[]", filestoupload[0]);
        if(!name){
			$('.name_field input').addClass('alert');
			$('html, body').animate({ scrollTop: $('.reviews_form').offset().top-50 }, 'slow');
		}
		$('.page-loader').show();
        $.ajax({
            type: "POST",
            url: "/wp-content/themes/parus/handler/rivews_form.php",
	        contentType: false, // важно - убираем форматирование данных по умолчанию
	        processData: false, // важно - убираем преобразование строк по умолчанию
            data: formData
        }).done(function () {
			$('.reviews_form').trigger("reset");
            $('.modal').hide();
            $(document.body).css('overflow', 'visible');
            closeModal();
            openModal($('.modal__reviews--success'));
			$('.page-loader').hide();
        });
        return false;

    });








    $('.popup-input-file').on('change', function() {
        previewFiles();
    });





    // $(".popup-input-file").change(function() {
    //   readURL(this);
    // });

    $('.text-body').on('click', function(){
		$(this).toggleClass('open')
	})

    $('.review_slider--item .more').on('click', function(){
    	$(this).closest(".review_slider--item").find('.text-body').toggleClass('open');
	})

	/*$('.review_slider--item').each(function(){
		var $textBody = $('.text-body', this),
			$text = $('span', $textBody),
			$more = $('.more', this);

		if($textBody.height() <= '100') {
			$more.hide();
		}
	});*/
	

	
	$(document).scroll(function(){
		if($('.review_slider--item').is('.slick-slide') && !$('body').hasClass('reviews_fixed')){
			$('.review_slider--item .text-body').each(function(){
				var h = $(this).height()*1;
				if(h>84){
					$(this).addClass('text-body-scroll');
				}
			});
			$('body').addClass('reviews_fixed');
		}
		
	});
	
	if($('#rev_upload').length > 0) {
		//replaceRevUpload();

		$(window).resize(function(){
			//replaceRevUpload();
		});
	}

	function replaceRevUpload() {
		if($(window).width() <= 576) {
			$('#rev_form .form-right').append($('#rev_upload'));
		} else {
			$('#rev_form .form-left').append($('#rev_upload'));
		}
	}
	/*$.ajax({
        url: '/wp-admin/admin-ajax.php',
        type: 'POST',
        data: 'action=get_ny',
        beforeSend: function( xhr ) {

        },
        success: function( data ) {
			$('body').append(data);
        }
	});*/
	$('.content__filter[data-slug="novogodnie"]').insertAfter($('.content__filter[data-slug="grup-ekskursii"]'));
	if(!$('body').is('.home') && !$('body').is('.term-24') && !$('body').is('.term-9') && !$('.content--bus').is('.nosort')){
		items = $('#tours .content__tour');
		arItems = $.makeArray(items);
		arItems.sort(function(a, b) {
			//console.log($(a).data("first_date"));
			//return $(a).data("true-price") - $(b).data("true-price")
			return Date.parse($(a).data("first_date")) - Date.parse($(b).data("first_date"));
		});
		$(arItems).appendTo("#tours");
		$('[data-wp-id=15464]').prependTo($('#tours'));
	}
	

	if ($("div").hasClass("g-scrolling-carousel")) {
		$(".g-scrolling-carousel .items").gScrollingCarousel();
	}


	$('.review_answer_title').on('click', function() {
		$(this).next('.review_answer_txt').slideToggle();
		$(this).toggleClass('active');
	})

	$('.js-filter-toggle_sort').on('click', function() {
		$('.js-rank-parametrs').fadeToggle();
		$(this).toggleClass('active');
	})
	$('.js-filter-duration_sort').on('click', function() {
		$('.js-duration-parametrs').fadeToggle();
		$(this).toggleClass('active');
	})

	$(document).mouseup(function (e){ // событие клика по веб-документу
		var div = $(".js-duration-parametrs, .js-rank-parametrs"); // тут указываем ID элемента
		if (!div.is(e.target) // если клик был не по нашему блоку
		    && div.has(e.target).length === 0) { // и не по его дочерним элементам
			div.hide(); // скрываем его
		}
	});

	/* активация календаря*/
 	var count_dp = 0;
	$('.rent-start').on('click', function(){
		if (count_dp == 0) {
			$(this).daterangepicker({
				"locale": {
			        "direction": "ltr",
			        "format": "YYYY/MM/DD",
			        "separator": " - ",
			        "applyLabel": "Показать",
			        "cancelLabel": "Сбросить",
			        "fromLabel": "From",
			        "toLabel": "To",
			        "customRangeLabel": "Custom",
			        "daysOfWeek": [
			            "Вс",
			            "Пн",
			            "Вт",
			            "Ср",
			            "Чтв",
			            "Птн",
			            "Сб"
			        ],
			        "monthNames": [
			            "Январь",
			            "Февраль",
			            "Март",
			            "Апрель",
			            "Май",
			            "Июнь",
			            "Июль",
			            "Август",
			            "Сернтябрь",
			            "Октябрь",
			            "Ноябрь",
			            "Декабрь"
			        ],
			        "firstDay": 1
			    },
			    "timePickerIncrement": 0,
			    "linkedCalendars": false,
			    "showCustomRangeLabel": false,
			    "startDate": false,
			    "endDate": false
			}, function(start, end, label) {
				var st = start.format("YYYY/MM/DD"),
					en = end.format("YYYY/MM/DD");
					//console.log('New date range selected: ' + start.format('DD/MM/YYYY') + ' to ' + end.format('DD/MM/YYYY') + ')' );
					//console.log('New date range geted: ' + st + ' to ' + en + ')' );
					//var arr = getBusinessDays(start,end);
					//get_cards_for_date(arr)
			});

			count_dp++;
		}
	});

	/*получаем начало и конец периода выбранных дат*/
	function getBusinessDays(start_date, end_date) {
	    var start = new Date(start_date);
	    start.setDate(start.getDate() + 1);
	    var end = new Date(end_date);
	    end.setDate(end.getDate() + 1);
	    var current = start;
	    var dates = [];

		  while(current<=end)  {
		  	var date  = new Date(current);
		  	var date2 = date.toISOString().slice(0,10); // "2014-05-12"
		    dates.push('"' + date2 + '"'); // add date to array
		    current.setDate(current.getDate() + 1); // increase current date by 1 day
		  }

		  // console.log('start' + start)
		  // console.log('end' + end)
		  // console.log(dates)
	  	return dates;
	}

	/*!!!!!!! НЕ ПЕРЕДАЕТСЯ АРГУМЕНТ, КРОМЕ ВЫБОРА ПО ДАТАМ */
	function get_cards_for_date(arr='') {
		var content__tours = $('.content__tours'), //блок скарточками туров
			cards = $('.content__tour'), //карточки туров
            have_sale = $('input[name=have_sale]').prop('checked') ? 1 : 0, // скидка
            exclusive = $('input[name=exclusive]').prop('checked') ? 1 : 0, // эксклбюзив
            duration = $('input[name=duration]:checked').val(), // продолжительность
            have_sale2 = $('input[name=have_sale_popup]').prop('checked') ? 1 : 0, // скидка моб
            exclusive2 = $('input[name=exclusive_popup]').prop('checked') ? 1 : 0, // эксклбюзив моб
            sorts = $('input[name=sorts]:checked').val(), // сортировка
			array2 = arr.toString().split( ',' ); // параметры функции

   		console.log('array2 is ' + array2)
		cards.show();

		// фильтр
		cards.each(function() {
			$(this).css({'marginRight' : '10px'});

			if (array2 !=0) {
	            let stuff = $(this).data('stuff'); // дата-аттрибут (массив дат)
	            if (stuff) {
	            	var stuff2 = stuff.toString().split( ',' );

					if(stuff2.filter(value => array2.includes(value)) < 1) {
						$(this).hide();
					}
	            } else {
	            	$(this).hide();
	   			}
			}

			if(have_sale || have_sale2) {
				cards.not('[data-sale="1"]').hide();
			}

			if(exclusive || exclusive2) {
				cards.not('[data-exlusive="1"]').hide();
			}

			if (duration) {
				if (duration == '3') {
					$('.js-filter-duration_sort span').html('до 3-х часов');
					if ( $(this).data('duration') > 3.5 || !$(this).data('duration') ) $(this).hide();
				} else if(duration == '5') {
					$('.js-filter-duration_sort span').html('3-5 часов');
					if ($(this).data('duration') <= 3 || $(this).data('duration') >= 5.5 || !$(this).data('duration') ) $(this).hide();
				} else if(duration == 'more5') {
					$('.js-filter-duration_sort span').html('более 5 часов');
					if ($(this).data('duration') < 5 || !$(this).data('duration') ) $(this).hide();
				} else {

				}
			}
        });

		// сортировка
		if (sorts) {
			if (sorts == 'expensive') {
				$('.js-filter-toggle_sort span').html('По возрастанию');
				content__tours.each(function(){
				    $(this).html($(this).children('.content__tour').sort(function(a, b){
				    	console.log(($(b).data('cost')))
				        return ( (  ($(b).data('cost')) === undefined  ) || ( ($(b).data('cost')) > ($(a).data('cost')) ) )  ? -1 : 1;
				    }));
				});
			}
			if (sorts == 'chip') {
				$('.js-filter-toggle_sort span').html('По убыванию');
				content__tours.each(function(){
				    $(this).html($(this).children('.content__tour').sort(function(a, b){
				        return ( (  ($(b).data('cost')) === undefined  ) || ( ($(b).data('cost')) < ($(a).data('cost')) ) )  ? -1 : 1;
				        //return ($(b).data('cost')) > ($(a).data('cost')) ? 1 : -1;
				    }));
				});
			}
			if (sorts == 'pops') {
				$('.js-filter-toggle_sort span').html('По популярности');
				content__tours.each(function(){
				    $(this).html($(this).children('.content__tour').sort(function(a, b){
				        return ($(b).data('popular')) < ($(a).data('popular')) ? 1 : -1;
				    }));
				});
			}
		}

		$('.modal__close.btn').html('Показать ' + $(".content__tour:visible").length + ' экскурсий');

		if (array2 !=0) {
			var monthNames =  ["января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря"];
			var start =   array2[0].replace(/"/g, "");
			start = start.toString().split( '-' );
			var startnew = start[2] + ' ' + monthNames[Number(start[1])-1];

			var last = array2.length > 1 ? array2[array2.length - 1].replace(/"/g, "") : 0;
			if (last) {
				last = last.toString().split( '-' );
				var lastnew = last[2] + ' ' + monthNames[Number(last[1])-1];
				$('.count_tour_title').html('Найдено ' + $(".content__tour:visible").length + ' экскурсий на даты: '+  startnew + ' - ' + lastnew);
			} else {
				$('.count_tour_title').html('Найдено ' + $(".content__tour:visible").length + ' экскурсий на дату: '+  startnew);
			}
			$('.count_tour_title').show();
			$('.tour__tickets-left').hide();
		} else {
			$('.tour__tickets-left').show();
			$('.count_tour_title').html('');
			$('.count_tour_title').hide();
		}
	}

	$(document).on('click', '.cancelBtn', function(){
		$('.rent-start').val('');
		console.log('cancelBtn');
		get_cards_for_date();
	})
	$(document).on('click', '.applyBtn', function(){
		if ($(window).width() >= 768) {
			var dates = $('#rent-start').val();
		} else {
			var dates = $('#rent-start_mob').val();
		}
		console.log('dates')
		var datesspl = dates.toString().split( ' - ' );
		var arr = getBusinessDays(datesspl[0],datesspl[1]);
		get_cards_for_date(arr)
	})

	// $('.rent-start').on('change', function(){
	// 	var dates = $('#rent-start').val();
	// 	var datesspl = dates.toString().split( ' - ' );
	// 	var arr = getBusinessDays(datesspl[0],datesspl[1]);
	// 	get_cards_for_date(arr)
	// })


	$('.js-4 input').on('change', function(){
		if ($(window).width() >= 768) {
			var dates = $('#rent-start').val();
		} else {
			var dates = $('#rent-start_mob').val();
		}
		if (dates) {
			var datesspl = dates.toString().split( ' - ' );
			var arr = getBusinessDays(datesspl[0],datesspl[1]);
		}

		get_cards_for_date(arr);
		$('.js-duration-parametrs').fadeOut();
		$('.js-rank-parametrs').fadeOut();
	});

	$('.js-filter-toggle').on('click', function() {
		openModal($('.modal__content--filter'));
	})

	$('.clear').on('click', function(){
		$('input[type="radio"]').prop('checked', false);
  		$('input:checked').prop('checked', false);
  		get_cards_for_date();
	})

	$('.searchform').on('submit', function(e){
		if(!$(this).hasClass('searchform-top')){
			e.preventDefault();
			let thisForm = $(this);
			if (!thisForm.find('.d1').val()) {
				return false;
			}
			$('.page-loader').show();
			$.ajax({
				type: "POST",
				url: "/wp-content/themes/parus/handler/search.php",
				data: $(this).serialize()
			}).done(function (resp) {
				$('#tours').html(resp);
				$('.count_tour_title').html('Найдено ' + $(".content__tour:visible").length + ' экскурсий');
				$('.count_tour_title').show();
				$('.rent-start').val('');
				$('.searchform-top .d1').val(thisForm.find('.d1').val());
				$('.page-loader').hide();
			});
		}
	});

	if($('body').is('.search')){
		$('.searchform:not(.searchform-top) .d2').click();
		$("html, body").animate({
			 scrollTop: $('.filter__general_wrapper').offset().top + "px"
		}, {
			duration: 500,
			easing: "swing"
		});
	}

	if ($(window).width() >= 768) {
		var sticky = new Sticky('.content__gates');
		//console.log(sticky)
	}

/*$(".banner").swipe({
    swipeLeft: leftSwipe,
    swipeRight: rightSwipe,
    threshold: 0
});
function leftSwipe(event) {
    console.log('swipe left');
     $('.slider-nav-item.active').next().trigger('click');
}

function rightSwipe(event) {
      console.log('swipe right');
     $('.slider-nav-item.active').prev().trigger('click');
}*/
let touchstartX = 0
let touchendX = 0

var slidernav = $('.slider-content');

function handleGesture() {
  if (touchendX < touchstartX) $('.slider-nav-item.active').next().trigger('click');
  if (touchendX > touchstartX) $('.slider-nav-item.active').prev().trigger('click');
}

slidernav.on('touchstart', e => {
  touchstartX = e.changedTouches[0].screenX
})

slidernav.on('touchend', e => {
  touchendX = e.changedTouches[0].screenX
  handleGesture()
})

/*
***The function to fix height bloks in catalog***
parent     - item of row
children   - children block of rows item who need to fixing height
countInRow - count of items in one row
*/
function fixHeightBlocksByRow(parent, children, countInRow){
	var tmpHT = 0;
	$(parent).each(function(i){
		var hT = $(this).find(children).height(),
			tmpI = i+1;
		if(tmpHT<hT) tmpHT = hT;

		if($(this).find(children+' img')){
			var hImg = $(this).find(children+' img').height();
			if(hImg>tmpHT)
				tmpHT = hImg;
		}

		if(tmpI%countInRow == 0){
			for (var j = i; j > i-countInRow; j--) {
				$(parent+':eq('+j+') '+children).css('height', tmpHT);
			}
			tmpHT = tmpI = 0;
		}
	});
}
$(window).scroll(function(){
fixHeightBlocksByRow('.content__tour', '.tour__info', 3);
});
fixHeightBlocksByRow('.content__tour', '.tour__info', 3);

$('.info-block__close').click(function() {
	$(this).parent().remove();
});



	$(function() {
		// Проверяем запись в куках о посещении
		if (!$.cookie('attention_block_cookie')) {
			// если cookie не установлен, выводим блок
			if($('*').is('.attention-block'))
			setTimeout("document.querySelector('.attention-block').style.display='block'");
		}
	});

	$('.attention-block__close').click(function(){
		$('.attention-block').fadeOut();
		$.cookie('attention_block_cookie', true, {
			// Время хранения cookie в днях
			expires: 3000,
			path: '/'
		});
	});




	//wishlist

	$.ajax({
		url: '/wp-content/themes/parus/template-parts/cookies.php',
		type: 'post',
		data: {

		},
		success: function(res) {
			var jsObj = JSON.parse(res);
			$('.wish-btn').each(function(){
				if ( $(this).attr('data-wp-id') in jsObj ) {
					$(this).addClass('is-active');
				} else {
					$(this).removeClass('is-active');
				}
			});
			//console.log(jsObj);
			var count = Object.keys(jsObj).length;
			if (count > 0) {
				$('.favs__count-wrap').addClass("favs-have");
				$('.favs__count-wrap .favs__count').html(count);
			}
		}
	});



	$(document).on('click', '.wish-btn', function () {
		var status = $(this).attr('data-wp-id');
		var this_btn = $(this);

		var wish_name = $(this).attr('data-title');

		$.ajax({
			url: '/wp-content/themes/parus/template-parts/cookies.php',
			type: 'post',
			data: {
				status: status
			},
			success: function(res) {
				var jsObj = JSON.parse(res);
				$('.wish-btn').each(function(){
					if ( $(this).attr('data-wp-id') in jsObj ) {
						$(this).addClass('is-active');
					} else {
						$(this).removeClass('is-active');
						if($('.content--wishlist').length){
							$(this).parents('.content__tour').hide('200');
						}
					}
				});

				if(this_btn.hasClass('is-active')){
					wish_modal_open(wish_name);
				}

				//console.log(jsObj);
				var count = Object.keys(jsObj).length;
				if (count > 0) {
					$('.favs__count-wrap').addClass("favs-have");
					$('.favs__count-wrap .favs__count').html(count);
				} else {
					$('.favs__count-wrap').removeClass("favs-have");
					$('.favs__count-wrap .favs__count').html(count);
				}
			}
		});
	});


	function wish_modal_open(wish_name){
		$('.wish-modal-block__transport-name').html(wish_name);
		$('.wish-modal-block').addClass('is-open');
		$('.wish-modal-block--wrapper').addClass('is-open');
		setTimeout(function () {
			$('.wish-modal-block').removeClass('is-open');
			$('.wish-modal-block--wrapper').removeClass('is-open');
		}, 3000);
	}

	//close popup - .close-modal (wish)
	$('.wish-modal-block').on('click', function (event) {
		if (event.target.closest('.close-modal')) {
			event.preventDefault();
			$(this).removeClass('is-open');
			$('.wish-modal-block--wrapper').removeClass('is-open');
		}
	});
	//close popup (wish)
	$('.wish-modal-block--wrapper').on('click', function (event) {
		event.preventDefault();
		$('.wish-modal-block').removeClass('is-open');
		$('.wish-modal-block--wrapper').removeClass('is-open');
	});

	//popup form send success
	function success_modal_block(){
		$('.success-modal-block').addClass('is-open');
		$('.success-modal-block--wrapper').addClass('is-open');
	}
	//close popup - .close-modal (success)
	$('.success-modal-block').on('click', function (event) {
		if (event.target.closest('.close-modal')) {
			event.preventDefault();
			$(this).removeClass('is-open');
			$('.success-modal-block--wrapper').removeClass('is-open');
		}
	});
	//close popup (success)
	$('.success-modal-block--wrapper').on('click', function (event) {
		event.preventDefault();
		$('.success-modal-block').removeClass('is-open');
		$('.success-modal-block--wrapper').removeClass('is-open');
	});


	//open popup - single_attention__btn
	$('.single_attention__btn').on('click', function (event) {
		$('.single_attention_modal').addClass('is-open');
		$('.single_attention_modal--wrapper').addClass('is-open');
	})
	//close popup - .close-modal (single_attention__btn)
	$('.single_attention_modal').on('click', function (event) {
		if (event.target.closest('.close-modal')) {
			event.preventDefault();
			$(this).removeClass('is-open');
			$('.single_attention_modal--wrapper').removeClass('is-open');
		}
	});
	//close popup (single_attention__btn)
	$('.single_attention_modal--wrapper').on('click', function (event) {
		event.preventDefault();
		$('.single_attention_modal').removeClass('is-open');
		$('.single_attention_modal--wrapper').removeClass('is-open');
	});


	//close popup - ESC
	$(document).keyup(function (event) {
		if (event.which == '27') {
			$('.wish-modal-block').removeClass('is-open');
			$('.wish-modal-block--wrapper').removeClass('is-open');
			$('.success-modal-block').removeClass('is-open');
			$('.success-modal-block--wrapper').removeClass('is-open');
			$('.single_attention_modal').removeClass('is-open');
			$('.single_attention_modal--wrapper').removeClass('is-open');
		}
	});







	$('.wp-block-gallery--center a').fancybox();
	$('.wp-block-gallery a').fancybox();


	$('.tours-content h2').each(function () {
		if(($(this).val().indexOf('Программа экскурсии')) ||
		($(this).val().indexOf('Программа мероприятия')) ||
		($(this).val().indexOf('Программа обзорной экскурсии'))
		){
			$(this).attr('id','title_excursion_program');
		}
	})

	if($('.content__anchor-excursion').length){
		if(!$('.tours-content h2#title_excursion_program').length){
			$('.content__anchor-excursion').hide();
		}
	}

	function getGet(name) {
		var s = window.location.search;
		s = s.match(new RegExp(name + '=([^&=]+)'));
		return s ? s[1] : false;
	}
	if(getGet('send')=='success'){
		success_modal_block();
	}

	$('.slider_videos').slick({
		infinite: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		prevArrow: '.content-header-videos .arrs_btn-prev',
		nextArrow: '.content-header-videos .arrs_btn-next',
	});

	$('.attractions-slider').slick({
		infinite: false,
		slidesToShow: 2,
		slidesToScroll: 1,
		arrows: true,
		// swipe: false,
		adaptiveHeight: true,
		responsive: [
			{
				breakpoint: 1220,
				settings: {
					arrows: false,
				}
			},
			{
				breakpoint: 1024,
				settings: {
					arrows: true,
				}
			},
			{
				breakpoint: 600,
				settings: {
					arrows: true,
					slidesToShow: 1,
					slidesToScroll: 1,
					// swipe: true,
				}
			},
		]
	});
});

