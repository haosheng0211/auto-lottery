<template>
  <router-view />
</template>

<script>
export default {
  watch: {
    '$store.state.i18n.locale': {
      handler(newLocale) {
        this.$i18n.locale = newLocale
      },
      immediate: true,
    },
  },
}
</script>
