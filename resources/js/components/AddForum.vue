<template>
    <div>
        <h2>Adaugă un nou forum</h2>
        <form @submit.prevent="addForum">
            <div class="form-group">
                <label for="course_id">Alegeți cursul:</label>
                <select
                    class="form-control"
                    id="course_id"
                    v-model="forum.course_id"
                    required
                >
                    <option disabled value="">Selectează un curs</option>
                    <option
                        v-for="course in courses"
                        :key="course.id"
                        :value="course.id"
                    >
                        {{ course.title }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Titlul forumului:</label>
                <input
                    type="text"
                    class="form-control"
                    id="title"
                    v-model="forum.title"
                    required
                />
            </div>
            <div class="form-group">
                <label for="description">Descrierea forumului:</label>
                <textarea
                    class="form-control"
                    id="description"
                    v-model="forum.description"
                    required
                ></textarea>
            </div>
            <button type="submit" class="mt-2 btn btn-primary">
                Adaugă forum
            </button>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        courses: {
            type: Array,
            default: () => [],
        },
    },
    data() {
        return {
            forum: {
                course_id: "",
                title: "",
                description: "",
            },
        };
    },
    methods: {
        async addForum() {
            try {
                const response = await fetch("/forum", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(this.forum),
                });

                if (response.ok) {
                    // Forumul a fost creat cu succes
                    // Resetați formularul
                    this.forum.course_id = "";
                    this.forum.title = "";
                    this.forum.description = "";

                    // Opțional: afișați un mesaj de succes sau redirecționați utilizatorul
                    alert("Forumul a fost creat cu succes.");
                } else {
                    // Tratați eroarea (de exemplu, afișați un mesaj de eroare)
                    console.error(
                        `Error ${response.status}: ${response.statusText}`
                    );
                }
            } catch (error) {
                // Tratați eroarea de rețea
                console.error("A apărut o eroare de rețea:", error);
            }
        },
    },
};
</script>
