import { createApp } from 'vue';
import router from './router';
import pinia from './store';

const app = createApp({});
app.use(router);
app.use(pinia);
app.mount('#mediamanager');



// createApp(App).mount('#mediamanager');