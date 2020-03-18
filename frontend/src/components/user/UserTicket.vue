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
                {{typeText}}
            </p>
            <div class="user-object__params">
                <div class="user-object__param --ticket">
                    <span>{{date}}</span>
                </div>
                <a :href="ticketLink" target="_blank" class="user-object__download">Скачать жалобу</a>
            </div>
        </div>
    </div>
</template>

<script>
    import ru from 'date-fns/locale/ru'
    import format from 'date-fns/format'

    const types = [
        {
            type: "complaint1",
            name: "Жалоба на отсутствие пандуса / подъемника на входе в объект"
        },
        {
            type: "complaint2",
            name: "Жалоба на отсутствие доступа на объект или несоответствии функциональных зон объекта требованиям нормативного законодательства"
        }
    ]

    export default {
        props: [
            'ticketId',
            "ticketImg",
            "ticketTitle",
            "ticketDate",
            "ticketType",
        ],
        computed: {
            date() {
                return format(new Date(this.ticketDate), 'dd.MM.yyyy', {
                    locale: ru
                })
            },
            ticketLink() {
                return `/api/complaints/${this.ticketId}/pdf`
            },
            typeText() {
                return types.find(t => t.type === this.ticketType).name
            }
        }
    };
</script>