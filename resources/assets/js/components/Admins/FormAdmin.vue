<template>
    <div class="container col-sm-offset-1">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Admin</div>
                    <div class="panel-body">
                        <!--<form>-->
                        <section>
                            <div class="form-group col-sm-12">
                                <div class="col-sm-6" :class="{'has-error': errors.has('name') }" >
                                    <label for="name" class="control-label">Name</label>
                                    <input id="name" type="text" class="form-control" name="name" v-validate="'required'"
                                           v-model="admin.name">
                                    <span class="text-danger" v-if="errors.has('name')">
                                    <strong>{{ errors.first('name') }}</strong>
                                </span>
                                </div>
                                <div class="col-sm-6" :class="{'has-error': errors.has('surname') }" >
                                    <label for="surname" class="control-label">Surname</label>
                                    <input id="surname" type="text" class="form-control" name="surname"
                                           v-validate="'required'" v-model="admin.surname">
                                    <span class="text-danger" v-if="errors.has('surname')">
                                    <strong>{{ errors.first('surname') }}</strong>
                                </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <div class="col-sm-6" :class="{'has-error': errors.has('phone') }">
                                    <label for="phone" class="control-label">Phone</label>
                                    <input id="phone" type="text" class="form-control" name="phone"
                                           v-validate="'required|numeric|min:10'" v-model="admin.phone">
                                    <span class="text-danger" v-if="errors.has('phone')">
                                    <strong>{{ errors.first('phone') }}</strong>
                                </span>
                                </div>

                                <div class="col-sm-6">
                                    <label class="control-label" >Country</label>
                                    <countries-list id="country" @selectedCountry="admin.country = $event"
                                    :setCountry="admin.country"></countries-list>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="col-sm-12" :class="{'has-error': errors.has('email') }">
                                    <label for="email" class="control-label">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                           v-validate="'required|email'" v-model="admin.email">
                                    <span class="text-danger" v-if="errors.has('email')">
                                    <strong>{{ errors.first('email') }}</strong>
                                </span>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">

                                <div class="col-sm-6" :class="{'has-error': errors.has('password') }" v-if="showPassword">
                                    <label for="password" class="control-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password"
                                           v-validate="'required|min:6|confirmed:password_confirmation'"
                                           v-model="admin.password">
                                    <span class="text-danger" v-if="errors.has('password')">
                                    <strong>{{ errors.first('password') }}</strong>
                                </span>
                                </div>

                                <div class="col-sm-6" :class="{'has-error': errors.has('password_confirmation') }" v-if="showPassword">
                                    <label for="password-confirm" class="control-label">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" v-validate="'required|confirmed:password'">
                                    <span class="text-danger" v-if="errors.has('password_confirmation')">
                                    <strong>{{ errors.first('password_confirmation') }}</strong>
                                </span>
                                </div>
                            </div>

                        </section>

                        <!--</form>-->
                    </div><!-- panel-body -->
                    <div class="panel-footer">
                        <button type="submit" @click="actionRegister" class="btn btn-success pull-right"
                                id="submit-button">
                            Create
                        </button>
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
                admin: {
                    id: '',
                    name: '',
                    surname: '',
                    country: 'Afganistan',
                    password: '',
                    email: '',
                    phone: '',
                },
                urlForm: '/admin/register',
                showPassword: true

            }
        },

        created() {
            let url = window.location.href;
            if(url.indexOf('edit') !== -1){
                var id = url.substr(url.lastIndexOf("/")-1, url.lastIndexOf("/"));
                this.admin.id = id.match(/\d+/)[0];
                this.urlForm = '/admin/' + this.admin.id + '/update';
                this.showPassword = false;
                this.getAdmin();
            }
        },
        methods:{
            actionRegister: function(){
                this.$validator.validateAll().then((result) => {
                    if(result) {
                        axios.post(this.urlForm, this.admin
                        ).then( response => {
                            console.log(response);
                        }).catch(function (error) {

                            console.log(error);
                        });
                    }
                });
            },
            getAdmin: function(){
                axios.get('/admin/'+ this.admin.id + '/show').then( response => {
                    this.admin.id = response.data.admin.id;
                    this.admin.name = response.data.admin.name;
                    this.admin.surname = response.data.admin.surname;
                    this.admin.country = response.data.admin.country;
                    this.admin.phone = response.data.admin.phone;
                    this.admin.email = response.data.admin.email;
                    console.log(this.admin.country);
                }).catch(function (error) {

                    console.log(error);
                });
            }
        }
    }
</script>

<style lang="css">
</style>
