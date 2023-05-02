import { createStore } from 'vuex';

export default createStore({
  state: {
    user: null,
    courses: [],
  },
  getters: {
    getUser: state => state.user,
    getCourses: state => state.courses,
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    setCourses(state, courses) {
      state.courses = courses;
    },
  },
  actions: {
    async fetchUser({ commit }) {
      const response = await fetch('/user');
      const data = await response.json();
      commit('setUser', data);
    },
    async fetchCourses({ commit }) {
      const response = await fetch('/courses');
      const data = await response.json();
      commit('setCourses', data);
    },
  },
});
