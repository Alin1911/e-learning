<template>
	<div class="test-component">
		<h2>{{ test.title }}</h2>
		<p>{{ test.description }}</p>
		<form @submit.prevent="submitTest">
			<div v-for="(exercise, index) in test.exercises" :key="exercise.id">
				<div class="card mb-3">
					<div class="card-body">
						<h5 class="card-title">{{ exercise.question }}</h5>
						<div
							v-if="
								exercise.exercise_type ===
								'multiple_choice_multiple_answers'
							"
						>
							<!-- Afișați opțiunile pentru grilă multiplă -->
							<div
								class="form-check"
								v-for="(
									option, optionIndex
								) in exercise.options"
								:key="option.id"
							>
								<input
									class="form-check-input"
									type="checkbox"
									:value="optionIndex"
									v-model="answers[index]"
								/>
								<label class="form-check-label">{{
									option.answer
								}}</label>
							</div>
						</div>
						<div
							v-else-if="
								exercise.exercise_type ===
								'multiple_choice_single_answer'
							"
						>
							<!-- Afișați opțiunile pentru grilă cu răspuns unic -->
							<div
								class="form-check"
								v-for="(
									option, optionIndex
								) in exercise.options"
								:key="option.id"
							>
								<input
									class="form-check-input"
									type="radio"
									:value="optionIndex"
									v-model="answers[index]"
								/>
								<label class="form-check-label">{{
									option.answer
								}}</label>
							</div>
						</div>
						<div v-else-if="exercise.exercise_type === 'numeric'">
							<!-- Afișați câmpul pentru răspuns numeric -->
							<input
								type="number"
								class="form-control"
								v-model="answers[index]"
							/>
						</div>
						<div v-else-if="exercise.exercise_type === 'ordering'">
							<!-- Afișați elementele pentru ordonare -->
							<div class="form-group">
								<label
									v-for="(
										item, itemIndex
									) in exercise.ordering_items"
									:key="item.id"
								>
									{{ item.item }}
									<select
										class="form-control"
										v-model="answers[index][itemIndex]"
									>
										<option
											v-for="(
												_, i
											) in exercise.ordering_items"
											:value="i + 1"
										>
											{{ i + 1 }}
										</option>
									</select>
								</label>
							</div>
						</div>
						<div
							v-else-if="
								exercise.exercise_type === 'fill_in_the_blank'
							"
						>
							<!-- Afișați câmpurile pentru completarea propoziției -->
							<div class="form-group">
								<template
									v-for="(
										word, wordIndex
									) in exercise.fill_in_the_blank_items"
								>
									<input
										type="text"
										class="form-control"
										v-model="answers[index][wordIndex]"
									/>
									<span
										v-if="
											wordIndex <
											exercise.fill_in_the_blank_items
												.length -
												1
										"
										>{{ word.word }}
									</span>
								</template>
							</div>
						</div>
					</div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">
				Trimite testul
			</button>
		</form>
	</div>
</template>
<script>
export default {
	props: {
		test: {
			title: "",
			description: "",
			exercises: [],
		},
	},
	data() {
		return {
			answers: [],
		};
	},
	methods: {
		async submitTest() {
			// Trimite răspunsurile utilizatorului la server
			const response = await fetch("/test/" + this.testId, {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
				},
				body: JSON.stringify(this.answers),
			});
			const result = await response.json();

			// Afișați rezultatul testului (de exemplu, numărul de puncte obținute)
			alert("Ai obținut " + result.points + " puncte!");
		},
	},
};
</script>
