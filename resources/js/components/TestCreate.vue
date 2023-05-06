<template>
  <div>
    <div class="mb-3">
      <label for="course-selector" class="form-label">Selectează cursul</label>
      <select class="form-select" id="course-selector" v-model="selectedCourse" @change="resetLesson">
        <option disabled value="">Alege un curs</option>
        <option v-for="course in courses" :key="course.id" :value="course">
          {{ course.title }}
        </option>
      </select>
    </div>
    <div v-if="selectedCourse">
      <div class="mb-3">
        <label for="lesson-selector" class="form-label">Selectează lecția (opțional)</label>
        <select class="form-select" id="lesson-selector" v-model="selectedLesson">
          <option value="">Fără lecție</option>
          <option v-for="lesson in selectedCourse.lessons" :key="lesson.id" :value="lesson">
            {{ lesson.title }}
          </option>
        </select>
      </div>
      <h3>Teste existente</h3>
      <div v-if="selectedLesson">
        <h4>Teste pentru lecția selectată</h4>
        <!-- Aici poți afișa testele pentru lecția selectată -->
      </div>
      <div>
        <h4>Teste pentru cursul selectat</h4>
        <!-- Aici poți afișa testele pentru cursul selectat -->
      </div>
      <h3>Adaugă un nou test</h3>
      <form @submit.prevent="addTest">
        <div class="mb-3">
          <label for="test-title" class="form-label">Titlul testului</label>
          <input type="text" class="form-control" id="test-title" v-model="newTest.title">
        </div>
        <div class="mb-3">
          <label for="test-description" class="form-label">Descrierea testului</label>
          <textarea class="form-control" id="test-description" rows="3" v-model="newTest.description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Adaugă testul</button>
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
      selectedLesson: '',
      newTest: {
        title: '',
        description: ''
      }
    };
  },
  methods: {
    resetLesson() {
      this.selectedLesson = '';
    },
    addTest() {
      if (!this.newTest.title || !this.newTest.description) {
        alert('Te rog să completezi toate câmpurile!');
        return;
      }
      // Aici poți adăuga logica pentru a trimite testul nou la server
      console.log('Test nou:', this.newTest);

      // Reset form
      this.newTest.title = '';
      this.newTest.description = '';
    }
  }
};
</script>