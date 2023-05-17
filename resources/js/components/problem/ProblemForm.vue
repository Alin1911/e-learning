<template>
	<div>
		<h2 v-if="!editMode">Adaugă exercițiu</h2>
		<h2 v-else>Editare exercițiu</h2>
		<form @submit.prevent="submitForm">
			<div>
				<label for="title">Titlu:</label>
				<input
					type="text"
					id="title"
					v-model="exercise.title"
					required
				/>
			</div>
			<div>
				<label for="description">Descriere:</label>
				<textarea
					id="description"
					v-model="exercise.description"
					required
				></textarea>
			</div>
			<div>
				<label for="example">Exemplu:</label>
				<textarea id="example" v-model="exercise.example"></textarea>
			</div>
			<div>
				<label for="hints">Indicii:</label>
				<textarea id="hints" v-model="exercise.hints"></textarea>
			</div>
			<div>
				<label for="restrictions">Restricții:</label>
				<textarea
					id="restrictions"
					v-model="exercise.restrictions"
				></textarea>
			</div>
			<div>
				<label for="similar_problems">Probleme similare:</label>
				<textarea
					id="similar_problems"
					v-model="exercise.similar_problems"
				></textarea>
			</div>
			<button type="submit">
				{{ editMode ? "Salvează" : "Adaugă" }}
			</button>
		</form>
	</div>
</template>

<script>
export default {
	props: {
		editMode: {
			type: Boolean,
			default: false,
		},
		initialExercise: {
			type: Object,
			default: () => ({}),
		},
	},
	data() {
		return {
			exercise: { ...this.initialExercise },
		};
	},
	methods: {
		submitForm() {
			this.$emit("submit", this.exercise);
			this.exercise = {};
		},
	},
};
</script>
