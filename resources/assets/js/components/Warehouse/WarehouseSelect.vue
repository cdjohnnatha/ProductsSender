<template>
    <select class="form-control" @change="selectingWarehouse" v-bind:value="setWarehouse" name="warehouse-select">
        <option v-for="warehouse in warehouses"  v-bind:value="warehouse.id">{{warehouse.name}}</option>
    </select>
</template>

<script>
    export default {
        props: ['setWarehouse'],
        data() {
            return {
                warehouses: []
            }
        },

        created() {
            axios.get('/admin/warehouses/').then( response => {
                this.warehouses = response.data.warehouses;
                this.$emit('selectedWarehouse', this.warehouses[0].id);
            });
        },

        methods:{
            selectingWarehouse: function(event){
                this.$emit('selectedWarehouse', event.target.value);
            }
        },
    }
</script>

<style lang="css">
</style>
