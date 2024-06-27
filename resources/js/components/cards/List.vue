<template>
  <div class="list">
    <div class="listheader">
      <p class="list-title">{{ title }}</p>
      <p class="list-counter">total: {{ totalCardInList }}</p>
      <div class="deletelist" @click="removeList">X</div>
    </div>
    <draggable group="cards" :list="cards" @end="$emit('change')">
    <card 
      v-for="(item, index) in cards"
      :body="item.body"
      :key="item.id"
      :cardIndex="index"
      :listIndex="listIndex"
    />
  </draggable>
  <card-add :listIndex="listIndex" />
  </div>
</template>

<script>
import CardAdd from './CardAdd.vue'
import Card from './Card.vue'
import draggable from 'vuedraggable'

export default {
  components: {
    draggable,
    CardAdd,
    Card
  },
  props: {
    title: {
      type: String,
      required: true,
    },
    cards: {
      type: Array,
      required: true,
    },
    listIndex: {
      type: Number,
      required: true,
    }
  },
  methods: {
    removeList() {
      if(confirm('本当にこのリストを削除しますか？')) {
        this.$store.dispatch('removeList', {listIndex: this.listIndex})
      }
    }
  },
  computed: {
    totalCardInList() {
      return this.cards.length;
    }
  }
}
</script>