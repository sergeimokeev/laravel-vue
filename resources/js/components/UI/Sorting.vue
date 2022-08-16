<template>
    <div class="col-12 col-lg-auto form-floating">
        <select v-model="modelValue" @change="$emit('update:modelValue', $event.target.value)" class="form-select"
                id="sortSelect" aria-label="sortSelect">
            <option value="" disabled>Open this select menu</option>
            <option v-for="option in options" :key="option.value" :value="option.value">
                {{ option.name }}
            </option>
        </select>
        <label for="sortSelect">Sort by</label>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {
            type: String
        },
        options: {
            type: Array,
            default: () => []
        }
    }
}
</script>
