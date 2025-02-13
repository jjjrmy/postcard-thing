<script setup lang="ts">
import { Icon } from "@iconify/vue";
</script>

<template>
    <div class="flex flex-col min-h-screen">
        <main class="grid flex-1 grid-cols-1 sm:grid-cols-2">
            <section class="col-span-1 px-20 pt-20">
                <header class="flex items-center gap-2">
                    <Icon icon="lucide:mailbox" class="size-16 text-wordmark" />
                    <h1 class="text-2xl font-bold">ePostCard<span class="text-muted">.tech</span></h1>
                </header>
                <slot />
            </section>
            <section class="flex flex-col items-center justify-center col-span-1 px-20 pt-20 bg-primary">
                <slot name="preview" />
            </section>
        </main>
        <footer>
            <slot name="footer" />
        </footer>
    </div>
</template>