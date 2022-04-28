<template>
  <v-card>
    <v-card-title>
      <v-btn color="primary" @click="$refs.create.open()">新增</v-btn>
    </v-card-title>
    <create ref="create" />
    <update ref="update" />
    <v-data-table :items="items" :loading="loading" :headers="headers">
      <template #item.active="{ item }">
        {{ item.active ? '啟用' : '禁用' }}
      </template>
      <template #item.actions="{ item }">
        <v-btn
          v-if="!item.active"
          text
          small
          color="success"
          @click="enable(item)"
        >
          啟用
        </v-btn>
        <v-btn
          v-if="item.active"
          text
          small
          color="error"
          @click="disable(item)"
        >
          禁用
        </v-btn>
        <v-btn
          v-if="!item.active"
          text
          small
          color="warning"
          @click="$refs.update.open(item)"
        >
          修改策略
        </v-btn>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
import axios from 'axios'
import Create from '@/views/strategy/components/create'
import Update from '@/views/strategy/components/update'

export default {
  name: 'Strategy',
  components: { Update, Create },
  data() {
    return {
      timer: null,
      items: [],
      headers: [
        { text: '跟注帳號', value: 'staff.username' },
        { text: '會員帳號', value: 'member.username' },
        { text: '最小限額', value: 'min_limit' },
        { text: '最大限額', value: 'max_limit' },
        { text: '跟注比例', value: 'tariff' },
        { text: '啟用狀態', value: 'active' },
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
        .get('/api/strategy')
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
    enable(item) {
      axios
        .post(`/api/strategy/${item.id}/enable`)
        .then((res) => {
          this.$message.success(res.data.message)
        })
        .catch((err) => {
          this.$message.error(err.response.data.message)
        })
    },
    disable(item) {
      axios
        .post(`/api/strategy/${item.id}/disable`)
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
