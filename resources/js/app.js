import { createApp } from "vue";
import "bootstrap";
import "@popperjs/core";

import Course from "@/components/Course.vue";
import CourseAdd from "@/components/CourseAdd.vue";
import Instructors from "@/components/Instructors.vue";
import Categories from "@/components/Categories.vue";
import CourseManager from "@/components/learn/CourseManager.vue";
import LessonCreate from "@/components/LessonCreate.vue";
import TestCreate from "@/components/TestCreate.vue";
import TestComponent from "@/components/TestComponent.vue";
import ExerciseCreate from "@/components/Exercise.vue";
import AddForum from "@/components/AddForum.vue";
import Lesson from "@/components/learn/Lesson.vue";
import Test from "@/components/learn/Test.vue";
import ForumList from "@/components/forum/ForumList.vue";
import TopicList from "@/components/forum/ForumView.vue";
import TopicView from "@/components/forum/TopicView.vue";
import ProblemForm from "@/components/problem/ProblemForm.vue";
import ProblemList from "@/components/problem/ProblemList.vue";
import AccountMenu from "@/components/user/MyAccount.vue";
import RoleRequestIndex from "@/components/role/RoleRequestIndex.vue";
import RoleRequestForm from "@/components/role/RoleRequestForm.vue";

import createNewStore from "./store.js";

const store = createNewStore();

const app = createApp({
	components: {
		course: Course,
		lesson: Lesson,
		test: Test,
		instructors: Instructors,
		categories: Categories,
		"course-manager": CourseManager,
		"lesson-create": LessonCreate,
		"test-create": TestCreate,
		"test-component": TestComponent,
		"exercise-create": ExerciseCreate,
		"add-forum": AddForum,
		"course-add": CourseAdd,
		"forum-list": ForumList,
		"topic-list": TopicList,
		"topic-view": TopicView,
		"problem-form": ProblemForm,
		"problem-list": ProblemList,
		"account-menu": AccountMenu,
		"role-request-index": RoleRequestIndex,
		"role-request-form": RoleRequestForm,
	},
});

app.use(store);

app.mount("#app");
