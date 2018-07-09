$(function(){
    $('.datetime-input').datetimepicker({
    	//timeFormat: 'HH:mm:ss',
		timeFormat: 'hh:mm tt',
		dateFormat: js_date_format,
		showButtonPanel: true,
		controlType: 'select',
		changeMonth: true,
		//changeYear: true
		stepMinute:15
    });
    
	$('.datetime-input-clear').button();
	
	$('.datetime-input-clear').click(function(){
		$(this).parent().find('.datetime-input').val("");
		return false;
	});	

});