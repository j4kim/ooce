<template>
  <div class="search-input">
    <div v-if="loading" class="me-2">
      <div class="spinner-grow spinner-grow-sm" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    <input
      class="form-control"
      list="search-options"
      type="search"
      placeholder="Rechercher un truc"
      v-model="query"
      @input="handleInput"
    />
    <datalist id="search-options">
      <option v-for="thing in things" value="Chargement..."/>
    </datalist>
  </div>
</template>

<script>
export default {
  data: () => ({
    query: "",
    debouncedSearch: undefined,
    loading: false,
    things: []
  }),
  created() {
    this.debouncedSearch = _.debounce(this.search, 300)
  },
  methods: {
    search() {
      console.log("search:", this.query)
      this.loading = false
    },
    handleInput() {
      this.loading = true
      this.debouncedSearch()
    }
  }
}
</script>

<style>
.search-input {
  display: flex;
  align-items: baseline;
}
</style>