import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex);

export const store = new Vuex.Store({
    state:{
        unread: []
    },

    mutations: {
        add_notification(state, notification){
            state.unread.push(notification);
        }
    },

    getters: {
        all_notifications(state){
            return state.unread;
        },

        notifications_length(state){
          return state.unread.length;
        },
    }
});