import './bootstrap';
import { createApp } from 'vue';

// استيراد المكونات بالأسماء الصحيحة
import HomeDisplay from './HomeDisplay.vue'; 
import CollegesDisplay from './CollegesDisplay.vue';

const app = createApp({});

// تسجيلهم بأسماء تاغات واضحة
app.component('home-display', HomeDisplay);
app.component('colleges-display', CollegesDisplay);

app.mount('#app');