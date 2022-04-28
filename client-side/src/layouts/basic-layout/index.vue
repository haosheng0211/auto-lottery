<template>
  <v-app :class="$style.layout">
    <BasicLayoutNavbar :drawer.sync="drawer" :clipped="clipped" />
    <BasicLayoutSidebar :drawer.sync="drawer" :clipped="clipped" />
    <BasicLayoutContent />
  </v-app>
</template>

<script>
import Content from '@/layouts/basic-layout/components/content'
import Navbar from '@/layouts/basic-layout/components/navbar'
import Sidebar from '@/layouts/basic-layout/components/sidebar'

export default {
  name: 'BasicLayout',
  components: {
    BasicLayoutContent: Content,
    BasicLayoutNavbar: Navbar,
    BasicLayoutSidebar: Sidebar,
  },
  data() {
    return {
      drawer: null,
    }
  },
  computed: {
    clipped() {
      return this.$vuetify.breakpoint.lgAndUp
    },
  },
}
</script>

<style lang="scss" module>
.layout {
  background: #f2f5f8 !important;
}
</style>
