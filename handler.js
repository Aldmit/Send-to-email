$(document).ready(function(){

	// Функция вывода стоимости услуги
	function calcCard(button, textBox=""){
		var a = $('#select_coverage__input1').attr('data-v');
		var b = $('#select_coverage__input2').attr('data-v');
		if(textBox!="")
			$(button).html(textBox+' <b><span></span></b>');
		else
			$(button).html('СТОИМОСТЬ УСЛУГИ: <span></span>');

		switch(a+b){
			case "a1": $(button+' span').text('840 руб'); break;
			case "a2": $(button+' span').text('1 110 руб'); break;
			case "a3": $(button+' span').text('1 670 руб'); break;
			case "a4": $(button+' span').text('2 230 руб'); break;
			case "a5": $(button+' span').text('2 780 руб'); break;
			case "a6": $(button+' span').text('3 340 руб'); break;
			case "a7": $(button+' span').text('3 900 руб'); break;
			case "a8": $(button+' span').text('4 180 руб'); break;
			case "a9": $(button+' span').text('4 450 руб'); break;
			case "a10": $(button+' span').text('4 730 руб'); break;
			case "a11": $(button+' span').text('5 010 руб'); break;
			case "a12": $(button+' span').text('5 290 руб'); break;
			case "a13": $(button+' span').text('5 570 руб'); break;

			case "b1": $(button+' span').text('2 450 руб'); break;
			case "b2": $(button+' span').text('4 670 руб'); break;
			case "b3": $(button+' span').text('8 670 руб'); break;
			case "b4": $(button+' span').text('12 230 руб'); break;
			case "b5": $(button+' span').text('15 120 руб'); break;
			case "b6": $(button+' span').text('16 460 руб'); break;
			case "b7": $(button+' span').text('17 790 руб'); break;
			case "b8": $(button+' span').text('18 680 руб'); break;
			case "b9": $(button+' span').text('19 570 руб'); break;
			case "b10": $(button+' span').text('20 460 руб'); break;
			case "b11": $(button+' span').text('21 130 руб'); break;
			case "b12": $(button+' span').text('21 570 руб'); break;
			case "b13": $(button+' span').text('22 240 руб'); break;

			default: $(button+' span').text('0 руб'); break;
		}
	}

	// Функция вывода списка выбора при клике на поле
	function hoverMenu(blockId, num){	
		$(blockId+' .calculator__form__input')
			.mouseover(function(){
				$(blockId+' .calculator__form__dropdown').css('display','block');
			})
			.mouseout(function(){
				$(blockId+' .calculator__form__dropdown').css('display','none');
			})
		;

		$(blockId+' .calculator__form__dropdown__custom-select li')
			.mouseover(function(){
				$(this).css('background','rgb(200, 200, 200)');
			})
			.mouseout(function(){
				$(this).css('background','white');
			})
			.click(function(){
				$('#select_coverage__input'+num).attr('value',$(this).attr('data-value'));
				$('#select_coverage__input'+num).attr('data-v',$(this).attr('data-v'));
				calcCard("#button_calc");
				calcCard("#down_calc", "Цена вашего полиса Зеленая карта составит: ");
			})
		;
	}

	// Всплывающее окошко с сообщением
	function showMessage(description, headText=""){
		$('.showMessage__headText').html(headText);
		$('.showMessage__desc').html(description);
		$('.showMessage').fadeIn().delay(1000).fadeOut();
	}

	// Открытие списков
	hoverMenu("#hoverMenu1","1");
	hoverMenu("#hoverMenu2","2");

	// Скрытие нижних полей до ввода верхних полей
	$('#section_inputs').hide();

	// Настройки левых пунктов меню => их изменение при открытии нижних полей
	$('.calculator__steps__step--2').css("margin-top","130px");
	$('.calculator__steps__step--3').css("margin-top","20px");
	$('#button_calc').click(function(){
		if(	$('#select_coverage__input1').attr('data-v') && $('#select_coverage__input2').attr('data-v')){
			$('#section_inputs').slideDown();
			$('.calculator__steps__step--3').css("margin-top","960px");
		}
		else
			showMessage("Проверьте, введены ли данные о территории действия карты (Выбеерите покрытие) и данные о желаемом сроке действия карты (Срок действия).","Не введены данные");
	});

	// Вывод сообщений о том, что файлы загружены
	$('input[type="file"]').change(function(){
		var fileNames = "";
		var file = $(this)[0].files;
		for(var i=0; i<file.length; i++){
			if(file[i].name == file[file.length-1].name)
				fileNames += file[i].name+" .";
			else	
				fileNames += file[i].name+" ,  ";
		}
		showMessage(fileNames,"Файлы загружены");
		if($(this).attr('id')=="file-input1")
			$('#file_names1').text("Файлы загружены");
		if($(this).attr('id')=="file-input2")
			$('#file_names2').text("Файлы загружены");
	});

	// Отправка данных ajax
	$('#button_send').click(function(){
		
		// new FormData() - объект для отправки через ajax пар ключ=>значение(набор значений)
		var form_data = new FormData();
		var data;
		
		// addend(имя данных, данные) - добавление данных в объект для отправки
		for(var i=0; i<$("#file-input1").prop('files').length && i<5; i++){
			if($("#file-input1").prop('files')[i]){
				data = eval($("#file-input1").prop('files')[i]);
				form_data.append('first_form_file[]',data);
			//	console.log("Файл 1 загружен");
			}
			// else
			//  console.log("Файл 1 не найден");
		}
		// Для отправки данных требуется сформировать один цельный объект
		for(var i=0; i<$("#file-input2").prop('files').length && i<5; i++){
			if($("#file-input2").prop('files')[i]){
				data = eval($("#file-input2").prop('files')[i]);
				form_data.append('second_form_file[]',data);
		  //	console.log("Файл 2 загружен");
			}
			// else
			//  console.log("Файл 2 не найден");
		}

		// Добавление всех элементов формы в один объект
		form_data.append('area', $('#select_coverage__input1').attr('value'));
		form_data.append('validity', $('#select_coverage__input2').attr('value'));
		form_data.append('phone', $('input[name="phone"]').val());
		form_data.append('email', $('input[name="email"]').val());
		form_data.append('policy', $('input[name="date_start"]').val());
		form_data.append('brand', $('input[name="car_make"]').val());
		form_data.append('model', $('input[name="car_model"]').val());
		form_data.append('state', $('input[name="car-reg-num"]').val());
		form_data.append('fio', $('input[name="fio"]').val());
		form_data.append('birth', $('input[name="dob"]').val());
		form_data.append('document', $('input[name="document_type"]').val());
		form_data.append('series', $('input[name="doc_serial"]').val());
		form_data.append('number', $('input[name="doc_number"]').val());
		form_data.append('address', $('input[name="address"]').val());
		console.log(" PUSH ");
		
		// Формирование запроса ajax
		$.ajax({
			url: '/handler.php', // Куда кидаем запрос
			type: "POST", // Каким методом
			data: form_data, // Объект, которым кидаемся
			contentType: false, // Отключаем стандартную кодировку при отправке
			processData: false, // Указываем на то, что нам не нужна конвертация в какой-то формат
			success: function(data) { // В случае удачного запроса, принимаем данные в ответ
				if(data){
					// console.log("1");
					showMessage(data, "Оповещение");
				}
				else console.log("0");
			}
		});



	});


	
});