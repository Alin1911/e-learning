<template>
	<div class="mt-5">
		<div
			class="border-bottom border-primary pb-2 mb-2 d-flex justify-content-between align-items-center"
		>
			<h2>Exerciții recomandate</h2>
			<a href="/problem/create" class="btn btn-primary"
				>Adauga un Exercițiu</a
			>
		</div>
		<div
			v-for="(exercise, index) in exercises"
			:key="exercise.id"
			class="exercise mb-4"
		>
			<div class="shadow pb-2 pt-3 px-3 bg-white">
				<div
					class="mb-2 d-flex justify-content-between align-items-center"
				>
					<h4
						class="w-100"
						@click="toggleDetails(index)"
						style="cursor: pointer"
					>
						<i class="fa-sharp fa-solid fa-chevron-down"></i>
						{{ exercise.title }}
					</h4>
					<a
						:href="'/problem/' + exercise.id"
						class="btn btn-sm btn-outline-primary"
						>Deschide</a
					>
				</div>
				<div class="h5" v-show="openIndex === index">
					<div class="row">
						<div class="col-md-12 mb-1">
							<p>{{ exercise.description }}</p>
						</div>
					</div>
					<div class="row" v-if="exercise.example">
						<div class="col-md-12 mb-1">
							<strong>Exemplu:</strong> {{ exercise.example }}
						</div>
					</div>
					<div class="row" v-if="exercise.hints">
						<div class="col-md-12 mb-1">
							<strong>Indicii:</strong> {{ exercise.hints }}
						</div>
					</div>
					<div class="row" v-if="exercise.restrictions">
						<div class="col-md-12 mb-1">
							<strong>Restricții:</strong>
							{{ exercise.restrictions }}
						</div>
					</div>
					<div class="row" v-if="exercise.similar_problems">
						<div class="col-md-12 mb-1">
							<strong>Probleme similare:</strong>
							{{ exercise.similar_problems }}
						</div>
					</div>
				</div>
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
	data() {
		return {
			openIndex: null,
		};
	},
	methods: {
		toggleDetails(index) {
			this.openIndex = this.openIndex === index ? null : index;
		},
	},
};
</script>
