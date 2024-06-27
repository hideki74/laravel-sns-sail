import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const savedLists = localStorage.getItem('trello-lists');

const store =  new Vuex.Store({
  state: {
    lists: savedLists ? JSON.parse(savedLists): [
        {
          title: 'Backlog',
          cards: [
            { body: 'English' },
            { body: 'Mathematics' },
          ]
        },
        {
          title: 'Todo',
          cards: [
            { body: 'Science' }
          ]
        },
        {
          title: 'Doing',
          cards: []
        }
    ],
  },
  getters: {
    totalCardCount(state) {
        let count = 0;
        state.lists.map(content => count += content.cards.length);
        return count;
    }
  },
  mutations: {
    addlist(state, payload) {
        state.lists.push({ title: payload.title, cards:[] })
    },
    updateList(state, payload) {
        state.lists = payload.lists
    },
    removelist(state, payload) {
        state.lists.splice(payload.listIndex, 1)
    },
    addCardToList(state, payload) {
        state.lists[payload.listIndex].cards.push({ body: payload.body })
    },
    removeCardFromList(state, payload) {
        state.lists[payload.listIndex].cards.splice(payload.cardIndex, 1);
    }
  },
  actions: {
    addlist(context, payload) {
        context.commit('addlist', payload)
    },
    updateList(context, payload) {
        context.commit('updateList', payload);
    },
    removeList(context, payload) {
        context.commit('removelist', payload)
    },
    addCardToList(context, payload) {
        context.commit('addCardToList', payload);
    },
    removeCardFromList(context, payload) {
        context.commit('removeCardFromList', payload);
    }
  },
  methods: {
    addList: function() {
      this.$store.dispatch('addlist', {title: this.title})
      this.title = ''
    },
  }
});

store.subscribe((mutation, state) => {
    localStorage.setItem('trello-lists', JSON.stringify(state.lists))
});

export default store;