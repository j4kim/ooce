require('./bootstrap');

import SearchInput from './SearchInput.vue';
import ThingInputField from './ThingInputField.vue';

new Vue({
  el: '#app',
  components: { SearchInput, ThingInputField }
});