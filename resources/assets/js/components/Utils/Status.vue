<template>
    <select class="form-control" name="status_id" v-bind:value="setStatus">
        <option v-for="item in status" v-bind:value="item.id">{{item.status}}</option>
    </select>
</template>

<script>
    export default {
        props: ['setStatus', 'status'],
        data() {
            return {
            }
        },
    }
</script>

<style lang="css">
</style>
