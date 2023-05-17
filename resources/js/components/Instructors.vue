<template>
	<form @submit.prevent="submitInstructor">
		<div class="form-group">
			<label for="name">Nume</label>
			<input type="text" class="form-control" id="name" v-model="instructor.name" required />
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email" v-model="instructor.email" required />
		</div>

		<div class="form-group">
			<label for="bio">Biografie</label>
			<textarea class="form-control" id="bio" v-model="instructor.bio" rows="3"></textarea>
		</div>

		<button type="submit" class="btn btn-primary">
			{{ isEdit ? "Actualizează instructor" : "Adaugă instructor" }}
		</button>
	</form>
</template>

<script>
import axios from "axios";

export default {
	props: {
		initialInstructor: {
			type: Object,
			default: null,
		},
	},
	data() {
		return {
			instructor: {
				name: "",
				email: "",
				bio: "",
			},
		};
	},
	computed: {
		isEdit() {
			return this.initialInstructor !== null;
		},
	},
	created() {
		if (this.isEdit) {
			this.instructor = { ...this.initialInstructor };
		}
	},
	methods: {
		async submitInstructor() {
			try {
				if (this.isEdit) {
					await axios.put(
						`/instructors/${this.instructor.id}`,
						this.instructor
					);
				} else {
					await axios.post("/instructors", this.instructor);
				}
				// Logica după creare sau actualizare cu succes (ex. redirect sau emitere eveniment)
			} catch (error) {
				// Tratează eroarea (ex. afișare mesaj)
			}
		},
	},
};
</script>
