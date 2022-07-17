<template>
  <div
    class="page d-flex flex-column justify-content-center align-items-center"
  >
    <img :src="baseUrl + '/img/error/sad.gif'" alt="" srcset="" />
    <h1 class="error">Сторінку не знайдено</h1>
  </div>
</template>

<script>
import config from "../../config/config.js";

export default {
  name: "NotFound",
  data() {
    return {
      baseUrl: config.BASE_URL,
    };
  },
};
</script>

<style>
.error {
  color: red;
}
</style>
