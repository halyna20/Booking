<template>
  <img
    v-if="user.image !== null"
    :src="user.image"
    class="rounded-bottom"
    alt="Фото користувача"
  />
  <div :class="this.$parent.editUser == false ? '' : 'd-none'">
    <div class="mb-3 row">
      <div class="col-sm-2 col-form-label">Ім'я</div>
      <div class="col-sm-10">
        <p v-if="user.first_name !== null">{{ user.first_name }}</p>
        <p v-else>Вкажіть своє ім'я</p>
      </div>
    </div>
    <div class="mb-3 row">
      <div class="col-sm-2 col-form-label">Прізвище</div>
      <div class="col-sm-10">
        <p v-if="user.last_name !== null">{{ user.last_name }}</p>
        <p v-else>Вкажіть своє прізвище</p>
      </div>
    </div>
    <div class="mb-3 row">
      <div class="col-sm-2 col-form-label">Email</div>
      <div class="col-sm-10">
        <p v-if="user.email !== null">{{ user.email }}</p>
        <p v-else>Вкажіть своє прізвище</p>
      </div>
    </div>
    <div class="mb-3 row">
      <div class="col-sm-2 col-form-label">Номер телефону</div>
      <div class="col-sm-10">
        <p v-if="user.phone !== null">{{ user.phone }}</p>
        <p v-else>Вкажіть свій номер телефону</p>
      </div>
    </div>
    <div class="mb-3 row">
      <div class="col-sm-2 col-form-label">Країна</div>
      <div class="col-sm-10">
        <p v-if="user.country !== null">{{ user.country.name }}</p>
        <p v-else>Вкажіть свою країну</p>
      </div>
    </div>
    <button @click.prevent="this.$parent.isEdit" class="btn btn-yellow">
      Змінити
    </button>
  </div>
</template>

<script>
export default {
  name: "ShowUser",
  props: ["user"],
};
</script>

<style>
</style>
