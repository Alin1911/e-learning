import { createApp } from 'vue';

import Course from '@/components/Course.vue';

const app = createApp({
    components: {
        'course': Course
    }
});

app.mount('#app');
