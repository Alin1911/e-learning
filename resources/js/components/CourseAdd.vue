<template>
    <div>
      <h1>{{ isUpdate ? 'Actualizare curs' : 'Creare curs' }}</h1>
      <form @submit.prevent="submitCourse">
        <!-- Titlu -->
        <div class="form-group">
          <label for="title">Titlu</label>
          <input type="text" class="form-control" id="title" v-model="course.title" required>
        </div>
  
        <!-- Descriere -->
        <div class="form-group">
          <label for="description">Descriere</label>
          <textarea class="form-control" id="description" v-model="course.description" required></textarea>
        </div>
  
        <!-- Preț -->
        <div class="form-group">
          <label for="price">Preț</label>
          <input type="number" step="0.01" class="form-control" id="price" v-model="course.price" required>
        </div>
  
        <!-- Discount -->
        <div class="form-group">
          <label for="discount">Discount</label>
          <input type="number" step="0.01" class="form-control" id="discount" v-model="course.discount">
        </div>
  
        <!-- Nivel -->
        <div class="form-group">
      <label for="level">Nivel</label>
      <select class="form-control" id="level" v-model="course.level">
        <option v-for="level in levels" :key="level" :value="level">
          {{ level }}
        </option>
      </select>
    </div>

  
        <!-- Informații adiționale -->
        <div class="form-group">
          <label for="additional_info">Informații adiționale</label>
          <textarea class="form-control" id="additional_info" v-model="course.additional_info"></textarea>
        </div>
  
        <!-- Durata -->
        <div class="form-group">
          <label for="duration">Durată</label>
          <select class="form-control" id="duration" v-model="course.duration">
            <option v-for="duration in durations" :key="duration" :value="duration">
              {{ duration }}
            </option>
          </select>
        </div>
  
        <!-- ID-ul categoriei -->
        <div class="form-group">
      <label for="category">Categorie</label>
      <select class="form-control" id="category" v-model="course.category_id">
        <option v-for="category in categories" :key="category.id" :value="category.id">
          {{ category.name }}
        </option>
      </select>
    </div>

  
        <!-- ID-ul instructorului -->
        <div class="form-group">
      <label for="instructor">Instructor</label>
      <select class="form-control" id="instructor" v-model="course.instructor_id">
        <option v-for="instructor in instructors" :key="instructor.id" :value="instructor.id">
          {{ instructor.name }}
        </option>
      </select>
    </div>
  
        <!-- Limba -->
        <div class="form-group">
      <label for="language">Limbă</label>
      <select class="form-control" id="language" v-model="course.language">
        <option v-for="language in languages" :key="language" :value="language">
          {{ language }}
        </option>
      </select>
    </div>

  <div clas="row">
    <div class="col-12 d-flex justify-content-center">
        <button type="submit" class="col-12 col-md-6  rounded-pill btn-lg mt-3 btn btn-warning">{{ isUpdate ? 'Actualizează curs' : 'Crează curs' }}</button>
    </div> </div>    
    </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    props: {
      initialCourse: {
        type: Object,
        default: null,
      },
    },
    data() {
      return {
        course: {
          title: '',
          description: '',
          price: null,
          discount: null,
          level: '',
          additional_info: '',
          duration: '',
          category_id: null,
          instructor_id: null,
          language: '',
          ...this.initialCourse,
        },
    };
  },
  computed: {
    isUpdate() {
      return !!this.initialCourse;
    },
  },
  methods: {
    async submitCourse() {
      try {
        let response;
        if (this.isUpdate) {
          response = await axios.put(`/course/${this.course.id}`, this.course);
          console.log('Curs actualizat:', response.data);
        } else {
          response = await axios.post('/course', this.course);
          console.log('Curs creat:', response.data);
        }
      } catch (error) {
        console.error('Eroare la trimiterea cursului:', error);
      }
    },
  },
};
</script>