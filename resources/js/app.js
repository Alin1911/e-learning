import { createApp } from 'vue';
import 'bootstrap';
import '@popperjs/core';

import Course from '@/components/Course.vue';
import CourseAdd from '@/components/CourseAdd.vue';
import Instructors from '@/components/Instructors.vue';
import Categories from '@/components/Categories.vue';
import CourseManager from './components/CourseManager.vue';
import store from './store.js';

const app = createApp({
    components: {
        'course': Course,
        'course-add': CourseAdd,
        'instructors': Instructors,
        'categories': Categories,
        'course-manager': CourseManager
    },
});

app.config.globalProperties.$store = store;

app.mount('#app');
