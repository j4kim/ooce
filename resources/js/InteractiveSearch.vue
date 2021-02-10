<template>
  <div class="search-input">
    <div class="input-group">
      <thing-input v-model="thingId" @update="update" @enter="openSearchResultPage"/>
      <button class="btn btn-primary border" type="button" @click="openSearchResultPage">
        <i class="bi bi-search"></i>
      </button>
    </div>
  </div>
</template>

<script>
import ThingInput from "./ThingInput"

export default {
  components: { ThingInput },
  data: () => ({
    thingId: undefined,
    query: ""
  }),
  watch: {
    thingId(newValue) {
      if (newValue) {
        this.openThingPage()
      }
    }
  },
  methods: {
    update(query) {
      this.query = query
    },
    openThingPage() {
      window.location = `${window.appUrl}/${this.thingId}`
    },
    openSearchResultPage() {
      window.location = `${window.appUrl}/search/${this.query}`
    }
  }
}
</script>

<style>
.search-input .thing-input input {
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}
</style>