import './bootstrap';
import { createApp } from 'vue';

import store from './store';

import NavbarComponent from './components/NavbarComponent.vue';

import Auth from './pages/auth/Index.vue'
import Decoder from './pages/decoder/Index.vue'
import DecoderDetails from './pages/decoder-details/Index.vue'
import NotFound from './pages/errors/Index.vue'



const createMyApp = () => {
    const app = createApp({});

    app.component('navbar-component', NavbarComponent);

    app.component('auth-component', Auth);
    app.component('decoder-component', Decoder);
    app.component('decoder-details-component', DecoderDetails);
    app.component('not-found-component', NotFound);

    app.use(store);

    return app;
};

createMyApp().mount('#app');