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
                <a href="" class="object-side__button --complaint">Подать жалобу</a>
            </div>
        </div>
        <div class="user-objects__content">
            <UserTicket
                :ticketImg="require('./../../assets/img/objects/1.png')"
                ticketTitle="Суши-бар Saya Sushi"
                ticketText="Жалоба на отсутствие доступа на объект или несоответствие функциональных зон объекта требованиям нормативного законодательства"
                ticketDate="12.08.2019"
                ticketAnswer="yes"
                ticketLink="#"
            />
            <UserTicket
                    :ticketImg="require('./../../assets/img/objects/1.png')"
                    ticketTitle="Стоматологическая клиника Vitadent"
                    ticketText="Жалоба на отсутствие пандуса/подъёмника на входе в объект"
                    ticketDate="25.11.2019"
                    ticketAnswer="no"
                    ticketLink="#"
            />
        </div>
    </div>
</template>

<script>
    import UserTicket from "./UserTicket";

    export default {
        components: {
            UserTicket
        }
    };
</script>

<style lang="scss">
    @import "./../../styles/mixins.scss";
</style>