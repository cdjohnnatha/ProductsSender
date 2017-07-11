<template>
    <section class="container col-sm-offset-1">
        <div class="row col-sm-10 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Subscriptions List</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="subscription in subscriptions">
                            <td>{{subscription.id}}</td>
                            <td>{{subscription.title}}</td>
                            <td>{{subscription.amount}}</td>
                            <td>
                                <a v-bind:href="'/admin/subscriptions/' + subscription.id + '/show-form'"
                                   class="edit-modal btn btn-info">
                                    <span class="glyphicon glyphicon-zoom-in"></span>
                                    Show
                                </a>
                                <a v-bind:href="'/admin/subscriptions/' + subscription.id + '/edit'"
                                   class="edit-modal btn btn-warning">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Edit
                                </a>
                                <button @click="deleting(subscription.id)" type="submit" class="btn btn-danger">
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
                subscriptions:[
                    {
                        id: '',
                        title: '',
                        amount: ''
                    }
                ]

            }
        },

        created() {
            axios.get('/admin/subscriptions/').then( response => {
                this.subscriptions = response.data.subscriptions;
                console.log(this.subscriptions);
            });

        },

        methods: {
            deleting: function(id){
                axios.delete('/admin/subscriptions/' + id + '/delete').then( response => {
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
