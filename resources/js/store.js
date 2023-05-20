import { createStore } from "vuex";

export default function createNewStore() {
	return createStore({
		state: {
			user: null,
			courses: [],
			selectedCourseId: null,
			openedLesson: null,
			currentCourse: {
				id: null,
				title: "",
				tests: [],
				lessons: [],
				forum: [],
			},
			completedLessons: [],
		},
		getters: {
			getUser: (state) => state.user,
			getCourses: (state) => state.courses,
			getSelectedCourse: (state) => {
				if (state.courses) {
					return state.courses.find(
						(course) => course.id === state.selectedCourseId
					);
				}
			},
			getSelectedCourseTitle: (state) => {
				if (state.courses) {
					const selectedCourse = state.courses.find(
						(course) => course.id === state.selectedCourseId
					);
					return selectedCourse ? selectedCourse.title : "";
				}
			},
			getLessons: (state) =>
				state.currentCourse ? state.currentCourse.lessons : [],
			getOpenedLesson: (state) => state.openedLesson,
			getCompletedLessons: (state) => state.completedLessons,
			getCurrentCourse: (state) => state.currentCourse,
			getForum: (state) => state.currentCourse.forum[0],
		},
		mutations: {
			setUser(state, user) {
				state.user = user;
			},
			setCourses(state, courses) {
				state.courses = courses;
			},
			setSelectedCourseId(state, courseId) {
				state.selectedCourseId = courseId;
			},
			setOpenedLesson(state, lesson) {
				state.openedLesson = lesson;
			},
			setCurrentCourse(state, course) {
				state.currentCourse = course;
			},
			setCompletedLessons(state, completedLessons) {
				state.completedLessons = completedLessons;
			},
		},
		actions: {
			async fetchUser({ commit }) {
				const response = await fetch("/user");
				const data = await response.json();
				commit("setUser", data);
			},
			async fetchCourses({ commit }) {
				const response = await fetch("/courses");
				const data = await response.json();
				commit("setCourses", data);
			},
			async fetchCourseData({ commit }, courseId) {
				const requestOptions = {
					headers: {
						Accept: "application/json",
					},
				};
				const response = await fetch(
					`/course/${courseId}`,
					requestOptions
				);
				const data = await response.json();
				console.log(data);
				commit("setCurrentCourse", data.course);
				commit("setCompletedLessons", data.completedLessons);
			},
			async toggleLessonCompletion(
				{ state, commit },
				{ courseId, lessonId }
			) {
				const course = state.courses.find(
					(course) => course.id === courseId
				);
				if (course) {
					const completedLessons = course.completedLessons;
					const index = completedLessons.indexOf(lessonId);
					if (index > -1) {
						completedLessons.splice(index, 1);
					} else {
						completedLessons.push(lessonId);
					}
					commit("setCourses", state.courses);
					// Aici puteți adăuga logica de actualizare a API-ului
				}
				window.location.replace("/learn/lesson/" + lessonId);
			},
		},
	});
}
