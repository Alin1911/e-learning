<template>
	<div v-if="exercise.exercise_type === 'numeric'">
		<div>
			<div class="form-ccontrol">
				<input
					class="form-control"
					type="number"
					:name="`exercise-${exercise.id}`"
					:id="`${exercise.id}`"
					v-model="internalSelectedAnswer"
				/>
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
			console.log("send: " + newValue);
			this.$emit("update-selected-answers", {
				exerciseId: this.exercise.id,
				selectedAnswers: [newValue],
			});
		},
	},
};
</script>
