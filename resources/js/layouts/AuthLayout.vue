<script setup>
import { useForm } from '@inertiajs/vue3';
import { destroy as logout } from '@/routes/auth';
import { Icon } from "@iconify/vue";
const logout_form = useForm();
const logout_function = () => {
    logout_form.delete(logout.url());
}
</script>

<template>
    <div class="min-h-full w-full bg-amora flex items-center justify-center">
        <div class="w-[1200px] max-w-full bg-white/10 p-10">
            <div class="flex justify-between border-b border-white/20">
                <h1 class="logo-small">AMOR<span>A</span></h1>
                <h5 class="slogan-small">Remember everything.</h5>
                <div>
                    <form @submit.prevent="logout_function">
                        <button type="submit" class="button button-secondary">Logout <Icon icon="material-symbols-light:logout" width="24" height="24" /></button>
                    </form>
                </div>
            </div>
            <div class="px-4 py-10">
                <slot/>
            </div>
        </div>
       
     
    </div>
</template>