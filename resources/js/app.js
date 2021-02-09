require('./bootstrap');

import SearchInput from './SearchInput.vue';
import ThingInput from './ThingInput.vue';

new Vue({
  el: '#app',
  components: { SearchInput,ThingInput }
});