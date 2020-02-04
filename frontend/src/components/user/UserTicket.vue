<template>
    <div class="user-object --ticket">
        <div class="user-object__image">
            <div class="image" v-bind:style="{'background-image': 'url(' + ticketImg + ')'}"></div>
        </div>
        <div class="user-object__description">
            <div class="user-object__title --ticket">
                <span>{{ticketTitle}}</span>
            </div>
            <p class="user-object__text">
                {{ticketText}}
            </p>
            <div class="user-object__params">
                <div class="user-object__param --ticket">
                    <span>{{ticketDate}}</span>
                </div>
                <div class="user-object__param" :class="ticketAnswer">
                    <span class="yes">Есть ответ</span>
                    <span class="no">Нет ответа</span>
                </div>
                <a :href="ticketLink" class="user-object__download">Скачать жалобу</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "ticketImg",
            "ticketTitle",
            "ticketText",
            "ticketDate",
            "ticketAnswer",
            "ticketLink"
        ]
    };
</script>