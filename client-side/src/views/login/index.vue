<template>
  <v-app>
    <v-layout :class="$style.layout" align-center justify-center>
      <v-card width="100%" max-width="375px">
        <v-card-title>
          {{ $t('login.title') }}
          <v-spacer />
          <SwitchLocale />
        </v-card-title>
        <v-card-text>
          <LoginForm />
        </v-card-text>
      </v-card>
    </v-layout>
  </v-app>
</template>

<script>
import LoginForm from '@/views/login/components/login-form'
import SwitchLocale from '@/components/switch-locale'

export default {
  name: 'Login',
  components: { LoginForm, SwitchLocale },
  mounted() {
    this.$store.dispatch('auth/logout')
  },
}
</script>

<style lang="scss" module>
.layout {
  padding: 16px;
  background: #f0f2f5 url('../../assets/images/login.background.png') no-repeat
    50%;
  background-size: 100%;
  position: relative;
}
</style>
