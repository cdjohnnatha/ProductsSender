<template>
    <select class="form-control" name="status_id" v-bind:value="set_status">
        <option v-for="item in status" v-bind:value="item.id">{{item.status}}</option>
    </select>
</template>

<script>
    export default {
        props: ['set_status', 'status'],
        data() {
            return {
            }
        },
    }
</script>

<style lang="css">
</style>
