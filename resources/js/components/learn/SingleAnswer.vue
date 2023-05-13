<template>
    <div v-if="exercise.type === 'single-answer'">
      <div class="form-check" v-for="(option, optionIndex) in exercise.options" :key="option.id">
        <input
          class="form-check-input"
          type="radio"
          :name="`exercise-${exercise.id}`"
          :id="`option-${exercise.id}-${optionIndex}`"
          :value="option.id"
          v-model="selectedAnswers[exercise.id]"
        />
        <label class="form-check-label" :for="`option-${exercise.id}-${optionIndex}`">
          {{ option.text }}
        </label>
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
  };
</script>
  