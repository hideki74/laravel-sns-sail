<template>
  <div>
    <main>
      <p class="info-line">All: {{ totalCardCount }} tasks</p>
        <list
          v-for="(item, index) in lists"
          :key="item.id"
          :title="item.title"
          :cards="item.cards"
          :listIndex="index"
          @change="movingCard"
        />
        <list-add />
    </main>
  </div>
</template>
  
<script>
// import ListAdd from './ListAdd.vue'
import List from './List.vue'
import { mapState } from 'vuex'

export default {
  data() {
    return {
      lists: [
        {
          "cards": [
            {
              "body": "hjjj"
            },
            {
              "body": "Science"
            },
            {
              "body": "English"
            }
          ],
          "title": "Todo"
        },
        {
          "cards": [
            {
              "body": "ggg"
            },
            {
              "body": "kk"
            }
          ],
          "title": "Backlog"
        },
        {
          "cards": [
            {
              "body": "ff"
            },
            {
              "body": "ff"
            }
          ],
          "title": "Doing"
        }
      ]
    }
  },
  components: {
    // ListAdd,
    List,
  },
  // methods: {
  //   movingCard() {
  //     this.$store.dispatch('updateList', {lists: this.lists});
  //   },
  //   movingList() {
  //     this.$store.dispatch('updateList', {lists: this.lists});
  //   }
  // },
  computed: {
    // ...mapState([
    //   'lists'
    // ]),
    totalCardCount() {
      return this.$store.getters.totalCardCount;
    }
  }
}
</script>

<style scoped>
/* html {
  font-family: 'Avenir', Helvetica, Arial, 'system-ui', sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  width: 100%;
  height: 100%;
  overflow-x: scroll;
}

header {
  height: 70px;
  color: white;
  font-style: italic;
  font-size: 40px;
  text-align: left;
  padding: 20px;
}

main {
  padding: 0 10px;
  width: calc(100% - 40px);
  height: 100%;
}

.body {
  font-size: 18px;
  width: 100%;
  word-wrap: break-word;
} */

.info-line {
  margin: 20px;
  font-size: 20px;
}

.list-index {
  display: flex;
}

</style>