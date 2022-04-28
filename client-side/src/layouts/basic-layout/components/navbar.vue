<template>
  <v-app-bar app :clipped-left="clipped" color="primary" dark>
    <v-app-bar-nav-icon @click="toggleDrawer" />
    <v-toolbar-title> {{ $t('layout.navbar.title') }} </v-toolbar-title>
    <v-spacer />
    <switch-locale />
    <notification />
  </v-app-bar>
</template>

<script>
import SwitchLocale from '@/components/switch-locale'
import Notification from '@/components/notification'

export default {
  name: 'Navbar',
  components: { Notification, SwitchLocale },
  props: {
    drawer: {
      type: null,
      default: null,
    },
    clipped: {
      type: null,
      default: null,
    },
  },
  methods: {
    toggleDrawer() {
      this.$emit('update:drawer', !this.drawer)
    },
  },
}
</script>
