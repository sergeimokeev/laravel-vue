<template>
    <form @submit.prevent="">
        <div class="form-floating mb-3">
            <input v-model="password" type="password" class="form-control rounded-4" id="password"
                   placeholder="Password">
            <label for="password">Password</label>
        </div>
        <div class="form-floating mb-3">
            <input v-model="password_confirmation" type="password" class="form-control rounded-4" name="password_confirmation"
                   id="password_confirmation" placeholder="Password confirmation">
            <label for="password_confirmation">Password confirmation</label>
        </div>
        <div class="form-floating mb-3">
            <input v-model="new_password" type="password" class="form-control rounded-4"
                   id="new_password" placeholder="New password">
            <label for="new_password">New password</label>
        </div>
        <button class="mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Reset password</button>
    </form>
</template>

<script>
export default {

}
</script>
