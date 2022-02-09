<template>
	<button
		:type="type"
		class="block py-2 px-4 rounded-md shadow-md active:shadow-sm bg-white font-medium border border-gray-300 focus:border-cyan-500 focus:outline-none"
	>
		<slot></slot>
	</button>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
	props: {
		type: {
			type: String,
			default: "button",
		},
	},
});
</script>
