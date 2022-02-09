<template>
	<div>
		<button :class="classes" class="w-full text-left" v-if="$props.as == 'button'">
			<slot></slot>
		</button>

		<Link :href="href" :class="classes" v-else>
			<slot />
		</Link>
	</div>
</template>

<script>
import { defineComponent } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
	components: {
		Link,
	},
	props: ["active", "href", "as"],

	computed: {
		classes() {
			return this.active
				? "block pl-3 pr-4 py-2 border-l-4 text-base font-medium focus:outline-none transition border-teal-400 text-teal-500 focus:text-teal-800 focus:bg-teal-100 focus:border-teal-700"
				: "block pl-3 pr-4 py-2 border-l-4 text-base font-medium focus:outline-none transition border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300";
		},
	},
});
</script>
