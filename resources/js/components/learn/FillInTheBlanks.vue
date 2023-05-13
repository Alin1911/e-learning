<template>
    <div v-if="exercise.type === 'fill-in-the-blanks'">
      <div v-for="(item, index) in exercise.fill_in_the_blank_items" :key="item.id">
        <label for="`fill-in-the-blank-item-${exercise.id}-${index}`">{{ item.position }}. {{ item.text }}</label>
        <input
          type="text"
          class="form-control"
          :id="`fill-in-the-blank-item-${exercise.id}-${index}`"
          v-model="selectedAnswers[exercise.id][index]"
        />
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      exercise: {
        type: Object,
        required: true,
      },
      selectedAnswers: {
        type: Object,
        required: true,
      },
    },
    created() {
      this.$set(this.selectedAnswers, this.exercise.id, []);
    },
  };
  </script>
  