<template>
  <div>
    <h2>Manager de curs</h2>
    {{ this.course_id }}
    <ul class="list-group">
      <li
        v-for="(lesson, index) in lessons"
        :key="lesson.id"
        class="list-group-item"
        :class="{ 'bg-success': completedLessons.includes(lesson.id) }"
      >
        <div class="d-flex justify-content-between">
          <div>
            {{ index + 1 }}. {{ lesson.title }}
            <button
              v-if="!completedLessons.includes(lesson.id)"
              class="btn btn-sm btn-primary ml-2"
              @click="openLesson(lesson)"
            >
              Deschide
            </button>
          </div>
          <button
            class="btn btn-sm"
            :class="{ 'btn-success': completedLessons.includes(lesson.id), 'btn-secondary': !completedLessons.includes(lesson.id) }"
            @click="toggleLessonCompletion(lesson)"
          >
            {{ completedLessons.includes(lesson.id) ? 'Parcursă' : 'Parcurge' }}
          </button>
        </div>
        <div v-if="openedLesson === lesson">
          <h5 class="mt-3">Teste</h5>
          <ul>
            <li v-for="test in lesson.tests" :key="test.id">{{ test.title }}</li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    course_id: {
      type: [String, Number],
      required: true,
    },
  },
  computed: {
    lessons() {
      return this.$store.getters.getLessonsByCourseId(this.course_id);
    },
    completedLessons() {
      return this.$store.getters.getCompletedLessonsByCourseId(this.course_id);
    },
    openedLesson: {
      get() {
        return this.$store.state.openedLesson;
      },
      set(lesson) {
        this.$store.commit('setOpenedLesson', lesson);
      },
    },
  },
  methods: {
    openLesson(lesson) {
      this.openedLesson = this.openedLesson === lesson ? null : lesson;
    },
    toggleLessonCompletion(lesson) {
      this.$store.dispatch('toggleLessonCompletion', {
        course_id: this.course_id,
        lessonId: lesson.id,
      });
    },
  },
  async created() {
    console.log('CourseManager created');
    console.log('this.course_id', this.course_id)
    await this.$store.dispatch('fetchCourseData', this.course_id);
  },
};
</script>
