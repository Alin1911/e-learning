<template>
	<div v-if="exercise.exercise_type === 'fill_in_the_blank'">
		<div
			v-for="(item, index) in exercise.fill_in_the_blank_items"
			:key="item.id"
		>
			<label :for="`fill-in-the-blank-item-${exercise.id}-${index}`"
				>Cuvânt {{ item.position }}</label
			>
			<input
				type="text"
				class="form-control"
				:id="`fill-in-the-blank-item-${exercise.id}-${index}`"
				:value="selectedAnswers[index]"
				@input="updateSelectedAnswer(index, $event.target.value)"
			/>
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
	methods: {
		updateSelectedAnswer(index, value) {
			// Clone the current selectedAnswers array
			let updatedAnswers = this.selectedAnswers.slice();
			// Update the cloned array with the new value
			updatedAnswers[index] = value;
			// Emit the exerciseId and the updated array
			this.$emit("update-selected-answers", {
				exerciseId: this.exercise.id,
				selectedAnswers: updatedAnswers,
			});
		},
	},
};
</script>
