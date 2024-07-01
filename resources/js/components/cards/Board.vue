<template>
  <div>
    <main>
      <p class="info-line">All: 0 tasks</p>
      <div class="list-index">
        <list v-for="(item, index) in lists"
              :key="item.id"
              :title="item.title"
              :listIndex="index"
        />
        <list-add />
      </div>
    </main>
  </div>
</template>
  
<script>
import ListAdd from './ListAdd.vue'
import List from './List.vue'
import { mapState } from 'vuex'

export default {
  components: {
    ListAdd,
    List
  },
  computed: {
    ...mapState([
      'lists'
    ])
  }
}
</script>

<style scoped>
html {
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

.info-line {
  margin: 20px;
  font-size: 20px;
}

.list-index {
  display: flex;
}







.addable .add-button {
  background-color: #00d78f;
  pointer-events: auto;
  cursor: pointer;
}

.add-button:active {
  background-color: #00d78f;
}


.card {
  margin-top: 10px;
  margin-bottom: 10px;
  position: relative;
  display: flex;
  padding: 30px 15px 40px;
  background-color: #fff;
  border-radius: 8px;
  width: 260px;
  cursor: pointer;
}

.close-button {
  position: absolute;
  top: 6px;
  right: 15px;
  font-size: 22px;
  cursor: pointer;
  border-radius: 8px;
  border-color: red;
  border-style: solid;
  background-color: red;
  color: white;
  margin: 5px;
}

.body {
  font-size: 18px;
  width: 100%;
  word-wrap: break-word;
}

.active .text-input {
  background-color: #fff;
}

.addable .add-button {
  background-color: #00d78f;
  pointer-events: auto;
  cursor: pointer;
}
</style>