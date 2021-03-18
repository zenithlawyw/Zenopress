<template>
  <div id="zenopress-public">
    <img alt="Vue logo" src="@/assets/logo.png" />
	<router-view></router-view>
    <HelloWorld msg="Welcome to Your ZenoPress App (Public)" />
  </div>
</template>

<script>
import HelloWorld from "../components/HelloWorld.vue";

export default {
  name: "ZenopressPublic",
  components: {
    HelloWorld
  }
};
</script>

<style lang="scss">
#zenopress-public {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
