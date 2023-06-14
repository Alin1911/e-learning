<template>
	<div>
		<h3 class="py-2 border-bottom border-primary mb-3">Cereri</h3>
		<div v-for="roleRequest in roleRequests" :key="roleRequest.id">
			<div v-if="!roleRequest.approved" class="card mb-3">
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
					<p v-if="roleRequest.motivation">
						Motiv: {{ roleRequest.motivation }}
					</p>
					<div>
						<button
							@click="approveRequest(roleRequest)"
							class="btn btn-success"
						>
							Acceptă
						</button>
						<button
							@click="rejectRequest(roleRequest)"
							class="btn btn-danger mx-3"
						>
							Respinge
						</button>
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
		this.loadRoleRequests();
	},
	methods: {
		loadRoleRequests() {
			axios.get("/role/request").then((response) => {
				this.roleRequests = response.data;
			});
		},
		approveRequest(roleRequest) {
			var form = {
				role_id: roleRequest.role.id,
				user_id: roleRequest.user.id,
				id: roleRequest.id,
				appoved: true,
			};
			axios.put(`/role/request/${roleRequest.id}`, form).then(() => {
				this.loadRoleRequests();
			});
		},
		rejectRequest(roleRequest) {
			axios.delete(`/role/request/${roleRequest.id}`).then(() => {
				this.loadRoleRequests();
			});
		},
	},
};
</script>
