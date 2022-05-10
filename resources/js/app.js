require("./bootstrap");

import {createApp, h} from "vue";
import {createInertiaApp} from "@inertiajs/inertia-vue3";
import {InertiaProgress} from "@inertiajs/progress";
import {createStore} from "vuex";
import storeData from "./Store/Store";

const store = new createStore(storeData);

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
                    .dispatch("getProducts")
                    .then((_) => {
                    })
                    .catch((error) => console.error(error))
            )
            .use(store)
            .mixin({methods: {route}})
            .mount(el);
    },
});

InertiaProgress.init({color: "#4B5563"});
