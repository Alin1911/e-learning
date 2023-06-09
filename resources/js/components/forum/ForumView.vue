<template>
	<div>
		<h2 class="border-bottom border-primary mb-3 py-1">
			Cele mai actuale subiecte!
		</h2>
		<div v-if="topics.length === 0" class="alert alert-success" role="alert">
			<p class="text-center">Nu există subiecte în acest forum.</p>
		</div>
		<div class="bg-white my-2 shadow p-4" v-for="topic in topics" :key="topic.id">
			<div class="d-flex justify-content-between">
				<div>
					<h3>{{ topic.title }}</h3>
					<p v-if="topic.description">{{ topic.description }}</p>
				</div>
				<div>
					<p>
						<i class="fa-solid fa-comments"></i>
						{{ topic.posts.length }} postări
					</p>
					<a class="btn btn-primary" :href="'/topics/' + topic.id">
						<span>Accesează</span>
					</a>
				</div>
			</div>
		</div>
		<div class="p-4 my-3 rounded shadow bg-white" v-if="showForm">
			<form @submit.prevent="submitTopic">
				<div class="form-group">
					<label for="title">Titlu:</label>
					<input type="text" class="form-control" id="title" v-model="newTopic.title" required />
				</div>
				<div class="form-group">
					<label for="description">Descriere:</label>
					<textarea class="form-control" id="description" v-model="newTopic.description"></textarea>
				</div>
				<button type="submit" class="mt-3 btn btn-primary">
					Adaugă
				</button>
			</form>
		</div>
		<div v-if="forum" class="row d-flex justify-content-center p-3 align-items-center">
			<hr class="mb-0" />
			<div class="col-8 d-flex justify-content-between align-items-center p-3">
				<h3 class="m-0">Întreaba ceva sau deschide un nou subiect!</h3>
				<button class="btn btn-primary" @click="addTopic">
					Adauga un subiect nou
				</button>
			</div>
			<hr />
		</div>
	</div>
</template>

<script>
import axios from "axios";

export default {
	props: ["forum_id"],
	data() {
		return {
			forum: null,
			topics: [],
			newTopic: {
				title: "",
				description: "",
				forum_id: null,
			},
			showForm: false,
		};
	},
	methods: {
		addTopic() {
			this.showForm = true;
		},
		async submitTopic() {
			try {
				this.newTopic.forum_id = this.forum_id;
				const a = await axios
					.post("/forums/" + this.forum.id + "/topics", this.newTopic)
					.then(async (response) => {
						axios.defaults.headers.common["Content-Type"] =
							"application/json";
						axios.defaults.headers.common["Accept"] =
							"application/json";
						response = await axios.get(
							`/forums/${this.forum_id}/topics`
						);
						this.forum = response.data;
						this.topics = response.data.topics;
						this.showForm = false;
					});
			} catch (error) {
				alert("A apărut o eroare la adaugarea subiectului!");
			}
		},
	},
	async created() {
		axios.defaults.headers.common["Content-Type"] = "application/json";
		axios.defaults.headers.common["Accept"] = "application/json";

		const response = await axios.get(`/forums/${this.forum_id}/topics`);
		this.forum = response.data;
		this.topics = response.data.topics;
	},
};
</script>
