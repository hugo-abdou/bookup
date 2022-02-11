<template>
	<input
		:class="['border-gray-300 focus:border-teal-300 focus:ring-0 rounded-md shadow-sm',error && '!border-red-600']"
		:value="modelValue"
		@input="$emit('update:modelValue', $event.target.value)"
		ref="input"
	/>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
	props: ["modelValue", "error"],

	emits: ["update:modelValue"],

	methods: {
		focus() {
			this.$refs.input.focus();
		},
	},
});
</script>
