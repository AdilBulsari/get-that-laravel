import { createApp } from 'vue';
import "./bootstrap";
import { createRouter, createWebHistory } from 'vue-router';
import ViewUIPlus from 'view-ui-plus'

import 'view-ui-plus/dist/styles/viewuiplus.css'
import routes  from "./router";
import common from './components/common';
const app = createApp({});
app.mixin(common);
app.component('mainapp', require('./components/mainapp.vue').default);

const myRouter = createRouter({
    history: createWebHistory(),
    routes,
  });

app.use(myRouter).use(ViewUIPlus).mount("#app");
 