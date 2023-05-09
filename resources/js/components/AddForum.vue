<template>
  <div>
    <h2>Adaugă un nou forum</h2>
    <form @submit.prevent="addForum">
      <div class="form-group">
        <label for="course_id">ID-ul cursului:</label>
        <input type="number" class="form-control" id="course_id" v-model="forum.course_id" required />
      </div>
      <div class="form-group">
        <label for="title">Titlul forumului:</label>
        <input type="text" class="form-control" id="title" v-model="forum.title" required />
      </div>
      <div class="form-group">
        <label for="description">Descrierea forumului:</label>
        <textarea class="form-control" id="description" v-model="forum.description" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Adaugă forum</button>
    </form>
  </div>
</template>

<script>
export default {
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
      const response = await fetch("/forums", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(this.forum),
      });

      if (response.ok) {
        // Forumul a fost adăugat cu succes
        // Resetați formularul și trimiteți un mesaj de succes
        this.forum = {
          course_id: "",
          title: "",
          description: "",
        };
        alert("Forumul a fost adăugat cu succes.");
      } else {
        // Tratați eroarea (de exemplu, afișați un mesaj de eroare)
        console.error(`Error ${response.status}: ${response.statusText}`);
      }
    },
  },
};
</script>
