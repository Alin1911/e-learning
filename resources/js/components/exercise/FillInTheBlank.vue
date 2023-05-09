<template>
  <div>
    <div v-for="(item, index) in items" :key="index" class="form-group py-2">
      <label :for="`item-${index}`">Cuvântul {{ index + 1 }}:</label>
      <input type="text" class="form-control" :id="`item-${index}`" v-model="item.word" placeholder="Cuvânt" />
      <input type="number" class="form-control mt-1" v-model="item.position" placeholder="Poziția" />
    </div>
    <button @click="addItem" class="btn btn-secondary mt-2">Adaugă cuvânt</button>
  </div>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: Object,
      default: () => ({}),
    },
  },
  emits: ['update:modelValue'],
  data() {
    return {
      items: [{ word: '', position: 1 }],
    };
  },
  methods: {
    addItem() {
      this.items.push({ word: '', position: this.items.length + 1 });
    },
  },
  watch: {
    items: {
      handler(value) {
        this.$emit('update:modelValue', { fillInTheBlankItems: value });
      },
      deep: true,
    },
  },
};
</script>
