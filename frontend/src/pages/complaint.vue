<template>
    <div class="complaint">
        <MainHeader />
        <div class="container">
            <div class="complaint__top">
                <h2 class="title">Подать жалобу</h2>
                <p class="complaint__pre-text">Внимание! В связи с тем, что Ваше письмо в дальнейшем будет направлено в государственный орган, оно должно выполнять определенные требования, такие как наличие Ф.И.О., ИИН, адреса (пункт 2 статьи 6 Закона Республики Казахстан от 12.01.2007 г. № 221-III «О порядке рассмотрения обращений физических и юридических лиц»). Пожалуйста, заполните данные поля без ошибок. Анонимные обращения не рассматриваются.</p>
                <p class="complaint__pre-text --required"><span>*</span> Поля, обязательные для заполнения</p>
            </div>
        </div>
        <div class="complaint__wrapper">
           <client-only>
               <complaint-content />
           </client-only>
        </div>
    </div>
</template>

<script>
    import MainHeader from "@/components/MainHeader";
    import ComplaintContent from "@/components/complaint/ComplaintContent";
    export default {
        components: {ComplaintContent, MainHeader},
        middleware: ['authenticated'],
        async asyncData({$axios, query: {objectId}}) {
            console.log(objectId)
        }
    }
</script>

<style lang="scss">
    @import "@/styles/mixins.scss";

    .complaint {
        &__wrapper {
            padding: 30px 0 60px;
            background: #F1F8FC;
        }
        &__top {
            padding: 46px 0 23px;
        }
        &__pre-text {
            margin: 43px 0 0;
            font-size: 16px;
            line-height: 30px;
            &.--required {
                margin: 19px 0 0;
                span {color:#E0202E;}
            }
        }
    }
</style>