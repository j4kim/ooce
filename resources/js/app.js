require('./bootstrap');

Vue.component('search-input', {
  template: `
    <div>
      <input class="form-control" type="search" placeholder="Rechercher un truc">
    </div>
  `
});

new Vue({
  el: '#app'
});