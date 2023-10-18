require( './bootstrap');
import{ createApp } from 'vue';
import Post from './components/Post.vue';
const app=createApp({});
app._component('post',Post);
app.mount('#app');
