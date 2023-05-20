<template>
	<div>
		<h3 class="py-2 border-bottom border-primary mb-3">Cereri</h3>
		<div v-for="roleRequest in roleRequests" :key="roleRequest.id">
			<div v-if="!roleRequest.approve" class="card mb-3">
				<div class="card-header">
					{{ roleRequest.user.name }}
				</div>
				<div class="card-body">
					<p>Nume: {{ roleRequest.user.name }}</p>
					<p>Email: {{ roleRequest.user.email }}</p>
					<p>Rol: {{ roleRequest.role.name }}</p>
					<p v-if="roleRequest.user.points">
						Puncte: {{ roleRequest.role.name }}
					</p>
					<div>
						<button class="btn btn-success">Acceptă</button>
						<button class="btn btn-danger mx-3">Respinge</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from "axios";

export default {
	data() {
		return {
			roleRequests: [],
		};
	},
	mounted() {
		var token = document.head.querySelector('meta[name="csrf-token"]');
		axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
		axios.defaults.headers.common["Content-Type"] = "application/json";
		axios.defaults.headers.common["Accept"] = "application/json";
		axios.get("/role/request").then((response) => {
			this.roleRequests = response.data;
			console.log(response.data);
		});
	},
};
</script>
