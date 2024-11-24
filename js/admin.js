jQuery(document).ready(function ($) {
	if($('*').is('[data-name="excursion_sort"]')){
		let input = $('[data-name="excursion_sort"] input').val(),
			table = $('[data-name="excursion_sort"]').parent().parent(),
			tag = $('[name="tag_ID"]').val();
		
		table.hide();
		
		$.post(
			a.ajaxUrl, 
			{
				action: 'get_term_tours', 
				id: tag
			},
			function(data){
				$(data).insertAfter(table);
			}
		);
		
		$('body').on('click', '.admin_tours__ud button', function(e){
			e.preventDefault();
			
			let cur_item = $(this).parent().parent().parent(),
				direction = $(this).data('direction');
				
			if(direction=='up')
				cur_item.insertBefore(cur_item.prev());
			else
				cur_item.insertAfter(cur_item.next());
			
			updateInputs();
		});
		
		function updateInputs(){
			var data = [];
			$('.admin_tours__item').each(function(i){
				let id = $(this).data('id');
				$(this).find('input').val(i);
				$(this).find('input').attr('value', i);
				
				data[i] = id;
			});
			
			$('[data-name="excursion_sort"] input').val(data.join(','));
		}
	}
});