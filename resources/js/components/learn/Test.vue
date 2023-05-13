<template>
  <div>
    <h2>{{ test.title }}</h2>
    <p>Timer: {{ minutes }}:{{ seconds }}</p>
    <form @submit.prevent="submitTest">
      <div v-for="(exercise, index) in test.exercises" :key="exercise.id" class="mb-4">
        <h4 class="mb-3">{{ index + 1 }}. {{ exercise.question }}</h4>
        <component
        :is="exerciseComponentName(exercise.exercise_type)"
        :exercise="exercise"
        :selected-answers.sync="selectedAnswers[exercise.id]"
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
  },
  data() {
    return {
      test: {
        title: "",
        exercises: [],
      },
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

        this.test.exercises.forEach((exercise) => {
          this.selectedAnswers = { ...this.selectedAnswers, [exercise.id]: [] };
        });

        this.startTimer();
      } catch (error) {
        console.error('Error fetching test:', error);
      }
    },
    exerciseComponentName(type) {
      switch (type) {
        case "single-answer":
          return "SingleAnswer";
        case "multiple_choice_multiple_answers":
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
  try {
    const response = await axios.post(`/test/${this.test.id}/check`, this.selectedAnswers, {
      headers: {
        "Content-Type": "application/json",
      },
    });

    if (response.status === 200) {
      // Handle success response
    } else {
      // Handle error response
    }
  } catch (error) {
    // Handle error
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
