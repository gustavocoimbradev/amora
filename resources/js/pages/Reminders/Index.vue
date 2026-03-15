<script setup>
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Icon } from "@iconify/vue";
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, Teleport } from 'vue';
import { store as storeReminder, update as updateReminder, destroy as destroyReminder } from '@/routes/reminders';
defineProps({
    reminders: Array 
});
const page = usePage();
const newReminderModal = ref(false);
const editReminderModal = ref(false);
const deleteReminderModal = ref(false);
const activeTitle = ref('');
const id = ref(0);
const form = useForm({
    'title': '',
    'description': '',
    'next_run_at': '',
    'frequency': '',
});
const resetForm = () => {
    setTimeout(() => {
        form.reset();
    }, 500);
}
const newReminder = () => {
    form.post(storeReminder.url(), {
        onSuccess: function(){
            newReminderModal.value = false;
            resetForm();
        },
    });
};
const editReminder = () => {
    form.put(updateReminder.url(id.value), {
        onSuccess: function(){
            editReminderModal.value = false;
            resetForm();
        },
    });
};
const openEditReminderModal = (reminder) => {
    id.value = reminder.id;
    editReminderModal.value = true;
    form.title = reminder.title;
    form.description = reminder.description;
    form.next_run_at = reminder.next_run_at.split('T')[0]; 
    form.frequency = reminder.frequency;
    activeTitle.value = reminder.title;
};
const openDeleteReminderModal = () => {
    deleteReminderModal.value = true;
}
const deleteReminder = () => {
    form.delete(destroyReminder.url(id.value), {
        onSuccess: function(){
            deleteReminderModal.value = false;
            closeEditReminderModal();
            resetForm();
        },
    });
}
const closeEditReminderModal = () => {
    editReminderModal.value = false;
    resetForm();
}
const closeDeleteReminderModal = () => {
    deleteReminderModal.value = false;
}
const frequencyOptions = {
    1: `Every day`,
    2: `Every week`,
    3: `Every month`,
    4: `Every year`
};
</script>

<template>
    <AuthLayout>
        <Teleport to="body">
            <div :class="['modal', newReminderModal ? 'modal--opened' : '']">
                <div class="modal__box">
                    <button class="modal__close" @click="newReminderModal = false">
                        <Icon icon="material-symbols:close" width="24" height="24" />
                    </button>
                     <form @submit.prevent="newReminder" class="form">
                        <div>
                            <h4 class="form-label">Title</h4>
                            <input v-model="form.title" type="text" class="form-field" placeholder="Remember to pay the bills for the month">
                            <span class="form-error" v-if="page.props.errors.title">{{ page.props.errors.title }}</span>
                        </div>
                        <div>
                            <h4 class="form-label">Description</h4>
                            <textarea v-model="form.description" class="form-field" placeholder="Remember to pay the bills"/>
                            <span class="form-error" v-if="page.props.errors.description">{{ page.props.errors.description }}</span>
                        </div>
                        <div>
                            <h4 class="form-label">Next run at</h4>
                            <input v-model="form.next_run_at" type="date" class="form-field">
                            <span class="form-error" v-if="page.props.errors.next_run_at">{{ page.props.errors.next_run_at }}</span>
                        </div>
                        <div>
                            <h4 class="form-label">Frequency</h4>
                            <select v-model="form.frequency" class="form-field">
                                <option v-for="option, key in frequencyOptions" :value="key">{{ option }}</option>
                            </select>
                            <span class="form-error" v-if="page.props.errors.frequency">{{ page.props.errors.frequency }}</span>
                        </div>
                        <div class="flex gap-4">
                            <button type="submit" class="button button-secondary">Create reminder <Icon icon="si:arrow-right-line" width="24" height="24" /></button>
                        </div>
                    </form>
                </div>
            </div>
        </Teleport>
        <Teleport to="body">
            <div :class="['modal', editReminderModal ? 'modal--opened' : '']">
                <div class="modal__box">
                    <button class="modal__close" @click="closeEditReminderModal">
                        <Icon icon="material-symbols:close" width="24" height="24" />
                    </button>
                     <form @submit.prevent="editReminder" class="form">
                        <div>
                            <h4 class="form-label">Title</h4>
                            <input v-model="form.title" type="text" class="form-field" placeholder="Remember to pay the bills for the month">
                            <span class="form-error" v-if="page.props.errors.title">{{ page.props.errors.title }}</span>
                        </div>
                        <div>
                            <h4 class="form-label">Description</h4>
                            <textarea v-model="form.description" class="form-field" placeholder="Remember to pay the bills"/>
                            <span class="form-error" v-if="page.props.errors.description">{{ page.props.errors.description }}</span>
                        </div>
                        <div>
                            <h4 class="form-label">Next run at</h4>
                            <input v-model="form.next_run_at" type="date" class="form-field">
                            <span class="form-error" v-if="page.props.errors.next_run_at">{{ page.props.errors.next_run_at }}</span>
                        </div>
                        <div>
                            <h4 class="form-label">Frequency</h4>
                            <select v-model="form.frequency" class="form-field">
                                <option v-for="option, key in frequencyOptions" :value="key">{{ option }}</option>
                            </select>
                            <span class="form-error" v-if="page.props.errors.frequency">{{ page.props.errors.frequency }}</span>
                        </div>
                        <div class="flex gap-4">
                            <button @click="openDeleteReminderModal" class="button button-secondary">Delete reminder <Icon icon="iconoir:cancel" width="24" height="24" /></button>
                            <button type="submit" class="button button-secondary">Update reminder <Icon icon="si:arrow-right-line" width="24" height="24" /></button>
                        </div>
                    </form>
                </div>
            </div>
        </Teleport>
        <Teleport to="body">
            <div :class="['modal', deleteReminderModal ? 'modal--opened' : '']">
                <div class="modal__box">
                    <button class="modal__close" @click="closeDeleteReminderModal">
                        <Icon icon="material-symbols:close" width="24" height="24" />
                    </button>
                     <form @submit.prevent class="form">
                        <div>
                            <h4 class="form-label">Are you sure you want to delete this reminder?</h4>
                            <hr class="text-white/20 mb-4">
                            <h6 class="text-md text-white/40">{{ activeTitle }}</h6>
                        </div>
                        <div class="flex gap-4">
                            <button type="button" @click="closeDeleteReminderModal" class="button button-secondary">No <Icon icon="iconoir:cancel" width="24" height="24" /></button>
                            <button type="button" @click="deleteReminder" class="button button-secondary">Yes <Icon icon="si:arrow-right-line" width="24" height="24" /></button>
                        </div>
                    </form>
                </div>
            </div>
        </Teleport>
        <div class="grid grid-cols-3 gap-10">
            <button class="card card--new" @click="newReminderModal = true">
                Add a new reminder
            </button>
            <button v-for="reminder in reminders" class="card" @click="openEditReminderModal(reminder)">
                <span>{{ reminder.title }}</span>
                <span class="text-sm text-white/30">{{ frequencyOptions[reminder.frequency] }}</span>
            </button>
        </div>
    </AuthLayout>
</template>