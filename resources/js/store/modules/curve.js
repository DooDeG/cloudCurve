import axios from 'axios'
import Cookies from 'js-cookie'
import * as types from '../mutation-types'


// state
export const state = {
    curve: [],
    curves: {},
}

// getters
export const getters = {
    SET_CURVE(state, data) {
        state.curve = data || {};
      },
    
    SET_CURVES(state, data) {
        state.curves = data || [];
    },
}

// mutations
export const mutations = {
    [types.SET_CURVE] (state, { data }) {
        state.curve = data || {};
    },
    [types.SET_CURVES] (state, { data }) {
        state.curves = data || [];
    },
}

// actions
export const actions = {
  
}
