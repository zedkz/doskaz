<template>
    <div class="list__item">
        <div class="list__date">
            <span>{{ formattedDate }}</span>
        </div>
        <template v-if="event.type === 'object_reviewed'">
            <div class="list__icon"></div>
            <div class="list__text">
                <a>
                    <username :value="event.data.username"/>
                </a> прокомментировал(а) ваш объект
                <nuxt-link :to="localePath({name: 'objects-id', params: {id: event.data.id}})">{{ event.data.title }}</nuxt-link>
            </div>
        </template>
        <template v-if="event.type === 'blog_comment_replied'">
            <div class="list__icon"></div>
            <div class="list__text">
                <a>
                    <username :value="event.data.username"/>
                </a> ответил(а) ваш комментарий к посту
                <nuxt-link
                        :to="localePath({name: 'blog-cat-slug', params: {cat: event.data.categorySlug, slug: event.data.slug}})">
                    {{ event.data.title }}
                </nuxt-link>
            </div>
        </template>
        <template v-if="event.type === 'level_reached'">
            <div class="list__icon list__icon_level">
                <span>{{ event.data.level }}</span>
            </div>
            <div
                    class="list__text"
            >Поздравляем, вы достигли {{ event.data.level }} уровень! <template v-if="event.data.unlockedAbility">
                {{ abilities[event.data.unlockedAbility] }}
            </template>
                <template v-if="event.data.pointsUntilNextLevel > 0">
                    До {{ event.data.level + 1 }} уровня вам нужно набрать баллов: {{ event.data.pointsUntilNextLevel }}.
                </template>
            </div>
        </template>
        <template v-if="event.type === 'award_issued'">
            <div class="list__icon list__icon_achievment"></div>
            <div class="list__text">Вам выдана награда: "{{ event.data.title }}"</div>
        </template>

        <template v-if="event.type === 'object_added'">
            <div class="list__icon"></div>
            <div class="list__text">
                Вы добавлили объект
                <nuxt-link :to="this.localePath({name: 'objects-id', params: {id: event.data.id}})">{{ event.data.title }}</nuxt-link>, {{ event.data.categoryTitle }}
            </div>
        </template>

    </div>

    <!--
<div class="list__item">
    <div class="list__date">
        <span>10 августа</span>
    </div>
    <div class="list__icon"></div>
    <div class="list__text">
        <a href="#">Илья Давыдов</a> дополнил ваш объект
        <a href="#">Суши-бар Saya Sushi</a>
    </div>
</div>

<div class="list__item">
    <div class="list__date">
        <span>6 августа</span>
    </div>
    <div class="list__icon"></div>
    <div class="list__text">
        <a href="#">Ирина Ахметова</a> ответила на ваш комментарий к объекту
        <a href="#">Ветеринарная клиника «Мурзик»</a>
    </div>
</div>

<div class="list__item">
    <div class="list__date">
        <span>1 августа</span>
    </div>
    <div class="list__icon"></div>
    <div class="list__text">
        Ваш объект
        <a href="#">Суши-бар Saya Sushi</a> проверен и верифицирован модератором
        <a href="#">Volkorn</a>
    </div>
</div>

<div class="list__item">
    <div class="list__date">
        <span>26 июля</span>
    </div>
    <div class="list__icon list__icon_level">
        <span>7</span>
    </div>
    <div
            class="list__text"
    >Поздравляем, вы достигли 7 уровня! Теперь вы можете сменить аватар. До 8 уровня вам нужно набрать 60 баллов.</div>
</div>

<div class="list__item">
    <div class="list__date">
        <span>23 июля</span>
    </div>
    <div class="list__icon list__icon_achievment"></div>
    <div class="list__text">Вам выдана награда за активное участие в развитии портала</div>
</div>

<div class="list__item">
    <div class="list__date">
        <span>10 июля</span>
    </div>
    <div class="list__icon"></div>
    <div class="list__text">
        Ваш объект
        <a href="#">Аптека №234</a> проверен и верифицирован модератором
        <a href="#">Валерия Осинская</a>
    </div>
</div>-->
    </div>

</template>

<script>
    import format from "date-fns/format";
    import ru from "date-fns/locale/ru";
    import Username from "../Username";

    export default {
        name: "UserEvent",
        components: {Username},
        props: [
            'event'
        ],
        computed: {
            formattedDate() {
                return format(new Date(this.event.date), 'd MMMM', {
                    locale: ru
                }).toLowerCase()
            },
            abilities() {
                return {
                    status_change: 'Теперь вы можете сменить статус.',
                    avatar_upload: 'Теперь вы можете загрузить аватар.'
                }
            }
        }
    }
</script>

<style scoped>

</style>