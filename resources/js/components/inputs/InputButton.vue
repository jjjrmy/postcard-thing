<script setup lang="ts">
import { computed } from 'vue'
import { tv } from 'tailwind-variants'

interface Props {
    type?: 'button' | 'submit' | 'reset'
    variant?: 'primary' | 'secondary'
    size?: 'sm' | 'md' | 'lg'
    disabled?: boolean
}

const props = withDefaults(defineProps<Props>(), {
    type: 'button',
    variant: 'primary',
    size: 'md',
    disabled: false,
})

const button = tv({
    base: [
        'font-medium',
        'rounded-md',
        'inline-flex',
        'items-center',
        'justify-center',
        'transition-colors',
        'focus:outline-none',
        'focus:ring-2',
        'focus:ring-offset-2',
        'disabled:opacity-50',
        'disabled:cursor-not-allowed',
    ],
    variants: {
        variant: {
            primary: [
                'bg-indigo-600',
                'text-white',
                'hover:bg-indigo-700',
                'focus:ring-indigo-500',
            ],
            secondary: [
                'bg-white',
                'text-gray-700',
                'border',
                'border-gray-300',
                'hover:bg-gray-50',
                'focus:ring-indigo-500',
            ],
        },
        size: {
            sm: 'px-3 py-2 text-sm',
            md: 'px-4 py-2 text-base',
            lg: 'px-6 py-3 text-lg',
        },
    },
    defaultVariants: {
        variant: 'primary',
        size: 'md',
    },
})

const buttonClasses = computed(() => {
    return button({ variant: props.variant, size: props.size })
})
</script>

<template>
    <button
        :type="type"
        :disabled="disabled"
        :class="buttonClasses"
    >
        <slot />
    </button>
</template> 