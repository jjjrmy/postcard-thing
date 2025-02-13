<script setup lang="ts">
import { ref } from 'vue';
import Postcard from '../js/components/Postcard.vue';
import { Side } from '../js/types';
import { InputToggle, InputButton } from '../js/components/inputs';
import { router } from '@inertiajs/vue3';

interface PostcardProps {
    id: string;
    name: string;
    address_1: string;
    address_2?: string;
    city: string;
    state: string;
    zip: string;
    message: string;
    image_caption?: string;
    image_url: string;
}

const props = defineProps<{
    postcard?: PostcardProps
}>();

const side = ref<Side>(Side.FRONT);

const goToCreate = () => {
    router.visit(route('postcards.create'));
};
</script>

<template>
    <main class="w-full h-screen bg-primary">
        <div class="container max-w-screen-md">
            <InputButton
                type="button"
                @click="goToCreate"
                class="uppercase"
            >
                Create New
            </InputButton>
            <Postcard 
                :side="side"
                :message="props.postcard?.message"
                :image_url="props.postcard?.image_url"
                :image_caption="props.postcard?.image_caption"
            />
            <InputToggle
                v-model="side"
                name="side"
                :options="[Side.FRONT, Side.BACK]"
                class="uppercase"
            />
        </div>
    </main>
</template>