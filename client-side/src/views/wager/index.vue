<template>
  <v-card>
    <v-data-table :items="items" :loading="loading" :headers="headers" />
  </v-card>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Wager',
  data() {
    return {
      timer: null,
      items: [],
      headers: [
        { text: '期數', value: 'cycle_no' },
        { text: '遊戲', value: 'game.name' },
        { text: '代理', value: 'member.agent.username' },
        { text: '會員', value: 'member.username' },
        { text: '玩法', value: 'trick.name' },
        { text: '金額', value: 'amount' },
        { text: '下注時間', value: 'created_at' },
        { text: '監聽時間', value: 'monitor_at' },
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
        .get('/api/wager?limit=30')
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
