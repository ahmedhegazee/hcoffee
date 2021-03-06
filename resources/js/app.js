require("./bootstrap");

import Vue from "vue";
import App from "./pages/App.vue";
import VueRouter from "vue-router";
import VueAxios from "vue-axios";
import axios from "axios";
import { routes } from "./routes/index";
Vue.component("test", "./components/test.vue");
Vue.use(VueRouter);
Vue.use(VueAxios, axios);
import "@fortawesome/fontawesome-free/css/all.css";
import "@fortawesome/fontawesome-free/js/all.js";
import Vuelidate from "vuelidate";
Vue.use(Vuelidate);
import VueSweetalert2 from "vue-sweetalert2";

// If you don't need the styles, do not connect
import "sweetalert2/dist/sweetalert2.min.css";

Vue.use(VueSweetalert2);

const router = new VueRouter({
    mode: "history",
    routes: routes
});

const app = new Vue({
    el: "#app",
    router,
    render: h => h(App)
});
