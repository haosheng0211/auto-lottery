<template>
  <v-dialog v-model="dialog" max-width="300px" @click:outside="close">
    <v-card>
      <v-card-title>修改跟注策略</v-card-title>
      <v-card-text>
        <v-text-field
          v-model="params.min_limit"
          :error-messages="errors.min_limit"
          type="number"
          label="最小限額"
        />
        <v-text-field
          v-model="params.max_limit"
          :error-messages="errors.max_limit"
          type="number"
          label="最大限額"
        />
        <v-text-field
          v-model="params.tariff"
          :error-messages="errors.tariff"
          type="number"
          label="跟注比例"
          step="0.01"
        />
        <v-btn color="primary" class="mt-4" block @click="onSubmit">修改</v-btn>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Update',
  data() {
    return {
      id: null,
      dialog: false,
      params: {
        tariff: null,
        max_limit: null,
        min_limit: null,
      },
      errors: {
        tariff: [],
        max_limit: [],
        min_limit: [],
      },
    }
  },
  methods: {
    open(item) {
      this.id = item.id
      this.dialog = true
      this.params = {
        tariff: item.tariff,
        max_limit: item.max_limit,
        min_limit: item.min_limit,
      }
    },
    close() {
      this.dialog = false
      this.params = this.$options.data().params
      this.errors = this.$options.data().errors
    },
    onSubmit() {
      axios
        .post(`/api/strategy/${this.id}`, this.params)
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
