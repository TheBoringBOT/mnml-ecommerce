require("./bootstrap");

import {createApp, h} from "vue";
import {createInertiaApp} from "@inertiajs/inertia-vue3";
import {InertiaProgress} from "@inertiajs/progress";
import {createStore} from "vuex";
import storeData from "./Store/Store";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import VueSocialSharing from "vue-social-sharing";

const store = new createStore(storeData);

// function to check when store state changes
// then store in local storage
// currently only storing cart in localstorage
// Perhaps store filter order etc
store.subscribe((mutation, state) => {
    // Store the state object as a JSON string
    localStorage.setItem("store", JSON.stringify(state.cart));
});

// Options for Toast Notifications
const toastOptions = {
    transition: "Vue-Toastification__fade",
    maxToasts: 5,
    newestOnTop: true,
    position: "top-right",
    timeout: 1990,
    closeOnClick: true,
    pauseOnFocusLoss: false,
    pauseOnHover: false,
    draggable: true,
    draggablePercent: 0.3,
    showCloseButtonOnHover: false,
    hideProgressBar: true,
    closeButton: false,
    icon: true,
    rtl: false,
};

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({el, app, props, plugin}) {
        return createApp({render: () => h(app, props)})
            .use(plugin)
            .use(
                store
                    .dispatch("initialiseStore")
                    .then((_) => {
                    })
                    .catch((error) => console.error(error))
            )

            .use(store)
            .use(VueSocialSharing)
            .use(Toast, toastOptions)
            .mixin({methods: {route}})
            .mount(el);
    },
});

InertiaProgress.init({color: "#4B5563"});
