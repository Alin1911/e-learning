<template>
	<div>
		<h3 class="mb-2 py-2 border-bottom mt-5">
			Completează cererea pentru rolul dorit
		</h3>
		<form @submit.prevent="submit">
			<div class="form-group">
				<label for="rol">Rol:</label>
				<select
					class="form-control"
					id="rol"
					name="rol"
					v-model="form.rol"
				>
					<option key="rol" :value="1">Administrator</option>
					<option key="rol" :value="3">Profesor</option>
				</select>
			</div>
			<div class="form-group mt-2">
				<label for="motivation"
					>Ce te-a determinat sa cauți acest rol:</label
				>
				<textarea
					type="text"
					class="form-control"
					id="motivation"
					name="motivation"
					required
					v-model="form.motivation"
				>
				</textarea>
			</div>
			<button class="mt-2 btn btn-success" type="submit">
				Trimite cerere
			</button>
		</form>
	</div>
</template>

<script>
import axios from "axios";
export default {
	methods: {
		submit() {
			var token = document.head.querySelector('meta[name="csrf-token"]');
			axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
			axios
				.post("/role/request", this.form)
				.then((response) => {
					alert("Cererea a fost trimisă cu succes!");
				})
				.then(() => {
					window.location.href = "/";
				})
				.catch((error) => {
					alert("Cererea nu a putut fi trimisă!");
				});
		},
	},
	data() {
		return {
			form: {
				rol: "",
				motivation: "",
			},
		};
	},
};
</script>
