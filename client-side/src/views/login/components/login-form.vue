<template>
  <v-form @submit.prevent="onSubmit">
    <v-text-field
      v-model="params.username"
      :label="$t('login.form.username')"
      :error-messages="errors.username"
    />
    <v-text-field
      v-model="params.password"
      :label="$t('login.form.password')"
      :error-messages="errors.password"
    />
    <v-btn block color="primary" type="submit" class="mt-4" :loading="loading">
      {{ $t('login.form.submit') }}
    </v-btn>
  </v-form>
</template>

<script>
export default {
  name: 'LoginForm',
  data() {
    return {
      params: {
        username: '',
        password: '',
      },
      errors: {
        username: [],
        password: [],
      },
      loading: false,
    }
  },
  methods: {
    reset() {
      this.errors = this.$options.data().errors
    },
    async onSubmit() {
      this.loading = true
      this.$store
        .dispatch('auth/login', this.params)
        .then(() => {
          this.$router.push('/')
        })
        .catch((err) => {
          if (err.response.status === 422) {
            this.errors = err.response.data.errors
          } else {
            this.$message.error(
              err.response.data.message ?? this.$t('login.form.failed')
            )
          }
        })
        .finally(() => {
          this.loading = false
        })
    },
  },
}
</script>
