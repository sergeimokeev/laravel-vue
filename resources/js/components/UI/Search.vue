<template>
    <div class="nav col-12 col-lg-4 me-lg-auto justify-content-center mb-3 mb-lg-0">
        <input :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" type="search" class="form-control rounded"
               placeholder="Search" aria-label="Search"
               aria-describedby="search-addon">
    </div>
</template>

<script>
export default {
    props: {
        modelValue: [String, Number]
    }
}
</script>

