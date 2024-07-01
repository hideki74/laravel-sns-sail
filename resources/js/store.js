import{ createStore } from 'vuex'

const savedLists = localStorage.getItem('trello-lists')

export const store = createStore({
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
  mutations: {
    addList(state, payload) {
        state.lists.push({ title: payload.title, cards:[] })
    },
    removeList(state, payload) {
        state.lists.splice(payload.listIndex, 1);
    },
    addCardToList(state, payload) {
        state.lists[payload.listIndex].cards.push({ body: payload.body });
    },
    removeCardFromList(state, payload) {
        state.lists[payload.listIndex].cards.splice(payload.cardIndex, 1)
    },
  },
  actions: {
    addList(context, payload) {
        context.commit('addList', payload)
    },
    removeList(context, payload) {
        context.commit('removeList', payload);
    },
    addCardToList(context, payload) {
        context.commit('addCardToList', payload)
    },
    removeCardFromList(context, payload) {
        context.commit('removeCardFromList', payload)
    },
  },
  getters: {
    totalCardCount(state) {
        let count = 0
        state.lists.map(content => count += content.cards.length)
        return count
    },
  }
})

store.subscribe((mutation, state) => {
    localStorage.setItem('trello-lists', JSON.stringify(state.lists))
})
  
export default store