require("./bootstrap");
/*window.Vue = require("vue").default;
Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
const app = new Vue({
    el: "#app",
});*/

import { createApp } from "vue";
import Home from "./components/Home.vue";
import Menu from "./components/Menu.vue";
import About from "./components/About.vue";
import Contact from "./components/Contact.vue";
import Reservation from "./components/Reservation.vue";

createApp({
        components: {
            Home,
            Menu,
            Contact,
            About,
            Reservation,
        },
    })
    .use(router)
    .mount("#app");