<template>
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <section v-show="userSection">
                        <div class="col-sm-6" :class="{'has-error' : 'errorsName'}">
                            <label for="name" class="control-label">Name</label>
                            <input id="name" type="text" class="form-control" name="name">
                            <span v-if="errorsName" class="help-block">
                                <strong>{{errorsName}}</strong>
                            </span>
                        </div>
                        <div class="col-sm-6">
                            <label for="surname" class="control-label">Surname</label>
                            <input id="surname" type="text" class="form-control" name="surname">
                        </div>

                        <div class="col-sm-6">
                            <label for="phone" class="control-label">Phone</label>
                            <input id="phone" type="text" class="form-control" name="phone">
                        </div>

                        <div class="col-sm-6">
                            <label class="control-label" >Country</label>
                            <countries-list id="country" @selectedCountry="user.country = $event"></countries-list>
                        </div>

                        <div class="col-sm-12">
                            <label for="email" class="control-label">E-Mail Address</label>
                            <input id="email" type="email" class="form-control" name="email">
                        </div>



                        <div class="col-sm-6">
                            <label for="password" class="control-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password">
                        </div>

                        <div class="col-sm-6">
                            <label for="password-confirm" class="control-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>


                    </section>

                    <section v-show="addressSection">
                        <address-form @filledAddress="user.address = $event"></address-form>
                    </section>


                </div><!-- panel-body -->
                <div class="panel-footer">
                    <button type="button" @click="changeSections" class="btn btn-success pull-right">
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
</template>

<script>
    export default {
        data() {
            return {
                userSection: true,
                addressSection: false,
                planSection: false,
                buttonName: 'Next',
                backButton: false,
                user: {
                    name: '',
                    country: '',
                    address:{
                        addressLabel: '',
                        name: '',
                        surname: '',
                        phone: '',
                        company: '',
                        address: '',
                        city: '',
                        state: '',
                        postalCode: '',
                        country: ''
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
                    return;
                }

                if(this.addressSection){
                    this.planSection = true;
                    this.addressSection = false;
                    this.buttonName = 'Register';
                    this.backButton = false;
                    $('#clickAddress').click();
                    return;
                }

                if(this.planSection){
                    alert('test');
                }
            },

            backSections: function(){
                if(this.addressSection){
                    this.planSection = false;
                    this.userSection = true;
                    this.addressSection = false;
                    this.backButton = false;
                }
            }
        }
    }
</script>

<style lang="css">
</style>
