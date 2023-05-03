<template>
  <div>
    <h2>Selected Course: {{ selectedCourseTitle }}</h2>
    <h3>Lessons:</h3>
    <ul>
      <li v-for="(lesson, index) in getLessons()" :key="index">
        {{ lesson.title }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ['course_id',],
  computed: {
    user() {
      return this.$store.getters.getUser;
    },
    selectedCourse() {
      return this.$store.getters.getSelectedCourse;
    },
    selectedCourseTitle() {
      return this.$store.getters.getSelectedCourseTitle;
    },
  },
  methods: {
    async fetchUser() {
      await this.$store.dispatch('fetchUser');
    },
    async fetchCourses() {
      await this.$store.dispatch('fetchCourses');
    },
    getLessons() {
      return this.selectedCourse ? this.selectedCourse.lessons : [];
    },
  },
  watch: {
    course_id(newValue) {
      this.$store.commit('setSelectedCourseId', newValue);
    },
  },
  mounted() {
    this.fetchUser();
    this.fetchCourses();
    this.$store.commit('setSelectedCourseId', this.course_id);
  },
};
</script>
