<template>
  <div>
    <div class="mb-3">
      <label for="course-selector" class="form-label">Selectează cursul</label>
      <select class="form-select" id="course-selector" v-model="selectedCourse">
        <option disabled value="">Alege un curs</option>
        <option v-for="course in courses" :key="course.id" :value="course">
          {{ course.title }}
        </option>
      </select>
    </div>
    <div v-if="selectedCourse">
    <div v-if="selectedCourse.lessons">
      <h3>Lecții existente</h3>
      <ul class="list-group mb-3">
        <li v-for="lesson in selectedCourse.lessons" :key="lesson.id" class="list-group-item">
          {{ lesson.title }}
        </li>
      </ul>
    </div>
      <h3>Adaugă o nouă lecție</h3>
      <form @submit.prevent="addLesson">
        <div class="mb-3">
          <label for="lesson-title" class="form-label">Titlul lecției</label>
          <input type="text" class="form-control" id="lesson-title" v-model="newLesson.title">
        </div>
        <div class="mb-3">
          <label for="lesson-description" class="form-label">Descrierea lecției</label>
          <textarea class="form-control" id="lesson-description" rows="3" v-model="newLesson.description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Adaugă lecția</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    courses: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      selectedCourse: '',
      newLesson: {
        title: '',
        description: ''
      }
    };
  },
  methods: {
    addLesson() {
      if (!this.newLesson.title || !this.newLesson.description) {
        alert('Te rog să completezi toate câmpurile!');
        return;
      }
      // Aici poți adăuga logica pentru a trimite lecția nouă la server
      console.log('Lecție nouă:', this.newLesson);

      // Reset form
      this.newLesson.title = '';
      this.newLesson.description = '';
    }
  }
};
</script>