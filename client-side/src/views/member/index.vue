<template>
  <v-card>
    <v-data-table :items="items" :loading="loading" :headers="headers" />
  </v-card>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Member',
  data() {
    return {
      timer: null,
      items: [],
      headers: [
        { text: '代理帳號', value: 'agent.username' },
        { text: '會員名稱', value: 'nickname' },
        { text: '會員帳號', value: 'username' },
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
        .get('/api/member')
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
