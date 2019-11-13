<template>
	<div class="blog">
		<MainHeader />

		<div class="container">
			<BlogInside />
		</div>

	</div>

</template>

<script>
	import MainHeader from "./../components/MainHeader";
	import BlogInside from "./../components/blog/BlogInside";

	export default {
		components: {
			MainHeader,
			BlogInside
		}
	};
</script>

<style lang="scss">
	@import "./../styles/mixins.scss";
</style>