<template>
    <section class="container col-sm-offset-1">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Package</div>
                <div class="panel-body">
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <div class="form-group col-sm-12" >
                                <div class="form-group col-sm-6" :class="{'has-error': errors.has('warehouse-select') }">
                                    <label>Warehouse</label>
                                    <warehouses-select @selectedWarehouse="objectPackage.warehouse_id = $event"
                                                       :setWarehouse="objectPackage.warehouse_id"></warehouses-select>
                                </div>
                                <div class="form-group col-sm-6" :class="{'has-error': errors.has('suite') }">
                                    <label>Suite</label>
                                    <input name="suite" class="form-control" type="text" placeholder="Suite Number  "
                                           v-model="objectPackage.object_owner" v-on:keyup="findUser" v-validate="'required'"
                                           v-bind:disabled="disabled">
                                    <span class="text-danger" v-if="errors.has('suite')">
                                        <strong>{{ errors.first('suite') }}</strong>
                                    </span>
                                    <span class="text-primary" v-if="!errors.has('suite')">
                                        <strong>{{user.name}} {{user.surname}} - {{user.email}}</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <div class="col-sm-6">
                                    <label>Status</label>
                                    <status-warehouse-select @selectedStatusWarehouse="objectPackage.status_id = $event"
                                        :setStatusWarehouse="objectPackage.status_id"></status-warehouse-select>
                                </div>
                                <div class="form-group col-sm-3" :class="{'has-error': errors.has('weight') }">
                                    <label>Weight</label>
                                    <input name="weight" class="form-control" type="number" placeholder="Weight"
                                           v-model="objectPackage.weight" v-validate="'required|decimal'"
                                           v-bind:disabled="disabled">
                                    <span class="text-danger" v-if="errors.has('weight')">
                                                <strong>{{ errors.first('weight') }}</strong>
                                            </span>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>Weight measure</label>
                                    <select class="form-control" v-model="objectPackage.weight_measure">
                                        <option value="kg">kg</option>
                                        <option value="g">g</option>
                                        <option value="lbs">lbs</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group col-sm-12">
                                <label class="col-sm-12">Dimensions</label>
                                <section>
                                    <div class="col-sm-3" :class="{'has-error': errors.has('width') }" >
                                        <input name="width" class="form-control" type="number" placeholder="Width"
                                               v-model="objectPackage.width" v-validate="'required|decimal'"
                                               v-bind:disabled="disabled">
                                        <span class="text-danger" v-if="errors.has('width')">
                                            <strong>{{ errors.first('width') }}</strong>
                                        </span>
                                    </div>
                                    <div class="col-sm-3" :class="{'has-error': errors.has('height') }">
                                        <input name="height" class="form-control" type="number" placeholder="Height"
                                               v-model="objectPackage.height" v-validate="'required|decimal'"
                                               v-bind:disabled="disabled">
                                        <span class="text-danger" v-if="errors.has('height')">
                                            <strong>{{ errors.first('height') }}</strong>
                                        </span>
                                    </div>
                                    <div class="col-sm-3" :class="{'has-error': errors.has('depth') }">
                                        <input name="depth" class="form-control" type="number" placeholder="Depth"
                                               v-model="objectPackage.depth" v-validate="'required|decimal'"
                                               v-bind:disabled="disabled">
                                        <span class="text-danger" v-if="errors.has('depth')">
                                            <strong>{{ errors.first('depth') }}</strong>
                                        </span>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="form-control" v-model="objectPackage.unit_measure">
                                            <option value="cm">cm</option>
                                            <option value="mm">mm</option>
                                            <option value="in">in</option>
                                            <option value="lb">lb</option>
                                            <option value="m">m</option>
                                        </select>
                                    </div>
                                </section>

                            </div>
                            <section class="col-sm-12 form-group">
                                <div class="col-sm-12">
                                    <label>Upload Pictures</label>
                                    <input type="file" class="form-control" multiple @change="prepareFiles"
                                           accept="image/*">
                                    <ul>
                                        <li v-for="(file, key) in filesName" @click="removeFileList(key)">{{file}}
                                            <span class="glyphicon glyphicon-remove remove-file"></span>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                            <section class="col-sm-12">
                                <div class="col-sm-12">
                                    <label>Quote</label>
                                    <textarea class="form-control" v-model="objectPackage.note"></textarea>
                                </div>
                            </section>

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
                urlForm: '/admin/packages/register',
                disabled: false,
                buttonName: 'Register',
                submitAction: this.submitForm,
                timeout: '',
                user: 'not found',
                filesName: [],
                objectPackage:{
                    id: '',
                    name: '',
                    width: '',
                    height: '',
                    depth: '',
                    unit_measure: 'cm',
                    weight_measure: 'kg',
                    note: ' ',
                    status_id: '',
                    object_owner: '',
                    warehouse_id: '',
                    pictures: []
                },

            }
        },

        created() {
            if(this.data_id !== 0) {
                let url = window.location.href;
                if (url.indexOf('edit') !== -1 && url.indexOf('admin') !== -1) {
                    this.changeForEdit();

                    axios.get('/admin/packages/' + this.data_id + '/show').then(response => {
                        this.objectPackage = response.data.package;
                        this.objectPackage.object_owner = this.objectPackage.user.id;
                        this.findUser();
                        for(var index in this.objectPackage.pictures){
                            this.filesName.push(this.objectPackage.pictures[index].name);
                        }

                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            }

        },

        methods: {
            submitForm: function(){
                //Remove existent image objects before send to update
                if(this.data_id !== 0) {
                    for(var index in this.objectPackage.pictures){
                        if(typeof(this.objectPackage.pictures[index]) === 'object'){
                            this.objectPackage.pictures.splice(index, 1);
                        }
                    }
                }
                this.$validator.validateAll().then((result) => {
                    if (result && this.objectPackage.warehouse_id !== -1 ) {
                        console.log(this.objectPackage);
                        axios.post(this.urlForm, this.objectPackage).then( response => {
                            if(response.status === 201)
                                location.href= '/admin/packages/show-list';
                        }).catch(function (error) {
                            console.log(error);
                        });
                    }
                });
            },

            changeForEdit: function(){
                this.disabled = false;
                this.urlForm = '/admin/packages/' + this.data_id + '/update';
                this.submitAction = this.submitForm;
                this.buttonName = 'Update';

            },

            findUser: function() {
                    axios.get('/admin/users/' + this.objectPackage.object_owner ).then(response => {
                        this.user = response.data.user;
                }).catch(error => {
                    this.user = 'not found ';
                    console.log(error);
                });
            },

            prepareFiles: function(files) {
                var count;
                for(count = 0; count < files.target.files.length; count++){
                    var fileReader = new FileReader();
                    this.filesName.push(files.target.files[count].name);
                    fileReader.readAsDataURL(files.target.files[count]);
                    fileReader.onload = (e) => {
                        this.objectPackage.pictures.push(e.target.result);
                    }
                }
            },

            removeFileList: function(index){
                this.filesName.splice(index, 1);
                if(typeof(this.objectPackage.pictures[index]) === 'object'){
                    axios.delete('/admin/packages/' + this.objectPackage.id + '/file/' +
                        this.objectPackage.pictures[index].id +'/delete' ).then(response => {
                        console.log('ok');
                    }).catch(error => {
                        this.user = 'not found ';
                        console.log(error);
                    });
                    this.objectPackage.pictures.splice(index, 1);
                }

            }
//



        }

    }
</script>

<style lang="css">

    .remove-file{
        color:red;
        cursor: pointer;
    }
</style>
