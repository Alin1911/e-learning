<template>
	<div class="card">
		<div class="card-header">
			<h2 class="mb-0">{{ course.title }}</h2>
		</div>
		<div class="card-body">
			<ul class="list-group">
				<li
					v-for="(lesson, index) in lessons"
					:key="lesson.id"
					class="list-group-item"
					:class="{
						'bg-success': completedLessons.includes(lesson.id),
						'bg-white': !completedLessons.includes(lesson.id),
					}"
				>
					<div
						class="d-flex justify-content-between align-items-center"
					>
						<div @click="openLesson(lesson)" class="w-100">
							Lecția - {{ index + 1 }}. {{ lesson.title }}
						</div>
						<button
							class="btn btn-sm"
							:class="{
								'btn-success': completedLessons.includes(
									lesson.id
								),
								'btn-secondary': !completedLessons.includes(
									lesson.id
								),
							}"
							@click="toggleLessonCompletion(lesson)"
						>
							{{
								completedLessons.includes(lesson.id)
									? "Parcursă"
									: "Parcurge"
							}}
						</button>
					</div>
					<div v-if="openedLesson === lesson">
						<ul class="list-group mt-2">
							<li
								class="list-group-item"
								v-for="test in lesson.tests"
								:key="test.id"
							>
								<div
									class="d-flex justify-content-between align-items-center"
								>
									<div>Test - {{ test.title }}</div>
									<a
										:href="'/learn/test/' + test.id"
										class="btn btn-sm btn-primary"
									>
										Verifica-ti cunostintele
									</a>
								</div>
							</li>
						</ul>
					</div>
				</li>
				<li
					v-if="hasTests"
					v-for="(test, index) in course.tests"
					:key="test.id"
					class="list-group-item"
				>
					<div
						class="d-flex justify-content-between align-items-center"
					>
						<div>Test de curs - {{ test.title }}</div>
						<a
							:href="'/learn/test/' + test.id"
							class="btn btn-sm btn-primary"
						>
							Verifica-ti cunostintele
						</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		course_id: {
			type: [String, Number],
			required: true,
		},
	},
	computed: {
		course() {
			return this.$store.getters.getCurrentCourse;
		},
		lessons() {
			return this.$store.getters.getLessons;
		},
		completedLessons() {
			return this.$store.getters.getCompletedLessons;
		},
		openedLesson: {
			get() {
				return this.$store.state.openedLesson;
			},
			set(lesson) {
				this.$store.commit("setOpenedLesson", lesson);
			},
		},
		hasTests() {
			return this.course.tests.length > 0;
		},
	},
	methods: {
		openLesson(lesson) {
			this.openedLesson = this.openedLesson === lesson ? null : lesson;
		},
		toggleLessonCompletion(lesson) {
			this.$store.dispatch("toggleLessonCompletion", {
				course_id: this.course_id,
				lessonId: lesson.id,
			});
		},
	},
	mounted() {
		console.log("CourseManager created");
		console.log("this.course_id", this.course_id);
		this.$store.dispatch("fetchCourseData", this.course_id);
	},
};
</script>
