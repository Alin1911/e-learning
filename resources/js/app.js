import { createApp } from 'vue';
import 'bootstrap';
import '@popperjs/core';

import Course from '@/components/Course.vue';
import CourseAdd from '@/components/CourseAdd.vue';
import Instructors from '@/components/Instructors.vue';
import Categories from '@/components/Categories.vue';
import CourseManager from '@/components/CourseManager.vue';
import LessonCreate from '@/components/LessonCreate.vue';
import TestCreate from '@/components/TestCreate.vue';

import createNewStore from './store.js';

const store = createNewStore();

const app = createApp({
    components: {
        'course': Course,
        'course-add': CourseAdd,
        'instructors': Instructors,
        'categories': Categories,
        'course-manager': CourseManager,
        'lesson-create': LessonCreate,
        'test-create': TestCreate,
    },
});

app.use(store);

app.mount('#app');
