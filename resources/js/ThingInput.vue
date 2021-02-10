<template>
  <div class="thing-input">
    <input
      class="form-control"
      type="search"
      placeholder="Rechercher un truc"
      v-model="query"
      @input="input"
      :readonly="!searching"
      @click="searching = true"
      @keyup.enter="$emit('enter')"
    />
    <div class="search-list-container" v-if="searching">
      <div class="list-group">
        <template v-if="!loading">
          <a
            v-for="thing in things"
            @click="select(thing)"
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
  props: {
    value: Number,
    containersOnly: Boolean
  },
  data: () => ({
    query: "",
    debouncedSearch: undefined,
    loading: false,
    things: [],
    selected: undefined,
    searching: false,
    updatedValue: undefined
  }),
  created() {
    this.debouncedSearch = _.debounce(this.search, 300)
    if (this.value) {
      this.fetchSelected()
    } else {
      this.searching = true
    }
  },
  methods: {
    input() {
      this.debouncedSearch()
      this.$emit('update', this.query)
    },
    search() {
      if (this.query === "") {
        this.things = []
        this.loading = false
        return
      }
      this.loading = true
      axios
        .get(`/search/${this.query}`, {
          params: { containersOnly: this.containersOnly }
        })
        .then(response => {
          this.things = response.data
        })
        .finally(() => this.loading = false)
    },
    async fetchSelected() {
      let response = await axios.get(this.value)
      let thing = response.data
      this.query = `${thing.id} - ${thing.name}`
    },
    select(thing) {
      this.$emit('input', thing.id)
      this.searching = false
      this.query = `${thing.id} - ${thing.name}`
    }
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
  z-index: 1;
}
</style>