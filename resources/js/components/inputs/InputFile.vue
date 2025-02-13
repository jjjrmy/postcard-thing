<script setup lang="ts">
import { ref } from 'vue';

interface Props {
  modelValue?: File | null;
  name: string;
  label?: string;
  error?: string;
  accept?: string;
  required?: boolean;
}

defineProps<Props>();
const emit = defineEmits<{
  (e: 'update:modelValue', value: File | null): void;
  (e: 'change', value: File | null): void;
}>();

const fileInput = ref<HTMLInputElement | null>(null);

const handleFileChange = (event: Event) => {
  const target = event.target as HTMLInputElement;
  const file = target.files?.[0] || null;
  emit('update:modelValue', file);
  emit('change', file);
};
</script>

<template>
  <div class="flex flex-col gap-1">
    <label v-if="label" :for="name" class="text-sm font-medium text-gray-700">
      {{ label }}
      <span v-if="required" class="text-red-500">*</span>
    </label>

    <div class="flex flex-col gap-2">
      <input
        ref="fileInput"
        :id="name"
        type="file"
        :name="name"
        :required="required"
        :accept="accept"
        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary/90"
        @change="handleFileChange"
      />
    </div>

    <p v-if="error" class="mt-1 text-sm text-red-600">{{ error }}</p>
  </div>
</template> 