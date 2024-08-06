<template>
    <div class="flex flex-col">
        <template v-if="isUp">
            <span v-if="!isDisabled" class="cursor-pointer mb-1">
                <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 0L13.9282 12H0.0717969L7 0Z" fill="#7843E9"/>
                </svg>
            </span>
            <span v-else class="mb-1">
                <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 0L13.9282 12H0.0717969L7 0Z" fill="#C4ABFB"/>
                </svg>
            </span>
        </template>

        <template v-else>
            <span v-if="!isDisabled" class="cursor-pointer">
                <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 12L13.9282 0H0.0717969L7 12Z" fill="#7843E9"/>
                </svg>
            </span>
            <span v-else>
                <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 12L13.9282 0H0.0717969L7 12Z" fill="#C4ABFB"/>
                </svg>
            </span>
        </template>
    </div>
</template>

<script>
    import { computed } from 'vue';

    export default {
        props: ['isUp', 'isDisabled'],
        
        setup(props) {
            const isUp = computed(() => props.isUp);
            const isDisabled = computed(() => props.isDisabled);

            return {
                isUp, 
                isDisabled,
            }
        }
    }
</script>

<style scoped>
</style>

