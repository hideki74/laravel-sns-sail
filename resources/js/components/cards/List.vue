<template>
  <div class="list">
    <div class="listheader">
      <p class="list-title">{{ title }}</p>
      <p class="list-counter">total: {{ totalCardInList }}</p>
      <div class="deletelist" @click="removeList">×</div>
    </div>
    <card v-for="(item, index) in cards"
            :body="item.body"
            :key="item.id"
            :cardIndex="index"
            :listIndex="listIndex"
            />
    <card-add :listIndex="listIndex" />
  </div>
</template>

<script>
import CardAdd from './CardAdd.vue'
import Card from './Card.vue'

export default {
  components: {
    CardAdd,
    Card
  },
  props: {
    title: {
      type: String,
      required: true
    },
    cards: {
      type: Array,
      required: true
    },
    listIndex: {
      type: Number,
      required: true
    }
  },
  methods: {
    removeList() {
      if(confirm('本当にこのリストを削除しますか？')){
        this.$store.dispatch('removeList', { listIndex: this.listIndex })
      }
    },
  },
  computed: {
  totalCardInList() {
    return this.cards.length
  }
},
}
</script>

<style scoped>
.list {
  margin: 0 5px auto;
  position: relative;
  display: inline-block;
  flex-direction: column;
  align-items: flex-start;
  min-width: 290px;
  width: 290px;
  background-color: #e0e0e0;
  border-radius: 8px;
  padding: 15px;
  border: solid #ddd 1px;
  color: gray;
  vertical-align: top;
}

.listheader {
  width: 290px;
  display: inline-flex;
  justify-content: space-between;
}

.list-title {
  font-size: 20px;
  font-weight: bold;
  padding: 15px;
}

.list-counter {
  color: rgb(0, 140, 255);
  padding: 15px;
}

.deletelist {
  position: absolute;
  top: 6px;
  right: 14px;
  font-size: 28px;
}

.deletelist:hover {
  opacity: 0.8;
  cursor: pointer;
}
</style>