<template>
  <div>
    <div class="person-comment" v-for="comment in comments" :key="comment.id">
      <div>
        <img
          :src="comment.userAvatar"
          class="avatar"
          v-if="!!comment.userAvatar.length"
        />
        <div
          v-else
          :style="`background:${colorGenerator()}`"
          class="no-avatar"
        ></div>
      </div>
      <div class="person-info">
        <div>
          <span class="person-name">{{ comment.userName }}</span>
          <p class="text-comment">{{ comment.text }}</p>
          <span class="date-comment small">Вчера в 22:25</span>
          <span class="small" @click="requestComment(comment.id)"
            >Ответить</span
          >
        </div>
      </div>
    </div>
  </div>
</template>
