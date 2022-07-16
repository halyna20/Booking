<template lang="">
    <div>
        <banner />
        <search />
        <about />
    </div>
</template>
<script>
import Search from "../components/home/Search.vue";
import Banner from "../components/home/Banner.vue";
import About from "../components/home/About.vue";

export default {
  name: "Home",
  components: {
    Search,
    Banner,
    About,
  },
};
</script>
<style lang="">
</style>
