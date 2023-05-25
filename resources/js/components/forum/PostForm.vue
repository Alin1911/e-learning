<template>
	<div class="form-control mt-4 p-4">
		<div>
			<label for="textAreaExample1">
				<h4>Postează</h4>
			</label>
			<textarea
				v-model="content"
				class="form-control"
				id="textAreaExample1"
				rows="4"
				placeholder="Adaugă o postare"
			></textarea>
		</div>
		<div class="row d-flex justify-content-end mt-2">
			<div class="col-2 d-flex justify-content-end">
				<button class="btn btn-primary" @click="addPost">
					Adaugă postarea
				</button>
			</div>
		</div>
	</div>
</template>

<script>
import axios from "axios";

export default {
	props: ["topicId"],
	data() {
		return {
			content: "",
		};
	},
	methods: {
		async addPost() {
			const csrfToken = document
				.querySelector('meta[name="csrf-token"]')
				.getAttribute("content");
			axios.defaults.headers.common["X-CSRF-TOKEN"] = csrfToken;
			axios.defaults.headers.common["Content-Type"] = "application/json";
			axios.defaults.headers.common["Accept"] = "application/json";

			const response = await axios
				.post(`/topics/${this.topicId}/posts`, {
					content: this.content,
				})
				.then((response) => {
					if (response.status === 201) {
						this.content = "";
						console.log("Post added:", response.data);
						this.$emit("postAdded", response.data);
					}
				})
				.catch((error) => {
					console.error("Error adding post:", response);
					if (error.response.status === 401) {
						window.location.href = "/login";
					}
				});
		},
	},
};
</script>
