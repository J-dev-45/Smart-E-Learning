import { createApp } from 'vue';
import axios from 'axios';
import CodePlayground from './Pages/CodePlayground.vue';

// Axios sends the XSRF cookie automatically, but keep the meta token as a fallback
const token = document.querySelector('meta[name="csrf-token"]')?.content;
if (token) axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const el = document.getElementById('app');

createApp(CodePlayground, {
    questionId: Number(el.dataset.questionId),
}).mount(el);