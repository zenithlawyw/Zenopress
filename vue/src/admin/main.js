import Vue from "vue";
import Zenopress from "./Zenopress.vue";
import router from "./router";
import store from "../store";

Vue.config.productionTip = true;

new Vue({
  el: '#zenopress',
	router,
	store,
	render: h => h(Zenopress),
	components: {
		Zenopress
	}
})
