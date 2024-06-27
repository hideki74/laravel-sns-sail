<template>
  <form :class="classList" @submit.prevent="addCardToList">
    <input v-model="body"
           type="text"
           class="text-input"
           placeholder="Add new card"
           @focusin="startEditing"
           @focusout="finishEditing"
    />
    <button type="submit" class="add-button"
      v-if="isEditing || bodyExists"
    >
      Add
    </button>
  </form>
</template>

<script>
export default {
  props: {
    listIndex: {
      type: Number,
      required: true,
    }
  },
  data() {
    return {
      body: '',
      isEditing: false,
    }
  },
  methods: {
    startEditing() {
      this.isEditing = true;
    },
    finishEditing() {
      this.isEditing = false;
    },
    addCardToList(){
      this.$store.dispatch('addCardToList', { body: this.body, listIndex: this.listIndex })
      this.body = ''
    }
  },
  computed: {
    classList() {
      const classList = ['addcard'];
      if (this.isEditing) {
        classList.push('active');
      }

      if (this.bodyExists) {
        classList.push('addable');
      }
      return classList;
    },
    bodyExists() {
      return this.body.length > 0;
    }
  }
}
</script>