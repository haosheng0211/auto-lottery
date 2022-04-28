<template>
  <v-menu offset-y absolute min-width="110px">
    <template #activator="{ attrs, on }">
      <v-btn icon v-bind="attrs" v-on="on">
        <v-icon> mdi-earth </v-icon>
      </v-btn>
    </template>
    <v-list dense>
      <template v-for="item in items">
        <v-list-item :key="item.locale" link @click="onClick(item.locale)">
          {{ item.name }}
        </v-list-item>
      </template>
    </v-list>
  </v-menu>
</template>

<script>
import i18nConfig from '@/config/i18n.config'

export default {
  name: 'SwitchLocale',
  data() {
    return {
      items: i18nConfig,
    }
  },
  methods: {
    onClick(locale) {
      this.$store.commit('i18n/setLocale', locale)
    },
  },
}
</script>
