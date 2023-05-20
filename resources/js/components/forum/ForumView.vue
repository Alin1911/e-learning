<template>
	<div>
		<h2 class="border-bottom border-primary mb-3 py-1">
			Cele mai actuale subiecte!
		</h2>
		<div
			v-if="topics.length === 0"
			class="alert alert-success"
			role="alert"
		>
			<p class="text-center">Nu există subiecte în acest forum.</p>
		</div>
		<div
			class="bg-white my-2 shadow p-4"
			v-for="topic in topics"
			:key="topic.id"
		>
			<div class="d-flex justify-content-between">
				<div>
					<h3>{{ topic.title }}</h3>
					<p v-if="topic.description">{{ topic.description }}</p>
				</div>
				<div>
					<p>{{ topic.posts.length }} postări</p>
					<a class="btn btn-primary" :href="'/topics/' + topic.id">
						<span>Accesează</span>
					</a>
				</div>
			</div>
		</div>
		<div
			v-if="forum"
			class="row d-flex justify-content-center p-3 align-items-center"
		>
			<hr class="mb-0" />
			<div
				class="col-8 d-flex justify-content-between align-items-center p-3"
			>
				<h3 class="m-0">Întreaba ceva sau deschide un nou subiect!</h3>
				<a class="btn btn-primary" :href="'/forums/' + forum.id">
					Adauga un subiect nou
				</a>
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
		};
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
