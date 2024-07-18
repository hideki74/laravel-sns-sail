import{ createStore } from 'vuex'

export const store = createStore({
  state: {
    lists: []
  },
  mutations: {
    init(state, payload) {
        state.lists = payload.lists;
    },
    // リスト追加
    addList(state, payload) {
        state.lists.push({ title: payload.title, cards:[] });
        axios.post('/memoCards/list', payload).then().catch(e => console.log(e));
    },
    // リスト削除
    removeList(state, payload) {
        state.lists.splice(payload.listIndex, 1);
    },
    // カード追加
    addCardToList(state, payload) {
        state.lists[payload.listIndex].cards.push({ body: payload.body });
    },
    // カード削除
    removeCardFromList(state, payload) {
        state.lists[payload.listIndex].cards.splice(payload.cardIndex, 1);
        axios.post('/memoCards/list', payload).then(res => console.log(res)).catch(e => console.log(e));
    },
    updateList(state, payload) {
        state.lists = payload.lists
    }
  },
  actions: {
    init(context, payload) {
        context.commit('init', payload);
    },
    addList(context, payload) {
        context.commit('addList', payload);
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
    updateList(context, payload) {
        context.commit('updateList', payload)
    }
  },
  getters: {
    totalCardCount(state) {
        let count = 0
        state.lists.map(content => count += content.cards.length)
        return count
    },
  }
})

// store.subscribe((mutation, state) => {
//     axios.put('/memoCards', {
//         cards_json: state.lists
//     }).then(res => state.lists = res.data).catch(e => console.log(e))
// })
  
export default store