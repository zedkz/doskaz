<template>
    <div class="popup__wrapper">
        <div class="popup__in --sm">
            <span class="popup__close" @click="close"></span>
            <h5 class="popup__title">Написать отзыв</h5>
            <textarea class="popup__textarea textarea" placeholder="Расскажите о ваших впечатлениях"
                      v-model.trim="reviewText" :disabled="reviewSubmitting"></textarea>
            <span class="popup__textarea-text">Введите минимум 20 символов</span>
            <div class="popup__buttons">
                <div class="timeline__tab-link timeline__tab-link_user"><span class="avatar"
                                                                              :style="`background-image:url(${user.avatar})`"></span>
                    <span class="name">{{ user.name }}</span></div>
                <button type="button" class="button" @click="createReview"
                        :disabled="reviewText.length < 20 || reviewSubmitting">Отправить
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import {get} from "vuex-pathify";

    export default {
        middleware: ['authenticated'],
        data() {
            return {
                reviewSubmitting: false,
                reviewText: '',
            }
        },
        computed: {
            user: get('authentication/user')
        },
        methods: {
            async createReview() {
                this.reviewSubmitting = true;
                await this.$axios.post(`/api/objects/${this.$route.params.id}/reviews`, {
                    text: this.reviewText
                })
                this.reviewText = '';
                this.reviewSubmitting = false;
                this.$emit('review-submitted')
                this.close()
            },
            close() {
                this.$router.push({
                    name: 'objects-id', params: {
                        id: this.$route.params.id
                    },
                    query: {
                        tab: 'reviews'
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>