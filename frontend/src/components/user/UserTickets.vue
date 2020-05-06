<template>
    <div class="user-objects">
        <h3 class="user-profile__mob-title">Мои тикеты</h3>
        <div class="user-objects__filter --between">
            <div class="filter">
                <div class="filter__text">Сортировать по</div>
                <div class="filter__dropdown">
                    <dropdown v-model="filter.sort" :options="sortOptions"/>
                </div>
            </div>
            <div class="filter">
                <nuxt-link :to="localePath({name: 'complaint'})" class="button --complaint">Подать жалобу</nuxt-link>
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
    import Dropdown from "../Dropdown";

    export default {
        props: [
            'pages',
            'complaints'
        ],
        components: {
            Dropdown,
            Pagination,
            UserTicket
        },
        data() {
            return {
                filter: {
                    sort: 'date desc'
                }
            }
        },
        computed: {
            sortOptions() {
                return [
                    {value: 'date desc', title: 'дате добавления'},
                    {value: 'date asc', title: 'сначала старые'},
                ]
            },
        },
        watch: {
            filter: {
                handler(v) {
                    this.$router.push(this.localePath({...this.$route, query: v}))
                },
                deep: true
            }
        }
    };
</script>

<style lang="scss">
    @import "@/styles/mixins.scss";
</style>