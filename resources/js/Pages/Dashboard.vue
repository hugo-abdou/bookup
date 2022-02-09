<template>
	<app-layout title="Dashboard">
		<div class="flex-grow w-full lg:flex"></div>
	</app-layout>
</template>

<script>
import { ref } from "vue";
import {
	Disclosure,
	DisclosureButton,
	DisclosurePanel,
	Menu,
	MenuButton,
	MenuItem,
	MenuItems,
} from "@headlessui/vue";
import {
	BadgeCheckIcon,
	ChevronDownIcon,
	ChevronRightIcon,
	CollectionIcon,
	SearchIcon,
	SortAscendingIcon,
	StarIcon,
} from "@heroicons/vue/solid";
import { MenuAlt1Icon, XIcon } from "@heroicons/vue/outline";
import AppLayout from "@/Layouts/AppLayout.vue";

const navigation = [
	{ name: "Dashboard", href: "#", current: true },
	{ name: "Domains", href: "#", current: false },
];
const userNavigation = [
	{ name: "Your Profile", href: "#" },
	{ name: "Settings", href: "#" },
	{ name: "Sign out", href: "#" },
];
const projects = [
	{
		name: "Workcation",
		href: "#",
		siteHref: "#",
		repoHref: "#",
		repo: "debbielewis/workcation",
		tech: "Laravel",
		lastDeploy: "3h ago",
		location: "United states",
		starred: true,
		active: true,
	},
	// More projects...
];
const activityItems = [
	{
		project: "Workcation",
		commit: "2d89f0c8",
		environment: "production",
		time: "1h",
	},
	// More items...
];

export default {
	components: {
		AppLayout,
		Disclosure,
		DisclosureButton,
		DisclosurePanel,
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		BadgeCheckIcon,
		ChevronDownIcon,
		ChevronRightIcon,
		CollectionIcon,
		MenuAlt1Icon,
		SearchIcon,
		SortAscendingIcon,
		StarIcon,
		XIcon,
	},
	setup() {
		const open = ref(false);

		return {
			navigation,
			userNavigation,
			projects,
			activityItems,
			open,
		};
	},
};
</script>