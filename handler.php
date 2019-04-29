<?php
	/* 
		Файл, который ловит и обрабатывает ajax запрос.
		Вся выводимая с паомощью echo информация
		будет помещена в ответ и кинута обратно в файл
		с ajax, где её поймает и обработает функция 
		success. 

		По сути, в данном случае, нам приходят данные в виде
		двух массивов $_POST и $_FILES, из которых мы должны
		их достать и обработать как следует.

	*/

	// Создаём три флажка для проверки пришедшего запроса
	$flag_form[0] = null;	$flag_form[1] = null;	$flag_form[2] = null;

	// Перемещаем данные из $_POST в переменные, чтобы удобнее было с ними работать
	$area = $_POST['area'];
	$validity = $_POST['validity'];
	// echo "IN0"; // Просто моя отладочная информация

	// Формирование сообщения $msg на случай, если что-то не будет загружено (проверка)
	$msg = "";
	if( $_POST['phone'] != "") $phone = $_POST['phone'];
		else $msg .= "<br>-Не введён номер телефона";

	if($_POST['email'] != "") $email = $_POST['email'];
		else $msg .= "<br>-Не введён адрес электронной почты";

	if($_POST['policy'] != "") $policy = $_POST['policy'];
		else $msg .= "<br>-Не введена дата начала действия полиса";
	
	// Если первые поля введены верно, то отметить флажком '1'
	if(isset($phone) &&	isset($email) &&	isset($policy)) $flag_form[0] = "1";
		else echo $msg."<br>";

	/* Проверка - используются ли файлы вместо первого блока полей?
		 Если существует имя первого файла первой формы файлов, то файлы используются
		 Отметить флажком 'f'
	*/
	if(isset($_FILES['first_form_file']['name'])) $flag_form[1] = "f";
	else{ // Если нет, то проверяются заполняемые поля 
		$msg = "<br>";
		if($_POST['brand'] != "") $brand = $_POST['brand'];
			else $msg .= "<br>-Не введена марка автомобиля";

		if($_POST['model'] != "") $model = $_POST['model'];
			else $msg .= "<br>-Не введена модель автомобиля";
			
		if($_POST['state'] != "") $state = $_POST['state'];
			else $msg .= "<br>-Не введён государственный номер";
		
		// Если все три параметра были указаны и переменные создались, отметить флажком 'i'
		if(isset($brand) &&	isset($model) &&	isset($state))	$flag_form[1] = "i";
			else echo $msg."";
	}

	/* Проверка - используются ли файлы вместо второго блока полей?
		 Если существует имя первого файла второй формы файлов, то файлы используются
		 Отметить флажком 'f'
	*/
	if(isset($_FILES['second_form_file']['name'])) $flag_form[2] = "f";
	else{ // Если нет, то проверяются заполняемые поля 
		$msg = "<br>";
		if($_POST['fio'] != "") $fio = $_POST['fio'];
			else $msg .= "<br>-Не введены имя, фамилия и отчество";
			
		if($_POST['birth'] != "") $birth = $_POST['birth'];
			else $msg .= "<br>-Не введена дата рождения";

		if($_POST['document'] != "") $document = $_POST['document'];
			else $msg .= "<br>-Не выбран тип документа";

		if($_POST['series'] != "") $series = $_POST['series'];
			else $msg .= "<br>-Не введена серия документа";

		if($_POST['number'] != "") $number = $_POST['number'];
			else $msg .= "<br>-Не введён номер документа";

		if($_POST['address'] != "") $address = $_POST['address'];
			else $msg .= "<br>-Не введён адрес прописки";

		// Если все параметры были указаны и переменные создались, отметить флажком 'i'
		if(isset($fio) &&	isset($birth) &&	isset($document) &&	isset($series) &&	isset($number) &&	isset($address)) $flag_form[2] = "i";
			else echo $msg."";
	}
 
	// Некоторая отладочная информация, позволяющая узнать, все ли флажки были сформированы
	/*
		if($flag_form[0]!=null){
			echo " OK 1 ";	
		}
		if($flag_form[1] !=null){
			echo " OK 2 ";	
		}
		if($flag_form[2]!=null){
			echo " OK 3 ";	
		}
		if($flag_form[0]!=null && $flag_form[1] !=null && $flag_form[2]!=null){
			echo " OK 4 ";	
		} 
	*/

	/* 
		Блоки формирования и отправки сообщения.
		Формируются четыре блока-функции на вариации флагов:
									1ii , 1fi , 1if , 1ff
		После чего сообщение отправляется.

		Для работы с переменными, функция нуждается в их передаче
	*/
	function sendMessage1ii($area,$validity,$phone,$email,$policy,$brand,$model,$state,$fio,$birth,$document,$series,$number,$address){
		// формирование переменных для функции mail()
		$to = "aldmitwork@yandex.ru"; // Адрес получателя
		$from = 'Yansex@webmaser.ru'; // Адрес отправителя
		$subject = "Заполнена контактная форма с ".$_SERVER['HTTP_REFERER']."Название формы "; // Заголовок письма

		$boundary = md5(date('r', time())); // формирование разделителя разделов
		$filesize = ''; // Понадобится для определения размера файла
		$headers = "MIME-Version: 1.0\r\n"; // формирование служебной информации для разметки MIME
		$headers .= "From: " . $from . "\r\n"; // Формирование адреса отправителя
		$headers .= "Reply-To: " . $from . "\r\n"; 
		$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n"; // Определение типа контента
		/*
			Разметка разделов по MIME:
				Так задаётся тип раздела (Content-Type: multipart/mixed;)
				Так показывается вложенность разделов (boundary=\"$boundary\")
				Так разделы разграничиваются (--$boundary)
				Так происходит закрытие формирования сообщения (--$boundary--")

				Доп. информацию искать по запросам "Письма на MIME"
		*/
		$message="
			Content-Type: multipart/mixed; boundary=\"$boundary\" 

			--$boundary

			Заявка на Грин карту:

			Территория покрытия: ".$area." 
			Срок действия: ".$validity." 
			Контактный телефон: ".$phone." 
			E-mail: ".$email." 
			Дата начала действия полиса: ".substr($policy,-2).".".substr($policy,5,2).".".substr($policy,0,4)." 

			Марка автомобиля: ".$brand." 
			Модель автомобиля: ".$model." 
			Гос.номер: ".$state."

			Фамилия Имя Отчество: ".$fio."  
			Дата рождения: ".substr($birth,-2).".".substr($birth,5,2).".".substr($birth,0,4)." 
			Тип документа: ".$document." 
			Серия: ".$series." 
			Номер: ".$number." 
			Адрес прописки: ".$address."

			--$boundary--";
		if(mail($to, $subject, $message, $headers)){
			//	header(''); // Тут можно указать адрес перенаправления
			echo "Ваше сообщение отправлено успешно";
		}else{
			echo "Ваше сообщение не отправлено";
		}
	}

	function sendMessage1fi($area,$validity,$phone,$email,$policy,$brand,$model,$state,$fio,$birth,$document,$series,$number,$address){
		$to = "aldmitwork@yandex.ru"; 
		$from = 'Yansex@webmaser.ru';
		$subject = "Заполнена контактная форма с ".$_SERVER['HTTP_REFERER']."Название формы ";

		$boundary = md5(date('r', time()));
		$filesize = '';
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "From: " . $from . "\r\n";
		$headers .= "Reply-To: " . $from . "\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

		// Таким способом осуществляется отправка изображений на сайт
		for($i=0;$i<count($_FILES['first_form_file']['name']);$i++) {
			if(is_uploaded_file($_FILES['first_form_file']['tmp_name'][$i])) {
				$attachment = chunk_split(base64_encode(file_get_contents($_FILES['first_form_file']['tmp_name'][$i])));
				$filename = $_FILES['first_form_file']['name'][$i];
				$filetype = $_FILES['first_form_file']['type'][$i];
				$filesize += $_FILES['first_form_file']['size'][$i];
				$message.="
				--$boundary\n".
				"Content-Type: \"image/gif\"; name=\"$filename\"\n".
				"Content-Transfer-Encoding: base64\n" .
				"Content-Disposition: inline; filename=\"$filename\"\n\n

				$attachment";
			}
		}
		$message.="
			Content-Type: multipart/mixed; boundary=\"$boundary\"

			--$boundary

			Заявка на Грин карту:

			Территория покрытия: ".$area." 
			Срок действия: ".$validity." 
			Контактный телефон: ".$phone." 
			E-mail: ".$email." 
			Дата начала действия полиса: ".substr($policy,-2).".".substr($policy,5,2).".".substr($policy,0,4)."

			Марка автомобиля,	Модель автомобиля 
			и Гос.номер должны быть во вложениях.

			Фамилия Имя Отчество: ".$fio."  
			Дата рождения: ".substr($birth,-2).".".substr($birth,5,2).".".substr($birth,0,4)." 
			Тип документа: ".$document." 
			Серия: ".$series." 
			Номер: ".$number." 
			Адрес прописки: ".$address."

		--$boundary--";
		if(mail($to, $subject, $message, $headers)){
				//header('');
			echo "Ваше сообщение отправлено успешно";
		}else{
			echo "Ваше сообщение не отправлено";
		}
	}

	function sendMessage1if($area,$validity,$phone,$email,$policy,$brand,$model,$state,$fio,$birth,$document,$series,$number,$address){
		$to = "aldmitwork@yandex.ru"; 
		$from = 'Yansex@webmaser.ru';
		$subject = "Заполнена контактная форма с ".$_SERVER['HTTP_REFERER']."Название формы ";

		$boundary = md5(date('r', time()));
		$filesize = '';
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "From: " . $from . "\r\n";
		$headers .= "Reply-To: " . $from . "\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

		for($i=0;$i<count($_FILES['second_form_file']['name']);$i++) {
			if(is_uploaded_file($_FILES['second_form_file']['tmp_name'][$i])) {
				$attachment = chunk_split(base64_encode(file_get_contents($_FILES['second_form_file']['tmp_name'][$i])));
				$filename = $_FILES['second_form_file']['name'][$i];
				$filetype = $_FILES['second_form_file']['type'][$i];
				$filesize += $_FILES['second_form_file']['size'][$i];
				$message.="
				--$boundary\n".
				"Content-Type: \"image/gif\"; name=\"$filename\"\n".
				"Content-Transfer-Encoding: base64\n" .
				"Content-Disposition: inline; filename=\"$filename\"\n\n

				$attachment";
			}
		}
		$message.="
			Content-Type: multipart/mixed; boundary=\"$boundary\"

			--$boundary

			Заявка на Грин карту:

			Территория покрытия: ".$area." 
			Срок действия: ".$validity." 
			Контактный телефон: ".$phone." 
			E-mail: ".$email." 
			Дата начала действия полиса: ".substr($policy,-2).".".substr($policy,5,2).".".substr($policy,0,4)."

			Марка автомобиля: ".$brand." 
			Модель автомобиля: ".$model." 
			Гос.номер: ".$state."

			Фамилия Имя Отчество, Дата рождения,
			Тип документа, Серия, Номер,
			и Адрес прописки должны быть во вложениях.

		--$boundary--";
		if(mail($to, $subject, $message, $headers)){
				//header('');
			echo "Ваше сообщение отправлено успешно";
		}else{
			echo "Ваше сообщение не отправлено";
		}
	}

	function sendMessage1ff($area,$validity,$phone,$email,$policy,$brand,$model,$state,$fio,$birth,$document,$series,$number,$address){
		$to = "eag@toursfera.ru"; 
		$from = 'strahovoy@strahovoy.net';
		$subject = "Заполнена контактная форма с ".$_SERVER['HTTP_REFERER']."Название формы ";

		$boundary = md5(date('r', time()));
		$filesize = '';
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "From: " . $from . "\r\n";
		$headers .= "Reply-To: " . $from . "\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

		for($i=0;$i<count($_FILES['first_form_file']['name']);$i++) {
			if(is_uploaded_file($_FILES['first_form_file']['tmp_name'][$i])) {
				$attachment = chunk_split(base64_encode(file_get_contents($_FILES['first_form_file']['tmp_name'][$i])));
				$filename = $_FILES['first_form_file']['name'][$i];
				$filetype = $_FILES['first_form_file']['type'][$i];
				$filesize += $_FILES['first_form_file']['size'][$i];
				$message.="
				--$boundary\n".
				"Content-Type: \"image/gif\"; name=\"$filename\"\n".
				"Content-Transfer-Encoding: base64\n" .
				"Content-Disposition: inline; filename=\"$filename\"\n\n

				$attachment";
			}
		}

		for($i=0;$i<count($_FILES['second_form_file']['name']);$i++) {
			if(is_uploaded_file($_FILES['second_form_file']['tmp_name'][$i])) {
				$attachment = chunk_split(base64_encode(file_get_contents($_FILES['second_form_file']['tmp_name'][$i])));
				$filename = $_FILES['second_form_file']['name'][$i];
				$filetype = $_FILES['second_form_file']['type'][$i];
				$filesize += $_FILES['second_form_file']['size'][$i];
				$message.="
				--$boundary
				
				Content-Type: \"$filetype\"; name=\"$filename\";
				Content-Transfer-Encoding: base64
				Content-Disposition: attachment; filename=\"$filename\"
				$attachment
				";
			}
		}

		$message.="
			Content-Type: multipart/mixed; boundary=\"$boundary\"

			--$boundary

			Заявка на Грин карту:

			Территория покрытия: ".$area." 
			Срок действия: ".$validity." 
			Контактный телефон: ".$phone." 
			E-mail: ".$email." 
			Дата начала действия полиса: ".substr($policy,-2).".".substr($policy,5,2).".".substr($policy,0,4)."

			Марка автомобиля, Модель автомобиля, Гос.номер,
			Фамилия Имя Отчество, Дата рождения,
			Тип документа, Серия, Номер,
			и Адрес прописки должны быть во вложениях.

		--$boundary--";
		if(mail($to, $subject, $message, $headers)){
				//header('');
			echo "Ваше сообщение отправлено успешно";
		}else{
			echo "Ваше сообщение не отправлено";
		}
	}

	 	$flag = $flag_form[0].$flag_form[1].$flag_form[2];

	 	if($flag == "1ii"){
	 		sendMessage1ii($area,$validity,$phone,$email,$policy,$brand,$model,$state,$fio,$birth,$document,$series,$number,$address);
		}
		if($flag == "1fi"){
			sendMessage1fi($area,$validity,$phone,$email,$policy,$brand,$model,$state,$fio,$birth,$document,$series,$number,$address);
		}
		if($flag == "1if"){
			sendMessage1if($area,$validity,$phone,$email,$policy,$brand,$model,$state,$fio,$birth,$document,$series,$number,$address);
		}
		if($flag == "1ff"){
			sendMessage1ff($area,$validity,$phone,$email,$policy,$brand,$model,$state,$fio,$birth,$document,$series,$number,$address);
		}
		 