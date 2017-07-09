<template>
    <section class="container col-sm-offset-1">
        <div class="row col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Admin</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Country</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="admin in admins">
                                <td>{{admin.id}}</td>
                                <td>{{admin.name}}</td>
                                <td>{{admin.surname}}</td>
                                <td>{{admin.country}}</td>
                                <td>{{admin.email}}</td>
                                <td>{{admin.phone}}</td>
                                <td>
                                    <a v-bind:href="'/admin/'+admin.id+'/edit'" class="edit-modal btn btn-warning">
                                        <span class="glyphicon glyphicon-edit"></span>
                                        Edit
                                    </a>
                                    <button type="submit" class="btn btn-danger">
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
                admins:[]

            }
        },

        created() {
            axios.get('/admin/list').then( response => {
                this.admins = response.data.admins;
                console.log(this.admins);
            });

        },

        methods: {
            submitLogin: function(){
                console.log('sending');
                axios.post('/admin/login', this.admin ).then( response => {
                    if( response.status === 202)
                        location.href = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            },
        }

    }
</script>

<style lang="css">
</style>
