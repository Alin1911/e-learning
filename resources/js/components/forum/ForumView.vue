<template>
	<div>
		<h2 class="border-bottom border-primary mb-3 py-1">Topicuri</h2>
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
