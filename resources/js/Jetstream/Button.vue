<template>
	<button
		:type="type"
		class="block py-2 px-4 rounded-md shadow-md shadow-cyan-900/50 active:shadow-sm bg-gradient-to-r from-teal-500 to-cyan-600 text-white font-medium hover:from-teal-600 hover:to-cyan-700 focus:outline-none"
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
			default: "submit",
		},
	},
});
</script>
