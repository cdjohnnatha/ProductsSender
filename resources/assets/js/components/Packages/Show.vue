<template>
    <section class="col-sm-4" id="picture-wall">
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
</template>

<script>
    import Lightbox from 'vue-image-lightbox';
    require('vue-image-lightbox/dist/vue-image-lightbox.min.css');
    export default {
        props: {
            pictures: [],
        },

        data(){
            return {
                pictures: [{
                        id:'',
                        name:'',
                        path:'',
                        type:'',
                }],
                images:[]
            }
        },

        components: {
            Lightbox,
        },


        created() {
//            if(this.objectPackage.pictures.length >= 0) {
//                for (var picture in this.objectPackage.pictures) {
//                    console.log("sss" + picture);
//                    var src = '/' + this.objectPackage.pictures[picture].path + this.objectPackage.pictures[picture].name;
//                    var pics = {};
//                    pics.thumb = src;
//                    pics.src = src;
//                    pics.caption = this.objectPackage.pictures[picture].id;
//                    this.images.push(pics);
//                }
//            }

        },
        methods: {
            openGallery(index) {
                this.$refs.lightbox.showImage(index)
            },

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
