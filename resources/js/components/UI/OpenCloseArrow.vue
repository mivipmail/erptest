<template>
    <span v-if="isOpened" class="cursor-pointer ml-1">
        <svg class="inline" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13 5.5L8 10.5L3 5.5" stroke="#828282" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
    <span v-else class="cursor-pointer ml-1">
        <svg class="inline" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.5 3L10.5 8L5.5 13" stroke="#828282" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
</template>

<script>
    import { computed } from 'vue';

    export default {
        props: ['isOpened'],
        
        setup(props) {
            const isOpened = computed(() => props.isOpened);

            return {
                isOpened,
            }
        }
    }
</script>

<style scoped>
</style>

