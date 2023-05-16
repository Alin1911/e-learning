<template>
    <div>
        <div
            class="bg-white my-2 shadow p-4"
            v-for="forum in forums"
            :key="forum.id"
        >
            <div class="d-flex justify-content-between">
                <div>
                    <h3>{{ forum.title }}</h3>
                    <p>{{ forum.description }}</p>
                </div>
                <div>
                    <p>{{ forum.topics.length }} topicuri</p>
                    <p>{{ posts }} postări</p>
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
            posts: 0,
        };
    },
    async created() {
        axios.defaults.headers.common["Content-Type"] = "application/json";
        axios.defaults.headers.common["Accept"] = "application/json";

        const response = await axios.get("/forums").then((response) => {
            this.forums = response.data;
            this.forums.forEach((forum) => {
                forum.topics.forEach((topic) => {
                    this.posts += topic.posts.length;
                });
            });
        });
    },
};
</script>
