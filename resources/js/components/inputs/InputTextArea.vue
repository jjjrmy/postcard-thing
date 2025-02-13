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
    rows: {
        type: Number,
        default: 3
    },
    maxlength: {
        type: Number,
        default: undefined
    },
    error: {
        type: String,
        default: undefined
    }
})

const emit = defineEmits(['update:modelValue'])
const value = useVModel(props, 'modelValue', emit)

const textarea = tv({
    base: 'block w-full p-4 mt-1 border rounded-md shadow-sm border-wordmark sm:text-sm resize-y',
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
    return textarea({ 
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
            <textarea
                :id="name"
                :name="name"
                v-model="value"
                :placeholder="placeholder"
                :rows="rows"
                :maxlength="maxlength"
                :class="inputClasses"
            ></textarea>
            
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