require('./bootstrap');

import InteractiveSearch from './InteractiveSearch.vue';
import ThingInputField from './ThingInputField.vue';

new Vue({
  el: '#app',
  components: {InteractiveSearch, ThingInputField }
});