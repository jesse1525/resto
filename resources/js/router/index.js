import { createRouter, createWebHistory } from "vue-router";
import Home from "../components/Home.vue";
import Menu from "../components/Menu.vue";
import Contact from "../components/Contact.vue";
import About from "../components/About.vue";
import Reservation from "../components/Reservation.vue";
const routes = [{
        path: "/",
        name: "home",
        component: Home,
    },
    {
        path: "/menus",
        name: "Menu",
        component: Menu,
    },
    {
        path: "/contact",
        name: "Contact",
        component: Contact,
    },
    {
        path: "/about",
        name: "About",
        component: About,
    },
    {
        path: "/reservation",
        name: "Reservation",
        component: Reservation,
    },
];
export default createRouter({
    history: createWebHistory(),
    routes,
});