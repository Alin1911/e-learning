<template>
	<div>
		<h3 class="mb-2 py-2 border-bottom mt-5">
			Completează cererea pentru rolul dorit
		</h3>
		<form @submit.prevent="submit">
			<div class="form-group">
				<label for="rol">Rol:</label>
				<select class="form-control" id="rol" name="rol">
					<option key="rol" :value="2">Administrator</option>
				</select>
			</div>
			<div class="form-group mt-2">
				<label for="motivation">De ce vrei acest rol?</label>
				<textarea
					type="text"
					class="form-control"
					id="motivation"
					name="motivation"
					required
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
				.catch((error) => {
					alert("Cererea nu a putut fi trimisă!");
				})
				.finally(() => {
					window.location.href = "/";
				});
		},
	},
	data() {
		return {
			form: {
				// Aici includ câmpurile formularului
			},
		};
	},
};
</script>
