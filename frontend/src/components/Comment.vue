<template>
  <div>
    <div class="replie-comment" v-for="replie in replies" :key="replie.id">
      <div>
        <img
          :src="replie.userAvatar"
          class="avatar"
          v-if="!!replie.userAvatar"
        />
        <div
          v-else
          :style="`background:${colorGenerator()}`"
          class="no-avatar"
        ></div>
      </div>
      <div class="person-info">
        <div>
          <span class="person-name">{{ replie.userName }}</span>
          <p class="text-comment">{{ replie.text }}</p>
          <span class="date-comment small">Вчера в 22:25</span>
          <span class="small" @click="requestComment(replie.id)">Ответить</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["replies"],
  methods: {
    colorGenerator() {
      return "#" + ((Math.random() * 0xffffff) << 0).toString(16);
    }
  }
};
</script>

<style lang="scss" scoped>
.replie-comment {
  margin-top: 29px;
  display: flex;
  margin-bottom: 35px;

  .person-info {
    padding-top: 6px;
    margin-left: 10px;

    .person-name {
      font-weight: bold;
      font-size: 16px;
    }

    .date-comment {
      margin-right: 40px;
    }

    .small {
      color: #5b6067;
      font-size: 14px;
    }
  }
  .no-avatar {
    height: 30px;
    width: 30px;
    border-radius: 50%;
  }
}
</style>
