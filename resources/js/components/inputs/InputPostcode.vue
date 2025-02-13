<script setup lang="ts">
import { computed } from 'vue'
import { useVModel } from '@vueuse/core'
import { tv } from 'tailwind-variants'

const props = defineProps({
    modelValue: {
        type: String,
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
    error: {
        type: String,
        default: undefined
    }
})

const emit = defineEmits(['update:modelValue'])
const value = useVModel(props, 'modelValue', emit)

const input = tv({
    base: 'block w-full mt-1 rounded-md shadow-sm sm:text-sm uppercase',
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
    return input({ state: props.error ? 'error' : 'default' })
})

const formatPostcode = (input: string) => {
    // Remove all non-alphanumeric characters
    const cleaned = input.replace(/[^a-zA-Z0-9]/g, '').toUpperCase()
    
    // Format as XXX XXX if length is 6
    if (cleaned.length === 6) {
        return `${cleaned.slice(0, 3)} ${cleaned.slice(3)}`
    }
    
    return cleaned
}

const handleInput = (e: Event) => {
    const input = (e.target as HTMLInputElement).value
    const formatted = formatPostcode(input)
    value.value = formatted
}
</script>

<template>
    <div>
        <label v-if="label" :for="name" class="block mb-1 text-sm font-medium text-gray-700">
            {{ label }}
        </label>
        
        <div class="relative">
            <input
                :id="name"
                type="text"
                :name="name"
                v-model="value"
                :placeholder="placeholder"
                :class="inputClasses"
                @input="handleInput"
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
