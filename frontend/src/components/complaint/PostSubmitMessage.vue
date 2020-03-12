<template>
    <div class="popup__wrapper" v-if="complaintPostSubmitMessage">
        <div class="popup__in --md">
            <a class="popup__close" @click="complaintPostSubmitMessage = null"></a>
            <p class="popup__text">
                Жалоба успешно отправлена. Спасибо за сотрудничество!
                Мы сформировали жалобу в pdf формате, его можно скачать тут или в вашем профиле во вкладке <nuxt-link to="/profile">Мои тикеты</nuxt-link>.
            </p>
            <div class="popup__buttons" style="justify-content: center">
                <a :href="`/api/complaints/${complaintPostSubmitMessage.complaintId}/pdf`" target="_blank" class="popup__button --yes" style="text-align: center; padding: 14px 0 16px 14px">
                    <span style="margin: 0" @click="$emit('want-to-help')">Скачать</span>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PostSubmitMessage",
        data() {
            return {complaintPostSubmitMessage: null}
        },
        mounted() {
            this.complaintPostSubmitMessage = this.$cookies.get('complaintPostSubmitMessage');
            this.$cookies.remove('complaintPostSubmitMessage')

            if(this.$route.query.test_message) {
                this.complaintPostSubmitMessage = {complaintId: 42}
            }
        }
    }
</script>

<style scoped>

</style>