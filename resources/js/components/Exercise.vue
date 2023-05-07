<template>
  <div>
    <div class="form-group">
      <label for="exercise-type">Tipul exercițiului:</label>
      <select class="form-control" id="exercise-type" v-model="selectedExerciseType">
        <option disabled value="">Selectează un tip de exercițiu</option>
        <option value="multiple_choice_multiple_answers">Grilă multiplă</option>
        <option value="multiple_choice_single_answer">Grilă cu răspuns unic</option>
        <option value="numeric">Răspuns numeric</option>
        <option value="ordering">Ordonare corectă a răspunsurilor</option>
        <option value="fill_in_the_blank">Completează propoziția</option>
      </select>
    </div>

    <div v-if="selectedExerciseType">
      <div class="form-group">
        <label for="question">Întrebarea:</label>
        <input type="text" class="form-control" id="question" v-model="question" />
      </div>

      <component
        :is="exerciseComponent"
        v-model="exerciseData"
      ></component>

      <button @click="addExercise" class="btn btn-primary">Adaugă exercițiul</button>
    </div>
  </div>
</template>

<script>
import MultipleChoiceMultipleAnswers from '@/components/MultipleChoiceMultipleAnswers.vue';
import MultipleChoiceSingleAnswer from '@/components/MultipleChoiceSingleAnswer.vue';
import Numeric from '@/components/Numeric.vue';
import Ordering from '@/components/Ordering.vue';
import FillInTheBlank from '@/components/FillInTheBlank.vue';

export default {
  components: {
    MultipleChoiceMultipleAnswers,
    MultipleChoiceSingleAnswer,
    Numeric,
    Ordering,
    FillInTheBlank,
  },
  data() {
    return {
      selectedExerciseType: '',
      question: '',
      exerciseData: null,
    };
  },
  computed: {
    exerciseComponent() {
      switch (this.selectedExerciseType) {
        case 'multiple_choice_multiple_answers':
          return 'MultipleChoiceMultipleAnswers';
        case 'multiple_choice_single_answer':
          return 'MultipleChoiceSingleAnswer';
        case 'numeric':
          return 'Numeric';
        case 'ordering':
          return 'Ordering';
        case 'fill_in_the_blank':
          return 'FillInTheBlank';
      }
    },
  },
  methods: {
    async addExercise() {
      const exercise = {
        test_id: this.$route.params.test_id, // Așigurați-vă că aveți test_id în parametrii rutei
        question: this.question,
        exercise_type: this.selectedExerciseType,
        ...this.exerciseData,
      };

      // Adăugați codul pentru a trimite exercițiul la server (de exemplu, prin POST la un API endpoint)
      // ...

      // Resetați formularul
      this.selectedExerciseType = '';
      this.question = '';
      this.exerciseData = null;
    },
  },
};
</script>
