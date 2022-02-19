<template>
    <div
        class="flex flex-col items-center min-h-screen pt-6 sm:justify-center sm:pt-0 bg-lv-3"
    >
        <div>
            <slot name="logo" />
        </div>

        <div
            class="w-full px-6 py-4 mt-6 overflow-hidden shadow-md sm:max-w-md bg-lv-2 sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
