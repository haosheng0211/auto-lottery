<template>
  <v-dialog v-model="dialog" max-width="300px" @click:outside="close">
    <v-card>
      <v-card-title>修改跟注帳號密碼</v-card-title>
      <v-card-text>
        <v-text-field
          v-model="params.password"
          label="密碼"
          :error-messages="errors.password"
        />
        <v-btn color="primary" class="mt-4" block @click="onSubmit">修改</v-btn>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import axios from 'axios'

export default {
  name: 'ChangePassword',
  data() {
    return {
      id: null,
      dialog: false,
      params: {
        password: null,
      },
      errors: {
        password: [],
      },
    }
  },
  methods: {
    open(item) {
      this.id = item.id
      this.dialog = true
      this.params = {
        password: '',
      }
    },
    close() {
      this.dialog = false
      this.params = this.$options.data().params
      this.errors = this.$options.data().errors
    },
    onSubmit() {
      axios
        .post(`/api/staff/${this.id}/change_password`, this.params)
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
