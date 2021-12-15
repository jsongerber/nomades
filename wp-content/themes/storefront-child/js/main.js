(function($) {

$(document).ready(function() {

	testExercice1();
	testExercice2();
	testExercice3();
	slider();
	// form();
	scrollTop();

})

function testExercice1() {

	let text = 'Ceci est un texte';
	console.log(text);

}

function testExercice2() {

	var number1 = 10;
	let number2 = 20;

	const additionResult = number1 + number2;

	console.log(additionResult);

}

function testExercice3() {

	$('.page-title').on('click', function() {
		
		// $('.page-title').css('textTransform', 'uppercase');

		$(this).animate({
			height: 100,
			width: 100,
		}, 1000)

	})

}

function slider() {

	$('.slider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.slider-previews',
		adaptiveHeight: true
	});

	$('.slider-previews').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		asNavFor: '.slider',
		dots: false,
		focusOnSelect: true,
	});

}

function form() {


	let isRequired = $(this).hasClass('obligatoire');
	let requiredAttr = $(this).attr('required');
	
	$(this).addClass('error');
	$(this).removeClass('error');
	

	if (isRequired) {

		// Code

	} else {

		// Code

	}

	$('input').on('blur', function() {
		
		// Code
		$(this).val();

	})

	// $('.')

}

function scrollTop() {

	$(document).on('scroll', function() {

		let scrollTop = $(this).scrollTop();
		if (scrollTop > 100) {
			$('.scrolltop').addClass('show');
		} else {
			$('.scrolltop').removeClass('show');
		}

	})

	$('.scrolltop').on('click', function() {

		$('html, body').animate({ scrollTop: 0 }, 300);

	})

}

})( jQuery );