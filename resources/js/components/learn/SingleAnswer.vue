<template>
    <div v-if="exercise.exercise_type === 'multiple_choice_single_answer'">
        <div class="ml-5" style="padding-left: 20px">
            <div
                class="form-check"
                v-for="(option, optionIndex) in exercise.options"
                :key="option.id"
            >
                <input
                    class="form-check-input"
                    type="radio"
                    :name="`exercise-${exercise.id}`"
                    :id="`option-${exercise.id}-${optionIndex}`"
                    :value="option.id"
                    v-model="internalSelectedAnswer"
                />
                <label
                    class="form-check-label"
                    :for="`option-${exercise.id}-${optionIndex}`"
                >
                    {{ option.option_text }}
                </label>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        exercise: {
            type: Object,
            required: true,
        },
        selectedAnswers: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            internalSelectedAnswer: this.selectedAnswers[0] || null,
        };
    },
    watch: {
        internalSelectedAnswer(newValue) {
            this.$emit("update-answers", {
                exerciseId: this.exercise.id,
                selectedAnswers: [newValue],
            });
        },
    },
};
</script>
