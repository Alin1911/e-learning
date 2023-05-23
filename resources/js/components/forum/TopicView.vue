<template>
	<div>
		<h1 class="border-bottom border-primary mb-3 py-1">
			{{ topic.title }}
		</h1>
		<p v-if="topic.description" class="border-bottom border-primary mb-3 py-1">
			{{ topic.description }}
		</p>
		<div class="bg-white p-4 shadow">
			<h2 class="mb-3 py-1">Postări</h2>
			<div v-if="topic.posts && topic.posts.length == 0" class="alert alert-info">
				Nu există postări
			</div>
			<div v-for="post in topic.posts" :key="post.id" class="bg-light border rouned-0 shadow pt-3 pb-2 px-3 mb-2">
				<div class="d-flex justify-content-between">
					<div class="col-10">
						<p>{{ post.content }}</p>
					</div>
					<div class="col-2 bg-light text-dark px-2">
						<p><i class="fa-regular fa-user"></i> {{ post.user.name }}</p>
						<p>
							<button class="btn btn-primary" :disabled="!post.like">
								<i class="fa-regular fa-thumbs-up" aria-hidden="true"></i>
								{{ post.likes }} aprecieri
							</button>
						</p>
						<p v-if="post.created_at">
							<i class="fa-regular fa-clock"></i> {{ formatDate(post.created_at) }}
						</p>
					</div>
				</div>
			</div>
		</div>
		<PostForm :topicId="topic.id" @postAdded="postAdded"></PostForm>
	</div>
</template>
<script>
import axios from "axios";
import PostForm from "./PostForm.vue";

export default {
	props: ["topic_id"],
	data() {
		return {
			topic: {},
		};
	},
	components: {
		PostForm,
	},
	methods: {
		postAdded(post) {
			this.topic.posts.push(post);
		},
		formatDate(dateString) {
			const date = new Date(dateString);
			return `${date.getDate()}.${date.getMonth() + 1
				}.${date.getFullYear()} ${date.getHours()}:${date.getMinutes()}`;
		},
	},
	async created() {
		axios.defaults.headers.common["Content-Type"] = "application/json";
		axios.defaults.headers.common["Accept"] = "application/json";

		const topicResponse = await axios.get(`/topics/${this.topic_id}`);
		if (topicResponse.status === 200) {
			this.topic = topicResponse.data;
		}
	},
};
</script>
