import { createStore } from 'vuex';

export default function createNewStore() {
  return createStore({
    state: {
      user: null,
      courses: [],
      selectedCourseId: null,
    },
    getters: {
      getUser: state => state.user,
      getCourses: state => state.courses,
      getSelectedCourse: state => {
        if (state.courses) {
          return state.courses.find(course => course.id === state.selectedCourseId);
        }
      },
      getSelectedCourseTitle: state => {
        if (state.courses) {
        const selectedCourse = state.courses.find(course => course.id === state.selectedCourseId);
        return selectedCourse ? selectedCourse.title : '';
        }
      },
    },
    mutations: {
      setUser(state, user) {
        state.user = user;
      },
      setCourses(state, courses) {
        state.courses = courses;
      },
      setSelectedCourseId(state, courseId) {
        state.selectedCourseId = courseId;
      },
    },
    actions: {
      async fetchUser({ commit }) {
        const response = await fetch('/user');
        const data = await response.json();
        console.log(data);
        commit('setUser', data);
      },
      async fetchCourses({ commit }) {
        const response = await fetch('/courses');
        const data = await response.json();
        console.log(data);
        commit('setCourses', data);
      },
    },
  });
}