function chk_session(){
	$.get('/auth/chks', function(data, textStatus){
		if (textStatus == 'success'){ 
			if(data.status == 'NG'){
				location.replace('/auth/login');
			}
		}
	},
	'json');
};

function repaint(link){
	// delete and load DOM
	$('#main-field').load(link);
};

function sub_repaint(link){
	// delete and load DOM
	$('#sub-field').load(link);
};

function sub_repaint_form_post(link){
	var postData = {};

	$('form.ajax-post').find(':text, :password, :hidden').each(function(){
		postData[$(this).attr('name')] = $(this).val();
	});

	$.post(link, postData, function(d){select_field(d)}, 'html');
};

function select_field(data){
	if ($('#sub-field').length > 0){
		$('#sub-field').empty().html(data);
	} else {
		$('#main-field').empty().html(data);
	}
};


// jump ----------
$(document).on('click', "[id^='lnk_']", function(ev){
	// check session
	chk_session();

	// disactive nav
	$('.nav-list > li.active').removeClass('active');

	// repaint
	var id_string = $(this).attr('id').split('__');
	repaint('/' + id_string[1].replace('-', '/'));

	// reactive nav
	$(this).parent().addClass('active');

	// href disabled
	ev.preventDefault();
});


// subjump ----------
$(document).on('click', "[id^='sublnk_']", function(ev){
	// check session
	chk_session();

	// repaint
	var id_string = $(this).attr('id').split('__');
	sub_repaint('/' + id_string[1].replace('-', '/'));

	// hide
	$('.sublnk-disabled').hide();

	// href disabled
	ev.preventDefault();
});

// simple form submit ----------
$(document).on('click', 'form.ajax-post button.send-btn', function(){
	// check session
	chk_session();

	var id_string = $(this).closest('form.ajax-post').attr('id').split('__');
	sub_repaint_form_post('/' + id_string[1].replace('-', '/'));
});


// reload ----------
$(document).on('click', '.page_reload', function(){
	location.reload(true);
});


// File upload ----------
$(document).on('click', '.image-selector', function(){
	$("input[type='file']").click();

	$("input[type='file']").change(function(){
		// upload
		var id_string = $('form.ajax-post-img').attr('id').split('__');

		$.getScript('/js/jquery.upload.js', function(){
			$('input[type=file]').upload(
				'/' + id_string[1].replace('-', '/'),
				function(d){select_field(d)},
				'html'
			);
		}); // getScript end
	}); // change end
});


// image crop
$(document).on('mouseover', '#crop_target', function(){

	function setCoords(c)
    {
		$("input[name='crop_x']").val(Math.round(c.x));
		$("input[name='crop_y']").val(Math.round(c.y));
		$("input[name='crop_w']").val(Math.round(c.w));
		$("input[name='crop_h']").val(Math.round(c.h));
    }

	$.getScript('/js/jquery.jcrop.js', function(){
		$('#crop_target').Jcrop({
			onChange:  setCoords,
			onSelect:  setCoords,
			aspectRatio: 1
			//allowResize: false
		});
	}); // getScript end
});

// view unlink button
$(document).on('mouseover', "[class='media']", function(){
	var target = $(this).children('div.media-body').children('button');

	target.show();

	$(this).mouseleave(function(){
		target.hide();
	});
});


// DatePicker
$(document).on('focus', '.date', function(){
	$(this).datepicker({
		format: 'yyyy/mm/dd',
		todayHighlight: 'true',
		language: 'ja'
	});
});


// Default Loading
$(document).ready(function(){
	// Default Load
	repaint('/center/tasklists');
});
