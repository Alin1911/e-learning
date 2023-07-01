<template>
	<div v-if="exercise.exercise_type === 'multiple_choice_multiple_answers'">
		<div class="ml-5" style="padding-left: 20px">
			<div
				class="form-check"
				v-for="(option, optionIndex) in exercise.options"
				:key="option.id"
			>
				<input
					class="form-check-input"
					type="checkbox"
					:name="`exercise-${exercise.id}`"
					:id="`option-${exercise.id}-${optionIndex}`"
					:value="option.id"
					v-model="internalSelectedAnswers"
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
			internalSelectedAnswers: this.selectedAnswers,
		};
	},
	watch: {
		internalSelectedAnswers: {
			deep: true,
			handler(newValue) {
				this.$emit("update-selected-answers", {
					exerciseId: this.exercise.id,
					selectedAnswers: newValue,
				});
				console.log(newValue);
			},
		},
	},
};
</script>
