<template>
    <section class="container col-sm-offset-1">
        <div class="col-sm-11 col-sm-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label>Package:</label>
                    # {{objectPackage.id}}
                </div>
                <div class="panel-body">
                    <section class="col-sm-12">
                        <section class="col-sm-4" id="picture-wall">
                            <label>Pictures of Package</label>
                            <label v-show="this.objectPackage.pictures.length <= 0 ? true : false">Pictures not found!</label>
                            <ul>
                                <li v-for="(image, index) in images" v-bind:class="index == 0 ? 'mainPicture thumbnail' : 'smallPictures col-sm-1'"  >
                                        <img v-if="index == 0" v-lazy="image.src" @click="openGallery(index)">
                                        <img v-else v-lazy="image.src" class="pictures" @click="openGallery(index)">
                                </li>
                            </ul>
                            <lightbox
                                    :images="images"
                                    ref="lightbox"
                                    :show-caption="true"
                                    :showLightBox="false"
                                    :showThumbs="true">
                            </lightbox>
                        </section>
                        <section class="col-sm-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Order Informations
                                </div>
                                <div class="panel-body">
                                </div>
                            </div>
                        </section>
                        <aside class="col-sm-4" >
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Object Informations
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th>Dimensions ({{objectPackage.unit_measure}}):</th>
                                                <td>
                                                    {{objectPackage.width}} x {{objectPackage.height}}
                                                     x {{objectPackage.depth}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Weight ({{objectPackage.weight_measure}}):</th>
                                                <td>{{objectPackage.weight}}</td>
                                            </tr>
                                            <tr>
                                                <th>Status:</th>
                                                <td>{{objectPackage.status.status}}</td>
                                            </tr>
                                            <tr>
                                                <th>Object Owner:</th>
                                                <td>{{objectPackage.user.name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Warehouse:</th>
                                                <td>{{objectPackage.warehouse.name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Note:</th>
                                                <td>{{objectPackage.note}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </aside>
                    </section>
                </div> <!-- panel body -->
                <footer class="panel-footer">
                    <a v-bind:href="'/admin/packages/' + objectPackage.id + '/edit'" class="btn btn-primary pull-right">Edit</a>
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
    import Lightbox from 'vue-image-lightbox';
    require('vue-image-lightbox/dist/vue-image-lightbox.min.css');
    export default {
        props: {
            data_id: 0
        },

        data(){
            return {
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
                    warehouse: {
                        name: '',
                    },

                    user: {
                      name: '',
                    },
                    status: {
                        status: '',
                    },

                    pictures: [{
                            id:'',
                            name:'',
                            path:'',
                            type:'',
                    }]
                },

                images:[]
            }
        },

        components: {
            Lightbox,
        },


        created() {
            console.log(this.data_id);
                axios.get('/admin/packages/' + this.data_id + '/show').then(response => {
                    this.objectPackage = response.data.package;
                    if(this.objectPackage.pictures.length >= 0) {
                        for (var picture in this.objectPackage.pictures) {
                            console.log("sss" + picture);
                            var src = '/' + this.objectPackage.pictures[picture].path + this.objectPackage.pictures[picture].name;
                            var pics = {};
                            pics.thumb = src;
                            pics.src = src;
                            pics.caption = this.objectPackage.pictures[picture].id;
                            this.images.push(pics);
                        }
                    }else{

                    }
                }).catch(function (error) {
                    console.log(error);
                });

        },
        methods: {
            openGallery(index) {
                this.$refs.lightbox.showImage(index)
            }
        }


    }
</script>

<style lang="css">

    ul{
        list-style-type : none;
        padding-left: 0;
    }

    ul li{
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    ul li img{
        width: 100%;
    }

    .mainPicture{
        width: 104%;
        height: 16em;
    }

    .mainPicture img{
        text-align: center;
    }

    .smallPictures{
        width: 25%;
        height: 4em;
        padding-right: 1px;
        padding-left: 1px;
    }

    .pictures{
        padding-top: .5em;
        display: inline;
        overflow: hidden;
        width: 100%;
    }

    #picture-wall{
        padding-left: 0;
    }

    .thumbnail{
        margin-bottom: 0;
        padding-bottom: 2px;
    }

</style>
