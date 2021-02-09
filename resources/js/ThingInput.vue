<template>
  <div class="search-input">
    <input type="hidden" :name="name" v-model="value">
    <input
      class="form-control"
      type="search"
      placeholder="Rechercher un truc"
      v-model="query"
      @input="debouncedSearch"
    />
    <div class="search-list-container">
      <div class="list-group">
        <template v-if="!loading">
          <a
            v-for="thing in things"
            @click="$emit('input', thing)"
            class="list-group-item list-group-item-action"
          >
            {{ thing.id }} <b>{{ thing.name }}</b>
          </a>
        </template>
        <div v-else class="list-group-item disabled">
          Chargement...
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "value",
    "name"
  ],
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
      if (this.query === "") {
        this.things = []
        this.loading = false
        return
      }
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
.search-list-container {
  position: relative;
}
.search-list-container > div {
  position: absolute;
  width: 100%;
  max-height: 252px;
  overflow: auto;
}
</style>