<template lang="ua">
    <div v-if="apartments.error">{{apartments.error}}</div>
    <search-apartment  v-else />
</template>
<script>
import { mapGetters } from "vuex";
import Search from "../components/home/Search";
import SearchApartment from "../components/search_result/Apartment";
export default {
  name: "SearchResult",

  components: {
    SearchApartment,
    Search,
  },

  computed: {
    ...mapGetters({
      apartments: "main/getApartments",
      error: "main/getMessage",
    }),
  },
};
</script>
<style lang="">
</style>
