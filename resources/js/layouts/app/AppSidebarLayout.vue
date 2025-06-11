<script setup lang="ts">
import AppContent from '@/components/AppContent.vue';
import AppShell from '@/components/AppShell.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import type { BreadcrumbItemType } from '@/types';
import {
    HomeIcon,
    DocumentTextIcon,
    ChatBubbleLeftRightIcon,
    Bars3BottomLeftIcon,
    XMarkIcon,
} from '@heroicons/vue/24/outline';
import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue';
import { useSidebar } from '@/composables/useSidebar';
import { Link as InertiaLink } from '@inertiajs/vue3';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import AppearanceSwitch from '@/components/AppearanceSwitch.vue';
import Notifications from '@/components/Notifications.vue';
import ProfileDropdown from '@/components/ProfileDropdown.vue';

interface Props {
    breadcrumbs?: BreadcrumbItemType[];
}

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});

const navigation = [
    { name: 'Dashboard', href: route('dashboard'), active: route().current('dashboard'), icon: HomeIcon },
    { name: 'AI Chat', href: route('chat.index'), active: route().current('chat.*'), icon: ChatBubbleLeftRightIcon },
    { name: 'Documents', href: route('documents.index'), active: route().current('documents.*'), icon: DocumentTextIcon },
];

const { sidebarOpen } = useSidebar();
</script>

<template>
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog as="div" class="relative z-40 lg:hidden" @close="sidebarOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
                </TransitionChild>

                <div class="fixed inset-0 z-40 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                        <DialogPanel class="relative flex w-full max-w-xs flex-1 flex-col bg-gray-900 pt-5 pb-4">
                            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                                <div class="absolute top-0 right-0 -mr-12 pt-2">
                                    <button type="button" class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
                                        <span class="sr-only">Close sidebar</span>
                                        <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                                    </button>
                                </div>
                            </TransitionChild>
                            <div class="flex flex-shrink-0 items-center px-4">
                                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                            </div>
                            <div class="mt-5 h-0 flex-1 overflow-y-auto">
                                <nav class="space-y-1 px-2">
                                    <InertiaLink v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.active ? 'bg-gray-800 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white', 'group flex items-center rounded-md px-2 py-2 text-base font-medium']">
                                        <component :is="item.icon" :class="['mr-4 h-6 w-6 flex-shrink-0']" aria-hidden="true" />
                                        {{ item.name }}
                                    </InertiaLink>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                    <div class="w-14 flex-shrink-0" aria-hidden="true">
                        <!-- Dummy element to force sidebar to shrink to fit close icon -->
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:flex lg:w-64 lg:flex-col">
            <div class="flex min-h-0 flex-1 flex-col bg-gray-900">
                <div class="flex h-16 flex-shrink-0 items-center bg-gray-900 px-4">
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                </div>
                <div class="flex flex-1 flex-col overflow-y-auto">
                    <nav class="flex-1 space-y-1 px-2 py-4">
                        <InertiaLink v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.active ? 'bg-gray-800 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white', 'group flex items-center rounded-md px-2 py-2 text-sm font-medium']">
                            <component :is="item.icon" :class="['mr-3 h-6 w-6 flex-shrink-0']" aria-hidden="true" />
                            {{ item.name }}
                        </InertiaLink>
                    </nav>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:pl-64">
             <div class="sticky top-0 z-10 flex h-16 flex-shrink-0 justify-between border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center">
                    <button type="button" class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 dark:border-gray-700 lg:hidden" @click="sidebarOpen = true">
                        <span class="sr-only">Open sidebar</span>
                        <Bars3BottomLeftIcon class="h-6 w-6" aria-hidden="true" />
                    </button>
                    <Breadcrumbs :breadcrumbs="breadcrumbs" />
                </div>
                <div class="flex items-center">
                    <AppearanceSwitch />
                    <Notifications />
                    <ProfileDropdown />
                </div>
            </div>

            <main class="flex-1">
                <div class="py-6">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-200">
                            <slot name="header" />
                        </h1>
                    </div>
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8">
                        <div class="py-4">
                            <slot />
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
