<template>
  <div class="category-selector">
    <div class="availability">
      <div class="availability__item availability__item_green isActive">
        <div class="availability__icon"></div>
        <span class="availability__text">Доступно</span>
      </div>
      <div class="availability__item availability__item_yellow">
        <div class="availability__icon"></div>
        <span class="availability__text">Частично доступно</span>
      </div>
      <div class="availability__item availability__item_red">
        <div class="availability__icon"></div>
        <span class="availability__text">Недоступно</span>
      </div>
    </div>

    <div class="category">
      <div class="category__scroll">
        <template v-if="category == ''">
          <div
            class="category__item category__item_food category__item_red"
            v-for="cat in categories"
            :key="cat.id"
          >
            <!-- <font-awesome-icon icon="user-secret" /> -->
            <i :class="'fa ' + cat.icon"></i>
            <div class="category__text" @click="selectCategory(cat.title)">
              {{ cat.title }}
            </div>
          </div>
        </template>
        <template v-else>
          <p class="subcategory-title" @click="category = ''">&#8592; {{ category }}</p>
          <div
            class="category__item category__item_food category__item_red"
            v-for="subcat in subcategory.subCategories"
            :key="subcat.id"
          >
            <div class="category__icon"></div>
            <div class="category__text" @click="setCategoryId(subcat.id)">{{ subcat.title }}</div>
          </div>
        </template>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      category: ""
    };
  },
  mounted() {
    this.$store.dispatch("getCategories");
  },
  methods: {
    selectCategory(cat) {
      this.category = cat;
    },
    setCategoryId(id) {
      this.$store.commit('setCategoryId', id)
      this.$root.$emit('setCategoryId', id);
    }
  },
  computed: {
    categories() {
      return this.$store.getters.retCategories;
    },
    subcategory() {
      let cat = this.$store.getters.retCategories;
      return cat.find(subcat => subcat.title === this.category);
    }
  }
};
</script>

<style lang="scss">
@import "./../styles/mixins.scss";

