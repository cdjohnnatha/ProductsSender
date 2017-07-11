<template>
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-md-offset-1">
            <div class="col-sm-12 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{nameForm}}</div>
                    <div class="panel-body">
                        <!--<form>-->
                        <section v-show="userSection">
                            <div class="form-group col-sm-12">
                                <div class="col-sm-6" :class="{'has-error': errors.has('name') }" >
                                    <label for="name" class="control-label">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" v-validate="'required'"
                                        v-model="user.name">
                                    <span class="text-danger" v-if="errors.has('name')">
                                        <strong>{{ errors.first('name') }}</strong>
                                    </span>
                                </div>
                                <div class="col-sm-6" :class="{'has-error': errors.has('surname') }" >
                                    <label for="surname" class="control-label">Surname</label>
                                    <input id="surname" type="text" class="form-control" name="surname"
                                           v-validate="'required'" v-model="user.surname">
                                    <span class="text-danger" v-if="errors.has('surname')">
                                        <strong>{{ errors.first('surname') }}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <div class="col-sm-6" :class="{'has-error': errors.has('phone') }">
                                    <label for="phone" class="control-label">Phone</label>
                                    <input id="phone" type="text" class="form-control" name="phone"
                                           v-validate="'required|numeric|min:10'" v-model="user.phone">
                                    <span class="text-danger" v-if="errors.has('phone')">
                                        <strong>{{ errors.first('phone') }}</strong>
                                    </span>
                                </div>

                                <div class="col-sm-6">
                                    <label class="control-label" >Country</label>
                                    <countries-list id="country" @selectedCountry="user.country = $event"></countries-list>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="col-sm-12" :class="{'has-error': errors.has('email') }">
                                    <label for="email" class="control-label">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                           v-validate="'required|email'" v-model="user.email">
                                    <span class="text-danger" v-if="errors.has('email')">
                                        <strong>{{ errors.first('email') }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">

                                <div class="col-sm-6" :class="{'has-error': errors.has('password') }">
                                    <label for="password" class="control-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password"
                                           v-validate="'required|min:6|confirmed:password_confirmation'"
                                           v-model="user.password">
                                    <span class="text-danger" v-if="errors.has('password')">
                                        <strong>{{ errors.first('password') }}</strong>
                                    </span>
                                </div>

                                <div class="col-sm-6" :class="{'has-error': errors.has('password_confirmation') }">
                                    <label for="password-confirm" class="control-label">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" v-validate="'required|confirmed:password'">
                                    <span class="text-danger" v-if="errors.has('password_confirmation')">
                                        <strong>{{ errors.first('password_confirmation') }}</strong>
                                    </span>
                                </div>
                            </div>

                        </section>

                        <section v-show="addressSection">
                            <address-form @filledAddress="user.address = $event"
                                          @addressStatus="buttonStatus = $event"
                                          :address="user.address"></address-form>
                        </section>

                        <section v-show="subscriptionSection">
                            <subscriptions @allowRegister="buttonStatus = $event"
                                           @subscription="user.subscriptions = $event"></subscriptions>
                        </section>

                        <!--</form>-->
                    </div><!-- panel-body -->
                    <div class="panel-footer">
                        <button type="submit" @click="actionButton" v-bind:disabled="changeButtonStatus"
                                class="btn btn-success pull-right" id="submit-button">
                            {{buttonName}}
                            <span class="glyphicon glyphicon-arrow-right"></span>
                        </button>
                        <div class="col-sm-2  pull-right">
                            <button type="button" @click="backSections" class="btn btn-warning" v-show="backButton">
                                <span class="glyphicon glyphicon-arrow-left"></span>
                                Back
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                userSection: true,
                addressSection: false,
                subscriptionSection: false,
                buttonName: 'Next',
                backButton: false,
                buttonStatus: false,
                nameForm: 'Register User',
                actionButton: this.validateUserSection,
                user: {
                    name: '',
                    surname: '',
                    country: '',
                    password: '',
                    subscriptions: '',
                    phone: '',
                    address:{
                        label: '',
                        name: '',
                        surname: '',
                        phone: '',
                        company: '',
                        address: '',
                        city: '',
                        state: '',
                        postal_code: '',
                        country: '',
                        addressStatus: false
                    }
                },

            }
        },
        methods:{
            changeSections: function(){
                if(this.userSection){
                    this.userSection = false;
                    this.addressSection = true;
                    this.backButton = true;
                    this.nameForm = 'Register Address';
                    return;
                }

                if(this.addressSection){
                    this.subscriptionSection = true;
                    this.addressSection = false;
                    this.buttonName = 'Register';
                    this.backButton = false;
                    this.buttonStatus = true;
                    this.nameForm = 'Select Subscription';
                    this.changeSections();
                    return;
                }


                if(this.subscriptionSection){
                    this.actionButton = this.actionRegister;
                }


            },

            backSections: function(){
                if(this.addressSection){
                    this.subscriptionSection = false;
                    this.userSection = true;
                    this.addressSection = false;
                    this.backButton = false;
                }
            },

            validateUserSection: function(){
                this.$validator.validateAll().then((result) => {
                    if(result) {
                        this.changeSections();
                        this.actionButton = this.addressAction;
                    }
                });
            },

            addressAction: function() {
                $('#clickAddress').click();
                this.changeSections();
            },

            registerUser: function(){
              return true;
            },

            actionRegister: function(){
                axios.post('/register', {
                    user: this.user
                }).then( response => {
                    if( response.status === 201){
                        location.href = 'login';
                    }
                }).catch(function (error) {
                    console.log(error);
//                    location.reload(true);
                });
            }
        },
        computed:{
            changeButtonStatus(){
                if(this.buttonStatus && !this.subscriptionSection){
                    this.changeSections();
                    this.actionButton = this.registerUser;
                }else{
                    return this.errors.any();
                }

                if(this.subscriptionSection){
                    this.actionButton = this.actionRegister;
                    return this.buttonStatus;

                }
            }
        }
    }
</script>

<style lang="css">
</style>
