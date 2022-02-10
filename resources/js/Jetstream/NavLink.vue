<template>
	<Link
		:class="[
				'flex items-center space-x-2 font-semibold',
				active ? 'text-teal-500' : 'text-gray-400'
			]"
		:href="href"
	>
		<slot />
	</Link>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
	components: {
		Link,
	},
	props: ["href", "active"],
});
</script>
