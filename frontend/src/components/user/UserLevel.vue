<template>
    <div class="user-level">
        <div class="user-level__progress">
            <div class="info">
                <div class="info__level">
                    <div class="info__level-num">
                        <span>{{ level.current }}</span>
                    </div>
                    <div class="info__level-text">
                        <span>уровень</span>
                    </div>
                </div>
                <div class="info__points">
                    <span>баллов {{ level.currentPoints }} / {{ level.nextLevelThreshold }}</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress__bar" v-bind:style="{'width': level.progressToNext + '%'}"></div>
            </div>
        </div>
        <div class="user-level__stats">
            <div class="stat">
                <div class="stat__num">
                    <span>{{ stats.objects }}</span>
                </div>
                <div class="stat__cat">
                    <span>объектов</span>
                </div>
            </div>
            <div class="stat">
                <div class="stat__num">
                    <span>0</span>
                </div>
                <div class="stat__cat">
                    <span>проверок</span>
                </div>
            </div>
            <div class="stat">
                <div class="stat__num">
                    <span>{{ stats.complaints }}</span>
                </div>
                <div class="stat__cat">
                    <span>жалоб</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {get} from 'vuex-pathify'

    export default {
        computed: {
            level: get('authentication/user@level'),
            stats: get('authentication/user@stats')
        }
    };
</script>

<style lang="scss">
    @import "./../../styles/mixins.scss";

    .user-level {
        background: #f1f8fc;
        padding: 26px 40px 35px;
        width: 100%;
        position: relative;

        &__progress {
            margin-bottom: 28px;

            .info {
                margin-bottom: 8px;
                display: flex;
                align-items: flex-end;
                justify-content: space-between;

                &__level {
                    display: flex;
                    align-items: flex-end;
                }

                &__level-num {
                    font-weight: 600;
                    font-size: 48px;
                    line-height: 48px;
                    color: #333333;
                }

                &__level-text {
                    font-weight: bold;
                    font-size: 14px;
                    line-height: 20px;
                    color: #333333;
                }

                &__points {
                    font-size: 14px;
                    line-height: 20px;
                    color: #5b6067;
                }
            }

            .progress {
                display: block;
                width: 100%;
                height: 8px;
                background: fade-out(#7b95a7, 0.3);
                border-radius: 10px;
                position: relative;

                &__bar {
                    position: absolute;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    border-radius: 10px;
                    background: #0f6bf5;
                }
            }
        }

        &__stats {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: flex-start;

            .stat {
                display: block;
                flex: 1 0 auto;
                text-align: left;

                &__num {
                    font-weight: bold;
                    font-size: 32px;
                    line-height: 40px;
                    color: #333333;
                }

                &__cat {
                    margin-top: -3px;
                    font-size: 14px;
                    line-height: 20px;
                    color: #5b6067;
                }
            }
        }
    }
</style>