import Vue from "vue";
import router from "./router";
import ZenopressPublic from "./ZenopressPublic.vue";
import store from "../store";

Vue.config.productionTip = true;

new Vue({
  store,
  router,
  render: h => h(ZenopressPublic)
}).$mount("#zenopress-public");
