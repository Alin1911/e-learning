<template>
	<form @submit.prevent="submitCategory">
		<div class="form-group">
			<label for="name">Nume</label>
			<input
				type="text"
				class="form-control"
				id="name"
				v-model="category.name"
				required
			/>
		</div>

		<button type="submit" class="btn btn-primary">
			{{ isUpdate ? "Actualizează categoria" : "Creează categoria" }}
		</button>
	</form>
</template>

<script>
import axios from "axios";

export default {
	props: {
		isUpdate: Boolean,
		initialCategory: Object,
	},
	data() {
		return {
			category: this.isUpdate
				? { ...this.initialCategory }
				: { name: "" },
		};
	},
	methods: {
		async submitCategory() {
			try {
				if (this.isUpdate) {
					await axios.put(
						`/categories/${this.category.id}`,
						this.category
					);
					// Logica după actualizare cu succes (ex. redirect sau emitere eveniment)
				} else {
					await axios.post("/categories", this.category);
					// Logica după creare cu succes (ex. redirect sau emitere eveniment)
				}
			} catch (error) {
				// Tratează eroarea (ex. afișare mesaj)
			}
		},
	},
};
</script>
