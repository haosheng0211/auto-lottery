<template>
  <v-menu offset-y :close-on-content-click="false">
    <template #activator="{ on, attrs }">
      <v-btn v-bind="attrs" icon v-on="on">
        <v-icon>
          {{ notification ? 'mdi-volume-high' : 'mdi-volume-off' }}
        </v-icon>
      </v-btn>
    </template>
    <v-card min-width="250px">
      <v-card-text>
        <v-slider
          v-model="audioVolume"
          max="1"
          step="0.1"
          min="0"
          hide-details
        />
      </v-card-text>
    </v-card>
  </v-menu>
</template>

<script>
export default {
  name: 'Notification',
  data() {
    return {
      audio: null,
    }
  },
  computed: {
    notification() {
      return this.audioVolume > 0
    },
    audioVolume: {
      get() {
        return this.$store.state.audioVolume
      },
      set(value) {
        console.log(value)
        this.$store.commit('setAudioVolume', value)
      },
    },
  },
  watch: {
    '$store.state.audioVolume': {
      handler(value) {
        this.$nextTick(() => {
          if (this.audio) {
            this.audio.volume = value
          }
        })
      },
      immediate: true,
    },
  },
  mounted() {
    this.subscribeNotification()
    this.createAudio()
  },
  destroyed() {
    this.unsubscribeNotification()
  },
  methods: {
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
    createAudio() {
      this.audio = new Audio(require('@/assets/audio/notification.wav'))
    },
    playerAudio() {
      if (this.notification) {
        this.audio.play()
      }
    },
  },
}
</script>
