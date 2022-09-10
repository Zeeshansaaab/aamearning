import './assets/css/bootstrap.min.css'
import './assets/css/bootstrap-toggle.min.css'
import './assets/css/line-awesome.min.css'
import './assets/css/vendor/prism.css'
import './assets/css/vendor/select2.min.css'
import './assets/css/vendor/jquery-jvectormap-2.0.5.css'
import './assets/css/vendor/datepicker.min.css'
import './assets/css/vendor/jquery-timepicky.css'
import './assets/css/vendor/bootstrap-clockpicker.min.css'
import './assets/css/vendor/bootstrap-pincode-input.css'
import './assets/css/app.css'
/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'
/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

import { fas } from '@fortawesome/free-solid-svg-icons'

import './assets/js/jquery-3.6.0.min.js'
import './assets/js/bootstrap.bundle.min.js'
import './assets/js/jquery.slimscroll.min.js'
import './assets/js/select2.min.js'
import './assets/js/nicEdit.js'
// import './assets/js/bootstrap-toggle.min.js'
import './assets/js/prism.js'
import './assets/js/app.js'


import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createPopper } from '@popperjs/core';
import mitt from 'mitt';

window.Popper = createPopper;

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
library.add(fas)
createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const appVue = createApp({ render: () => h(app, props) })
            .component('font-awesome-icon', FontAwesomeIcon)
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            
            appVue.config.globalProperties.emitter = mitt()
            appVue.mount(el);
            
    },
});
InertiaProgress.init({ color: '#4B5563' });
