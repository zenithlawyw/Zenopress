import Vue from "vue";
import Router from "vue-router";

const Welcome = () => import("../../views/Welcome");

Vue.use(Router);

let router = new Router({
	routes: configRoutes()
});

export default router;

function configRoutes () {
	return [
		{
			path: "/welcome",
			name: "Welcome",
			component: Welcome
		}
	];
}
