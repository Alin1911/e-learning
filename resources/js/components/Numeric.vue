<template>
  <div class="form-group">
    <label for="numeric-answer">Răspuns corect:</label>
    <input type="number" class="form-control" id="numeric-answer" v-model="correctAnswer" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      correctAnswer: 0,
    };
  },
  watch: {
    correctAnswer(value) {
      this.$emit('input', { correctAnswer: value });
    },
  },
};
</script>
