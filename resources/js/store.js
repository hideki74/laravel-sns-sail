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
    }
  },
  actions: {
    addList(context, payload) {
        context.commit('addList', payload)
    },
    removeList(context, payload) {
        context.commit('removeList', payload);
    }
  },
  getters: {
  }
})

store.subscribe((mutation, state) => {
    localStorage.setItem('trello-lists', JSON.stringify(state.lists))
})
  
export default store