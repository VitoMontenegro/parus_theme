document.addEventListener('dates_loaded', () => {
	var allowDates = [],
		salesDates = [];
		
	window.dates.dates.forEach((element) => {
		if(!allowDates.includes(element.date))
			allowDates.push(element.date);
	});
	
	var displayMonthsCount = (jQuery(window).width()>631)?2:1,
		type = (jQuery(window).width()>631)?'multiple':'default',
		m = [
			'января',
			'февраля',
			'марта',
			'апреля',
			'мая',
			'июня',
			'июля',
			'августа',
			'сентября',
			'октября',
			'ноября',
			'декабря'
		];
	
	const { Calendar } = window.VanillaCalendarPro;
	const Options = {
		type: type,
		displayMonthsCount: displayMonthsCount,
		monthsToSwitch: 1,
		displayDatesOutside: false,
		locale: 'ru-RU',
		disableAllDates: true,
		selectedTheme: 'light',
		enableDates:allowDates,
		disableDatesPast: true,
		enableDateToggle: false,
		dateMin: window.dates.min_date,
		disableToday: true,
		displayDateMin: window.dates.min_date,
		dateToday: window.dates.min_date,
		onClickDate(self) {
			jQuery('.form-title-time').hide();
			jQuery('.tickets_addr_wrap').hide();
			var split = self.context.selectedDates[0].split('-'),
			t = 'Доступное время на '+split[2]+' '+m[(split[1]*1)-1]+' '+split[0];
			jQuery('[name="form_date"]').val(self.context.selectedDates[0]).change();
			jQuery('[name="form_date"]').change();
			jQuery('.form-title-time').text(t);
			jQuery('.form-title-time').fadeIn();
			jQuery('.tickets_addr_wrap').fadeIn();
		},
	};
	const calendar = new Calendar('#custom_datepicker', Options);
	calendar.init();
	jQuery('[data-vc-date="'+window.dates.min_date+'"] button').click();
	jQuery('.custom_datepicker__wrapper').show();
});