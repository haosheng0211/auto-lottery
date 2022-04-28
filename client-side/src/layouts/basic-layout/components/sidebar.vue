<template>
  <v-navigation-drawer :value="drawer" app :clipped="clipped" @input="onInput">
    <v-list dense nav>
      <template v-for="item in items">
        <v-list-item :key="item.name" color="primary" link :to="item.path">
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{ $t(item.name) }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </template>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
import menuConfig from '@/config/menu.config'

export default {
  name: 'Sidebar',
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
  data() {
    return {
      items: menuConfig,
    }
  },
  methods: {
    onInput(drawer) {
      this.$emit('update:drawer', drawer)
    },
  },
}
</script>
