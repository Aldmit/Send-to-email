<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="orange_shape_styles.css">
		<script type="text/javascript" src="handler.js"></script>
		<title>Document</title>
	</head>
	<body>
		<section>
			<div class="showMessage">
				<div class="showMessage__box">
					<span class="showMessage__headText"></span>
					<span class="showMessage__desc">Описание</span>
				</div>
			</div>
			<div class="container calculator__wrapper">
				<div class="calculator__steps green-card">
					<div class="calculator__steps__relative">
						<div class="calculator__steps__step calculator__steps__step--1">1. Рассчитайте стоимость карты</div>
						<div class="calculator__steps__step calculator__steps__step--2"'>2. Введите данные страхователя</div>
						<div class="calculator__steps__step calculator__steps__step--3">3. Закажите зеленую карту</div>
					</div>
				</div>
				<div class="row">
					<div class="col-3 ml-auto calculator__form__input">
						<input type="text" name="" id="" placeholder="Выберите тип ТС" disabled value="Легковой автомобиль">
					</div>
					<div class="col-4 alculator__form__holder--w35" id="hoverMenu1">
						<div class="calculator__form__input 
												calculator__form__input--ico-loc 
												input--dropdown toggable-list-dropdown"
								data-toggle="tooltip" data-placement="top" title="Выберите покрытие">
								<!-- drop -->
								<input id="select_coverage__input1" type="text" placeholder="Выберите покрытие" readonly name='country' required>
								<!-- drop -->
								<div class="calculator__form__dropdown calculator__form__dropdown--no-pad">
										<ul class="calculator__form__dropdown__custom-select">
												<li data-v="b" data-value="Все страны (Европа + СНГ)">Все страны (Европа + СНГ)</li>
												<li data-v="a" data-value="Украина, Молдова, Беларусь">Украина, Молдова, Беларусь</li>
										</ul>
								</div>
								<!-- drop -->
						</div>
					</div>
					<div class="col-3 calculator__form__holder--w35 mr-auto" id="hoverMenu2">
						<div class="mr-auto calculator__form__input">
							<input type="text" name="" id="select_coverage__input2" placeholder="Срок действия" readonly required>
							<div class="calculator__form__dropdown calculator__form__dropdown--no-pad">
									<ul class="calculator__form__dropdown__custom-select">
											<li data-value="15 дней" data-v="1">15 дней</li>
											<li data-value="1 месяц" data-v="2">1 месяц</li>
											<li data-value="2 месяца" data-v="3">2 месяца</li>
											<li data-value="3 месяца" data-v="4">3 месяца</li>
											<li data-value="4 месяца" data-v="5">4 месяца</li>
											<li data-value="5 месяцев" data-v="6">5 месяцев</li>
											<li data-value="6 месяцев" data-v="7">6 месяцев</li>
											<li data-value="7 месяцев" data-v="8">7 месяцев</li>
											<li data-value="8 месяцев" data-v="9">8 месяцев</li>
											<li data-value="9 месяцев" data-v="10">9 месяцев</li>
											<li data-value="10 месяцев" data-v="11">10 месяцев</li>
											<li data-value="11 месяцев" data-v="12">11 месяцев</li>
											<li data-value="12 месяцев" data-v="13">12 месяцев</li>
									</ul>
							</div>
						</div>
					</div>
					
					<div class="w-100"></div>
					<div class="col text-center">
						<button id="button_calc" class="btn btn-calc-cta btn--have-price" type="">РАССЧИТАТЬ СТОИМОСТЬ</button>		
					</div>
				</div>
	<!-- 
				<form  enctype="multipart/form-data" method="POST" id="main"> -->
				<div id="section_inputs" class="row regular-input">
					<div class="col-1"></div>
					<div class="col-7">
						<div class="col-12">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>Контактный телефон</label>
										<input 	class="calculator__form__input left-icon calculator__form__contacts__input--ico-phone" 
														type="tel" name="phone" placeholder="Пример: 71234567890" 
														data-toggle="tooltip" data-placement="top" 
														title="Номер телефона должен содержать 11 цифр и начинаться с цифры 7"
														pattern="^7[0-9]{10}">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label>Ваш email</label>
										<input 	class="calculator__form__input left-icon calculator__form__contacts__input--ico-email" 
														type="text" name="email" placeholder="Пример: my_adress@mail.ru" 
														data-toggle="tooltip" data-placement="top" 
														title="Email - это ваша электронная почта, по которой с вами можно связаться."
														>
									</div>
								</div>
							</div>					
						</div>

						<div class="col-12 b-line">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>Дата начала действия Полиса</label>
										<input 	class="calculator__form__input left-icon calculator__form__contacts__input--ico-phone" 
														id="calc__select-startdate" type="date" name="date_start" placeholder="Пример: 22.01.2016" 
														data-toggle="tooltip" data-placement="top" title="Дата должна иметь формат ДД.ММ.ГГ"
														pattern="^[0-9]{2}\.[0-9]{2}\.[0-9]{4}">
									</div>
								</div>
							</div>					
						</div>

						<div class="col-12">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>Марка автомобиля</label>
										<input 	class="calculator__form__input calculator__form__input--ico-car" 
														id="calc__green__car-make" type="text" name="car_make" placeholder="Введите марку автомобиля" 
														data-toggle="tooltip" data-placement="top" title="Марка автомобиля должна быть введена на английском"
														pattern="^[\x1F-\xBF]*">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label>Модель автомобиля</label>
										<input 	class="calculator__form__input calculator__form__input--ico-car" 
														id="calc__green__car-model" type="text" name="car_model" placeholder="Введите модель автомобиля" 
														data-toggle="tooltip" data-placement="top" title="Модель автомобиля должна быть введена на английском"
														pattern="^[\x1F-\xBF]*">
									</div>
								</div>
							</div>					
						</div>

						<div class="col-12 b-line">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>Гос. номер</label>
										<input 	class="calculator__form__input calculator__form__input--car-reg-num" 
														id="" type="text" name="car-reg-num" placeholder="A000AAREG" 
														data-toggle="tooltip" data-placement="top" title="Введите гос. номер автомобиля страхователя"
														pattern="^[abcehkmoptxyABCEHKMOPTYX]{1}[0-9]{3}[abcehkmoptxyABCEHKMOPTYX]{2}[0-9]{1,3}">
									</div>
								</div>
							</div>					
						</div>

						<div class="col-sm-12">
								<div class="calculator__form__separator__group-title">Данные cтрахователя</div>
								<div class="alert alert--black">В полисе зеленая карта указываются только данные страхователя Управлять ТС может любой водитель</div>
						</div>

						<div class="col-12">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>Полное ФИО</label>
										<input 	class="calculator__form__input calculator__form__input--ico-car" 
														id="" type="text" name="fio" placeholder="Захаров Константин Артемьевич" 
														data-toggle="tooltip" data-placement="top" title="Введите ФИО страхователя"
														pattern="[^0-9]*">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label>Дата рождения</label>
										<input 	class="calculator__form__input calculator__form__input--ico-car" 
														id="calc__select-birthdate" type="date" name="dob" placeholder="Пример: 13.06.1973" 
														data-toggle="tooltip" data-placement="top" title="Введите дату рождения страхователя"
														pattern="^[0-9]{2}\.[0-9]{2}\.[0-9]{4}">
									</div>
								</div>
							</div>					
						</div>

						<div class="col-12">
							<div class="row">
								<div class="col-12">
									<div class="form-group mt15">
											<label>Выберите тип документа</label>
											<div class="radio-buttons" id="choice-delivery">
													<div class="radio-buttons__btn">
															<input class="bt0n" type="radio" name="document_type" id="document_type_1" value="passport" checked>
															<label for="document_type_1"><span>Паспорт</span></label>
													</div>
													<div class="radio-buttons__btn">
															<input class="bt0n" type="radio" name="document_type" id="document_type_2" value="zagran">
															<label for="document_type_2"><span>Загранпаспорт</span></label>
													</div>
													<div class="radio-buttons__btn">
															<input class="bt0n" type="radio" name="document_type" id="document_type_3" value="prava">
															<label for="document_type_3"><span>Права</span></label>
													</div>
											</div>
									</div>
								</div>
							</div>					
						</div>

						<div class="col-12 b-line">
							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<label>Серия</label>
										<input 	class="calculator__form__input left-icon calculator__form__input--ico-numeric" 
														id="" type="text" name="doc_serial" placeholder="0000" 
														data-toggle="tooltip" data-placement="top" title="Введите серию документа"
														pattern="^[0-9]{4}">
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<label>Номер</label>
										<input 	class="calculator__form__input left-icon calculator__form__input--ico-numeric" 
														id="" type="text" name="doc_number" placeholder="000000" 
														data-toggle="tooltip" data-placement="top" title="Введите номер документа"
														pattern="^[0-9]{6}">
									</div>
								</div>
							</div>					
						</div>

						<div class="col-12">
							<div class="row">
								<div class="col-12">
									<div class="form-group">
										<label>Адрес прописки</label>
										<input 	class="calculator__form__input left-icon calculator__form__contacts__input--ico-loc" 
														id="" type="text" name="address" placeholder="125525, Санкт-Петербург, ул. Строителей, дом 5 кв. 124" 
														data-toggle="tooltip" data-placement="top" title="Введите адрес прописки, указанный в паспорте страхователя"
														>
									</div>
								</div>
							</div>					
						</div>	
						<div class="w-100"></div>
						<div class="col m-auto  text-center">
							<div id="button_send" class="btn btn-calc-cta btn--have-price">ОФОРМИТЬ ЗАКАЗ</div>		
						</div>
					</div>
					<div class="col-3 green-sidebar">
						<div class="calculator__form__uploader">
								<div class="calculator__form__uploader__title">
										Загрузите скан свидетельства о регистрации ТС и не заполняйте поля слева
										<div class="dropzone">
												<div class="fallback">
														<label class="file-input-box" for="file-input1">Выбрать файлы</label>
														<input name="file[]" type="file" id="file-input1" multiple />
												</div>
											</div>
										<div id="file_names1"></div>
								</div>
						</div>
						
						<div class="calculator__form__uploader">
								<div class="calculator__form__uploader__title">
										Загрузите документ удостоверяющий личность (паспорт/права/загран. паспорт) и
										не заполняйте поля слева
										<div class="dropzone">
												<div class="fallback">
													<label class="file-input-box" for="file-input2">Выбрать файлы</label>
													<input name="file[]" type="file" id="file-input2" multiple />
												</div>
											</div>
										<div id="file_names2"></div>
								</div>
						</div>

						<div class="calculator__form__price-preview">
								<div id="down_calc" class="calculator__form__price-preview__title">
										Цена вашего полиса Зеленая карта составит: <b><span>0 руб</span></b>
								</div>
								<div class="calculator__form__price-preview__price"></div>
						</div>
					</div>
	<!-- 
				</form> -->
					<div class="col-1"></div>
				</div>

			</div>
		</section>
	</body>
</html>