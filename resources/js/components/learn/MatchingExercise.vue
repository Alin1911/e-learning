<template>
	<div v-if="exercise.type === 'matching-exercise'">
		<div
			class="row"
			v-for="(item, index) in exercise.matching_items"
			:key="item.id"
		>
			<div class="col-md-6">
				<label for="`matching-item-${exercise.id}-${index}`">{{
					item.text
				}}</label>
			</div>
			<div class="col-md-6">
				<select
					class="form-control"
					:id="`matching-item-${exercise.id}-${index}`"
					v-model="selectedAnswers[exercise.id][index]"
				>
					<option
						v-for="(opt, optIndex) in exercise.matching_items"
						:key="opt.id"
						:value="opt.id"
					>
						{{ opt.match }}
					</option>
				</select>
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
			type: Object,
			default: () => [],
		},
	},
	created() {
		this.$set(this.selectedAnswers, this.exercise.id, []);
	},
};
</script>
