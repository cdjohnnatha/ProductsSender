<template>
    <section class="container col-sm-offset-1">
        <div class="row col-sm-11 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Package List</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Unit_measure</th>
                            <th>Weight</th>
                            <th>Weight_measure</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="package in packages">
                            <td>{{package.id}}</td>
                            <td>{{package.width}}</td>
                            <td>{{package.height}}</td>
                            <td>{{package.unit_measure}}</td>
                            <td>{{package.weight}}</td>
                            <td>{{package.weight_measure}}</td>
                            <td><span class="label label-default">{{package.status.status}}</span></td>
                            <td>
                                <a v-bind:href="'/admin/packages/' + package.id + '/show-view'"
                                   class="edit-modal btn btn-info">
                                    <span class="glyphicon glyphicon-zoom-in"></span>
                                    Show
                                </a>
                                <a v-bind:href="'/admin/packages/' + package.id + '/edit'"
                                   class="edit-modal btn btn-warning">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Edit
                                </a>
                                <button @click="deleting(package.id)" type="submit" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    Delete
                                </button>
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
                packages:[
                    {
                        id: '',
                        width: '',
                        height: '',
                        unit_measure: '',
                        weight: '',
                        weight_measure: '',
                        note: '',
                        status: {
                            id: '',
                            status: '',
                        }
                    }
                ]

            }
        },

        created() {
            axios.get('/admin/packages/').then( response => {
                this.packages = response.data.packages;
                console.log(this.packages);
            });

        },

        methods: {
            deleting: function(id){
                axios.delete('/admin/packages/' + id + '/delete').then( response => {
                console.log(response.data);
                 if( response.status === 200)
                        location.href = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }

    }
</script>

<style lang="css">
</style>
