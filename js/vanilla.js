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
		onClickDate(self) {
			var split = self.context.selectedDates[0].split('-'),
			t = 'Доступное время на '+split[2]+' '+m[self.context.selectedMonth]+' '+self.context.selectedYear;
			jQuery('[name="form_date"]').val(self.context.selectedDates[0]).change();
			jQuery('[name="form_date"]').change();
			jQuery('.form-title-time').text(t);
		},
	};
	const calendar = new Calendar('#custom_datepicker', Options);
	calendar.init();
	jQuery('[data-vc-date-today] button').click();
	jQuery('.custom_datepicker__wrapper').show();

	
	console.log(allowDates);
	//console.log(window.dates.dates);
});