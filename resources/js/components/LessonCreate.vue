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
			<div v-if="selectedCourse.lessons">
				<h3>Lecții existente</h3>
				<ul class="list-group mb-1">
					<li
						v-for="lesson in selectedCourse.lessons"
						:key="lesson.id"
						class="list-group-item d-flex bd-highlight mb-3"
					>
						<b class="p-2 bd-highlight">{{ lesson.title }}</b>
						<div class="ms-auto p-2 bd-highlight">
							<small v-if="lesson.user" class="text-secondary">
								Propusa de:
								<span class="text-dark">{{
									lesson.user.name
								}}</span>
							</small>
							<a class="m-1" :href="'/lesson/' + lesson.id"
								><i class="fa-solid fa-eye"></i
							></a>
							<a
								class="m-1"
								:href="'/lesson/' + lesson.id + '/edit'"
								><i class="fas fa-edit"></i
							></a>
							<!-- <a
								class="m-1"
								:href="'/lesson/' + lesson.id + '/delete'"
								><i class="fa-solid fa-trash"></i
							></a> -->
						</div>
					</li>
				</ul>
			</div>
			<h3>Adaugă o nouă lecție</h3>
			<form @submit.prevent="addLesson">
				<div class="mb-3">
					<label for="lesson-title" class="form-label"
						>Titlul lecției</label
					>
					<input
						type="text"
						class="form-control"
						id="lesson-title"
						v-model="newLesson.title"
					/>
				</div>
				<div class="mb-3">
					<label for="lesson-description" class="form-label"
						>Descrierea lecției</label
					>
					<textarea
						class="form-control"
						id="lesson-description"
						rows="3"
						v-model="newLesson.description"
					></textarea>
				</div>
				<button type="submit" class="btn btn-primary">
					Adaugă lecția
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
			newLesson: {
				title: "",
				description: "",
			},
		};
	},
	methods: {
		async addLesson() {
			if (!this.newLesson.title || !this.newLesson.description) {
				alert("Te rog să completezi toate câmpurile!");
				return;
			}
			// Aici poți adăuga logica pentru a trimite lecția nouă la server
			try {
				const response = await axios.post("/lesson", {
					title: this.newLesson.title,
					description: this.newLesson.description,
					course_id: this.selectedCourse.id,
				});

				if (response.status === 200) {
					alert("Lecția a fost adăugată cu succes!");
					// Actualizează lista de lecții a cursului selectat cu datele primite de la server
					this.selectedCourse.lessons = response.data;
				} else {
					alert("A apărut o eroare la adăugarea lecției!");
				}
			} catch (error) {
				console.error(error);
				alert("A apărut o eroare la adăugarea lecției!");
			}

			// Reset form
			this.newLesson.title = "";
			this.newLesson.description = "";
		},
	},
};
</script>
