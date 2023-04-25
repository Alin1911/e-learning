
<template>
    <div class="course">
      <h2>{{ course.title }}</h2>
      <p>{{ course.description }}</p>
    </div>
  </template>
  
  <script>
  export default {
    name: 'Course',
    props: {
      course: Object,
    },
  };
  </script>
  
  <style scoped>
  .course {
    border: 1px solid #ccc;
    padding: 1rem;
    margin-bottom: 1rem;
  }
  </style>
  