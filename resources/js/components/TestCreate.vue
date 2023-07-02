<template>
	<div>
		<div class="mb-3">
			<label for="course-selector" class="form-label"
				>Selectează cursul</label
			>
			<select
				class="form-select"
				id="course-selector"
				v-model="selectedCourse"
				@change="resetLesson"
			>
				<option disabled value="">Alege un curs</option>
				<option
					v-for="course in courses"
					:key="course.id"
					:value="course"
				>
					{{ course.title }}
				</option>
			</select>
		</div>
		<div v-if="selectedCourse">
			<div class="mb-3">
				<label for="lesson-selector" class="form-label"
					>Selectează lecția (opțional)</label
				>
				<select
					class="form-select"
					id="lesson-selector"
					v-model="selectedLesson"
				>
					<option value="">Fără lecție</option>
					<option
						v-for="lesson in selectedCourse.lessons"
						:key="lesson.id"
						:value="lesson"
					>
						{{ lesson.title }}
					</option>
				</select>
			</div>
			<div v-if="selectedLesson">
				<h3>Teste pentru lecția selectată</h3>
				<ul class="list-group mb-3">
					<li
						v-for="test in selectedLesson.tests"
						:key="test.id"
						class="list-group-item d-flex bd-highlight mb-3"
					>
						<b class="p-2 bd-highlight">{{ test.title }}</b>
						<div class="ms-auto p-2 bd-highlight">
							<a class="m-1" :href="'/test/' + test.id"
								><i class="fa-solid fa-eye"></i
							></a>
							<a class="m-1" :href="'/test/' + test.id + '/edit'"
								><i class="fas fa-edit"></i
							></a>
							<!-- <a
								class="m-1"
								:href="'/test/' + test.id + '/delete'"
								><i class="fa-solid fa-trash"></i
							></a> -->
						</div>
					</li>
				</ul>
			</div>
			<div v-if="selectedCourse && !selectedLesson">
				<h3>Teste pentru cursul selectat</h3>
				<ul class="list-group mb-3">
					<div v-for="test in selectedCourse.tests">
						<li
							v-if="test && !test.lesson_id"
							:key="test.id"
							class="list-group-item d-flex bd-highlight mb-3"
						>
							<b class="p-2 bd-highlight">{{ test.title }}</b>
							<div class="ms-auto p-2 bd-highlight">
								<a class="m-1" :href="'/test/' + test.id"
									><i class="fa-solid fa-eye"></i
								></a>
								<a
									class="m-1"
									:href="'/test/' + test.id + '/edit'"
									><i class="fas fa-edit"></i
								></a>
								<!-- <a
									class="m-1"
									:href="'/test/' + test.id + '/delete'"
									><i class="fa-solid fa-trash"></i
								></a> -->
							</div>
						</li>
					</div>
				</ul>
			</div>
			<h3>Adaugă un nou test</h3>
			<form @submit.prevent="addTest">
				<div class="mb-3">
					<label for="test-title" class="form-label"
						>Titlul testului</label
					>
					<input
						type="text"
						class="form-control"
						id="test-title"
						v-model="newTest.title"
					/>
				</div>
				<div class="mb-3">
					<label for="test-lesson" class="form-label"
						>Timp pentru test</label
					>
					<input
						type="number"
						class="form-control"
						id="test-time"
						v-model="newTest.time"
					/>
				</div>
				<div class="mb-3">
					<label for="test-description" class="form-label"
						>Descrierea testului</label
					>
					<textarea
						class="form-control"
						id="test-description"
						rows="3"
						v-model="newTest.description"
					></textarea>
				</div>
				<button type="submit" class="btn btn-primary">
					Adaugă testul
				</button>
			</form>
		</div>
	</div>
</template>

<script>
import axios from "axios";
export default {
	props: {
		courses: {
			type: Array,
			required: true,
		},
	},
	data() {
		return {
			selectedCourse: "",
			selectedLesson: "",
			newTest: {
				title: "",
				description: "",
				time: 10,
			},
		};
	},
	methods: {
		resetLesson() {
			this.selectedLesson = "";
		},
		async addTest() {
			if (!this.newTest.title || !this.newTest.description) {
				alert("Te rog să completezi toate câmpurile!");
				return;
			}

			try {
				const response = await axios
					.post("/test", {
						title: this.newTest.title,
						description: this.newTest.description,
						course_id: this.selectedCourse.id,
						lesson_id: this.selectedLesson
							? this.selectedLesson.id
							: null,
					})
					.then((response) => {
						return response;
					})
					.catch((error) => {
						return error.response;
					});

				if (response.status === 200) {
					alert("Testul a fost adăugat cu succes!");
					console.log(response.data);
					if (this.selectedLesson) {
						this.selectedLesson.tests.push(response.data);
					} else {
						this.selectedCourse.tests.push(response.data);
					}
				} else {
					alert("A apărut o eroare la adăugarea testului!");
				}
			} catch (error) {
				console.error(error);
				alert("A apărut o eroare la adăugarea testului!");
			}

			// Reset form
			this.newTest.title = "";
			this.newTest.description = "";
		},
	},
};
</script>
