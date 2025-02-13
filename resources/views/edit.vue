<script setup lang="ts">
import { ref, computed } from 'vue';
import { useForm } from 'laravel-precognition-vue-inertia';
import EditLayout from './layouts/EditLayout.vue';
import { InputText, InputTextArea, InputToggle, InputButton, InputFile } from '../js/components/inputs/index.ts';
import Postcard from '../js/components/Postcard.vue';
import { Side } from '../js/types.ts';

// TODO: We should use a package that exports this automatically
interface PostcardProps {
    id?: string;
    name?: string;
    address_1?: string;
    address_2?: string;
    city?: string;
    state?: string;
    zip?: string;
    message?: string;
    image_caption?: string;
    image_url?: string | File;
}

const props = defineProps<{
    postcard?: PostcardProps
}>();

const isEditing = !!props.postcard;

const formMethod = computed(() => isEditing ? 'put' : 'post');
const formEndpoint = computed(() => isEditing 
    ? route('postcards.update', { postcard: props.postcard?.id }) 
    : route('postcards.store')
);

const form = useForm(formMethod.value, formEndpoint.value, {
    ...props.postcard,
    name: props.postcard?.name,
    address_1: props.postcard?.address_1,
    address_2: props.postcard?.address_2,
    city: props.postcard?.city,
    state: props.postcard?.state,
    zip: props.postcard?.zip,
    message: props.postcard?.message,
    image_caption: props.postcard?.image_caption,
    image_url: props.postcard?.image_url,
});

const side = ref<Side>(Side.FRONT);
const previewUrl = ref<string | undefined>(undefined);
const imageFile = ref<File | null>(null);

const handleFileChange = (file: File | null) => {
    imageFile.value = file;
    if (file) {
        form.image_url = file;
    } else {
        form.image_url = undefined;
    }
};

const submit = () => form.submit({
    preserveScroll: true,
    onSuccess: () => {
        if (previewUrl.value) {
            URL.revokeObjectURL(previewUrl.value);
            previewUrl.value = undefined;
        }
        form.reset();
    },
});

const imageUrl = computed(() => {
    if (form.image_url instanceof File) {
        return URL.createObjectURL(form.image_url);
    }
    return form.image_url;
});

const postcardImageUrl = computed(() => {
    if (!form.image_url) return undefined;
    return imageUrl.value;
});

const copyLink = () => {
    const url = route('postcards.show', { postcard: props.postcard?.id });
    navigator.clipboard.writeText(url);
};
</script>
 
<template>
    <EditLayout>
        <form id="postcard-form" @submit.prevent="submit">
            <fieldset v-show="side === Side.FRONT" class="grid grid-cols-2 gap-4 gap-x-6">
                <InputText
                    v-model="form.name"
                    name="name"
                    label="Recipient Name"
                    required
                    :error="form.errors.name"
                    @change="form.validate('name')"
                    class="col-span-full"
                />

                <InputText
                    v-model="form.address_1"
                    name="address_1"
                    label="Street 1"
                    required
                    :error="form.errors.address_1"
                    @change="form.validate('address_1')"
                    class="col-span-full"
                />

                <InputText
                    v-model="form.address_2"
                    name="address_2"
                    label="Street 2"
                    :error="form.errors.address_2"
                    @change="form.validate('address_2')"
                    class="col-span-full"
                />

                <InputText
                    v-model="form.city"
                    name="city"
                    label="City"
                    required
                    :error="form.errors.city"
                    @change="form.validate('city')"
                    class="col-span-1"
                />

                <InputText
                    v-model="form.state"
                    name="state"
                    label="State"
                    required
                    :error="form.errors.state"
                    @change="form.validate('state')"
                    class="col-span-1"
                />

                <InputText
                    v-model="form.zip"
                    name="zip"
                    label="ZipCode"
                    required
                    :error="form.errors.zip"
                    @change="form.validate('zip')"
                    class="col-span-full"
                />

                <InputTextArea
                    v-model="form.message"
                    name="message"
                    label="Message"
                    required
                    :error="form.errors.message"
                    @change="form.validate('message')"
                    class="col-span-full"
                />
            </fieldset>
            <fieldset v-show="side === Side.BACK" class="grid grid-cols-2 gap-4">
                <InputText
                    v-model="form.image_caption"
                    name="image_caption"
                    label="Image Caption"
                    :error="form.errors.image_caption"
                    @change="form.validate('image_caption')"
                    class="col-span-full"
                />

                <InputFile
                    v-model="imageFile"
                    name="image_url"
                    label="Upload Image"
                    required
                    accept="image/*"
                    :error="form.errors.image_url"
                    @change="handleFileChange"
                    class="col-span-full"
                />
            </fieldset>
        </form>

        <template #preview>
            <h2 class="text-2xl font-bold text-[#7dd3fc]">Preview</h2>
            <Postcard   
                :side="side" 
                :message="form.message"
                :image_url="postcardImageUrl"
                :image_caption="form.image_caption"
            />
            <InputToggle
                v-model="side"
                name="side"
                :options="[Side.FRONT, Side.BACK]"
                class="uppercase"
            />
        </template>

        <template #footer>
            <InputButton
                type="submit"
                form="postcard-form"
                variant="primary"
            >
                {{ isEditing ? 'Update' : 'Save' }}
            </InputButton>
            <InputButton
                type="button"
                variant="secondary"
                :disabled="!isEditing"
                @click="copyLink"
            >
                Copy Link
            </InputButton>
        </template>
    </EditLayout>
</template>