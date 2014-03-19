jQuery(document).ready(function() {
	jQuery('table').each(function() {jQuery(this).removeAttr('border');});

	jQuery('table table').each(function() {
		jQuery(this).find('tbody > tr > td:first-child').hide();

		title = jQuery.trim(jQuery(this).find('tbody > tr:nth-child(4) > td:nth-child(2)').text());
		if (title.length == 0) {
			title = jQuery(this).find('tbody > tr:nth-child(6) > td:nth-child(2)').text().substring(0, 25);
			text = jQuery(this).find('tbody > tr:nth-child(6) > td:nth-child(2)').text();
			if (text.length > title.length) title += '...';
		}
		href = jQuery(this).find('tbody a').attr('href');
		tags = jQuery.trim(jQuery(this).find('tbody > tr:nth-child(5) > td:nth-child(2)').text());
		if (tags.length == 0) tags = '-';
		date = jQuery(this).find('tbody > tr:nth-child(3) > td:nth-child(2)').text();

		tt = jQuery('<a/>', {href:href, text: title, target: '_blank'});
	jQuery(this).find('tbody > tr:nth-child(1) > td:nth-child(2)').empty().append(tt);

	jQuery(this).find('tbody > tr:nth-child(2) > td:nth-child(2)').empty().text('Дата: ' + date + ' Тэги: ' + tags).addClass('italic');

	jQuery(this).find('tbody > tr:nth-child(3)').hide();
	jQuery(this).find('tbody > tr:nth-child(4)').hide();
	jQuery(this).find('tbody > tr:nth-child(5)').hide();

	});
});

$(document).ready(function() {
    $('table table').click(function() {
       $(this).find('.content').toggle();

       var $upto = $(this).offset().top - 50
       $(document.body).animate({
            'scrollTop': $upto
       }, 250);

    }); 
});

