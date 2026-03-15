<script setup>
import GuestLayout from '@/layouts/GuestLayout.vue';
import { Icon } from "@iconify/vue";
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { create as login } from '@/routes/auth';
import { store } from '@/routes/register';

const form = useForm({
    'name': '',
    'email': '',
    'password': '',
});
const submit = () => {
    form.post(store.url());
}
const page = usePage();
</script>

<template>
    <GuestLayout>
        <form @submit.prevent="submit" action="" class="form">
            <div>
                <h4 class="form-label">Seu nome</h4>
                <input v-model="form.name" type="text" class="form-field" placeholder="John Snow">
                <span class="form-error" v-if="page.props.errors.name">{{ page.props.errors.name }}</span>
            </div>
            <div>
                <h4 class="form-label">Seu e-mail</h4>
                <input v-model="form.email" type="email" class="form-field" placeholder="example@email.com">
                <span class="form-error" v-if="page.props.errors.email">{{ page.props.errors.email }}</span>
            </div>
            <div>
                <h4 class="form-label">Crie uma senha</h4>
                <input v-model="form.password" type="password" class="form-field" placeholder="●●●●●●●●●●●">
                <span class="form-error" v-if="page.props.errors.password">{{ page.props.errors.password }}</span>
            </div>
            <div class="flex gap-4">
                <Link :href="login.url()" class="button button-secondary">Cancel <Icon icon="iconoir:cancel" width="24" height="24" /></Link>
                <button type="submit" class="button button-secondary">Confirm <Icon icon="si:arrow-right-line" width="24" height="24" /></button>
            </div>
        </form>
    </GuestLayout>
</template>