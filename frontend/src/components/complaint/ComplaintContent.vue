<template>
	<div class="container">
		<form @submit.prevent="submit">
			<div class="complaint__item">
				<h4 class="title --md">Персональная информация</h4>
				<div class="complaint__line complaint__row">
					<div class="complaint__col required" :class="{ 'error': $v.form.surname.$error }">
						<label for="11" class="label">Фамилия</label>
						<div class="input" id="11">
							<input type="text" v-model="form.surname">
						</div>
					</div>
					<div class="complaint__col required" :class="{ 'error': $v.form.name.$error }">
						<label for="12" class="label">Имя</label>
						<div class="input" id="12">
							<input type="text" v-model="form.name">
						</div>
					</div>
				</div>
				<div class="complaint__line complaint__row">
					<div class="complaint__col required" :class="{ 'error': $v.form.patronymic.$error }">
						<label for="21" class="label">Отчество</label>
						<div class="input" id="21">
							<input type="text" v-model="form.patronymic">
						</div>
					</div>
					<div class="complaint__col required" :class="{ 'error': $v.form.iin.$error }">
						<label for="22" class="label">ИИН</label>
						<div class="input" id="22">
							<input type="text" v-model="form.iin">
						</div>
					</div>
				</div>
				<div class="complaint__line complaint__row">
					<div class="complaint__col --lg-2 required" :class="{ 'error': $v.form.address.$error }">
						<label for="31" class="label">Адрес проживания</label>
						<div class="input" id="31">
							<input type="text" v-model="form.address">
						</div>
					</div>
					<div class="complaint__col required" :class="{ 'error': $v.form.phone.$error }">
						<label for="32" class="label">Телефон</label>
						<div class="input" id="32">
							<input type="text" v-model="form.phone">
						</div>
					</div>
				</div>
				<div class="complaint__line complaint__row">
					<div class="complaint__col --lg-2 required" :class="{ 'error': $v.form.agency.$error }">
						<label for="41" class="label">Наименование органа обращения</label>
						<div class="select" id="41">
							<select  v-model="form.agency">
								<option disabled selected value>Например, Министерство здравоохранения РК</option>
								<option>Министерство иностранных дел РК</option>
								<option>Министерство обороны РК</option>
								<option>Министерство образования РК</option>
							</select>
						</div>
					</div>
					<div class="complaint__col"></div>
				</div>
				<div class="complaint__line complaint__row">
					<div class="checkbox">
						<input type="checkbox" checked id="r1">
						<label for="r1">Запомнить мои данные</label>
					</div>
				</div>
			</div>
			<div class="complaint__item">
				<h4 class="title --md">Жалоба</h4>
				<div class="complaint__line --sm complaint__row required" :class="{ 'error': $v.form.type.$error }">
					<div class="complaint__col --text">
						<label for="s2" class="label --vertical">Вид жалобы</label>
					</div>
					<div class="complaint__col --lg">
						<div class="select">
							<select id="s2" v-model="form.type">
								<option>Жалоба на отсутствие доступа на объект или несоответствии функциональных зон</option>
								<option>Жалоба на отсутствие доступа на объект или несоответствии функциональных зон</option>
								<option>Жалоба на отсутствие доступа на объект или несоответствии функциональных зон</option>
								<option>Жалоба на отсутствие доступа на объект или несоответствии функциональных зон</option>
							</select>
						</div>
					</div>
				</div>
				<div class="complaint__line --sm complaint__row required" :class="{ 'error': $v.form.date.$error }">
					<div class="complaint__col --text">
						<label class="label --vertical">Дата посещения объекта</label>
					</div>
					<div class="complaint__col --sm">
						<div class="input --date">
							<vuejs-datepicker :format="format" :language="ru" v-model="form.date"></vuejs-datepicker>
						</div>
					</div>
				</div>
				<div class="complaint__line --sm complaint__row required" :class="{ 'error': $v.form.objectName.$error }">
					<div class="complaint__col --text">
						<label for="i2" class="label --vertical">Название объекта</label>
					</div>
					<div class="complaint__col --lg">
						<div class="input" id="i2">
							<input type="text" v-model="form.objectName">
						</div>
					</div>
				</div>
				<div class="complaint__line --sm complaint__row required" :class="{ 'error': $v.form.city.$error }">
					<div class="complaint__col --text">
						<label for="s3" class="label --vertical">Город</label>
					</div>
					<div class="complaint__col --lg">
						<div class="select">
							<select id="s3" v-model="form.city">
								<option>Усть-Каменогорск</option>
								<option>Павлодар</option>
								<option>Петропавловск</option>
								<option>Кызылорда</option>
								<option>Астана</option>
								<option>Костанай</option>
							</select>
						</div>
					</div>
				</div>
				<div class="complaint__line --sm complaint__row required" :class="{ 'error': $v.form.street.$error }">
					<div class="complaint__col --text">
						<label for="i3" class="label --vertical">Улица</label>
					</div>
					<div class="complaint__col --lg">
						<div class="input" id="i3">
							<input type="text" v-model="form.street">
						</div>
					</div>
				</div>
				<div class="complaint__line --sm complaint__row required" :class="{ 'error': $v.form.houseNumber.$error }">
					<div class="complaint__col --text">
						<label for="i4" class="label --vertical">Номер дома</label>
					</div>
					<div class="complaint__col --sm">
						<div class="input" id="i4">
							<input type="text" v-model="form.houseNumber">
						</div>
					</div>
				</div>
				<div class="complaint__line --sm complaint__row">
					<div class="complaint__col --text">
						<label for="i5" class="label --vertical">Офис(если есть)</label>
					</div>
					<div class="complaint__col --sm">
						<div class="input" id="i5">
							<input type="text">
						</div>
					</div>
				</div>
				<div class="complaint__line --sm complaint__row required" :class="{ 'error': $v.form.purpose.$error }">
					<div class="complaint__col --text">
						<label for="i6" class="label --vertical">Цель посещения объекта</label>
					</div>
					<div class="complaint__col --lg">
						<div class="input" id="i6">
							<input type="text" v-model="form.purpose">
						</div>
					</div>
				</div>
				<div class="complaint__accordion">
					<h3 class="title --small">Выберите из списка, что именно вас не устроило на объекте</h3>
					<div class="complaint__accordion-item">
						<div class="complaint__row">
							<div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">Паркова</div>
							<div class="complaint__accordion-content complaint__col --lg">
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch1">
									<label for="ch1">Отсутствие специального парковочного места</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch2">
									<label for="ch2">Специальное парковочное место находится далеко от входа</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch3">
									<label for="ch3">Отсутствие на асфальте специальной разметки со знаком «Инвалид» </label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch4">
									<label for="ch4">Отсутствие специального знака «Инвалид» рядом с парковочным местом</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch5">
									<label for="ch5">Отсутствие бордюрного пандуса</label>
								</div>
							</div>
						</div>
					</div>
					<div class="complaint__accordion-item">
						<div class="complaint__row">
							<div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">Входная группа</div>
							<div class="complaint__accordion-content complaint__col --lg">
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch11">
									<label for="ch11">Отсутствие специального парковочного места</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch21">
									<label for="ch21">Специальное парковочное место находится далеко от входа</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch31">
									<label for="ch31">Отсутствие на асфальте специальной разметки со знаком «Инвалид» </label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch41">
									<label for="ch41">Отсутствие специального знака «Инвалид» рядом с парковочным местом</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch51">
									<label for="ch51">Отсутствие бордюрного пандуса</label>
								</div>
							</div>
						</div>
					</div>
					<div class="complaint__accordion-item">
						<div class="complaint__row">
							<div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">Пути движения по объекту</div>
							<div class="complaint__accordion-content complaint__col --lg">
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch12">
									<label for="ch12">Отсутствие специального парковочного места</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch22">
									<label for="ch22">Специальное парковочное место находится далеко от входа</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch32">
									<label for="ch32">Отсутствие на асфальте специальной разметки со знаком «Инвалид» </label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch42">
									<label for="ch42">Отсутствие специального знака «Инвалид» рядом с парковочным местом</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch52">
									<label for="ch52">Отсутствие бордюрного пандуса</label>
								</div>
							</div>
						</div>
					</div>
					<div class="complaint__accordion-item">
						<div class="complaint__row">
							<div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">Зона оказания услуг</div>
							<div class="complaint__accordion-content complaint__col --lg">
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch13">
									<label for="ch13">Отсутствие специального парковочного места</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch23">
									<label for="ch23">Специальное парковочное место находится далеко от входа</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch33">
									<label for="ch33">Отсутствие на асфальте специальной разметки со знаком «Инвалид» </label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch43">
									<label for="ch43">Отсутствие специального знака «Инвалид» рядом с парковочным местом</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch53">
									<label for="ch53">Отсутствие бордюрного пандуса</label>
								</div>
							</div>
						</div>
					</div>
					<div class="complaint__accordion-item">
						<div class="complaint__row">
							<div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">Туалет</div>
							<div class="complaint__accordion-content complaint__col --lg">
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch14">
									<label for="ch14">Отсутствие специального парковочного места</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch24">
									<label for="ch24">Специальное парковочное место находится далеко от входа</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch34">
									<label for="ch34">Отсутствие на асфальте специальной разметки со знаком «Инвалид» </label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch44">
									<label for="ch44">Отсутствие специального знака «Инвалид» рядом с парковочным местом</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch54">
									<label for="ch54">Отсутствие бордюрного пандуса</label>
								</div>
							</div>
						</div>
					</div>
					<div class="complaint__accordion-item">
						<div class="complaint__row">
							<div class="complaint__accordion-head complaint__col --text" v-on:click="toggleClass">Навигация</div>
							<div class="complaint__accordion-content complaint__col --lg">
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch15">
									<label for="ch15">Отсутствие специального парковочного места</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch25">
									<label for="ch25">Специальное парковочное место находится далеко от входа</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch35">
									<label for="ch35">Отсутствие на асфальте специальной разметки со знаком «Инвалид» </label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch45">
									<label for="ch45">Отсутствие специального знака «Инвалид» рядом с парковочным местом</label>
								</div>
								<div class="checkbox complaint__line --sm">
									<input type="checkbox" id="ch55">
									<label for="ch55">Отсутствие бордюрного пандуса</label>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="complaint__line complaint__row">
					<div class="complaint__col --text">
						<label for="t1" class="label">Другое</label>
					</div>
					<div class="complaint__col --lg">
						<textarea placeholder="Текст сообщения" class="textarea" id="t1"></textarea>
					</div>
				</div>
				<div class="complaint__line complaint__row">
					<div class="checkbox">
						<input type="checkbox" id="d1">
						<label for="d1">Данными условиями создана угроза причинения вреда моей жизни и здоровью (отметить, если это так)</label>
					</div>
				</div>
			</div>
			<div class="complaint__item">
				<div class="complaint__line complaint__row">
					<div class="complaint__col --text">
						<label for="v1" class="label">Ссылка на видео</label>
						<span class="label-text">не обязательно</span>
					</div>
					<div class="complaint__col --lg">
						<div class="complaint__line --sm">
							<div class="input">
								<input type="text" id="v1" placeholder="http://">
							</div>
						</div>

						<div class="complaint__line --sm" v-for="(input, index) in inputs" v-bind:key="index">
							<div class="input">
								<input type="text" v-model="input.videoLink" placeholder="http://">
							</div>
						</div>

						<button type="button" @click="addVideoLink" class="add-link">Добавить еще видео</button>

					</div>
				</div>
				<div class="complaint__line complaint__row required" id="file_required_class">
					<div class="complaint__col --text">
						<label for="v1" class="label">Загрузить фото</label>
					</div>
					<div class="complaint__col --lg">
						<div class="photo-input__wrapper">
							<div class="photo-input">
								<input type="file" accept="image/*" @change="imageFileChanged" id="file"/>
								<span v-if="url" v-bind:style="{ 'background-image': 'url(' + url + ')' }"></span>
							</div>
						</div>

						<button type="button" @click="addPhotoInput" class="add-link">Добавить еще фото</button>
						<div class="complaint__line">
							<button type="submit" class="button">
								Отправить
							</button>
							<p class="complaint__hide-text" v-if="$v.form.$error">Заполните, пожалуйста, все обязательные поля</p>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	import { required } from "vuelidate/lib/validators";

	export default {
		data() {
			return {
				form: {
					name: "",
					surname: "",
					patronymic: "",
					iin: "",
					address: "",
					phone: "",
					agency: "",
					type: "",
					date: "",
					objectName: "",
					city: "",
					street: "",
					houseNumber: "",
					purpose: ""
				},
				imageFile: "",
				format: "dd.MM.yyyy",
				isOpen: true,
				ru: vdp_translation_ru.js,
				inputs: [],
				photos: [],
				url: null
			};
		},
		validations: {
			form: {
				surname: { required },
				name: { required },
				patronymic: { required },
				iin: { required },
				address: { required },
				phone: { required },
				agency: { required },
				type: { required },
				date: { required },
				objectName:  { required },
				city: { required },
				street: { required },
				houseNumber: { required },
				purpose: { required }
			}
		},
		components: {
			vuejsDatepicker
		},
		methods: {
			submit() {
				this.$v.form.$touch();
				//валидация для файла c картинкой пока такая, как дополнишь для множественных напиши, сделаю исходя из того как надо
				var file = document.getElementById("file");
				if (file.files.length == 0) {
					document.getElementById("file_required_class").classList.add('error');
				}
				else {
					document.getElementById("file_required_class").classList.remove('error');
				}

				//для остальных элементов
				if( this.$v.form.$error ) return

				//дальше submit
				console.log('Submit');
			},
			toggleClass: function (event) {
				//Чтобы закрывались остальные пункты при открытии текущего
				//var matches = document.querySelectorAll('.complaint__accordion-head');
				//for(var i = 0; i < matches.length; i++) {
				//  matches[i].classList.remove('isActive');
				//}
				event.target.classList.toggle('isActive');
			},
			addVideoLink(e) {
				e.stopPropagation();
				this.inputs.push({
					videoLink: ''
				});
				e.preventDefault();
			},
			addPhotoInput(e) {
				e.stopPropagation();
				this.photos.push({
					photoInput: ''
				});
				e.preventDefault();
			},
			imageFileChanged(event) {
				var input = event.target;

				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = (e) => {
						this.url = e.target.result;
					}
					reader.readAsDataURL(input.files[0]);
				}
			}
		}
	}


