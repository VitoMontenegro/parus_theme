jQuery(document).ready(function($){		

	//======================================
	//======================================
	//===========    Cookie  ================
	//======================================
	//======================================	
	function getCookie(name) {
	  let matches = document.cookie.match(new RegExp(
	    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	  ));
	  return matches ? decodeURIComponent(matches[1]) : undefined;
	}

	function setCookie(name, value, options = {}) {	

		//console.log(options);
		
		if (options.expires instanceof Date) {
			options.expires = options.expires.toUTCString();
			//console.log('1')
		} else {
			let date = new Date(Date.now() + 24 * 30 * 3600 * 1000);
			options.expires = date.toUTCString();
			//console.log('2')
		} 

		let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

		for (let optionKey in options) {

			updatedCookie += "; " + optionKey;

			let optionValue = options[optionKey];

			if (optionValue !== true) {
				updatedCookie += "=" + optionValue;
			}
		}

		document.cookie = updatedCookie;
	}

	function deleteCookie(name) {
	  setCookie(name, "", {
	    'max-age': -1
	  })
	}

	//======================================
	//======================================
	//===========    Wheel  ================
	//======================================
	//======================================		

	var tick = new Audio('/wp-content/themes/parus/wheel/tick.mp3');			
	var currentCount = getCookie('winnercount') ? getCookie('winnercount') : 3;	
	var winnersList = getCookie('winnersList') ? JSON.parse(getCookie('winnersList')) : [];		
	var	datecookienew = getCookie('datecookienew');	
	console.log('date: ' + datecookienew)


	//setting
	$('.wheel').superWheel({

        slices: [
            {
                text: '<a href="/avtorskaya-ekskursiya-blokadnyi-leningrad-s-posesheniem-piskarevskogo-memorialnogo-kladbisha">Блокадный Ленинград</a>',
                message: 'Вам повезло! Подарок к заказу',
                background: '#777',
                color: 'white',
                value: 0
            },
            {
                text: 'В другой раз...',
                message: 0,
                background: '#ff5722',
                color: 'white',
                value: 1
            },

            {
                text: '<a href="/ekskursii-mify-i-legendy-peterburga">Мифы и легенды <span>Петербурга</span></a>',
                message: 'Вам повезло! Скидка 10%',
                background: '#ffc107',
                color: 'white',
                value: 0
            },
            {
                text: 'Почти...',
                message: 0,
                background: '#3f51b5',
                color: 'white',
                value: 1
            },

            {
                text: '<a href="/obzornyye/">Обзорная экскурсия <span>с часовней</span></a>',
                message: 'Вам повезло! Бесплатная доставка',
                background: '#4caf50',
                color: 'white',
                value: 0
            },
            {
                text: 'Печалька...',
                message: 0,
                background: '#777',
                color: 'white',
                value: 1
            },

            {
                text: '30% скидка <span>на любую</span> экскурсию',
                message: 'Вам повезло! Скидка 15%',
                background: '#ff5722',
                color: 'white',
                value: 0
            },

            {
                text: 'Упс!',
                message: 0,
                background: '#4caf50',
                color: 'white',
                value: 0
            },

            {
                text: '30% скидка на экскурсию в Кронштадт',
                message: 'Вам повезло! моделирование ленчика',
                background: '#3f51b5',
                color: 'white',
                value: 0
            },
            {
                text: 'Так получилось',
                message: 0,
                background: '#ffc107',
                color: 'white',
                value: 0
            }
        ],									
		
		//======================================
		//======================================
		//=======    Wheel Parameters    =======
		//======================================
		//======================================
		text : {
			color: '#fff',
			offset : 8,
			letterSpacing: 0,
			orientation: 'v',
			arc: true
		},
		
		slice : {
			background : "#333",
		},
		
        line: {
            width: 1,
            color: "#fff",
        },

        outer: {
            width: 10,
            color: "#fff",
        },

        inner: {
            width: 0,
            color: "#fff",
        },
		
        marker: {
            animate: true,
            background: '#f75a50'
        },
        
        center: {
            width: 25,
            background: '#fff',
            rotate: true,
            class: "",
            html: {
                template: '<button type="button" class="spin-button"><img width="60" height="50" src="/wp-content/themes/parus/wheel/logo.svg"/></button>',
                width: 45,
            }
        },
		width: 500,
		duration: 1500,			
	});	

	// visual
	$('.spin-to-win').html('Вращать колесо (' + currentCount + ')');

	$('.wheel').superWheel('onStart',function(results){
		$('.spin-to-win').html(' Вращение...');		
    	try {
    		ym(16828501,'reachGoal','click-fortuna');
    	} catch (e) {
    		console.log(e)
    	}
		
	});	

	$('.wheel').superWheel('onStep',function(results){
		if (typeof tick.currentTime !== 'undefined')
			tick.currentTime = 0;
		tick.play();
	});


	$(document).on('click','.spin-to-win',function(e){
		e.preventDefault();
		var winnersList = getCookie('winnersList') ? JSON.parse(getCookie('winnersList')) : [];

		if (currentCount > 0) {				
			$('.wheel').superWheel('start',0);
			$(this).addClass('disabled');							
		} else {
			var	datecookienew = getCookie('datecookienew');				
        	var date = new Date(+datecookienew);

				$('.wheel').addClass('done');
			$('.wheeltitle').html('<p> В следующий раз вы сможете испытать удачу ' + date.toLocaleDateString() +  + ' </p> <br><br><div class="msngrs_block single my-2"><a class="msngrs_block--whatsapp" href="https://api.whatsapp.com/send?phone=79516853733&text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru.+чтобы+активировать+свой+приз+из+колеса+фортуны" target="_blank"><img src="/wp-content/themes/parus/wheel/ico-whatsapp_white128.png" alt="">Написать в WhatsApp</a><a  class="msngrs_block--tg" target="_blank" href="tg://resolve?domain=excursion_parus" rel="nofollow"><img src="/wp-content/themes/parus/wheel/tg.png" alt="">Написать в Telegram</a><div>');
		}
	});	
	

	$('.wheel').superWheel('onComplete',function(results){

		//console.log('currentCount ' + currentCount)
		if (results.message !== 0 ) {
			var	noarr = 0;
			var array = [results.text];
			var winnersList = getCookie('winnersList') ? JSON.parse(getCookie('winnersList')) : []; 
			$.each(winnersList, function (i, item) {
				if (winnersList[i][0] == results.text) {
					console.log(winnersList[i][0] )
					console.log(results.text )
					noarr = 1;
				}
			});
			if (noarr < 1) {
				winnersList = winnersList.concat([array]); // вот тут у вас массив теперь будет всегда.
				setCookie('winnersList', JSON.stringify(winnersList)); // а вот тут у вас сохранились корректно куки
			}
			
			setCookie('winnersList', JSON.stringify(winnersList)); // а вот тут у вас сохранились корректно куки
			setCookie('winnercount', --currentCount); // а вот тут у вас сохранились корректно куки
			var regex = /<\/?\w+[^>]*\/?>/g,
				rtext = results.text.replace(regex, "");
			if (noarr < 1) {
			    $('.wheelradio').append(
			      $('<input>').prop({
			        type: 'radio',
			        id: rtext,
			        name: 'wheelselect',
			        value: rtext
			      })
			    ).append(
			      $('<label>').prop({
			        for: rtext
			      }).html(rtext)
			    );					
			}


			if (currentCount > 0) {
				$('.spin-to-win').removeClass('disabled');
				$('.spin-to-win').html('Вращать колесо (' + currentCount + ')'); //donedone
			} else {	
				let date = new Date(Date.now() + 30 * 24 * 3600 * 1000);
				setCookie('winnercount', '0', {expires: date});

				$('.wheeltitle').html('Поздравляем!<br> Выберите свой приз:')				
				$('.wheeltitlesubtitle').html('')	
				/*$.each(winnersList, function (i, item) {
				    $('.wheelselect').append($('<option>', { 
				        value: winnersList[i],
				        text : winnersList[i] 
				    }));
				});*/						
			    //$('.wheelselect').show();		
				$('.spin-to-win').hide();
				$('.wheel').addClass('done');
				$('.input-block').show();
			}	
		} else{
			setCookie('winnercount', --currentCount); // а вот тут у вас сохранились корректно куки
			if (currentCount > 0) {
				$('.spin-to-win').removeClass('disabled');
				$('.spin-to-win').html('Вращать колесо (' + currentCount + ')'); //donedone
			} else {
				$('.wheelcount').html(currentCount + ' попыток');
				var winnersList = getCookie('winnersList') ? JSON.parse(getCookie('winnersList')) : [];
				if (winnersList.length > 0) {	

					$('.wheeltitle').html('Поздравляем!<br> Выберите свой приз:')				
					$('.wheeltitlesubtitle').html('')	
					let date = new Date(Date.now() + 30 * 24 * 3600 * 1000);
					setCookie('winnercount', 0, {expires: date});

					/*$.each(winnersList, function (i, item) {
					    $('.wheelselect').append($('<option>', { 
					        value: winnersList[i],
					        text : winnersList[i] 
					    }));
					});	*/					
				    //$('.wheelselect').show();		
					$('.spin-to-win').hide();
					$('.wheel').addClass('done');
					$('.input-block').show();
				} else {
					$('.spin-to-win').html('До встречи');
					$('.wheeltitle').html('Не расстраивайтесь и возвращайтесь завтра!');
					$('.wheel').addClass('done');
					$('.wheeltitlesubtitle').html('Через 24 часа вы снова сможете испытать удачу и выиграть свой приз.');

					let date = new Date(Date.now() + 24 * 3600 * 1000);
					setCookie('winnercount', 0, {expires: date});
					setCookie('datecookienew', Date.now() +  24 * 3600 * 1000, {expires: new Date(Date.now() + 30 * 24 * 3600 * 1000)});
				}					
			}
		}
	});


	//======================================
	//======================================
	//===========    Modal  ================
	//======================================
	//======================================	

	$('body').on('click', '.triggers', function() {
		var	datecookienew = getCookie('datecookienew');
		$('.modalwheel-wrapper').addClass('open');
		$('.page-wrapper').addClass('blur-it');

		if (datecookienew > 1) {
			var data = new Date(datecookienew*1);
			//console.log(data);

			$('.wheel').addClass('done');
			$('.wheeltitle').html('<p>В следующий раз вы сможете испытать удачу ' + data.toLocaleDateString()  + ' </p><br><br> <div class="msngrs_block single my-2"><a class="msngrs_block--whatsapp" href="https://api.whatsapp.com/send?phone=79516853733&text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru.+чтобы+активировать+свой+приз+из+колеса+фортуны" target="_blank"><img src="/wp-content/themes/parus/wheel/ico-whatsapp_white128.png" alt="">Написать в WhatsApp</a><a  class="msngrs_block--tg" target="_blank" href="tg://resolve?domain=excursion_parus" rel="nofollow"><img src="/wp-content/themes/parus/wheel/tg.png" alt="">Написать в Telegram</a><div>');
			$('.wheeltitlesubtitle').html('');
			$('.wheel-input-container').html('');

		} else if (currentCount < 1) {
			var winnersList = getCookie('winnersList') ? JSON.parse(getCookie('winnersList')) : [];
			if (winnersList.length > 0) {	
				let date = new Date(Date.now() + 30 * 24 * 3600 * 1000);
				setCookie('winnercount', 0, {expires: date});

				// $.each(winnersList, function (i, item) {
				//     $('.wheelselect').append($('<option>', { 
				//         value: winnersList[i],
				//         text : winnersList[i] 
				//     }));
				// });		
				$('.wheelradio').html('');
				$.each(winnersList, function (i, item) {
				    // $('.wheelselect').append($('<option>', { 
				    //     value: winnersList[i],
				    //     text : winnersList[i] 
				    // }));
				    var regex = /<\/?\w+[^>]*\/?>/g,
				    	winnersListnew = winnersList[i][0],
						rtext = winnersListnew.replace(regex, "");
				    $('.wheelradio').append(
				      $('<input>').prop({
				        type: 'radio',
				        id: rtext,
				        name: 'wheelselect',
				        value: rtext
				      })
				    ).append(
				      $('<label>').prop({
				        for: rtext
				      }).html(rtext)
				    );



				});		
				$('.wheeltitle').html('Поздравляем!<br> Выберите свой приз:')				
				$('.wheeltitlesubtitle').html('')				
			    //$('.wheelselect').show();		
				$('.spin-to-win').hide();
				$('.wheel').addClass('done');
				$('.input-block').show();
			}
		} else {
			var winnersList = getCookie('winnersList') ? JSON.parse(getCookie('winnersList')) : [];
			if (winnersList.length > 0) {	
				// $.each(winnersList, function (i, item) {
				//     $('.wheelselect').append($('<option>', { 
				//         value: winnersList[i],
				//         text : winnersList[i] 
				//     }));
				// });		
				$('.wheelradio').html('');
				$.each(winnersList, function (i, item) {
				    // $('.wheelselect').append($('<option>', { 
				    //     value: winnersList[i],
				    //     text : winnersList[i] 
				    // }));
				    var regex = /<\/?\w+[^>]*\/?>/g,
				    	winnersListnew = winnersList[i][0],
						rtext = winnersListnew.replace(regex, "");

				    $('.wheelradio').append(
				      $('<input>').prop({
				        type: 'radio',
				        id: rtext,
				        name: 'wheelselect',
				        value: rtext
				      })
				    ).append(
				      $('<label>').prop({
				        for: rtext
				      }).html(rtext)
				    );



				});	
			}
		}


		return false;
	});

	$('.btn-close.trigger').on('click', function() {
		$('.modalwheel-wrapper').removeClass('open');
		$('.page-wrapper').removeClass('blur-it');
		return false;
	});
	$(document).mouseup(function (e){ // событие клика по веб-документу
		var div = $(".modalwheel"); // тут указываем ID элемента
		if (!div.is(e.target) // если клик был не по нашему блоку
		    && div.has(e.target).length === 0) { // и не по его дочерним элементам
			$('.modalwheel-wrapper').removeClass('open');
			$('.page-wrapper').removeClass('blur-it');
			return false;
		}
	});

	//======================================
	//======================================
	//===========    Ajax  ================
	//======================================
	//======================================	

	$('.wheel-prize').on('submit', function(e) {
		e.preventDefault(); 
		var form = $(this),
			mail = form.find('.wheelemail').val(),
			//wheelselect = form.find('.wheelselect').val(); 
			wheelselect = form.find('input[name="wheelselect"]:checked').val()  


	    if (!wheelselect) {
	        form.find('.wheelradio').append('<p class="warning"> Выберите свой приз </p>');
	        return false;
	    } else {
	    	form.find('.wheelradio p').remove();
	    }

		if (!mail || mail.replace(/[^\d]/g, '').length < 10) {
	        form.find('.wheelemail').addClass('acf-error');
	        return false;
	    } else {
	        form.find('.wheelemail').removeClass('acf-error');
	    }

     	$.ajax({
        type: "POST",
        url: "/wp-content/themes/parus/wheel/sendmail.php",
	        data: {
	            mail: mail,
	            wheelselect: wheelselect
	        },
	        success: function(data) {
	        	try {
	        		ym(16828501,'reachGoal','send-fortuna')
	        	} catch (e) {
	        		console.log(e)
	        	}
	        	
	            if (data == "Ваша заявка принята! Наш менеджер с вами свяжется.") {
					setCookie('datecookienew', Date.now() + 30 * 24 * 3600 * 1000, {expires: new Date(Date.now() + 30 * 24 * 3600 * 1000)});	                
	                $('input').remove();
	                $('textarea').remove();
	                $('.wheel-input-container').remove();
	                $('.wheeltitle').html('Ваш запрос отправлен! ');
	                $('.wheeltitlesubtitle').html('<p>Напишите нам для быстрой активации подарка </p> <div class="msngrs_block single my-2"><a class="msngrs_block--whatsapp" href="https://api.whatsapp.com/send?phone=79516853733&text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru.+чтобы+активировать+свой+приз+из+колеса+фортуны" target="_blank"><img src="/wp-content/themes/parus/wheel/ico-whatsapp_white128.png" alt="">Написать в WhatsApp</a><a  class="msngrs_block--tg" target="_blank" href="tg://resolve?domain=excursion_parus" rel="nofollow"><img src="/wp-content/themes/parus/wheel/tg.png" alt="">Написать в Telegram</a><div>');
	            } else if(!isNaN(data)) {  
	            	var date = new Date(data*1000);
					setCookie('datecookienew', data*1000, {expires: new Date(Date.now() + 30 * 24 * 3600 * 1000)});
					deleteCookie('winnersList');
					console.log('datecookienew: ' + date);
					console.log('data: ' + data*1000)
					console.log('Date.now: ' + (Date.now() + 30 * 24 * 3600 * 1000))

					$('.wheel').addClass('done');
	            	$('.wheeltitle').html('<p>В следующий раз вы сможете испытать удачу ' + date.toLocaleDateString() + ' </p> <br><br><div class="msngrs_block single my-2"><a class="msngrs_block--whatsapp" href="https://api.whatsapp.com/send?phone=79516853733&text=Здравствуйте.+Я+обращаюсь+с+сайта+parus-peterburg.ru.+чтобы+активировать+свой+приз+из+колеса+фортуны" target="_blank"><img src="/wp-content/themes/parus/wheel/ico-whatsapp_white128.png" alt="">Написать в WhatsApp</a><a  class="msngrs_block--tg" target="_blank" href="tg://resolve?domain=excursion_parus" rel="nofollow"><img src="/wp-content/themes/parus/wheel/tg.png" alt="">Написать в Telegram</a><div>');
	            	$('.wheeltitlesubtitle').html('');
	            	$('.wheel-input-container').html('');
	            } else { 
	            	$('.wheeltitle').html('Что-то пошло не так');
	            }

	            
	        },
	        error: function(xhr, str) {
	            console.log('data err: ' + data);
                $('.wheeltitle').html('Что-то пошло не так');
	        }
		});
	});





});