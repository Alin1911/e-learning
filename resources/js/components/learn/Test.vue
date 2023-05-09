<template>
    <div>
      <h2>{{ test.title }}</h2>
      <form @submit.prevent="submitTest">
        <div v-for="(question, index) in test.questions" :key="question.id" class="mb-4">
          <p>{{ index + 1 }}. {{ question.text }}</p>
          <div v-if="question.type === 'single-answer'">
            <!-- Single-answer question -->
            <div class="form-check" v-for="(option, optionIndex) in question.options" :key="option.id">
              <input
                class="form-check-input"
                type="radio"
                :name="`question-${index}`"
                :id="`option-${index}-${optionIndex}`"
                :value="option.id"
                v-model="selectedAnswers[question.id]"
              />
              <label class="form-check-label" :for="`option-${index}-${optionIndex}`">
                {{ option.text }}
              </label>
            </div>
          </div>
          <div v-else-if="question.type === 'multiple-answer'">
            <!-- Multiple-answer question -->
            <div class="form-check" v-for="(option, optionIndex) in question.options" :key="option.id">
              <input
                class="form-check-input"
                type="checkbox"
                :id="`option-${index}-${optionIndex}`"
                :value="option.id"
                v-model="selectedAnswers[question.id]"
              />
              <label class="form-check-label" :for="`option-${index}-${optionIndex}`">
                {{ option.text }}
              </label>
            </div>
          </div>
          <div v-else-if="question.type === 'numeric'">
            <!-- Numeric question -->
            <input type="number" class="form-control" v-model="selectedAnswers[question.id]" />
          </div>
          <div v-else-if="question.type === 'ordering'">
            <!-- Ordering question -->
            <div v-for="(item, itemIndex) in question.items" :key="item.id" class="form-group">
              <label :for="`item-${index}-${itemIndex}`">{{ item.text }}</label>
              <input
                type="number"
                class="form-control"
                :id="`item-${index}-${itemIndex}`"
                :min="1"
                :max="question.items.length"
                v-model="selectedAnswers[question.id][itemIndex]"
              />
            </div>
          </div>
          <div v-else-if="question.type === 'fill-in-the-blank'">
            <!-- Fill-in-the-blank question -->
            <div v-for="(blank, blankIndex) in question.blanks" :key="blank.id" class="form-group">
              <label :for="`blank-${index}-${blankIndex}`">{{ blank.text }}</label>
              <input
                type="text"
                class="form-control"
                :id="`blank-${index}-${blankIndex}`"
                v-model="selectedAnswers[question.id][blankIndex]"
              />
            </div>
          </div>
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
          questions: [],
        }),
      },
    },
    data() {
      return {
        selectedAnswers: {},
      };
    },
    methods: {
        async submitTest() {
      // Logica de trimitere a răspunsurilor la API pentru evaluare
      // Exemplu: await axios.post('/submit-test', { answers: this.selectedAnswers });
      console.log("Răspunsuri trimise:", this.selectedAnswers);
    },
  },
  created() {
    // Inițializarea structurii selectedAnswers în funcție de tipurile de întrebări
    this.test.questions.forEach((question) => {
      if (question.type === 'single-answer' || question.type === 'numeric') {
        this.$set(this.selectedAnswers, question.id, null);
      } else if (question.type === 'multiple-answer') {
        this.$set(this.selectedAnswers, question.id, []);
      } else if (question.type === 'ordering' || question.type === 'fill-in-the-blank') {
        this.$set(this.selectedAnswers, question.id, new Array(question.items.length).fill(null));
      }
    });
  },
};
</script>
