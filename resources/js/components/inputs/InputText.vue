<script setup lang="ts">
import { computed } from 'vue'
import { useVModel } from '@vueuse/core'
import { tv } from 'tailwind-variants'

const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: ''
    },
    name: {
        type: String,
        required: true
    },
    label: {
        type: String,
        default: ''
    },
    placeholder: {
        type: String,
        default: ''
    },
    required: {
        type: Boolean,
        default: false
    },
    type: {
        type: String,
        default: 'text'
    },
    autocomplete: {
        type: String,
        default: 'off'
    },
    error: {
        type: String,
        default: undefined
    }
})

const emit = defineEmits(['update:modelValue'])
const value = useVModel(props, 'modelValue', emit)

const input = tv({
    base: 'block w-full p-4 mt-1 border rounded-md shadow-sm border-wordmark sm:text-sm',
    variants: {
        state: {
            error: 'border-red-500 focus:border-red-500 focus:ring-red-500',
            default: 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500'
        }
    },
    defaultVariants: {
        state: 'default'
    }
})

const inputClasses = computed(() => {
    return input({ 
        state: props.error ? 'error' : 'default'
    })
})
</script>

<template>
    <div>
        <label v-if="label" :for="name" class="block mb-1 text-sm font-medium text-gray-700">
            {{ label }}
        </label>
        
        <div class="relative">
            <input
                :id="name"
                :type="type"
                :name="name"
                v-model="value"
                :placeholder="placeholder"
                :autocomplete="autocomplete"
                :class="inputClasses"
            >
            
            <span 
                v-if="!required" 
                class="absolute text-sm text-gray-300 -translate-y-1/2 pointer-events-none select-none right-3 top-1/2"
            >
                OPTIONAL
            </span>
            
            <div v-if="error" class="mt-1 text-sm text-red-600">
                {{ error }}
            </div>
        </div>
    </div>
</template>
