<template>
    <section class="container col-sm-offset-1">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Subscriptions</div>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <div class="form-group col-sm-9" :class="{'has-error': errors.has('title') }">
                                <label>Title for Subscription</label>
                                <input name="title" class="form-control" type="text" placeholder="Title"
                                       v-model="subscription.title" v-validate="'required'"
                                       v-bind:disabled="disabled">
                                <span class="text-danger" v-if="errors.has('title')">
                                    <strong>{{ errors.first('title') }}</strong>
                                </span>
                            </div>
                            <div class="form-group col-sm-3" :class="{'has-error': errors.has('amount') }" >
                                <label>Storage Time</label>
                                <input name="amount" class="form-control" type="number" placeholder="Days"
                                       v-model="subscription.amount" v-validate="'required|decimal'"
                                       v-bind:disabled="disabled">
                                <span class="text-danger" v-if="errors.has('amount')">
                                    <strong>{{ errors.first('amount') }}</strong>
                                </span>
                            </div>
                            <div class="col-sm-12">
                                <h4>Benefits
                                    <button class="btn" id="addBenefit" @click="addMessage" v-bind:disabled="disabled">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </h4>
                            </div>
                            <div class="form-group col-sm-6 benefits-inputs" v-for="(benefit, index) in subscription.benefits">
                                <input v-bind:name="'benefit-'+index" v-bind:id="'benefit-'+index"
                                       class="form-control" type="text" placeholder="Message"
                                       v-model="benefit.message" v-bind:disabled="disabled">
                            </div>
                        </div>
                    </div>
                </div> <!-- panel body -->
                <footer class="panel-footer">
                    <button type="submit" id="submit-button" class="btn btn-primary pull-right"
                            @click="submitAction">{{buttonName}}</button>
                    <div class="col-sm-11">
                        <a href="/admin/dashboard" id="cancel-button" class="btn btn-danger pull-right">Cancel</a>
                    </div>
                    <div class="clearfix" v-bind:id="data_id"></div>
                </footer>
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
                urlForm: '/admin/subscriptions/register',
                disabled: false,
                buttonName: 'Register',
                submitAction: this.submitForm,
                subscription:{
                    id: '',
                    title: '',
                    amount: '',
                    benefits: [
                        {message: ''}
                    ],
                }



            }
        },

        created() {
            if(this.data_id !== 0){
                let url = window.location.href;
                if(url.indexOf('edit') !== -1) {
                    this.changeForEdit();
                }

                if(url.indexOf('show') !== -1) {
                    this.buttonName = 'Edit';
                    this.disabled = true;
                    this.submitAction = this.changeForEdit;

                    axios.get('/admin/subscriptions/'+ this.data_id + '/show').then( response => {
                        this.subscription = response.data.subscription;
                        console.log(this.subscription);
                    }).catch(function (error) {
                        console.log(error);
                    });

                }
                else{
                    this.buttonName = 'Register'
                }
            }

        },

        methods: {
            submitForm: function(){
                console.log('sending');
                this.$validator.validateAll().then((result) => {
                    if (result) {
                        axios.post(this.urlForm, this.subscription ).then( response => {
                            location.href= response.data;
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }
                });
            },

            changeForEdit: function(){
                this.disabled = false;
                this.urlForm = '/admin/subscriptions/' + this.data_id + '/update';
                this.submitAction = this.submitForm;
                this.buttonName = 'Update';

            },

            addMessage: function(){
                this.subscription.benefits.push({message:''});
            }
        }

    }
</script>

<style lang="css">
</style>
