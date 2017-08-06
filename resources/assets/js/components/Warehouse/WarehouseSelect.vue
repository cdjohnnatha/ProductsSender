<template>
    <select class="form-control" v-bind:value="setWarehouse" name="warehouse-select">
        <option v-for="warehouse in warehouses"  v-bind:value="warehouse.id">{{warehouse.name}}</option>
    </select>
</template>

<script>
    export default {
        props: ['setWarehouse', 'warehouses'],
        data() {
            return {
            }
        },

        created() {

        },

    }
</script>

<style lang="css">
</style>
