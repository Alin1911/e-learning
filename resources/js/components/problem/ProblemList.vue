<template>
	<div>
		<h2>Lista de exerciții</h2>
		<div
			v-for="(exercise, index) in exercises"
			:key="exercise.id"
			class="exercise"
		>
			<h3 @click="toggleDetails(index)">{{ exercise.title }}</h3>
			<div v-show="exercise.showDetails">
				<p>{{ exercise.description }}</p>
				<p v-if="exercise.example">Exemplu: {{ exercise.example }}</p>
				<p v-if="exercise.hints">Indicii: {{ exercise.hints }}</p>
				<p v-if="exercise.restrictions">
					Restricții: {{ exercise.restrictions }}
				</p>
				<p v-if="exercise.similar_problems">
					Probleme similare: {{ exercise.similar_problems }}
				</p>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		exercises: {
			type: Array,
			default: () => [],
		},
	},
	methods: {
		toggleDetails(index) {
			this.exercises[index].showDetails =
				!this.exercises[index].showDetails;
		},
	},
};
</script>
