<template>
  <v-dialog v-model="dialog" max-width="300px" @click:outside="close">
    <v-card>
      <v-card-title>新增代理帳號</v-card-title>
      <v-card-text>
        <v-text-field
          v-model="params.username"
          :error-messages="errors.username"
          label="帳號"
        />
        <v-text-field
          v-model="params.password"
          :error-messages="errors.password"
          label="密碼"
        />
        <v-btn color="primary" class="mt-4" block @click="onSubmit">新增</v-btn>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Create',
  data() {
    return {
      dialog: false,
      params: {
        username: null,
        password: null,
      },
      errors: {
        username: [],
        password: [],
      },
    }
  },
  methods: {
    open() {
      this.dialog = true
    },
    close() {
      this.dialog = false
      this.params = this.$options.data().params
      this.errors = this.$options.data().errors
    },
    onSubmit() {
      axios
        .post('/api/agent', this.params)
        .then((res) => {
          this.close()
          this.$message.success(res.data.message)
        })
        .catch((err) => {
          if (err.response.status === 422) {
            this.errors = err.response.data.errors
          } else {
            this.$message.error(err.response.data.message)
          }
        })
    },
  },
}
</script>
