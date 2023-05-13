<template>
  <div>
    <h2>{{ test.title }}</h2>
    <p>Timer: {{ minutes }}:{{ seconds }}</p>
    <form @submit.prevent="submitTest">
      <div v-for="(exercise, index) in test.exercises" :key="exercise.id" class="mb-4">
        <p>{{ index + 1 }}. {{ exercise.text }}</p>
        <component
          :is="exerciseComponentName(exercise.type)"
          :exercise="exercise"
          :selected-answers.sync="selectedAnswers"
        />
      </div>
      <button type="submit" class="btn btn-primary">Trimite testul</button>
    </form>
  </div>
</template>

<script>
import SingleAnswer from "./SingleAnswer.vue";
import MultipleAnswer from "./MultipleAnswer.vue";
import OrderingExercise from "./OrderingExercise.vue";
import FillInTheBlanks from "./FillInTheBlanks.vue";
import MatchingExercise from "./MatchingExercise.vue";
import axios from 'axios';

export default {
  components: {
    SingleAnswer,
    MultipleAnswer,
    OrderingExercise,
    FillInTheBlanks,
    MatchingExercise,
  },
  props: {
    test_id: {
      type: [String, Number],
      required: true,
    },
    test: {
      type: Object,
      default: () => ({
        title: "",
        exercises: [],
      }),
    },
  },
  data() {
    return {
      test: {},
      selectedAnswers: {},
      timer: null,
      minutes: 30,
      seconds: 0,
    };
  },
  methods: {
    async fetchTest() {
  try {
    const response = await axios.get(`/learn/test/${this.test_id}`, {
      headers: {
        Accept: 'application/json',
      },
    });
    this.test = response.data.test;

    // Inițializează selectedAnswers după ce testul a fost setat
    this.test.exercises.forEach((exercise) => {
      this.$set(this.selectedAnswers, exercise.id, []);
    });

    // Start the timer
    this.startTimer();
  } catch (error) {
    console.error('Error fetching test:', error);
  }
},
    exerciseComponentName(type) {
      switch (type) {
        case "single-answer":
          return "SingleAnswer";
        case "multiple-answer":
          return "MultipleAnswer";
        case "ordering-exercise":
          return "OrderingExercise";
        case "fill-in-the-blanks":
          return "FillInTheBlanks";
        case "matching-exercise":
          return "MatchingExercise";
      }
    },
    async submitTest() {
      clearInterval(this.timer);
      // Aici înlocuiți cu un apel API real
      const response = await fetch(`/test/${this.test.id}/check`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(this.selectedAnswers),
      });

      if (response.ok) {
        // Handle success response
      } else {
        // Handle error response
      }
    },
    startTimer() {
      this.timer = setInterval(() => {
        this.seconds -= 1;
        if (this.seconds < 0) {
          this.minutes -= 1;
          this.seconds = 59;
        }

        if (this.minutes < 0) {
          clearInterval(this.timer);
          this.submitTest();
        }
      }, 1000);
    },
  },
  mounted() {
    this.fetchTest();
  },
};
</script>
