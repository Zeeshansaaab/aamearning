<script setup>
    import { computed } from 'vue';
    
    const emit = defineEmits(['update:checked']);
    
    const props = defineProps({
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            default: null,
        },
        title: {
            default: null
        }
    });
    
    const proxyChecked = computed({
        get() {
            return props.checked;
        },
    
        set(val) {
            emit("update:checked", val);
        },
    });
    </script>


<template>
    <div class="form-group">
        <p>{{ title }}</p>
        <div class="toggle btn"  style="width: 100%; height: 50px;">
            <input :value="value" v-model="proxyChecked"
                type="checkbox" :class="`btn ${proxyChecked ? 'btn-outlinine-success' : 'btn-outlinine-danger'}`" id="btn-check-outlined" autocomplete="off"
            />
            <label  style="width: 100%; height: 50px;" :class="`btn ${proxyChecked ? 'btn-success' : 'btn-danger'}`" id="btn-check-outlined" for="btn-check-outlined">{{ proxyChecked ? "Active" : "Inactive" }}</label>
        </div>
    </div>
</template>