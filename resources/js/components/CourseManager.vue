<template>
    <div>
        {{ user }}

      <h2>{{ course.name }}</h2>
      <div >
        <ul>
          <li v-for="(lesson, index) in course.lessons" :key="lesson.id">
            <a @click="selectLesson(lesson, index)">{{ lesson.title }}</a>
          </li>
        </ul>
      </div>
      <div v-if="selectedLesson">
        <h3>{{ selectedLesson.title }}</h3>
        <p>{{ selectedLesson.description }}</p>
      </div>
    </div>
  </template>
  
  <script>
export default {
  props: ['course', 'selectedLesson'],
  computed: {
    user() {
      console.log('store:', this.$store);
      return this.$store.getters.getUser;
    },
    courses() {
      return this.$store.getters.getCourses;
    },
  },
  data() {
    return {
      course_id: null,
      selectedLesson: null,
    };
  },
  methods: {
    async fetchUser() {
      await this.$store.dispatch('fetchUser');
    },
    async fetchCourses() {
      await this.$store.dispatch('fetchCourses');
    },
    selectLesson(lesson, index) {
      this.selectedLesson = lesson;
    },
  },
  mounted() {
    this.fetchUser();
    this.fetchCourses();
  },
};
  </script>