require('./bootstrap');
window.$ = window.jQuery = require('jquery')
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import mitt from 'mitt';
import Notifications from 'notiwind'
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

// Sweet Alert
window.swal = require('sweetalert2');
window.toast = swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000,
    customClass: {
        title: 'text-xl'
    }
});

library.add(fas)

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const appVue = createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } });
            appVue.config.globalProperties.swal = window.swal;
            appVue.config.globalProperties.toast = window.toast;
            appVue.config.globalProperties.emitter = mitt()
            appVue.use(Notifications)
            appVue.component('font-awesome-icon', FontAwesomeIcon)
            appVue.mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
