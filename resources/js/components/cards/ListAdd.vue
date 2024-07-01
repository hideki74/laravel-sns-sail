<template>
  <form :class="classList" @submit.prevent="addList">
  <input v-model="title"
    type="text"
    class="text-input"
    placeholder="Add new list"
    @focusin="startEditing"
    @focusout="finishEditing"
  >
  <button type="submit" class="add-button"
    v-if="isEditing || titleExists"  
  >
  Add
  </button>
  </form>
</template>
  
<script>
export default {
  data() {
    return {
      title: '',
      isEditing: false
    }
  },
  methods: {
    addList() {
      this.$store.dispatch('addList', { title: this.title })
      this.title = ''
    },
    startEditing() {
      this.isEditing = true
    },
    finishEditing() {
      this.isEditing = false
    }
  },
  computed: {
    classList() {
      const classList = ['addlist']
      if (this.isEditing) {
        classList.push('active')
      }

      if (this.titleExists) {
        classList.push('addable')
      }
      return classList
    },
    titleExists() {
      return this.title.length > 0;
    }
  }
}
</script>

<style scoped>
.addlist {
  margin: 0 10px auto;
  display: inline-block;
  flex-direction: column;
  align-items: flex-start;
  min-width: 320px;
  width: 320px;
}

.text-input {
  padding: 20px 15px;
  width: calc(100% - 30px);
  background-color: #ccc;
  border-radius: 8px;
  cursor: pointer;
  border: none;
  font-family: "Noto Sans Japanese", "Noto Sans", 'system-ui', sans-serif;
  font-weight: 700;
  font-size: 24px;
  color: #242424;
  cursor: pointer;
  overflow: overlay;
}

.text-input:focus {
  outline: 0;
  cursor: initial;
}

.active .text-input {
  background-color: #fff;
}


.add-button {
  margin-top: 15px;
  padding: 15px 18px;
  background-color: #999;
  border: none;
  border-radius: 8px;
  font-family: "Noto Sans Japanese", "Noto Sans", 'system-ui', sans-serif;
  font-weight: 700;
  font-size: 18px;
  color: #fff;
}

.add-button:hover {
  opacity: 0.8;
  cursor: pointer;
}

.addable .add-button {
  background-color: #00d78f;
  pointer-events: auto;
  cursor: pointer;
}
</style>