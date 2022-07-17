<template lang="ua">

    <search-apartment class="page" />
</template>
<script>
import { mapGetters } from "vuex";

import SearchApartment from "../components/search_result/Apartment";
export default {
  name: "SearchResult",

  components: {
    SearchApartment,
  },

  computed: {
    ...mapGetters({
      apartments: "main/getApartments",
    }),
  },
};
</script>
<style lang="">
</style>
