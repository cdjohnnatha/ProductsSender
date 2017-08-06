<template>
    <section class="container col-sm-offset-1">
        <div class="row col-sm-11 col-sm-offset-1">
            <div class="panel panel-default">

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
