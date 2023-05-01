<template>
  <div class="">
    <div class="container mb-3">
      <div class="row g-0">
        <div v-if="course.image" class="col-md-4">
          <img :src="course.image" class="img-fluid rounded-start" alt="Course image">
        </div>
        <div class="col-12">
          <div class="card-body">
            <h5 class="card-title mb-5">{{ course.title || 'Title not available' }}</h5>
            <p v-if="course.description" class="card-text">{{ course.description }}</p>
            <p v-else class="card-text text-muted">Description not available</p>
            <p class="card-text">
              <small v-if="course.level || course.language || course.duration" class="text-muted">
                <span v-if="course.level" class="course-level me-2">Nivel: {{ course.level }}</span>
                <span v-if="course.language" class="course-language me-2">Limba: {{ course.language }}</span>
                <span v-if="course.duration" class="course-duration">Durata: {{ course.duration }}</span>
              </small>
            </p>
            <p v-if="course.category_id" class="card-text">Category: {{ course.category.name }}</p>
            <p v-if="course.instructor_id" class="card-text">Instructor: {{ course.instructor_id }}</p>
            <p v-if="course.additional_info" class="card-text">{{ course.additional_info }}</p>
            <div class="course-price mt-3">
              <span v-if="course.discount" class="text-danger me-1">
                <s v-if="course.price">{{ course.price }} USD</s>
              </span>
              <span  v-if="course.price" >{{ course.discount ? (course.price - course.discount) : course.price }} USD</span>
            </div>
          </div>
        </div>
        <button class="enroll-btn btn btn-primary mt-3" @click="enroll">Enroll</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Course',
  props: {
    course: Object,
  },
  methods: {
  async enroll(courseId) {
    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      const response = await fetch(`/course/${this.course.id}/enroll`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
      });

      if (response.ok) {
        const data = await response.json();
        console.log(data);
        window.location.href = `/learn/course/${this.course.id}`;
      } else {
        const errorData = await response.json();
        console.error(errorData);
      }
    } catch (error) {
      console.error('Error:', error);
    }
  },
  },
};
</script>