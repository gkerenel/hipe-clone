<script setup lang="ts">
    const props = defineProps({
        errors: {
            type: Array,
            required: false,
            default: () => null,
            validator: (value: any) => value === null || Array.isArray(value)
        }
    })

    function checkErrors() : number {
        return props.errors ? props.errors.length : 0
    }
</script>

<template>
    <div v-show="errors" class="bg-red-200 text-red-700 rounded-md p-4 m-2">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium">There were {{ checkErrors() ? checkErrors() : '' }} errors with your submission</h3>
                <div v-if="checkErrors()" class="mt-2 text-sm">
                    <ul v-for="error in errors" class="list-disc pl-5 space-y-1">
                        <li>{{ error }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
