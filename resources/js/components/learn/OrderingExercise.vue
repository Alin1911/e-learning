<template>
	<div v-if="exercise.type === 'ordering-exercise'">
		<div v-for="(item, index) in exercise.ordering_items" :key="item.id">
			<label for="`ordering-item-${exercise.id}-${index}`">{{
				item.text
			}}</label>
			<select
				class="form-control"
				:id="`ordering-item-${exercise.id}-${index}`"
				v-model="selectedAnswers[exercise.id][index]"
			>
				<option
					v-for="(opt, optIndex) in exercise.ordering_items"
					:key="opt.id"
					:value="optIndex"
				>
					{{ optIndex + 1 }}
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
			type: Object,
			required: true,
		},
	},
	created() {
		this.$set(this.selectedAnswers, this.exercise.id, []);
	},
};
</script>
