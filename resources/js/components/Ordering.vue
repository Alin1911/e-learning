<template>
  <div>
    <div v-for="(item, index) in items" :key="index" class="form-group py-2">
      <label :for="`item-${index}`">Elementul {{ index + 1 }}:</label>
      <input type="text" class="form-control" :id="`item-${index}`" v-model="item.content" placeholder="Element" />
      <input type="number" class="form-control mt-1" v-model="item.correctOrder" placeholder="Ordine corectă" />
    </div>
    <button @click="addItem" class="btn btn-secondary mt-2">Adaugă element</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [{ content: '', correctOrder: 1 }],
    };
  },
  methods: {
    addItem() {
      this.items.push({ content: '', correctOrder: this.items.length + 1 });
    },
  },
  watch: {
    items: {
      handler(value) {
        this.$emit('input', { orderingItems: value });
      },
      deep: true,
    },
  },
};
</script>
