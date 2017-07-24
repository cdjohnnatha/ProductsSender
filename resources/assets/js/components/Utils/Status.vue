<template>
    <select class="form-control" @change="selectingStatus" v-bind:value="setStatus" id="status-selector">
        <option v-for="item in selectedStatus" v-bind:value="item.id">{{item.status}}</option>
    </select>
</template>

<script>
    export default {
        props: ['setStatus'],
        data() {
            return {
                selectedStatus: {
                    id: '',
                    status: ''
                }
            }
        },

        created() {
            axios.get('/admin/status').then( response => {
                this.selectedStatus = response.data.status;
            });
        },

        methods:{
            selectingStatus: function(event){
                this.$emit('selectedStatus', event.target.value);
            }
        },
    }
</script>

<style lang="css">
</style>
