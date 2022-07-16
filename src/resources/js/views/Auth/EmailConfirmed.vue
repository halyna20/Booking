<template>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Електронну адресу підтверджено</div>

          <div class="card-body">
            <div class="alert alert-success" role="alert">
              Посилання для підвердження було надіслано на вашу електронну
              адресу. Перед тим як продовжити, будь ласка, перевірте свою пошту
            </div>

            <p>
              Не отримали лист? Натисніть на кнопку, щоб відправити повторно
            </p>
            <!--action="{{ route('verification.resend') }}-->
            <form class="d-inline" method="POST">
              <button type="submit" class="btn btn-yellow m-0 align-baseline">
                Відправити
              </button>
            </form>
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