.category-selector .category .category__scroll .subcategory-title {
  width: 100%;
  cursor: pointer
}
.category-selector {
  height: calc(100% - 225px);

  .availability {
    display: flex;
    flex-direction: row;
    justify-content: flex-start;
    align-items: center;
    padding-bottom: 30px;

    &__item {
      display: flex;
      flex-direction: row;
      justify-content: flex-start;
      align-items: center;
      background: $tr;
      transition: background 0.3s;
      margin-left: 20px;
      cursor: pointer;

      &:first-child {
        margin-left: 0;
      }

      &:hover {
        background: #f1f8fc;
      }

      &.isActive {
        background: #f1f8fc;

        .availability {
          &__text {
            font-weight: bold;
          }
        }

        &.availability__item_green {
          .availability {
            &__icon {
              background-color: $green;
              background-image: url("data:image/svg+xml,%3Csvg width='22' height='14' viewBox='0 0 22 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M3.22581 0L0 3.20635L11 14L22 3.20635L18.7419 0L11 7.65079L3.22581 0Z' fill='white'/%3E%3C/svg%3E%0A");
            }
          }
        }

        &.availability__item_yellow {
          .availability {
            &__icon {
              background-color: $yellow;
              background-image: url("data:image/svg+xml,%3Csvg width='24' height='6' viewBox='0 0 24 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M23.993 0.0017395H0.00708008V5.99821H23.993V0.0017395Z' fill='%23FFFFFF'/%3E%3C/svg%3E%0A");
            }
          }
        }

        &.availability__item_red {
          .availability {
            &__icon {
              background-color: $red;
              background-image: url("data:image/svg+xml,%3Csvg width='22' height='22' viewBox='0 0 22 22' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M21.2646 4.29808L17.702 0.735474L11 7.47269L4.29808 0.735474L0.735474 4.29808L7.47269 11L0.735474 17.702L4.29808 21.2646L11 14.5274L17.702 21.2646L21.2646 17.702L14.5274 11L21.2646 4.29808Z' fill='%23FFFFFF'/%3E%3C/svg%3E%0A");
            }
          }
        }
      }

      &.availability__item_green {
        .availability {
          &__icon {
            border: 2px solid $green;
            background-image: url("data:image/svg+xml,%3Csvg width='22' height='14' viewBox='0 0 22 14' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M3.22581 0L0 3.20635L11 14L22 3.20635L18.7419 0L11 7.65079L3.22581 0Z' fill='%233DBA3B'/%3E%3C/svg%3E%0A");
          }
        }
      }

      &.availability__item_yellow {
        .availability {
          &__icon {
            border: 2px solid $yellow;
            background-image: url("data:image/svg+xml,%3Csvg width='24' height='6' viewBox='0 0 24 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M23.993 0.0017395H0.00708008V5.99821H23.993V0.0017395Z' fill='%23F8AC1A'/%3E%3C/svg%3E%0A");
          }
        }
      }

      &.availability__item_red {
        .availability {
          &__icon {
            border: 2px solid $red;
            background-image: url("data:image/svg+xml,%3Csvg width='22' height='22' viewBox='0 0 22 22' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M21.2646 4.29808L17.702 0.735474L11 7.47269L4.29808 0.735474L0.735474 4.29808L7.47269 11L0.735474 17.702L4.29808 21.2646L11 14.5274L17.702 21.2646L21.2646 17.702L14.5274 11L21.2646 4.29808Z' fill='%23DE1220'/%3E%3C/svg%3E%0A");
          }
        }
      }
    }

    &__icon {
      display: block;
      width: 40px;
      height: 40px;
      transition: border 0.3s, background 0.3s;
      background-color: $tr;
      background-position: center;
      background-repeat: no-repeat;
    }

    &__text {
      padding: 0 10px;
      font-size: 16px;
      line-height: 20px;
      color: #333333;
    }
  }

  .category {
    height: calc(100% - 70px);

    &__scroll {
      position: relative;
      overflow-x: hidden;
      overflow-y: auto;
      height: 100%;
      padding-right: 30px;
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-start;
      align-items: flex-start;

      &::-webkit-scrollbar {
        width: 10px;
      }

      &::-webkit-scrollbar-track {
        background: $tr;
      }

      &::-webkit-scrollbar-thumb {
        background: transparentize(#c4c4c4, 0.5);
      }
    }

    &__item {
      display: flex;
      flex-direction: row;
      justify-content: flex-start;
      align-items: center;
      background: $tr;
      transition: background 0.3s;
      margin-left: 20px;
      cursor: pointer;
      width: 230px;
      margin-bottom: 20px;

      &:first-child {
        margin-left: 0;
      }

      &:nth-child(odd) {
        margin-left: 0;
      }

      &:hover {
        background: #f1f8fc;

        .category {
          &__text {
            font-weight: bold;
          }
        }

        &.category__item_green {
          .category {
            &__icon {
              background-color: $green;
            }
          }
        }

        &.category__item_yellow {
          .category {
            &__icon {
              background-color: $yellow;
            }
          }
        }

        &.category__item_red {
          .category {
            &__icon {
              background-color: $red;
            }
          }
        }
      }

      &.category__item_food {
        .category {
          &__icon {
            background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.01941 5.74903V14.9348C5.01941 15.1743 5.10678 15.3815 5.28189 15.5564C5.45391 15.7285 5.65748 15.815 5.89203 15.8178C6.12643 15.815 6.33015 15.7284 6.50235 15.5564C6.67728 15.3815 6.76463 15.1743 6.76463 14.9348V5.74903C7.02711 5.65713 8.01101 4.78018 8.01101 4.49901V0.804473C8.01101 0.685021 7.96714 0.581326 7.87977 0.493774C7.79221 0.406399 7.68852 0.362534 7.56907 0.362534C7.44926 0.362534 7.34574 0.406399 7.25837 0.493774C7.17082 0.581504 7.12713 0.685021 7.12713 0.804473V3.67718C7.12713 3.79699 7.08326 3.90051 6.99589 3.98788C6.90834 4.07543 6.80482 4.11894 6.68519 4.11894C6.56538 4.11894 6.46187 4.07543 6.37449 3.98788C6.28712 3.90051 6.24325 3.79681 6.24325 3.67718V0.804473C6.24325 0.685021 6.19939 0.581326 6.11201 0.493774C6.02464 0.406399 5.92097 0.362534 5.80134 0.362534C5.68153 0.362534 5.57802 0.406399 5.49064 0.493774C5.40309 0.581504 5.3594 0.685021 5.3594 0.804473V3.67718C5.3594 3.79699 5.31554 3.90051 5.22816 3.98788C5.14061 4.07543 5.03709 4.11894 4.91746 4.11894C4.79766 4.11894 4.69414 4.07543 4.60676 3.98788C4.51921 3.90051 4.47552 3.79681 4.47552 3.67718V0.804473C4.47552 0.685021 4.43184 0.581326 4.34428 0.493774C4.25691 0.406399 4.15324 0.362534 4.03358 0.362534C3.91378 0.362534 3.81026 0.406399 3.72291 0.493774C3.63554 0.581504 3.59167 0.685021 3.59167 0.804473V4.49886C3.59176 4.77997 4.75693 5.65695 5.01941 5.74903Z' fill='white'/%3E%3Cpath d='M5.90322 15.8187C5.8994 15.8187 5.89578 15.8176 5.89196 15.8176C5.88817 15.8176 5.88471 15.8187 5.88074 15.8187H5.90322Z' fill='white'/%3E%3Cpath d='M11.5467 16C11.5429 16 11.5393 15.9989 11.5355 15.9989C11.5317 15.9989 11.5281 16 11.5243 16H11.5467Z' fill='white'/%3E%3Cpath d='M9.65983 7.9552H10.663V15.1161C10.663 15.3556 10.7503 15.5628 10.9253 15.7376C11.0974 15.9097 11.301 15.9963 11.5356 15.9991C11.7699 15.9963 11.9736 15.9097 12.1458 15.7376C12.3208 15.5628 12.4083 15.3556 12.4083 15.1161V0.441939C12.4083 0.322487 12.3645 0.218793 12.2771 0.13124C12.1896 0.0438652 12.0861 0 11.9664 0H11.6488C11.0411 0 10.5208 0.216453 10.0881 0.649121C9.65551 1.08197 9.43909 1.60222 9.43909 2.20981V7.73428C9.43909 7.79411 9.461 7.84594 9.50469 7.88963C9.54817 7.93328 9.6 7.9552 9.65983 7.9552Z' fill='white'/%3E%3C/svg%3E%0A");
          }
        }
      }
    }

    &__icon {
      width: 30px;
      height: 30px;
      background-color: #f1f8fc;
      background-position: center;
      background-repeat: no-repeat;
      transition: background 0.3s;
    }

    &__text {
      font-size: 16px;
      line-height: 20px;
      color: #333333;
      padding: 0 10px;
    }
  }
}
</style>
