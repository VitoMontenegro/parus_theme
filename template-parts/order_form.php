

				
				<?php if (get_the_ID()==1347 && false): ?>
					<div id="nh-widget-iframe"></div>
					<script src='https://events.nethouse.ru/assets/js/nh-wiget-iframe.js'></script>
					<script>
						window.nhWigetInit({
							container: '#nh-widget-iframe',
							src:'https://events.nethouse.ru/buy_tickets/86960/iframe/',
							height: 480,
							width: '100%',
							border: 'none'
							});
						</script>
				<?php else: ?>
					<div class="content__header">
						<div class="tours-content" <?php if($term != 'group' || !$id_crm){echo 'style="width:100%;"';} ?>>
							<?php if ($term == 'group' && $id_crm): ?>
								<form class="content__form form" id="order_form-page" data-crm="<?=get_field('id_crm')?>" method="post" enctype="multipart/form-data" >
									<input type="hidden" name="clientID" id="clientID" value="<?php echo $_COOKIE["_ym_uid"]; ?>">
									<input type="hidden" name="post_id" id="post_id" value="<?=get_the_ID();?>">
									<input type="hidden" name="id_crm" id="id_crm" value="<?=get_field('id_crm')?>">
									<?php
										$sopr = get_field('id_crm_eks', get_the_ID());
									?>
									<?php if(get_post_meta(get_the_ID(),'tickets', 1) || $sopr): ?>
										<div class="form-block tours-wrap__form-block">
											<div class="form-title">
												Выберите дату
											</div>
												<div class="custom_datepicker__wrapper" style="display:none">
													<div id="custom_datepicker"></div>
													<div class="custom_datepicker__legend">
														<div class="custom_datepicker__legend_item">
															<i></i>
															<span>Есть места</span>
														</div>
														<div class="custom_datepicker__legend_item">
															<i></i>
															<span>Места заняты</span>
														</div>
													</div>
												</div>
											<label class="form__label form__label--tickets" style="display:none">
												<div class="form__date-wrapper">
													<input
														type="date"
														value="<?php echo $start_date ?>"
														required
														class="form__date timeinp"
														name="form_date"
													/>
													<?php
														$sd = explode('-', $start_date);
													?>
													<input type="text" name="fake_form_date" class="fake_form_date" value="<?=$sd[2]?>.<?=$sd[1]?>.<?=$sd[0]?>">
												</div>
											</label>

											<div class="form-title form-title-time">Доступное время</div>
											<div id="form__radio"></div>
