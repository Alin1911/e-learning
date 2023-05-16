<template>
    <div class="form-group mb-2">
        <label for="numeric-answer">Răspuns corect:</label>
        <input
            type="number"
            class="form-control"
            id="numeric-answer"
            v-model="correctAnswer"
        />
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
    emits: ["input"],
    data() {
        return {
            correctAnswer: 0,
        };
    },
    watch: {
        correctAnswer(value) {
            this.$emit("input", { correctAnswer: value });
        },
        modelValue: {
            deep: true,
            immediate: true,
            handler(value) {
                if (value && value.correctAnswer !== undefined) {
                    this.correctAnswer = value.correctAnswer;
                }
            },
        },
    },
};
</script>
