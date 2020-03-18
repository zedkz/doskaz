<template>
    <div class="user-objects">
        <div class="user-objects__filter --between">
            <div class="filter">
                <div class="filter__text">Сортировать по</div>
                <div class="filter__dropdown">
                    <div class="dropdown">
                        <div class="dropdown__selected">
                            <span>дате добавления</span>
                        </div>
                        <div class="dropdown__list">
                            <div class="dropdown__item">
                                <span>дате добавления</span>
                            </div>
                            <div class="dropdown__item">
                                <span>дате добавления</span>
                            </div>
                            <div class="dropdown__item">
                                <span>дате добавления</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter">
                <nuxt-link :to="{name: 'complaint'}" class="object-side__button --complaint">Подать жалобу</nuxt-link>
            </div>
        </div>
        <div class="user-objects__content">
            <UserTicket
                    v-for="complaint in complaints"
                    :key="complaint.id"
                    :ticket-id="complaint.id"
                    :ticketImg="complaint.image"
                    :ticketTitle="complaint.title"
                    :ticket-type="complaint.type"
                    :ticketDate="complaint.date"
            />
        </div>

        <div class="user-tickets__pagination">
            <pagination :pages="pages" v-if="pages > 1"/>
        </div>
    </div>
</template>

<script>
    import UserTicket from "./UserTicket";
    import Pagination from "../Pagination";

    export default {
        props: [
            'pages',
            'complaints'
        ],
        components: {
            Pagination,
            UserTicket
        }
    };
</script>

<style lang="scss">
    @import "@/styles/mixins.scss";
</style>