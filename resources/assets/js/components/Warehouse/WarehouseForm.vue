<template>
    <section class="container col-sm-6 col-sm-offset-3" id="form-admin">
        <div class="row">
            <div class="panel panel-default">
                <header class="panel-heading">
                    Login
                </header>
                <div class="panel-body">
                    <form role="form">
                        <div class="form-group col-sm-10 col-sm-offset-1" :class="{'has-error': errors.has('email') }" >
                            <input name="email" class="form-control" type="text" placeholder="Login"
                                   v-model="admin.email" v-validate="'required|email'">
                            <span class="text-danger" v-if="errors.has('email')">
                <strong>{{ errors.first('email') }}</strong>
              </span>
                        </div>
                        <div class="form-group col-sm-10 col-sm-offset-1" :class="{'has-error': errors.has('password') }" >
                            <input name="password" class="form-control" type="password" placeholder="Password"
                                   v-model="admin.password">
                            <span class="text-danger" v-if="errors.has('password')">
                <strong>{{ errors.first('password') }}</strong>
              </span>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-1">
                                <button class="btn btn-primary" @click.prevent="submitLogin" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data(){
            return {
                admin:{
                    email: '',
                    password: '',
                    remember: false
                }

            }
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
            }
        }

    }
</script>

<style lang="css">
</style>
