<template>
	<div>
		<div class="bg-white mb-3 shadow px-3 py-3" v-for="forum in forums" :key="forum.id">
			<div class="d-flex justify-content-between">
				<div>
					<h3>{{ forum.title }}</h3>
					<p>{{ forum.description }}</p>
				</div>
				<div>
					<p><i class="fa-regular fa-comments"></i> {{ forum.topics.length }} topicuri</p>
					<p><i class="fa-regular fa-comment"></i> {{ forum.posts }} postări</p>
					<a class="btn btn-primary" :href="'forums/' + forum.id">
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
	data() {
		return {
			forums: [],
		};
	},
	async created() {
		axios.defaults.headers.common["Content-Type"] = "application/json";
		axios.defaults.headers.common["Accept"] = "application/json";

		const response = await axios.get("/forums").then((response) => {
			this.forums = response.data;
			this.forums.forEach((forum) => {
				forum.posts = 0;
				forum.topics.forEach((topic) => {
					forum.posts += topic.posts.length;
				});
			});
		});
	},
};
</script>
