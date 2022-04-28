<template>
  <v-card>
    <v-card-title>
      <v-btn color="primary" @click="$refs.create.open()">新增</v-btn>
    </v-card-title>
    <create ref="create" />
    <change-password ref="changePassword" />
    <v-data-table :items="items" :loading="loading" :headers="headers">
      <template #item.actions="{ item }">
        <v-btn
          v-if="item.status === 0"
          small
          color="success"
          text
          @click="login(item)"
        >
          登入
        </v-btn>
        <v-btn
          v-if="item.status !== 0"
          small
          color="error"
          text
          @click="disable(item)"
        >
          停止
        </v-btn>
        <v-btn
          v-if="item.status === 0"
          small
          color="warning"
          text
          @click="$refs.changePassword.open(item)"
        >
          修改密碼
        </v-btn>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
import axios from 'axios'
import Create from '@/views/staff/components/create'
import ChangePassword from '@/views/staff/components/change-password'

export default {
  name: 'Staff',
  components: { ChangePassword, Create },
  data() {
    return {
      timer: null,
      items: [],
      headers: [
        { text: '跟注帳號', value: 'username' },
        { text: '運行狀態', value: 'status_description' },
        { text: '新增時間', value: 'created_at' },
        { text: '更新時間', value: 'updated_at' },
        { value: 'actions', sortable: false, align: 'right' },
      ],
      loading: true,
    }
  },
  mounted() {
    this.timer = setInterval(() => {
      this.getItems()
    }, 1000)
  },
  destroyed() {
    if (this.timer) {
      clearInterval(this.timer)
    }
  },
  methods: {
    getItems() {
      this.loading = true
      axios
        .get('/api/staff')
        .then((res) => {
          this.items = res.data
        })
        .catch((err) => {
          this.$message.error(err.response.data.message)
        })
        .finally(() => {
          this.loading = false
        })
    },
    login(item) {
      axios
        .post(`/api/staff/${item.id}/login`)
        .then((res) => {
          this.$message.success(res.data.message)
        })
        .catch((err) => {
          this.$message.error(err.response.data.message)
        })
    },
    disable(item) {
      axios
        .post(`/api/staff/${item.id}/disable`)
        .then((res) => {
          this.$message.success(res.data.message)
        })
        .catch((err) => {
          this.$message.error(err.response.data.message)
        })
    },
  },
}
</script>
