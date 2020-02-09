<template>
    <div class="user-comments__item">
        <div class="user-comments__image" v-bind:style="{'background-image': 'url(' + commentObjectImg + ')'}"></div>
        <div class="user-comments__description">
            <p class="user-comments__text">{{commentText}}</p>
            <div class="user-comments__info">{{commentDate}}&nbsp;к объекту&nbsp;<strong>{{commentObject}}</strong></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            "commentObjectImg",
            "commentText",
            "commentDate",
            "commentObject"
        ]
    };
</script>