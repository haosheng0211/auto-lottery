<template>
  <v-card>
    <v-data-table :items="items" :loading="loading" :headers="headers" />
  </v-card>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Track',
  data() {
    return {
      timer: null,
      items: [],
      headers: [
        { text: '期數', value: 'cycle_no', cellClass: 'highlight' },
        { text: '遊戲', value: 'game.name' },
        { text: '跟注帳號', value: 'staff.username' },
        { text: '會員帳號', value: 'member.username' },
        { text: '目標', value: 'trick.name' },
        { text: '金額', value: 'amount' },
        { text: '狀態', value: 'status_description' },
        { text: '下注時間', value: 'created_at' },
        { text: '更新時間', value: 'updated_at' },
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
        .get('/api/track?limit=30')
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
  },
}
</script>
