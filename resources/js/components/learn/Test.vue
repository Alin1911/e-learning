<template>
  <div>
    <h2>{{ test.title }}</h2>
    <p>Timer: {{ minutes }}:{{ seconds }}</p>
    <form @submit.prevent="submitTest">
      <div v-for="(exercise, index) in test.exercises" :key="exercise.id" class="mb-4">
        <p>{{ index + 1 }}. {{ exercise.text }}</p>
        <div v-if="exercise.type === 'single-answer'">
          <!-- Single-answer exercise -->
          <div class="form-check" v-for="(option, optionIndex) in exercise.options" :key="option.id">
            <input
              class="form-check-input"
              type="radio"
              :name="`exercise-${index}`"
              :id="`option-${index}-${optionIndex}`"
              :value="option.id"
              v-model="selectedAnswers[exercise.id]"
            />
            <label class="form-check-label" :for="`option-${index}-${optionIndex}`">
              {{ option.text }}
            </label>
          </div>
        </div>
        <!-- Add other exercise types here -->
      </div>
      <button type="submit" class="btn btn-primary">Trimite testul</button>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    test: {
      type: Object,
      default: () => ({
        title: '',
        exercises: [],
      }),
    },
  },
  data() {
    return {
      selectedAnswers: {},
      timer: null,
      minutes: 30,
      seconds: 0,
    };
  },
  methods: {
    async submitTest() {
      // Stop the timer
      clearInterval(this.timer);

      // Logica de trimitere a răspunsurilor la API pentru evaluare
      // Exemplu: await axios.post('/submit-test', { answers: this.selectedAnswers });
      console.log("Răspunsuri trimise:", this.selectedAnswers);
    },
    startTimer() {
      this.timer = setInterval(() => {
        if (this.seconds === 0) {
          this.minutes--;
          this.seconds = 59;
        } else {
          this.seconds--;
        }

        if (this.minutes === 0 && this.seconds === 0) {
          clearInterval(this.timer);
          this.submitTest();
        }
      }, 1000);
    },
  },
  created() {
    // Inițializarea structurii selectedAnswers în funcție de tipurile de exerciții
    this.test.exercises.forEach((exercise) => {
      if (exercise.type === 'single-answer') {
        this.$set(this.selectedAnswers, exercise.id, null);
      }
      // Add initialization for other exercise types here
    });

    // Start the timer
    this.startTimer();
  },
};
</script>
