<template>
	<div>
		<div
			class="d-flex justify-content-between border-bottom border-danger mb-4 pb-2"
		>
			<h2>Test: {{ test.title }}</h2>
			<h3>
				Timp rămas:
				<span class="text-danger">{{ minutes }}:{{ seconds }}</span>
			</h3>
		</div>
		<form @submit.prevent="submitTest">
			<div
				v-for="(exercise, index) in test.exercises"
				:key="exercise.id"
				class="mb-4 border-bottom py-3"
			>
				<h4 class="mb-3">Exercitiul {{ index + 1 }}.</h4>
				<h5 class="mb-3">{{ exercise.question }}</h5>
				<component
					:is="exerciseComponentName(exercise.exercise_type)"
					:exercise="exercise"
					:selected-answers.sync="selectedAnswers[exercise.id]"
					@update-answers="updateSelectedAnswers"
				/>
			</div>
			<button type="submit" class="btn btn-primary">
				Trimite testul
			</button>
		</form>
	</div>
</template>

<script>
import SingleAnswer from "./SingleAnswer.vue";
import MultipleAnswer from "./MultipleAnswer.vue";
import OrderingExercise from "./OrderingExercise.vue";
import FillInTheBlanks from "./FillInTheBlanks.vue";
import MatchingExercise from "./MatchingExercise.vue";
import axios from "axios";

export default {
	components: {
		SingleAnswer,
		MultipleAnswer,
		OrderingExercise,
		FillInTheBlanks,
		MatchingExercise,
	},
	props: {
		test_id: {
			type: [String, Number],
			required: true,
		},
	},
	data() {
		return {
			test: {
				title: "",
				exercises: [],
			},
			selectedAnswers: {},
			timer: null,
			minutes: 30,
			seconds: 0,
		};
	},
	methods: {
		updateSelectedAnswers({ exerciseId, selectedAnswers }) {
			this.selectedAnswers[exerciseId] = selectedAnswers;
			this.$forceUpdate();
		},

		async fetchTest() {
			try {
				const response = await axios.get(
					`/learn/test/${this.test_id}`,
					{
						headers: {
							Accept: "application/json",
						},
					}
				);
				this.test = response.data.test;

				this.test.exercises.forEach((exercise) => {
					this.selectedAnswers = {
						...this.selectedAnswers,
						[exercise.id]: [],
					};
				});

				this.startTimer();
			} catch (error) {
				console.error("Error fetching test:", error);
			}
		},
		exerciseComponentName(type) {
			switch (type) {
				case "multiple_choice_single_answer":
					return "SingleAnswer";
				case "multiple_choice_multiple_answers":
					return "MultipleAnswer";
				case "ordering_items":
					return "OrderingExercise";
				case "fill_in_the_blank_items":
					return "FillInTheBlanks";
				case "matching-exercise":
					return "MatchingExercise";
			}
		},
		async submitTest() {
			clearInterval(this.timer);
			try {
				const answersArray = Object.keys(this.selectedAnswers).map(
					(key) => ({
						exercise_id: key,
						selected_answers: this.selectedAnswers[key],
					})
				);

				const response = await axios
					.post(`/test/${this.test.id}/check`, answersArray, {
						headers: {
							"Content-Type": "application/json",
						},
					})
					.then((response) => {
						alert(response.data.result.review_text);
						window.location.href =
							"/learn/course/" + response.data.course_id;
					})
					.catch((error) => {
						alert(error);
					});
			} catch (error) {
				console.error("Error submitting test:", error);
			}
		},

		startTimer() {
			this.timer = setInterval(() => {
				this.seconds -= 1;
				if (this.seconds < 0) {
					this.minutes -= 1;
					this.seconds = 59;
				}

				if (this.minutes < 0) {
					clearInterval(this.timer);
					this.submitTest();
				}
			}, 1000);
		},
	},
	mounted() {
		this.fetchTest();
	},
};
</script>
