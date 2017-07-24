<template>
    <select class="form-control" @change="selectingStatus" v-bind:value="setStatusWarehouse" id="status-selector">
        <option v-for="item in selectedStatusWarehouse" v-bind:value="item.id">{{item.status}}</option>
    </select>
</template>

<script>
    export default {
        props: ['setStatusWarehouse'],
        data() {
            return {
                selectedStatusWarehouse: {
                    id: '',
                    status: ''
                }
            }
        },

        created() {
            axios.get('/admin/status/warehouses').then( response => {
                this.selectedStatusWarehouse = response.data.statuswarehouse;
                this.$emit('selectedStatusWarehouse', response.data.statuswarehouse[0].id);
            });
        },

        methods:{
            selectingStatus: function(event){
                this.$emit('selectedStatusWarehouse', event.target.value);
            }
        },
    }
</script>

<style lang="css">
</style>
