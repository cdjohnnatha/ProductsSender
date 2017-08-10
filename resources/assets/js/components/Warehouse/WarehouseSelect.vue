<template>
    <select class="form-control" v-bind:value="setwarehouse" name="warehouse_id">
        <option v-for="warehouse in warehouses"  v-bind:value="warehouse.id">
            {{warehouse.address.label}}
        </option>
    </select>
</template>

<script>
    export default {
        props: {
            warehouses: Array,
            setwarehouse: ''
        },
        data() {
            return {
            }
        }
    }
</script>

<style lang="css">
</style>
