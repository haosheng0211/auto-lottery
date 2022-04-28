<template>
  <div>
    <v-tooltip bottom>
      <template #activator="{ on, attrs }">
        <v-btn v-bind="attrs" icon v-on="on" @click="toggleNotification">
          <v-icon>
            {{ notification ? 'mdi-volume-high' : 'mdi-volume-off' }}
          </v-icon>
        </v-btn>
      </template>
      {{ notification ? '關閉通知' : '開啟通知' }}
    </v-tooltip>
  </div>
</template>

<script>
export default {
  name: 'Notification',
  computed: {
    notification: {
      get() {
        return this.$store.state.notification
      },
      set(value) {
        this.$store.commit('setNotification', value)
      },
    },
  },
  mounted() {
    this.subscribeNotification()
  },
  destroyed() {
    this.unsubscribeNotification()
  },
  methods: {
    toggleNotification() {
      this.notification = !this.notification
    },
    subscribeNotification() {
      const agentChannel = this.$pusher.subscribe('agent')

      agentChannel.bind('agent.stopped', (data) => {
        this.playerAudio()

        if (data.status_description) {
          this.$message.error(
            `代理帳號 [${data.username}] ${data.status_description}`
          )
        }
      })

      const staffChannel = this.$pusher.subscribe('staff')

      staffChannel.bind('staff.stopped', (data) => {
        this.playerAudio()

        if (data.status_description) {
          this.$message.error(
            `跟注帳號 [${data.username}] ${data.status_description}`
          )
        }
      })

      const wagerChannel = this.$pusher.subscribe('wager')

      wagerChannel.bind('wager.created', () => {
        this.playerAudio()
        this.$message.success('有新下注紀錄')
      })
    },
    unsubscribeNotification() {
      this.$pusher.unsubscribe('agent')
      this.$pusher.unsubscribe('staff')
      this.$pusher.unsubscribe('wager')
    },
    playerAudio() {
      if (this.notification) {
        const audio = new Audio(require('@/assets/audio/notification.wav'))

        audio.play()
      }
    },
  },
}
</script>
