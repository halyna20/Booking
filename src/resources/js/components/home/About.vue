<template>
  <section class="about">
    <div class="about-img rounded-1 position-absolute">
      <img
        class="w-100 h-100 rounded-1"
        :src="baseUrl + '/img/home/home2.jpg'"
        alt=""
      />
    </div>
    <div class="container position-relative">
      <div class="about-block">
        <h3 class="about-title">Про нас</h3>
        <p>
          Several Nights - Онлайн-сервіс для бронювання житла без черг та
          операторів.
          <br />
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
          minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat.
        </p>
        <p>
          Sed ut perspiciatis unde omnis iste natus error sit voluptatem
          accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
          ab illo inventore veritatis et quasi architecto beatae vitae dicta
          sunt explicabo.
        </p>
      </div>
    </div>
  </section>
</template>

<script>
import config from "../../config/config";
export default {
  name: "About",
  data() {
    return {
      baseUrl: config.BASE_URL,
    };
  },
};
</script>

<style>
</style>