<input type="hidden" name="trip" value="">
											<?php if(get_post_meta(get_the_ID(),'on_address', 1)): ?>
												<div class="form__radio form__radio-vokzaal">
													<div class="form__radio-radio_wrap">
														<input type="radio" id="a1" name="adr" value="Московский вокзал, Лиговский проспект 43/45" checked />
														<label for="a1">Московский вокзал</label>	
													</div>
													<div class="form__radio-radio_wrap">
														<?php $n20 = [1296, 1370, 4107, 4285, 1390, 1382, 
																	17551, 11655, 1302, 1346]; 
														 if(in_array(get_the_ID(), $n20)) {
														 	$a2 = "Невский, 20";
														 }	else{
															$a2 = "Невский, 17";
														 }		

																	?>
											<input type="radio" id="a2" name="adr" value="<?=$a2;?>" />
															<label for="a2"><?php echo $a2;?></label>
													</div>
												</div>

													<div class="tickets_addr_wrap">
														<div class="tickets_addr" id="addr_moskovskiy">
															<div class="tickets_addr__title">Московский вокзал</div>
															<div class="tickets_addr__items"></div>
														</div>
														<div class="tickets_addr" id="addr_nevskiy">
															<div class="tickets_addr__title">
																<?php if(in_array(get_the_ID(), $n20)): ?>
																	Невский, 20
																<?php else: ?>
																	Невский, 17
																<?php endif ?>
															</div>
															<div class="tickets_addr__items"></div>
														</div>
													</div>
											<?php else: ?>
												<?php if ($addr == 'Московский вокзал'): ?>
													<?php $addr .= ', Лиговский проспект 43/45'; ?>
												<?php endif ?>
												<div class="tickets_addr" id="addr_moskovskiy">
													<div class="tickets_addr__items"></div>
												</div>
												<input type="hidden" name="adr" value="<?= $addr ?>">
											<?php endif; ?>
										</div>	
										
										<?php $sales = true; ?>
										<div id="all-prices" class="form-block">
											<div class="form-title tours-content__form-title">
												Введите количество билетов
											</div>			

											<label class="form__label form__label--number">
												<span class="form__text form__text--tickets">Взрослые</span>
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
														readonly
													/>
													<div class="form__number-up">
														<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
															<path d="M1 7.5H14M7.5 1L7.5 14" stroke="#2C84D1" stroke-width="2" stroke-linecap="round"/>
														</svg>
													</div>
												</div>
												<?php if (get_field('p_vzroslie_sale') && $sales): ?>
													<div class="flex">
														<span class="form__text form__text--price">
															<span class="form__p_vzroslie"><?=get_field('p_vzroslie_sale')?></span> руб.
														</span>
														<span class="old-price"><?=get_field('p_vzroslie')?> руб.</span>
													</div>
												<?php else: ?>	
													<div class="flex">
														<span class="form__text form__text--price">
															<span class="form__p_vzroslie"><?=get_field('p_vzroslie')?></span> руб.
														</span>
													</div>
												<?php endif ?>
											</label>	

											<label class="form__label form__label--number">
												<span class="form__text form__text--tickets">Пенсионеры</span>
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
														name="sold_old" 
														readonly
													/>
													<div class="form__number-up">
														<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
															<path d="M1 7.5H14M7.5 1L7.5 14" stroke="#2C84D1" stroke-width="2" stroke-linecap="round"/>
														</svg>
													</div>
												</div>
												<?php if (get_field('p_pensionery_sale') && $sales): ?>
													<div class="flex">
														<span class="form__text form__text--price">
															<span class="form__p_pensionery"><?=get_field('p_pensionery_sale')?></span> руб.
														</span>
														<span class="old-price"><?=get_field('p_pensionery')?> руб.</span>
													</div>
												<?php else: ?>				  			
													<div class="flex">
														<span class="form__text form__text--price">
															<span class="form__p_pensionery"><?=get_field('p_pensionery')?></span> руб.
														</span>
													</div>
												<?php endif ?>
											</label>				  

											<label class="form__label form__label--number">
												<span class="form__text form__text--tickets">Студенты</span>
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
														name="sold_students"  
														readonly
													/>
													<div class="form__number-up">
														<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
															<path d="M1 7.5H14M7.5 1L7.5 14" stroke="#2C84D1" stroke-width="2" stroke-linecap="round"/>
														</svg>
													</div>
												</div>
												<?php if (get_field('p_studenty_sale') && $sales): ?>
													<div class="flex">
														<span class="form__text form__text--price">
															<span class="form__p_studenty"><?=get_field('p_studenty_sale')?></span> руб.
														</span>
														<span class="old-price"><?=get_field('p_studenty')?> руб.</span>
													</div>
												<?php else: ?>	
													<div class="flex">
														<span class="form__text form__text--price">
															<span class="form__p_studenty"><?=get_field('p_studenty')?></span> руб.
														</span>
													</div>
												<?php endif ?>
											</label>
										  
											<label class="form__label form__label--number">
												<span class="form__text form__text--tickets">
													Школьники
													<?php if (get_the_ID() == 3790) : ?>
														<i class="plus16">16+</i>
													<?php endif ?>
												</span>
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
														name="sold_school" 
														readonly
													/>
													<div class="form__number-up">
														<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
															<path d="M1 7.5H14M7.5 1L7.5 14" stroke="#2C84D1" stroke-width="2" stroke-linecap="round"/>
														</svg>
													</div>
												</div>
												<?php if (get_field('p_shkolniki_sale') && $sales): ?>
													<div class="flex">
														<span class="form__text form__text--price">
															<span class="form__p_shkolniki"><?=get_field('p_shkolniki_sale')?></span> руб.
														</span>
														<span class="old-price"><?=get_field('p_shkolniki')?> руб.</span>
													</div>
												<?php else: ?>	
													<div class="flex">
														<span class="form__text form__text--price">
															<span class="form__p_shkolniki"><?=get_field('p_shkolniki')?></span> руб.
														</span>
													</div>
												<?php endif ?>
											</label>	

											<?php if ( get_field('p_doshkolniki') && get_the_ID() != 3790) : ?>
												<label class="form__label form__label--number">
													<span class="form__text form__text--tickets">Дошкольники</span>
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
															name="sold_childs" 
															readonly
														/>
														<div class="form__number-up">
															<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
																<path d="M1 7.5H14M7.5 1L7.5 14" stroke="#2C84D1" stroke-width="2" stroke-linecap="round"/>
															</svg>
														</div>
													</div>
													<?php if (get_field('p_doshkolniki_sale') && $sales): ?>
														<div class="flex">
															<span class="form__text form__text--price">
																<span class="form__p_doshkolniki"><?=get_field('p_doshkolniki_sale')?></span> руб.
															</span>
															<span class="old-price"><?=get_field('p_doshkolniki')?> руб.</span>
														</div>
													<?php else: ?>	
														<div class="flex">
															<span class="form__text form__text--price">
																<span class="form__p_doshkolniki"><?=get_field('p_doshkolniki')?></span> руб.
															</span>
														</div>
													<?php endif ?>
												</label>
											<?php endif; ?>
										  
											<label class="form__label form__label--number">
												<span class="form__text form__text--tickets">Иностранцы (взрослые, студенты, дети)</span>
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
														name="sold_adults_for" 
														readonly
													/>
													<div class="form__number-up">
														<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15" fill="none">
															<path d="M1 7.5H14M7.5 1L7.5 14" stroke="#2C84D1" stroke-width="2" stroke-linecap="round"/>
														</svg>
													</div>
												</div>
												<?php if (get_field('p_vzroslie_inostrancy_sale') && $sales): ?>
													<div class="flex">
														<span class="form__text form__text--price">
															<span class="form__p_vzroslie_inostrancy"><?=get_field('p_vzroslie_inostrancy_sale')?></span> руб.
														</span>
														<span class="old-price"><?=get_field('p_vzroslie_inostrancy')?> руб.</span>
													</div>
												<?php else: ?>	
													<div class="flex">
														<span class="form__text form__text--price">
															<span class="form__p_vzroslie_inostrancy"><?=get_field('p_vzroslie_inostrancy')?></span> руб.
														</span>
													</div>
												<?php endif ?>
											</label>
											
										<div class="hidden">
											<label class="form__label form__label--number">
												<span class="form__text form__text--tickets">Студенты иностранцы</span>
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
														name="sold_students_for" 
														readonly
													/>
													<div class="form__number-up">+</div>
												</div>
												<?php if (get_field('p_studenty_inostrancy_sale') && $sales): ?>
													<div class="flex"><span class="form__text form__text--price"><?=get_field('p_studenty_inostrancy_sale')?> руб.</span><span class="old-price"><?=get_field('p_studenty_inostrancy')?> руб.</span></div>
												<?php else: ?>	
													<div class="flex"><span class="form__text form__text--price"><?=get_field('p_studenty_inostrancy')?> руб.</span></div>
												<?php endif ?>
											</label>

											<label class="form__label form__label--number">
												<span class="form__text form__text--tickets">Дети иностранцы</span>
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
														name="sold_childs_for" 
														readonly
													/>
													<div class="form__number-up">+</div>
												</div>
												<?php if (get_field('p_deti_inostrancy_sale')): ?>
													<div class="flex"><span class="form__text form__text--price"><?=get_field('p_deti_inostrancy_sale')?> руб.</span><span class="old-price"><?=get_field('p_deti_inostrancy')?> руб.</span></div>
												<?php else: ?>	
													<div class="flex"><span class="form__text form__text--price"><?=get_field('p_deti_inostrancy')?> руб.</span></div>
												<?php endif ?>
											</label>
											
										</div>

											<?php if (!get_field('no_advance_payment')): ?>
												<label class="form__label form__label--checkbox mt-20">
													<input name="20percent" type="radio" value="off" class="form__checkbox" checked>
													<span>Оплатить полную стоимость</span>
												</label>
												<label class="form__label form__label--checkbox mt-10">
													<input name="20percent" type="radio" value="on" class="form__checkbox" />
													<span>Предоплата 30%</span>
												</label>					
											<?php endif ?>
										</div>

										<div class="form-block">
											<div class="flex justify-content-between tours-wrap__promo">
												<div class="tours-wrap__promo-ttl">Промокод</div>
												<label class="form__label tours-wrap__promo_label">
													<input 
													type="text" 
													name="promo" 
													class="form__input form__input--promo" 
													<?php if ($_COOKIE['promoCode']): ?>
														value="<?php echo $_COOKIE['promoCode'];?>"
													<?php else: ?>	
														placeholder="Введите промо-код" 
													<?php endif ?>
													
													/>
													<span class="promo-loader"></span>
													<span id="promo_ok"></span>
												</label>
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
									<?php else: ?>	
										<div class="form-block">				  			
											<p class="alert" style="color: red;padding-left: 10px;margin-bottom: 30px;">Билеты закончились</p>
											<input
												style="margin-bottom:15px;" 
												type="submit"
												value="Заказать звонок"
												class="form__submit form__submit--request"
											/>	
										</div>				
									<?php endif ?>

									<div class="form-block">
										<div class="form-title">
											Ваши данные
										</div>
										<p id="message" style="color:red"></p> 
										<div class="flex justify-content-between">
											<label class="form__label fio_field">
												<input type="text" name="name" required class="form__input" placeholder="ФИО*" />
											</label>

											<label class="form__label email_field">
												<input type="text" id="email" name="mail" class="form__input" placeholder="E-mail" />
											</label>

											<label class="form__label phones_field">
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

										<?php if (get_field('p_vzroslie_sale')): ?>
											<input type="hidden" name="price_adults" value="<?=get_field('p_vzroslie_sale')?>" />
										<?php else: ?>	
											<input type="hidden" name="price_adults" value="<?=get_field('p_vzroslie')?>" />
										<?php endif ?>


										<?php if (get_field('p_doshkolniki_sale')): ?>
											<input type="hidden" name="price_childs" value="<?=get_field('p_doshkolniki_sale')?>" />
										<?php else: ?>	
											<input type="hidden" name="price_childs" value="<?=get_field('p_doshkolniki')?>" />
										<?php endif ?>


										<?php if (get_field('p_pensionery_sale')): ?>
											<input type="hidden" name="price_old" value="<?=get_field('p_pensionery_sale')?>" />
										<?php else: ?>	
											<input type="hidden" name="price_old" value="<?=get_field('p_pensionery')?>" />
										<?php endif ?>


										<?php if (get_field('p_studenty_sale')): ?>
											<input type="hidden" name="price_students" value="<?=get_field('p_studenty_sale')?>" />
										<?php else: ?>	
											<input type="hidden" name="price_students" value="<?=get_field('p_studenty')?>" />
										<?php endif ?>


										<?php if (get_field('p_shkolniki_sale')): ?>
											<input type="hidden" name="price_school" value="<?=get_field('p_shkolniki_sale')?>" />
										<?php else: ?>	
											<input type="hidden" name="price_school" value="<?=get_field('p_shkolniki')?>" />
										<?php endif ?>


										<?php if (get_field('p_vzroslie_inostrancy_sale')): ?>
											<input type="hidden" name="price_adults_for" value="<?=get_field('p_vzroslie_inostrancy_sale')?>" />
										<?php else: ?>	
											<input type="hidden" name="price_adults_for" value="<?=get_field('p_vzroslie_inostrancy')?>" />
										<?php endif ?>


										<?php if (get_field('p_studenty_inostrancy_sale')): ?>
											<input type="hidden" name="price_students_for" value="<?=get_field('p_studenty_inostrancy_sale')?>" />
										<?php else: ?>	
											<input type="hidden" name="price_students_for" value="<?=get_field('p_studenty_inostrancy')?>" />
										<?php endif ?>


										<?php if (get_field('p_deti_inostrancy_sale')): ?>
											<input type="hidden" name="price_childs_for" value="<?=get_field('p_deti_inostrancy_sale')?>" />
										<?php else: ?>	
											<input type="hidden" name="price_childs_for" value="<?=get_field('p_deti_inostrancy')?>" />
										<?php endif ?>


										<input type="hidden" name="true_price" value="">
										<input type="hidden" name="date_and_time" id="date_and_time" value="" />

										<div style="margin-top: 15px;margin-bottom: 20px; text-align: center" class="form-agreement">
											Нажимая “Купить билеты” или “Заказать звонок” я соглашаюсь с <a href="/soglashenie-o-poryadke-obrabotki-personalnyh-dannyh" target="_blank">политикой конфиденциальности</a>.
										</div>	
								
										<div class="robo">
											<img src="/wp-content/themes/parus/img/robokassa.svg" style="width: 174px;background: #fff;padding: 14px;" alt="robokassa">
											<div class="robo__right">
												<span>Оплата проводится через систему безопасных платежей Robokassa&nbsp;</span>
												<i class="robo__hint">
													<img src="/wp-content/themes/parus/assets/images/_icons/question.svg" alt="">
													<div class="robo__hint_text">Robokassa - известный платежный инструмент, выступающий посредником между компанией-продавцом и покупателем для удаленной оплаты услуг.</div>
												</i>
												<br><span style="margin-top: 4px;display: block;">Ваши данные надежно защищены.</span>
											</div>
										</div>
									</div>
								</form>
							<?php elseif(!$tury): ?>
								<div class="content--indiv-tour-page">
									<form class="content__form form contact_form indiv_form">
									<input type="hidden" name="clientID" id="clientID" value="<?php echo $_COOKIE["_ym_uid"]; ?>">
										<div class="form-block">
											<div class="form-title">
												Ваши данные
											</div>

										<p id="message" style="color:red"></p> 
											<input type="hidden" name="subject" value="Заявка на экскурсию. [<?=get_the_title()?>]">
											<input type="hidden" name="url" value="<?=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>">
										<input type="hidden" name="utm_source" id="utm_source" value=""/>
		
											<div class="flex justify-content-between">
												<label class="form__label fio_field">
													<input type="text" name="name" class="form__input" placeholder="<?=($lang=='en')?'Full name':'ФИО'?>" />
												</label>
												<label class="form__label email_field">
													<input type="email" id="email" name="email" class="form__input" placeholder="E-mail" />
												</label>
												<label class="form__label phones_field">
													<input type="tel" id="phone" name="phone" required class="form__input mask" placeholder="<?=($lang=='en')?'Phone':'Телефон'?>*" value="" onkeyup="this.value = this.value.replace(/[A-Za-zА-Яа-яЁё]/, '');" />
												</label>
											</div>

											<div class="form__footer">
												<input type="submit" value="<?php echo $lang=='en'? 'Send' : 'Забронировать' ; ?>" class="form__submit form__submit-individ yellow ru"  />
												<div style="margin-top: 15px;margin-bottom: 20px;" class="form-agreement">
													<?php if($lang=='en'):?>
														By clicking "Submit" I agree to the <a href="/soglashenie-o-poryadke-obrabotki-personalnyh-dannyh" target="_blank">terms of processing my data.</a>
													<?php else: ?>
														Нажимая “Отправить” я соглашаюсь с <a href="/soglashenie-o-poryadke-obrabotki-personalnyh-dannyh" target="_blank">политикой конфиденциальности</a>.
													<?php endif; ?>					
												</div>				
											</div>
						
										</div>
									</form>
								</div>
							<?php else: ?>
								<div class="content--indiv-tour-page">
									<form class="content__form form contact_form indiv_form tour_form">
									<input type="hidden" name="clientID" id="clientID" value="<?php echo $_COOKIE["_ym_uid"]; ?>">
										<div class="form-block">
											<div class="form-title">
												Ваши данные
											</div>

											<p id="message" style="color:red"></p> 
											<input type="hidden" name="subject" value="Заявка на тур. [<?=get_the_title()?>]">
											<input type="hidden" name="url" value="<?=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']?>">

											<div class="flex justify-content-between">
												<label class="form__label fio_field">
													<input type="text" name="name" class="form__input" placeholder="<?=($lang=='en')?'Full name':'ФИО'?>" />
												</label>
												<label class="form__label email_field">
													<input type="email" id="email" name="email" class="form__input" placeholder="E-mail" />
												</label>
												<label class="form__label phones_field">
													<input type="tel" id="phone" name="phone" required class="form__input mask" placeholder="<?=($lang=='en')?'Phone':'Телефон'?>*" value="" onkeyup="this.value = this.value.replace(/[A-Za-zА-Яа-яЁё]/, '');" />
												</label>
											</div>
											<?php if ($term != 'group'): ?>
												<label class="form__label">
													<textarea style="width: 100%;height: 90px;" name="msg" class="form__textarea" placeholder="Сообщение"></textarea>
												</label>
											<?php endif; ?>


											<div class="form__footer">
												<input type="submit" value="<?php echo $lang=='en'? 'Send' : 'Забронировать' ; ?>" class="form__submit form__submit-individ yellow ru" />
												<div style="margin-top: 15px;margin-bottom: 20px;" class="form-agreement">
													<?php if($lang=='en'):?>
														By clicking "Submit" I agree to the <a href="/soglashenie-o-poryadke-obrabotki-personalnyh-dannyh" target="_blank">terms of processing my data.</a>
													<?php else: ?>
														Нажимая “Отправить” я соглашаюсь с <a href="/soglashenie-o-poryadke-obrabotki-personalnyh-dannyh" target="_blank">политикой конфиденциальности</a>.
													<?php endif; ?>					
												</div>				
											</div>
						
										</div>
									</form>
								</div>
							<?php endif; ?>				
						</div>
						<?php if ($term == 'group' && $id_crm): ?>
							<div class="form__gates_wrapper">
								<div class="form__pregates" style="background-image:url(<?=get_webp($galery_first['url'])?>)">
									<div class="form__pregates_shadow"></div>
									<div class="form__pregates_duration">
										<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M9.3041 17C14.1067 17 18 13.1944 18 8.5C18 3.80558 14.1067 0 9.3041 0C4.5015 0 0.608227 3.80558 0.608227 8.5C0.608227 10.5534 1.35819 12.4881 2.67467 14.0016H0.668914C0.299483 14.0016 1.1134e-08 14.2944 0 14.6555C-1.11359e-08 15.0166 0.299483 15.3093 0.668913 15.3093L4.45286 15.3093C4.82229 15.3093 5.12177 15.0166 5.12177 14.6555V10.9567C5.12177 10.5956 4.82229 10.3029 4.45286 10.3029C4.08343 10.3029 3.78395 10.5956 3.78395 10.9567V13.2562C2.61413 11.9609 1.94605 10.2842 1.94605 8.5C1.94605 4.5278 5.24037 1.30769 9.3041 1.30769C13.3678 1.30769 16.6622 4.5278 16.6622 8.5C16.6622 12.4722 13.3678 15.6923 9.3041 15.6923C8.93467 15.6923 8.63519 15.985 8.63519 16.3462C8.63519 16.7073 8.93467 17 9.3041 17ZM9.30415 4.18521C9.67358 4.18521 9.97306 4.47794 9.97306 4.83905V9.10093L12.1455 11.2244C12.4067 11.4797 12.4067 11.8937 12.1455 12.1491C11.8842 12.4044 11.4607 12.4044 11.1995 12.1491L8.83115 9.8341C8.70571 9.71148 8.63523 9.54517 8.63523 9.37176V4.83905C8.63523 4.47794 8.93472 4.18521 9.30415 4.18521Z" fill="#2C84D1"/>
										</svg>
										<span><?php echo $duration; ?></span>
									</div>
									<div class="form__pregates_title"><?=get_the_title()?></div>
									<div class="form__pregates_note">
										<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 2V16C0.5 17.1 1.39 18 2.5 18H16.5C17.6 18 18.5 17.1 18.5 16V2C18.5 0.9 17.6 0 16.5 0H2.5C1.39 0 0.5 0.9 0.5 2ZM12.5 6C12.5 7.66 11.16 9 9.5 9C7.84 9 6.5 7.66 6.5 6C6.5 4.34 7.84 3 9.5 3C11.16 3 12.5 4.34 12.5 6ZM3.5 14C3.5 12 7.5 10.9 9.5 10.9C11.5 10.9 15.5 12 15.5 14V15H3.5V14Z" fill="white"/>
										</svg>
										<span>
										<?php if($lang=='en'): ?>
											(Have an identity document with you)
										<?php else: ?>
											При себе иметь документ удостоверяющий личность.
										<?php endif; ?>  
										</span>
									</div>
								</div>
								
								<div class="form__gates">									
									<div class="pay_info__item">
										<div class="pay_info__item_title">Оплата 100%</div>
										<div class="pay_info__item_text">
											<p>Для экономии вашего времени рекомендуем покупать билет по полной стоимости.</p>
											<p>В этом случае необходимо прийти к месту посадки за 5-10 мин. до начала экскурсии и насладиться поездкой.</p>
										</div>
									</div>
									
									<div class="pay_info__item">
										<div class="pay_info__item_title">Предоплата 30%</div>
										<div class="pay_info__item_text">
											<p>Предоплата доступна на некоторые программы.</p>
											<p>При покупке по предоплате вам необходимо оплатить оставшуюся часть за 30 мин. до начала экскурсии в нашем офисе на Лиговском проспекте, 47, 3 этаж, офис 4. <br><b>Иначе бронь будет автоматически снята.</b></p>
										</div>
									</div>
									
									<div class="pay_info__item">
										<div class="pay_info__item_title">После оплаты</div>
										<div class="pay_info__item_text">
											<p>Вам на почту придут письма с подтверждением бронирования, квитанцией и билетом с организационной информацией.</p>
										</div>
									</div>
								</div>							
							</div>							
						<?php endif ?>
						
					</div>
				<?php endif ?>
