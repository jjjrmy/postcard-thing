<script setup lang="ts">
import { Side } from '../types';
import Stamp from './Stamp.vue';

defineProps<{
    side?: Side;
    message?: string;
    image_url?: string;
    image_caption?: string;
}>();
</script>

<template>
    <article 
        ref="cardRef"
        class="relative bg-white rounded-lg shadow-md min-h-96 aspect-video"
    >
        <div class="card-inner">
            <div v-show="!side || side === Side.FRONT" class="p-8 front">
                <div class="absolute top-8 right-8">
                    <Stamp />
                </div>
                <div class="max-w-[60%] whitespace-pre-wrap">{{ message }}</div>
            </div>
            <div v-show="!side || side === Side.BACK" class="relative h-full back">
                <img 
                    v-if="image_url"
                    :src="image_url"
                    :alt="image_caption || 'Postcard image'"
                    class="object-cover w-full h-full rounded-lg"
                />
                <div 
                    v-if="image_caption"
                >
                    {{ image_caption }}
                </div>
            </div>
        </div>
    </article>
</template>