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
                <nuxt-link :to="{name: 'complaint'}" class="button --complaint">Подать жалобу</nuxt-link>
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

            <div class="user-object --ticket">
                <div class="user-object__image">
                    <div class="image"></div>
                </div>
                <div class="user-object__description">
                    <div class="user-object__title --ticket">
                        <span>werwerewrewrwer</span>
                    </div>
                    <p class="user-object__text">
                       werwer werewrwerewr ewrewrwe wrwerw ewr wrewewrew wr wer wer we ew rwrwrewerewr  r wer wrwerwer  wer wer
                    </p>
                    <div class="user-object__params">
                        <div class="user-object__param --ticket">
                            <span>12.10.2029</span>
                        </div>
                        <a href="ticketLink" target="_blank" class="user-object__download">Скачать жалобу</a>
                    </div>
                </div>
            </div>
            <div class="user-object --ticket">
                <div class="user-object__image">
                    <div class="image"></div>
                </div>
                <div class="user-object__description">
                    <div class="user-object__title --ticket">
                        <span>werwerewrewrwer</span>
                    </div>
                    <p class="user-object__text">
                        werwer werewrwerewr ewrewrwe wrwerw ewr wrewewrew wr wer wer we ew rwrwrewerewr  r wer wrwerwer  wer wer
                    </p>
                    <div class="user-object__params">
                        <div class="user-object__param --ticket">
                            <span>12.10.2029</span>
                        </div>
                        <a href="ticketLink" target="_blank" class="user-object__download">Скачать жалобу</a>
                    </div>
                </div>
            </div>
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
                    sort: 'date_desc'
                }
            }
        },
        computed: {
            sortOptions() {
                return [
                    {value: 'date_desc', title: 'дате добавления'},
                    {value: 'date_asc', title: 'сначала старые'},
                ]
            },
        },
        watch: {
            filter: {
                handler(v) {
                    this.$router.push({...this.$route, query: v})
                },
                deep: true
            }
        }
    };
</script>

<style lang="scss">
    @import "@/styles/mixins.scss";
</style>