import Vue from 'vue'
import VueI18n from 'vue-i18n'

import en from '^public/js/lang/en'
import th from '^public/js/lang/th'

Vue.use(VueI18n)
export const i18n = new VueI18n({
  locale: window.default_locale, // set locale
  fallbackLocale: window.fallback_locale,
  messages: {
    en,
    th
  } // set locale messages
})