<template>
  <div class="container page">
    <div class="row justify-content-center mt-5">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Електронну адресу підтверджено</div>

          <div class="card-body">
            <div class="alert alert-success" role="alert">
              Ваша електронна адреса успішно підтверджена
            </div>

            <p>
              Тепер ви можете здійснити бронювання чи додати своє помешкання
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  name: "EmailConfirmed",
  mounted() {
    this.getUser();
  },
  methods: {
    ...mapActions({ getUser: "auth/getUser" }),
  },
};
</script>

<style>
</style>
