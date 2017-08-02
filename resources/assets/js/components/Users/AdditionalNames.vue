<template>
    <section class="container col-sm-offset-1">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label>
                        Additional Names
                    </label>
                    <p>
                        Those listed names bellow belongs to your Holyship account. All the
                            consignment which will be send to them, using the EUA Address
                            will be put it out on the packages
                    </p>
                </div>
                <div class="panel-body">
                    <section class="col-sm-6" v-for="(additional, index) in additionals">
                        <div class="input-group form-group">
                            <input type="text" class="form-control" v-bind:value="additional.name"
                            v-model="additional.name">
                            <span v-if="additional.delete == false"
                                  class="btn input-group-addon" @click="addName">
                                <span class="glyphicon glyphicon-plus"></span>
                            </span>
                            <span v-show="additional.delete" class="btn input-group-addon" @click="removeName(index)">
                                <span class="glyphicon glyphicon-trash"></span>
                            </span>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
    import CustomClearance from '../Utils/ObjectJson/CustomClearance'
    export default {
        props: {
            data_id: 0,
            user_id: 0,
        },
        data(){
            return {
                urlForm: '/user/' + this.user_id + '/',
                disabled: false,
                submitAction: this.submitForm,
                additionals:[{
                    name: '',
                    delete: false
                }]
            }
        },

        created() {


        },

        methods: {
            submitForm: function(){
                this.$validator.validateAll().then((result) => {
                    if (result && this.objectPackage.warehouse_id !== -1 ) {
                        axios.post(this.urlForm, this.objectPackage).then( response => {
                            if(response.status === 201)
                                location.href= '/admin/packages/show-list';
                            console.log(response);
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }
                });
            },

            addName() {
                if(this.additionals.length >= 1){
                    if(this.additionals[this.additionals.length -1].name != ''){
                        this.additionals.push({name:'', delete: false});
                        this.additionals[this.additionals.length -2].delete = true;
                        console.log(this.additionals[0].name);
                    }
                }else{
                    this.additionals.push({name:''});
                }


            },

            removeName(index){
                this.additionals.splice(index, 1);
            }

        }

    }
</script>

<style lang="css">

</style>
