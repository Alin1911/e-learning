<template>
  <div>
    <div v-for="(option, index) in options" :key="index" class="form-check">
      <input type="checkbox" class="form-check-input" :id="`option-${index}`" v-model="option.correct" />
      <label class="form-check-label" :for="`option-${index}`">
        <input type="text" class="form-control" v-model="option.answer" placeholder="Răspuns" />
      </label>
    </div>
    <button @click="addOption" class="btn btn-secondary mt-2">Adaugă opțiune</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      options: [{ answer: '', correct: false }],
    };
  },
  methods: {
    addOption() {
      this.options.push({ answer: '', correct: false });
    },
  },
  watch: {
    options: {
      handler(value) {
        this.$emit('input', { options: value });
      },
      deep: true,
    },
  },
};
</script>
