<template>
	<div class="blog__in">
		<div class="blog__content">
			<h2 class="title">Блог</h2>
			<form class="input">
				<input type="text" placeholder="Поиск по блогу"/>
				<button alt="search">
					<svg width="24"	height="24"	viewBox="0 0 24 24"	fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M23.3397 20.1519L19.3617 16.1746C20.4101 14.5385 21.036 12.6053 21.036 10.5179C21.036 4.70874 16.3272 0 10.518 0C4.70944 0 0 4.70874 0 10.518C0 16.3273 4.70944 21.036 10.518 21.036C12.6053 21.036 14.5385 20.4101 16.1739 19.3617L20.1518 23.3397C21.0322 24.2201 22.4593 24.2201 23.3397 23.3397C24.2201 22.4593 24.2201 21.0323 23.3397 20.1519ZM10.518 18.0309C6.369 18.0309 3.00511 14.6677 3.00511 10.518C3.00511 6.36905 6.36905 3.00516 10.518 3.00516C14.6676 3.00516 18.0308 6.36905 18.0308 10.518C18.0308 14.6677 14.6676 18.0309 10.518 18.0309Z" fill="#5B6067"/>
					</svg>
				</button>
			</form>
			<ul class="blog__list">
				<li class="blog__list-item">
					<div class="blog__item">
						<h3 class="blog__item-title">Жалоба на игрока</h3>
						<img class="blog__item-img" src="./../../assets/img/blog/blog1.jpg" alt="Жалоба">
						<p class="blog__item-text">Каждый гражданин может повлиять на то, чтобы его окружала городская безбарьерная среда. Взывание к совести хозяев объектов, споры, объяснения и скандалы обычно ни к чему не приводят. Самый действенный способ – подача жалобы на недоступный объект в уполномоченный государственный орган. В Казахстане жалобы принимают областные Департаменты Комитета труда, социальной защиты и миграции населения. Данные государственные органы наделены полномочиями выдавать предписание на адаптацию объекта или накладывать административные штрафы за невыполнение предписаний. </p>
						<div class="blog__item-bottom">
							<div>
								<span class="blog__item-link">7 марта 2019</span>
								<span class="blog__item-link">Новости</span>
							</div>
							<div>
								<a href="" class="blog__item-link">Подробнее</a>
							</div>
						</div>
					</div>
				</li>
				<li class="blog__list-item">
					<div class="blog__item">
						<h3 class="blog__item-title">«Народный контроль» в Павлодаре: эпизоды 3 и 4</h3>
						<img class="blog__item-img" src="./../../assets/img/blog/blog2.jpg" alt="Жалоба">
						<p class="blog__item-text">Сотрудничество между проектом «Доступный Казахстан» и телеканалом Хабар продолжается. В программе «Народный контроль» вышли 2 очередных сюжета про павлодарские объекты.</p>
						<div class="blog__item-bottom">
							<div>
								<span class="blog__item-link">19 марта 2019</span>
								<span class="blog__item-link">Новости</span>
							</div>
							<div>
								<a href="" class="blog__item-link">Подробнее</a>
							</div>
						</div>
					</div>
				</li>
				<li class="blog__list-item">
					<div class="blog__item">
						<h3 class="blog__item-title">«Народный контроль» в Павлодаре: эпизоды 1 и 2</h3>
						<img class="blog__item-img" src="./../../assets/img/blog/blog3.jpg" alt="Жалоба">
						<p class="blog__item-text">С недавнего времени между проектом «Доступный Казахстан» и телеканалом Хабар началось сотрудничество по формированию контента для программы «Народный контроль». Съемки начались с Павлодара, ведущим определен герой проекта «Доступный Павлодар» Ерлан Курмангазин. В начале февраля съемочная группа проверила 10 социально значимых объектов на доступность для людей с инвалидностью.</p>
						<div class="blog__item-bottom">
							<div>
								<span class="blog__item-link">7 марта 2019</span>
								<span class="blog__item-link">Новости</span>
							</div>
							<div>
								<a href="" class="blog__item-link">Подробнее</a>
							</div>
						</div>
					</div>
				</li>
			</ul>
			<div class="blog__pagination">
				<Pagination />
			</div>
		</div>
		<div class="blog__side">
			<div class="blog__category">
				<span class="blog__category-title">Категории</span>
				<a href="" class="blog__category-link isActive"><span>Все категории</span></a>
				<a href="" class="blog__category-link"><span>Новости</span></a>
				<a href="" class="blog__category-link"><span>Обучение</span></a>
				<a href="" class="blog__category-link"><span>Видео</span></a>
				<a href="" class="blog__category-link"><span>Мероприятия</span></a>
				<a href="" class="blog__category-link"><span>Статьи</span></a>
				<a href="" class="blog__category-link"><span>Законодательство</span></a>
				<a href="" class="blog__category-link"><span>Опросы</span></a>
			</div>
			<div class="blog__category">
				<span class="blog__category-title">Дата</span>
				<a href="" class="blog__category-link isActive"><span>За все время</span></a>
				<a href="" class="blog__category-link"><span>За год</span></a>
				<a href="" class="blog__category-link"><span>За месяц</span></a>
				<a href="" class="blog__category-link"><span>За неделю</span></a>
			</div>
			<div class="blog__category --share">
				<span class="blog__category-title">Поделиться</span>
				<div class="social">
					<a href="" class="social__link --fcb">
						<img src="./../../assets/img/social/fcb.svg"/>
					</a>
					<a href="" class="social__link --vk">
						<img src="./../../assets/img/social/vk.svg"/>
					</a>
					<a href="" class="social__link --ok">
						<img src="./../../assets/img/social/ok.svg"/>
					</a>
					<a href="" class="social__link --my">
						<img src="./../../assets/img/social/my.svg"/>
					</a>
				</div>
			</div>
			<div class="blog__category">
				<a href="" class="subscribe-link">Подписаться на рассылку</a>
			</div>
		</div>
	</div>
