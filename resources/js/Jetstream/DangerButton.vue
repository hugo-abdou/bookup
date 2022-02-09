<template>
	<Button :type="type" class="!from-red-400 !to-red-700 focus:!ring-red-400 !shadow-red-900/50">
		<slot></slot>
	</Button>
</template>

<script>
import { defineComponent } from "vue";
import Button from "./Button.vue";

export default defineComponent({
	components: { Button },
	props: {
		type: {
			type: String,
			default: "button",
		},
	},
});
</script>
