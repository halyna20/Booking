<template>
  <footer>
    <div
      class="container py-4 d-flex justify-content-around align-items-center"
    >
      <img class="footer-img" :src="baseUrl + '/img/Hotel.png'" />
      <div>
        <ul>
          <links />
        </ul>
      </div>
      <div>
        <ul>
          <li>
            <img class="pe-2" :src="baseUrl + '/img/telephone.svg'" />
            <span>+38(066) 462 77 76</span>
          </li>
          <li>
            <img class="pe-2" :src="baseUrl + '/img/tg.svg'" />
            <span>Телеграм-бот SeveralNights</span>
          </li>
          <li>
            <img class="pe-2" :src="baseUrl + '/img/mail.svg'" />
            <span>office@severalnights.ua</span>
          </li>
        </ul>
      </div>
    </div>
  </footer>
</template>

<script>
import config from "../../config/config";
import Links from "./Links";
export default {
  name: "Footer",
  data() {
    return {
      baseUrl: config.BASE_URL,
    };
  },
  components: {
    Links,
  },
};
</script>

<style>
</style>
