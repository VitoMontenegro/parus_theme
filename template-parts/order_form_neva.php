<?php
	global $wpdb;
	
	$cur_t = time()+60*60*3;
	$shedule_all = $wpdb->get_results('SELECT DISTINCT neva_id,departure_time,program_id,ship_id,pier_id FROM wp_nevatickets WHERE program_id = \''.$neva_id.'\' AND departure_time>='.$cur_t.' ORDER BY departure_time ASC;');
	
	$from = $cur_t;
	$to = mktime(23, 59, 59, date('n', time()), date('j', time()), date('Y', time()));
	
	if (count($shedule_all)){
		$fst = $shedule_all[0];
		$from = mktime(0, 0, 0, date('n', $fst->departure_time), date('j',  $fst->departure_time), date('Y',  $fst->departure_time));
		if($from<$cur_t){
			$from = $cur_t;
		}
		$to = mktime(23, 59, 59, date('n',  $fst->departure_time), date('j',  $fst->departure_time), date('Y',  $fst->departure_time));
	}
	
	$piers = json_decode(get_field('piers_nevatravel', 'option'), true);
	$_piers = [];
	foreach($piers as $item){
		$_piers[$item['id']] = $item;
	}
	
	$shedule = $wpdb->get_results('SELECT DISTINCT neva_id,departure_time,program_id,ship_id,pier_id FROM wp_nevatickets WHERE program_id = \''.$neva_id.'\' AND departure_time>='.$from.' AND departure_time<='.$to.' ORDER BY departure_time ASC;');
	
	$fullprice = get_field('neva_fullprice_custom');
	$privprice = get_field('neva_privprice_custom');
	$childprice = get_field('neva_childprice_custom');
	if(!$fullprice)
		$fullprice = get_field('neva_fullprice');
	if(!$privprice)
		$privprice = get_field('neva_privprice');
	if(!$childprice)
		$childprice = get_field('neva_childprice');
	
	
