<template>
	<div v-if="exercise.exercise_type === 'ordering'">
		<div v-for="(item, index) in exercise.ordering_items" :key="item.id">
			<label :for="`ordering-item-${exercise.id}-${index}`">{{
				item.item
			}}</label>
			<select
				class="form-control"
				:id="`ordering-item-${exercise.id}-${index}`"
				:value="selectedAnswers[index]"
				@change="
					updateSelectedAnswer(index, $event.target.value, item.item)
				"
			>
				<option
					v-for="optIndex in exercise.ordering_items.length"
					:key="optIndex"
					:value="optIndex"
				>
					{{ optIndex }}
				</option>
			</select>
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
			// Log the values to make sure they are being captured correctly
			console.log("Index:", index, "Value:", value);

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
