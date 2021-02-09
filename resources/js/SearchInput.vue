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
      @input="debouncedSearch"
    />
    <datalist id="search-options">
      <option
        v-for="thing in things"
        :value="`${thing.id} - ${thing.name}`"
      />
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
      if (!this.query) return
      this.loading = true
      axios
        .get(`/search/${this.query}`)
        .then(response => {
          this.things = response.data
        })
        .finally(() => this.loading = false)
    },
  }
}
</script>

<style>
.search-input {
  display: flex;
  align-items: baseline;
}
</style>