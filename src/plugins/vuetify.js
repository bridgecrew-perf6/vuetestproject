import Vue from 'vue';
import Vuetify from 'vuetify/lib/framework';


Vue.use(Vuetify, {
    theme: {
        primary: '#9652ff',
        success: '#3cd1c2',
        info: '#3f51b5',
        error: '#f83e70'
    }
});

export default new Vuetify({
});