?>
<div class="content__header">
	<div class="tours-content">
		<form class="neva_form" method="post" enctype="multipart/form-data">
			<div class="form-title">Выберите дату, причал и время отправления</div>
			<label class="form__date-wrapper">
				<span class="neva_form_name">Дата отправления</span>
				<input type="date" data-id="<?=$neva_id?>" value="<?=date('Y-m-d', $from)?>" required class="neva_form__timeinp form__date" name="form_date">
			</label>
			<label>
				<span class="neva_form_name">Причал отправления</span>
				<select name="form_pier">
					<option value="1">Любой причал</option>
					<?php foreach($shedule as $item): ?>
						<option value="<?=$item->pier_id?>"><?=$_piers[$item->pier_id]['name']?></option>
					<?php endforeach ?>
				</select>
			</label>
			<div class="neva_form__radio">
			
				<span class="neva_form_name">Время отправления</span>
				
				<?php foreach($shedule as $item): ?>
					<label class="neva_form__radio_item">
						<input name="form_time" data-pier="<?=$item->pier_id?>" type="radio" value="<?=$item->neva_id?>">
						<span><?=date('H:i', $item->departure_time)?></span>
					</label>
				<?php endforeach ?>
			</div>
			
			<?php if (!count($shedule_all)): ?>
				<p class="neva_form__note">На эту экскурсию нет билетов</p>
			<?php endif ?>
			
			<div class="form-block neva_form__prices">
				<div class="form-title tours-content__form-title">
					Введите количество билетов
				</div>			
				<label class="form__label form__label--number">
					<span class="form__text form__text--tickets">Взрослый</span>
					<div class="form__input-wrapper">
							<div class="form__number-down">													
								<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 2" fill="none">
									<path d="M1 1H14" stroke="#cccccc" stroke-width="2" stroke-linecap="round"/>
								</svg>
							</div>
						<input
							type="number"
							class="form__input form__input--number"
							value="0"
							min="0"
							name="sold_adults" 
							data-price="<?=$fullprice?>" 
						/>
						<div class="form__number-up">
							<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
								<path d="M1 7.5H14M7.5 1L7.5 14" stroke="#2C84D1" stroke-width="2" stroke-linecap="round"/>
							</svg>
						</div>
					</div>
					<div class="flex">
						<span class="form__text form__text--price">
							<span class="form__p_vzroslie"><?=$fullprice?></span> руб.
						</span>
					</div>
				</label>	

				<label class="form__label form__label--number">
					<span class="form__text form__text--tickets">Льготный</span>
					<div class="form__input-wrapper">
							<div class="form__number-down">													
								<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 2" fill="none">
									<path d="M1 1H14" stroke="#cccccc" stroke-width="2" stroke-linecap="round"/>
								</svg>
							</div>
						<input
							type="number"
							class="form__input form__input--number"
							value="0"
							min="0" 
							name="sold_priv" 
							data-price="<?=$privprice?>" 
						/>
						<div class="form__number-up">
							<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
								<path d="M1 7.5H14M7.5 1L7.5 14" stroke="#2C84D1" stroke-width="2" stroke-linecap="round"/>
							</svg>
						</div>
					</div>			  			
					<div class="flex">
						<span class="form__text form__text--price">
							<span class="form__p_pensionery"><?=$privprice?></span> руб.
						</span>
					</div>
				</label>				  
				<label class="form__label form__label--number">
					<span class="form__text form__text--tickets">Детский</span>
					<div class="form__input-wrapper">
							<div class="form__number-down">													
								<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 2" fill="none">
									<path d="M1 1H14" stroke="#cccccc" stroke-width="2" stroke-linecap="round"/>
								</svg>
							</div>
						<input
							type="number"
							class="form__input form__input--number"
							value="0"
							min="0" 
							name="sold_child" 
							data-price="<?=$childprice?>" 
						/>
						<div class="form__number-up">
							<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
								<path d="M1 7.5H14M7.5 1L7.5 14" stroke="#2C84D1" stroke-width="2" stroke-linecap="round"/>
							</svg>
						</div>
					</div>
					<div class="flex">
						<span class="form__text form__text--price">
							<span class="form__p_studenty"><?=$childprice?></span> руб.
						</span>
					</div>
				</label>
			</div>
			
			<div class="form-block">
				<div class="flex justify-content-between tours-wrap__promo">
					<div class="total tours-wrap__total">
						<div>
							<span>Итого:</span>
							<span>
								 <span class="t_count">0</span> <span class="tickets">билетов</span> на <span class="t_price">0</span> руб.
							</span>
						</div>
						<div class="total-sale_price" style="display:none">
							<span class="total-sale_price_text">Предоплата онлайн: </span>
							<span class="total-sale_price_count">0</span>
							<span class="total-sale_price_currency"> руб.</span>
						</div>
					</div>											
				</div>
			</div>
			
			<div class="form-block">
				<div class="form-title">
					Ваши данные
				</div>
				<p id="message" style="color:red"></p> 
				<div class="flex justify-content-between">
					<label class="form__label">
						<input type="text" name="name" required class="form__input" placeholder="ФИО*" />
					</label>

					<label class="form__label email_field">
						<input type="text" id="email" name="mail" class="form__input" placeholder="E-mail" />
					</label>

					<label class="form__label">
						<input type="tel" id="phone" name="phone" required class="form__input mask" placeholder="Телефон*" value="" onkeyup="this.value = this.value.replace(/[A-Za-zА-Яа-яЁё]/, '');" />
					</label>								
				</div>

				<label class="form__label form__label--summary">
					<input
						type="hidden"
						readonly 
						value="0"
						class="form__input form__input--short form__input--readonly" 
						name="amount"
					/>
					<input
						type="submit"
						value="Купить билеты"
						class="form__submit form__submit--buy" 
						onclick="yaCounter16828501.reachGoal('4buy_tickets4');"
					/>
					<input
						type="submit"
						value="Заказать звонок"
						class="form__submit form__submit--request"
						onClick="" 
					/>
				</label>

				<input type="hidden" name="utm_source" id="utm_source" value="<?php echo $_COOKIE["utm_source"]; ?>"/>
				<input type="hidden" name="discount" id="discount" data-fulldiscount="0" value="100">
				<input type="hidden" name="title" value="<?=get_the_title()?>">
				<input type="hidden" name="true_price" value="">
				<input type="hidden" name="date_and_time" id="date_and_time" value="" />

				<div style="margin-top: 15px;margin-bottom: 20px;" class="form-agreement">
					Нажимая “Отправить” я соглашаюсь с <a href="/soglashenie-o-poryadke-obrabotki-personalnyh-dannyh" target="_blank">политикой конфиденциальности</a>.
				</div>	
			</div>
			<input type="hidden" name="clientID" id="clientID" value="<?php echo $_COOKIE["_ym_uid"]; ?>">
			<input type="hidden" name="wp_id" value="<?=get_the_ID()?>">
		</form>
	</div>
	<div class="form__gates">
		<div class="form__gates_title">
			<?php the_title(); ?>
		</div>

		<div class="duration_block">
			<span class="durations">Продолжительность</span>  <?php echo $duration; ?>
		</div>

		<p class="content__red">
			<?php if($lang=='en'): ?>
				(Have an identity document with you)
			
			<?php else: ?>
				При себе иметь документ удостоверяющий личность.
			<?php endif; ?>              
		</p>
		
		<div class="pay_info__item">
			<div class="pay_info__item_title">Оплата 100%</div>
			<div class="pay_info__item_text">
				Для экономии вашего времени рекомендуем покупать билет по полной стоимости. 
				В этом случае необходимо прийти к месту посадки <b>за 5-10 мин.</b> до
				начала экскурсии и насладиться поездкой.
			</div>
		</div>
		
		<div class="pay_info__item">
			<div class="pay_info__item_title">Предоплата 30%</div>
			<div class="pay_info__item_text">
				При покупке по предоплате вам необходимо будет оплатить оставшуюся часть 
				<b>за 30 мин.</b> до начала экскурсии в нашем офисе на Невском проспекте, 71/1, 2 этаж, офис 2.9.<br><b>Иначе бронь будет автоматически снята.</b>
			</div>
		</div>
		
		<div class="pay_info__item pay_info__item-last">
			<div class="pay_info__item_subtitle">Цените свое время.</div>
		</div>
	</div>
</div>
	