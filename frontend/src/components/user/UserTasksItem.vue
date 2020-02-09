<template>
    <div class="user-tasks__item">
        <div class="user-tasks__item-left">
            <div class="user-tasks__item-status" :class="tasksItemStatus"></div>
            <div class="user-tasks__item-date">{{ tasksItemDate }}</div>
            <div class="user-tasks__item-text">{{ tasksItemText }}</div>
        </div>
        <div class="user-tasks__item-points">{{ tasksItemPoints }}</div>
    </div>
</template>

<script>
    export default {
        props: [
            "tasksItemStatus",
            "tasksItemDate",
            "tasksItemText",
            "tasksItemPoints"
        ]
    };
</script>