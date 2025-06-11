import { ref } from 'vue';

const sidebarOpen = ref(false);

export function useSidebar() {
    return {
        sidebarOpen,
    };
} 