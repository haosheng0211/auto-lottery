<template>
  <v-dialog v-model="dialog" max-width="300px" @click:outside="close">
    <v-card>
      <v-card-title>新增跟注策略</v-card-title>
      <v-card-text>
        <v-select
          v-model="params.staff_id"
          label="跟注帳號"
          :error-messages="errors.staff_id"
          :items="option.staff"
          item-text="username"
          item-value="id"
        />
        <v-select
          v-model="params.member_id"
          label="會員帳號"
          :error-messages="errors.member_id"
          :items="option.member"
          item-text="username"
          item-value="id"
        />
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
        staff_id: null,
        member_id: null,
        tariff: null,
        max_limit: null,
        min_limit: null,
      },
      errors: {
        staff_id: [],
        member_id: [],
        tariff: [],
        max_limit: [],
        min_limit: [],
      },
      option: {
        staff: [],
        member: [],
      },
    }
  },
  methods: {
    open() {
      this.dialog = true
      this.getSelectOptions()
    },
    close() {
      this.dialog = false
      this.params = this.$options.data().params
      this.errors = this.$options.data().errors
    },
    onSubmit() {
      axios
        .post('/api/strategy', this.params)
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
    getSelectOptions() {
      axios
        .get('/api/staff/select_options')
        .then((res) => {
          this.option.staff = res.data
        })
        .catch((err) => {
          this.$message.error(err.response.data.message)
        })
      axios
        .get('/api/member/select_options')
        .then((res) => {
          this.option.member = res.data
        })
        .catch((err) => {
          this.$message.error(err.response.data.message)
        })
    },
  },
}
</script>
