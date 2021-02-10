<template>
  <div class="thing-input-field">
    <input type="hidden" :name="name" :value="internalValue">
    <thing-input v-model="internalValue" :containers-only="true" />
  </div>
</template>

<script>
import ThingInput from "./ThingInput"

export default {
  props: ['value', 'name'],
  components: { ThingInput },
  data: () => ({ internalValue: undefined }),
  created() {
    this.internalValue = this.value
  }
}
</script>