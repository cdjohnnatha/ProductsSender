<template>
    <section class="container col-sm-offset-1">
        <div class="row col-sm-8 col-sm-offset-1">
            <h3>Package List</h3>
            <div class="panel panel-default" v-for="package in packages">
                <div class="panel-heading col-sm-12">
                    <span>Package Status:</span>
                    <label>{{package.status.status}}</label>
                </div>
                <section class="panel-body">
                    <table class="col-sm-12">
                        <thead>
                            <tr>
                                <th class="col-sm-3">Package Name: <span>#{{package.id}}</span></th>
                                <th class="col-sm-3">Informations: </th>
                                <th class="col-sm-3">Registered At: </th>
                                <th class="col-sm-3">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-sm-4">
                                    <img id="picture" v-bind:src="'/'+package.pictures[0].path + '/'
                                    + package.pictures[0].name" alt="">

                                </td>
                                <td>{{package.note}}</td>
                                <td><label>{{package.created_at}}</label></td>
                                <td><a v-bind:href="package.id">Show details</a></td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: {
            data_id: 0
        },
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
                        created_at: '',
                        status: {
                            id: '',
                            status: '',
                        },
                        pictures: [{
                            id: 0,
                            name: '',
                            path: '',
                            type: ''
                        }]
                    }
                ]

            }
        },

        created() {
            axios.get('/home/' + this.data_id + '/packages/').then( response => {
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
    #picture{
        height: 6em;
    }
</style>
