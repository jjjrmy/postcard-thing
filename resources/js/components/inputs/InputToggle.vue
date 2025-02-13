<script setup lang="ts">
import { computed } from 'vue'
import { useVModel } from '@vueuse/core'
import { tv } from 'tailwind-variants'

type OptionObject = { label: string; value: string }
type Options = string[] | OptionObject[]

const props = defineProps<{
    modelValue: string
    name: string
    label?: string
    options: Options
    required?: boolean
    error?: string
}>()

const emit = defineEmits<{
    'update:modelValue': [value: string]
}>()

const value = useVModel(props, 'modelValue', emit)

const normalizedOptions = computed<OptionObject[]>(() => {
    return Array.isArray(props.options) 
        ? props.options.map(opt => 
            typeof opt === 'string' 
                ? { label: opt, value: opt }
                : opt
        )
        : []
})

const toggle = tv({
    base: 'inline-flex p-1 bg-white border rounded-lg',
    variants: {
        state: {
            error: 'border-red-500 focus:border-red-500 focus:ring-red-500',
            default: 'border-gray-200 focus:border-indigo-500 focus:ring-indigo-500'
        }
    },
    defaultVariants: {
        state: 'default'
    }
})

const optionStyle = tv({
    base: 'px-4 py-1 text-sm font-medium transition-colors rounded-md cursor-pointer',
    variants: {
        selected: {
            true: 'bg-gray-600 text-white',
            false: 'text-gray-700'
        }
    },
    defaultVariants: {
        selected: false
    }
})

const toggleClasses = computed(() => {
    return toggle({ state: props.error ? 'error' : 'default' })
})
</script>

<template>
    <div>
        <label v-if="label" :for="name" class="block mb-1 text-sm font-medium text-gray-700">
            {{ label }}
        </label>

        <div class="relative">
            <div :class="toggleClasses">
                <template v-for="option in normalizedOptions" :key="option.value">
                    <label :for="option.value" class="relative flex-1">
                        <input
                            type="radio"
                            :name="name"
                            :id="option.value"
                            :value="option.value"
                            v-model="value"
                            class="sr-only peer"
                        >
                        <div :class="optionStyle({ selected: value === option.value })">
                            {{ option.label }}
                        </div>
                    </label>
                </template>
            </div>

            <div v-if="error" class="mt-1 text-sm text-red-600">
                {{ error }}
            </div>
        </div>
    </div>
</template> 