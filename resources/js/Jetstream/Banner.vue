<template>
	<div class="fixed top-20 right-5 z-[999] space-y-2">
		<banner-message
			v-for="(banner,index) in banners"
			@close="close(index)"
			:banner="banner"
			:key="index"
		/>
	</div>
</template>

<script>
import { usePage } from "@inertiajs/inertia-vue3";
import { defineComponent, ref, watch } from "vue";
import BannerMessage from "./BannerMessage.vue";

export default defineComponent({
	components: { BannerMessage },
	setup() {
		const props = usePage().props;
		const banners = ref([]);

		watch(props, () => {
			if (props.value.jetstream.flash.banner) {
				banners.value.push({
					...props.value.jetstream.flash,
					// id: new Date().getTime().toString(36),
				});
			}
		});

		function close(index) {
			banners.value = banners.value.filter((b, i) => i !== index);
		}

		return {
			close,
			banners,
		};
	},
});
</script>
