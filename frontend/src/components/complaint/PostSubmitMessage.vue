<template>
    <div class="popup__wrapper" v-if="complaintPostSubmitMessage">
        <div class="popup__scroll">
            <div class="popup__in --md">
                <a class="popup__close" @click="complaintPostSubmitMessage = null"></a>
                <p class="popup__text">
                    Мы сформировали жалобу в .docx формате, его можно скачать тут или в вашем профиле во вкладке <nuxt-link to="/profile">Мои тикеты</nuxt-link>.
                </p>
                <div class="popup__buttons" style="justify-content: center">
                    <a :href="`/api/complaints/${complaintPostSubmitMessage.complaintId}/doc`" target="_blank" class="popup__button --yes" style="text-align: center; padding: 14px 0 16px 14px">
                    <span style="margin: 0" @click="$emit('want-to-help')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21" fill="none">
                            <path d="M10.9629 1.19636C11.3585 1.39272 11.2596 1.68725 11.1607 2.96358C11.0618 4.33809 10.5674 6.69438 9.67738 9.05068C8.78739 11.407 7.40297 13.7633 6.21632 15.4323C5.02967 17.1995 4.04079 18.2795 3.24969 18.9668C2.55748 19.654 1.96415 19.8504 1.66749 19.8504C1.37083 19.9486 1.17305 19.8504 1.07417 19.654C0.975278 19.4577 0.975278 19.1631 1.07417 18.8686C1.17305 18.4759 1.37083 18.0832 1.86527 17.5923C2.3597 17.1014 3.24969 16.4141 4.53523 15.825C5.72188 15.236 7.30408 14.6469 8.58962 14.3523C9.87515 13.9596 10.864 13.7633 11.754 13.6651C12.644 13.4687 13.3362 13.3706 14.1273 13.3706C14.8195 13.2724 15.6106 13.2724 16.3028 13.3706C16.9951 13.4687 17.6873 13.5669 18.2806 13.6651C18.8739 13.7633 19.3684 13.9596 19.8628 14.2542C20.2583 14.5487 20.6539 14.9414 20.8517 15.3341C21.0494 15.7269 21.0494 16.2177 20.8517 16.5123C20.6539 16.8068 20.3572 17.0032 20.0606 17.1995C19.665 17.2977 19.2695 17.2977 18.775 17.1995C18.2806 17.1014 17.6873 16.7086 17.0939 16.3159C16.5006 15.9232 15.9073 15.4323 15.0173 14.5487C14.1273 13.6651 13.2373 12.6833 12.3473 11.6033C11.4574 10.5234 10.7651 9.54158 10.3696 8.65796C9.87515 7.67617 9.57849 6.98892 9.38072 6.30167C9.18294 5.51623 8.98517 4.82898 8.98517 4.23991C8.88628 3.55265 8.98517 3.06176 8.98517 2.57086C9.08405 2.07997 9.18294 1.68725 9.28183 1.4909C9.4796 1.29454 9.67738 1.09818 9.77627 1.09818C9.97404 1 10.0729 1 10.0729 1C10.1718 1 10.2707 1 10.3696 1C10.6663 1 10.864 1.19636 10.9629 1.19636Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linejoin="round"/>
                        </svg>
                        Скачать
                    </span>
                    </a>
                </div>
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