</script>

<style lang="scss">

	.required {
		label {
			&:after {
				content: '*';
				color: #E0202E;
				margin: 0 0 0 5px;
			}
		}
		&.error {
			.input, .select select, .photo-input {
				border-color: #E0202E;
			}
		}
	}

	.complaint {
		&__hide {
			&-text {
				display: inline-block;
				margin: 0 0 0 20px;
			}
		}
		&__row {
			display: flex;
		}
		&__col {
			flex-basis: 0;
			flex-grow: 1;
			max-width: 100%;
			padding: 0 20px;
			&.--sm {
				flex: 0 0 (170/1080)*100%;
				max-width: (170/1080)*100%;
			}
			&.--text {
				flex: 0 0 (240/1080)*100%;
				max-width: (240/1080)*100%;
			}
			&.--lg {
				flex: 0 0 (840/1080)*100%;
				max-width: (840/1080)*100%;
			}
			&.--lg-2 {
				flex: 0 0 (690/1080)*100%;
				max-width: (690/1080)*100%;
			}
			&:first-child {
				padding: 0 20px 0 0;
			}
			&:last-child {
				padding: 0 0 0 20px;
			}
		}
		&__line {
			margin: 38px 0 0;
			&.--sm {
				margin: 20px 0 0;
			}
			&:first-child {
				margin: 0;
			}
		}
		&__item {
			background: #ffffff;
			margin: 20px 0;
			padding: 30px 40px 40px;
			.label {
				font-size: 16px;
				line-height: 20px;
				margin: 0 0 6px;
				display: block;
				font-weight: 700;
				&-text {
					font-size: 12px;
					line-height: 20px;
					color: #5B6067;
					display: block;
				}
				&.--vertical {
					padding: 15px 0 0;
					font-size: 16px;
					line-height: 20px;
					font-weight: 400;
					color: #5B6067;
				}
			}
			.add-link {
				margin: 15px 0 0;
				display: inline-block;
			}
			.photo-input {
				width: 80px;
				height: 80px;
				border: 1px solid #7B95A7;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				position: relative;
				background: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjUiIGhlaWdodD0iMjUiIHZpZXdCb3g9IjAgMCAyNSAyNSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTI0LjU1NTcgMTAuMDQ5N0gxNS4wNjE1VjAuNTU1NTQySDEwLjA0OThWMTAuMDQ5N0gwLjU1NTY2NFYxNS4wNjE0SDEwLjA0OThWMjQuNTU1NUgxNS4wNjE1VjE1LjA2MTRIMjQuNTU1N1YxMC4wNDk3WiIgZmlsbD0iIzdCOTVBNyIvPgo8L3N2Zz4K") center no-repeat;
				background-size: 24px;
				margin: 0 30px 30px 0;
				display: inline-block;
				&__wrapper {
					font-size: 0;
					margin: 0 0 -30px;
				}
				span {
					display: block;
					width: 100%;
					height: 100%;
					position: relative;
					background-size: cover;
					background-position: center;
					background-repeat: no-repeat;
					margin: 0 auto;
					z-index: 1;
				}
				input {
					cursor: pointer;
					position: absolute;
					opacity: 0;
					width: 100%;
					height: 100%;
					z-index: 2;
				}
			}
			&:first-child {
				margin: 0;
			}
		}
		&__accordion {
			margin: 60px 0 0;
			.title {
				margin: 0 0 10px;
			}
			&-item {
				border-bottom: 1px dashed #7B95A7;
				padding: 20px 0;
			}
			&-content {
				display: none;
				.complaint__line:first-child {
					margin: 4px 0 0;
				}
			}
			&-head {
				font-weight: 700;
				cursor: pointer;
				flex: 0 0 100% !important;
				max-width: 100% !important;
				position: relative;
				line-height: 30px;
				height: 30px;
				&:after {
					position: absolute;
					top: 50%;
					margin: -2px 0 0;
					right: 5px;
					content: '';
					border-top: 5px solid #333333;
					border-right: 5px solid transparent;
					border-left: 5px solid transparent;
				}
				&.isActive {
					flex: 0 0 (240/1080)*100% !important;
					max-width: (240/1080)*100% !important;
					&:after {
						margin: -2px 0 0 10px;
						right: auto;
						border-top: none;
						border-bottom: 5px solid #333333;

					}
					& + .complaint__accordion-content {
						display: block;
					}
				}
			}
		}
	}
</style>