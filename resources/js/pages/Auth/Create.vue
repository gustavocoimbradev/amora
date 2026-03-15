<script setup>
import GuestLayout from '@/layouts/GuestLayout.vue';
import { store } from '@/routes/auth';
import { create as register } from '@/routes/register';
import { Icon } from "@iconify/vue";
import { Link, useForm, usePage } from '@inertiajs/vue3';
const page = usePage();
const form = useForm({
    'email': '',
    'password': ''
});
const submit = () => {
    form.post(store.url());
}
</script>

<template>
    <GuestLayout>
        <form @submit.prevent="submit" action="" class="form">
            <div>
                <h4 class="form-label">Qual o seu e-mail?</h4>
                <input v-model="form.email" type="email" class="form-field" placeholder="example@email.com">
            </div>
            <div>
                <h4 class="form-label">Qual a sua senha?</h4>
                <input v-model="form.password" type="password" class="form-field" placeholder="●●●●●●●●●●●">
                <span class="form-error" v-if="page.props.errors.credentials">{{ page.props.errors.credentials }}</span>
            </div>
            <div class="flex gap-4">
                <Link :href="register.url()" class="button button-secondary">Register <Icon icon="material-symbols-light:person-outline" width="24" height="24" /></Link>
                <button type="submit" class="button button-secondary">Login <Icon icon="si:arrow-right-line" width="24" height="24" /></button>
            </div>
        </form>
    </GuestLayout>
</template>