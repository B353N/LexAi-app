<script setup lang="ts">
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
import { useForm, Link, router } from '@inertiajs/vue3';
import { ref, onMounted, nextTick } from 'vue';
import { PaperAirplaneIcon, UserCircleIcon, CpuChipIcon } from '@heroicons/vue/24/solid';

const props = defineProps({
    chats: Array,
    activeChat: Object,
});

const messageForm = useForm({
    message: '',
});

const messageInput = ref<HTMLInputElement | null>(null);
const messagesContainer = ref<HTMLDivElement | null>(null);

const scrollToBottom = () => {
    nextTick(() => {
        if (messagesContainer.value) {
            messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
        }
    });
};

onMounted(() => {
    scrollToBottom();
});

const sendMessage = () => {
    if (!props.activeChat || messageForm.processing || !messageForm.message.trim()) return;

    messageForm.post(route('chat.messages.store', props.activeChat.id), {
        preserveScroll: true,
        onSuccess: () => {
            messageForm.reset('message');
            messageInput.value?.focus();
            scrollToBottom();
        },
        onFinish: () => {
            scrollToBottom();
        }
    });
};

const startNewChat = () => {
    router.post(route('chat.store'));
};
</script>

<template>
    <AppSidebarLayout title="AI Chat">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                AI Chat Assistant
            </h2>
        </template>

        <div class="flex h-[calc(100vh-150px)] bg-white dark:bg-gray-800 shadow-xl rounded-lg">
            <!-- Sidebar -->
            <div class="w-1/3 bg-gray-50 dark:bg-gray-900/50 p-4 overflow-y-auto border-r border-gray-200 dark:border-gray-700 rounded-l-lg">
                <button @click="startNewChat" class="w-full mb-4 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                    New Chat
                </button>
                <ul class="space-y-2">
                    <li v-for="chat in chats" :key="chat.id">
                        <Link :href="route('chat.show', chat.id)"
                           class="block p-3 rounded-lg text-sm truncate transition-colors duration-200"
                           :class="{
                                'bg-indigo-500/10 text-indigo-700 dark:text-indigo-300 font-semibold': activeChat && chat.id === activeChat.id,
                                'hover:bg-gray-200 dark:hover:bg-gray-700/50 text-gray-600 dark:text-gray-400': !activeChat || chat.id !== activeChat.id
                           }">
                            {{ chat.title || 'New Chat' }}
                        </Link>
                    </li>
                </ul>
            </div>

            <!-- Chat Window -->
            <div class="flex-1 flex flex-col rounded-r-lg">
                <!-- Messages -->
                <div ref="messagesContainer" class="flex-1 p-6 overflow-y-auto space-y-6">
                     <div v-if="activeChat && activeChat.messages && activeChat.messages.length > 0">
                        <div v-for="message in activeChat.messages" :key="message.id" class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center"
                                 :class="message.role === 'user' ? 'bg-indigo-500 text-white' : 'bg-gray-600 text-white'">
                                <UserCircleIcon v-if="message.role === 'user'" class="h-6 w-6" />
                                <CpuChipIcon v-else class="h-6 w-6" />
                            </div>
                            <div class="flex flex-col">
                                <span class="font-bold text-sm text-gray-800 dark:text-gray-200">
                                    {{ message.role === 'user' ? 'You' : 'LexAI' }}
                                </span>
                                <div class="mt-1 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700/50 px-4 py-2 rounded-lg">
                                    <p class="whitespace-pre-wrap">{{ message.content }}</p>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div v-else class="flex items-center justify-center h-full">
                        <div class="text-center text-gray-400 dark:text-gray-500">
                            <CpuChipIcon class="mx-auto h-12 w-12" />
                            <h3 class="mt-2 text-sm font-medium">{{ activeChat ? 'No messages yet.' : 'Select a chat to start' }}</h3>
                            <p class="mt-1 text-sm">{{ activeChat ? 'Begin your conversation with LexAI.' : 'Or create a new chat.' }}</p>
                        </div>
                     </div>
                </div>

                <!-- Input -->
                <div class="p-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 rounded-br-lg">
                    <form @submit.prevent="sendMessage" class="flex items-center gap-4">
                        <input type="text"
                               ref="messageInput"
                               v-model="messageForm.message"
                               placeholder="Ask LexAI anything..."
                               class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white disabled:opacity-50"
                               :disabled="!activeChat || messageForm.processing">
                        <button type="submit"
                                class="p-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 disabled:bg-indigo-400 disabled:cursor-not-allowed transition-colors"
                                :disabled="!activeChat || messageForm.processing || !messageForm.message.trim()">
                            <PaperAirplaneIcon class="h-5 w-5" />
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </AppSidebarLayout>
<<<<<<< HEAD
</template> 
=======
</template>
>>>>>>> f9e35fbd3f2fdddd8b35aeb575db4426aebae235