</template>

<script>
	import Pagination from "./../Pagination";

	export default {
		components: {
			Pagination
		}
	};
</script>

<style lang="scss">
	.subscribe-link {
		display: block;
		padding: 0 0 0 30px;
		line-height: 20px;
		color: #5B6067;
		font-size: 14px;
		-webkit-transition: opacity 0.3s;
		-moz-transition: opacity 0.3s;
		-ms-transition: opacity 0.3s;
		-o-transition: opacity 0.3s;
		transition: opacity 0.3s;
		background: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0.00322759 10.6289C2.50061 10.6289 4.8483 11.6006 6.6126 13.3679C8.38013 15.1352 9.35326 17.4893 9.35326 19.9952H13.2018C13.2018 12.7165 7.28072 6.79526 0.00322759 6.79526V10.6289ZM0.00927943 3.83323C8.90987 3.83323 16.1515 11.0854 16.1515 20H20C20 8.97127 11.0316 0 0.00927943 0V3.83323ZM5.33124 17.3221C5.33124 18.788 4.13742 19.9771 2.66562 19.9771C1.19382 19.9771 0 18.7884 0 17.3221C0 15.8553 1.19342 14.6671 2.66521 14.6671C4.13701 14.6671 5.33124 15.8553 5.33124 17.3221Z' fill='%23E67C2B'/%3E%3C/svg%3E%0A") left top no-repeat;
		background-size: 20px;
		&:hover {
			opacity: 0.7;
		}
	}
	.blog {
		&__in {
			display: flex;
			justify-content: space-between;
			padding: 45px 0 30px;
			.input {
				margin: 34px 0;
			}
		}
		&__content {
			width: 710px;
		}
		&__side {
			width: 260px;
		}
		&__list {
			list-style: none;
			padding: 0;
			margin: 48px 0 0;
			&-item {
				padding: 48px 0 35px;
				border-top: 1px solid #7B95A7;
				&:first-child {
					border: none;
					padding: 0 0 35px;
				}
			}
		}
		&__item {
			&-title, & > h3 {
				font-weight: bold;
				font-size: 32px;
				margin: 0 0 32px;
				line-height: 40px;
			}
			&-img, & > img {
				display: block;
				max-width: 100%;
				margin: 32px 0 29px;
			}
			&-text, & > p {
				font-size: 16px;
				line-height: 30px;
				margin: 24px 0;
			}
			&-bottom {
				display: flex;
				justify-content: space-between;
				font-size: 0;
			}
			&-link {
				display: inline-block;
				font-size: 14px;
				line-height: 20px;
				color: #5B6067;
				& + .blog__item-link {
					margin: 0 0 0 50px;
				}
			}
		}
		&__pagination {
			padding: 40px 0 30px;
		}
		&__category {
			margin: 24px 0;
			&.--share {
				margin: 35px 0 54px;
			}
			&-link {
				display: block;
				line-height: 30px;
				color: #333333;
				position: relative;
				margin: 2px 0;
				span {
					border-bottom: 3px solid transparent;
					line-height: 20px;
				}
				&:hover {
					background: #F1F8FC;

					&:before {
						position: absolute;
						content: '';
						width: 10px;
						top: 0;
						right: 100%;
						height: 100%;
						background: #F1F8FC;
					}
				}
				&.isActive {
					font-weight: 600;
					span {
						border-color: #0F6BF5;
					}
				}
			}
			&-title {
				font-size: 14px;
				margin: 0 0 6px;
				display: block;
				color: #5B6067;
			}
			.social {
				margin: 15px 0 0;
			}
		}
	}

	.social {
		font-size: 0;
		&__link {
			display: inline-block;
			width: 50px;
			height: 50px;
			margin: 0 0 0 20px;
			line-height: 50px;
			text-align: center;
			transition: opacity 0.3s;
			&:hover {
				opacity: 0.7;
			}
			img {
				vertical-align: middle;
				display: inline-block;
			}
			&.--fcb {
				background: #4267B2;
			}
			&.--vk {
				background: #4A76A8;
			}
			&.--ok {
				background: #EE8208;
			}
			&.--my {
				background: #168DE2;
			}
			&:first-child {
				margin: 0;
			}
		}
		&.--md {
			.social__link {
				width: 30px;
				height: 30px;
				margin: 0 0 0 10px;
				line-height: 30px;
				img {
					-webkit-transform: scale(0.6);
					-moz-transform: scale(0.6);
					-ms-transform: scale(0.6);
					-o-transform: scale(0.6);
					transform: scale(0.6);
				}
				&:first-child {
					 margin: 0;
				 }
			}
		}
	}

	a.blog__item-link {
		transition: opacity 0.4s;
		&:hover {
			opacity: 0.7
		}
	}
</style>