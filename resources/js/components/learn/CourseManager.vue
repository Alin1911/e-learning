<template>
    <div>
      <h2>Manager de curs</h2>
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
      courseId: {
        type: [String, Number],
        required: true,
      },
    },
    data() {
      return {
        lessons: [],
        completedLessons: [],
        openedLesson: null,
      };
    },
    async created() {
      await this.fetchCourseData();
    },
    methods: {
      async fetchCourseData() {
        try {
          const response = await fetch(`/course/${this.courseId}`);
          const data = await response.json();
          this.lessons = data.lessons;
          this.completedLessons = data.completedLessons;
        } catch (error) {
          console.error("Error fetching course data:", error);
        }
      },
      openLesson(lesson) {
        this.openedLesson = this.openedLesson === lesson ? null : lesson;
      },
      async toggleLessonCompletion(lesson) {
        if (this.completedLessons.includes(lesson.id)) {
          // Logic for marking lesson as not completed
          // Update the API and remove the lesson id from the completedLessons array
        } else {
          // Logic for marking lesson as completed
          // Update the API and add the lesson id to the completedLessons array
        }
      },
    },
  };
  </script>
  