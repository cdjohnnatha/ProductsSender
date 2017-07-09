<template>
    <section class="container col-sm-offset-1">
        <div class="row col-sm-12 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Warehouses</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Box Price</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>Postal Code</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="warehouse in warehouses">
                            <td>{{warehouse.id}}</td>
                            <td>{{warehouse.name}}</td>
                            <td>{{warehouse.box_price}}</td>
                            <td>{{warehouse.address.address}}</td>
                            <td>{{warehouse.address.city}}</td>
                            <td>{{warehouse.address.country}}</td>
                            <td>{{warehouse.address.state}}</td>
                            <td>{{warehouse.address.postal_code}}</td>
                            <td>
                                <a v-bind:href="'/admin/warehouses/'+warehouse.id+'/edit'" class="edit-modal btn btn-warning">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Edit
                                </a>
                                <button @click="deleteAdmin(warehouse.id)" type="submit" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span> Delete</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data(){
            return {
                warehouses:[]

            }
        },

        created() {
            axios.get('/admin/warehouses/').then( response => {
                this.warehouses = response.data.warehouses;
                console.log(this.warehouses);
            });

        },

        methods: {
            submitLogin: function(){
//                axios.post('/admin/login', this.admin ).then( response => {
//                    if( response.status === 202)
//                        location.href = response.data;
//                }).catch(function (error) {
//                    console.log(error);
//                });
            },

            deleteAdmin: function(id){
                console.log("calling");
                axios.delete('/admin/' + id + '/delete').then( response => {
                    if( response.status === 201)
                        console.log('worked');
                    console.log(response);
//                        location.href = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }

    }
</script>

<style lang="css">
</style>
