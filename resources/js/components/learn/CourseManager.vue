<template>
	<div class="row">
		<div class="col-12 border-bottom border-primary mb-4">
			<h2>{{ course.title }}</h2>
		</div>
		<div class="col-12">
			<div class="row">
				<div class="progress">
					<div
						class="progress-bar progress-bar-striped progress-bar-animated"
						role="progressbar"
						:aria-valuenow="course.userPoints"
						aria-valuemin="0"
						:aria-valuemax="course.totalPoints"
						:style="'width: ' + getProgres + '%'"
					></div>
					{{ course.userPoints }} / {{ course.totalPoints }} ({{
						getProgres
					}}%)
				</div>
			</div>
			<div class="row">
				<div
					v-for="(lesson, index) in lessons"
					:key="lesson.id"
					class="col-12 m-1 p-2 shadow-sm"
					:class="{
						'bg-success': completedLessons.includes(lesson.id),
						'bg-light': !completedLessons.includes(lesson.id),
					}"
				>
					<div
						class="d-flex justify-content-between align-items-center"
					>
						<div
							@click="openLesson(lesson)"
							class="w-100"
							style="cursor: pointer"
						>
							<i class="fa-solid fa-person-chalkboard"></i>
							Lecția - {{ index + 1 }}. {{ lesson.title }}
							<span v-if="lesson.tests.length > 0">
								<i class="fa-solid fa-caret-down"></i>
							</span>
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
						<div class="mt-2">
							<div
								class="bg-light col-12 m-1 p-2 shadow-sm"
								v-for="test in lesson.tests"
								:key="test.id"
							>
								<div
									class="d-flex justify-content-between align-items-center"
								>
									<div>
										<i class="fa-solid fa-list-check"></i>
										Test - {{ test.title }}
									</div>
									<a
										:href="'/learn/test/' + test.id"
										class="btn btn-sm btn-primary"
									>
										Verifica-ti cunostintele
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div
					v-if="hasTests"
					v-for="(test, index) in course.tests"
					:key="test.id"
					class="bg-light col-12 m-1 p-2 shadow-sm"
				>
					<div
						class="d-flex justify-content-between align-items-center"
					>
						<div>
							<i class="fa-solid fa-list-check"></i>
							Test de curs - {{ test.title }}
						</div>
						<a
							:href="'/learn/test/' + test.id"
							class="btn btn-sm btn-primary"
						>
							Verifica-ti cunostintele
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
					<h3 class="m-0">Hai să învățam împreuna</h3>
					<a class="btn btn-primary" :href="'/forums/' + forum.id">
						Întrebări și răspunsuri
					</a>
				</div>
				<hr />
			</div>
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
		getProgres() {
			return Math.floor(
				Math.min(
					100,
					(this.course.userPoints / this.course.minimalPoints) * 100
				)
			);
		},
		forum() {
			return this.$store.getters.getForum;
		},
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
