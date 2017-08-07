<template>
    <section class="col-sm-12" id="picture-wall">
        <label v-show="this.pictures.length <= 0 ? true : false">Pictures not found!</label>
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
            pictures: Array,
        },

        data(){
            return {
                images:[]
            }
        },
        components: {
            Lightbox,
        },


        created() {
            console.log('created');
            console.log(this.pictures);
            if(this.pictures.length > 0){
                for(var count = 0; count < this.pictures.length; count++){
                    this.images.push({
                        'src': '/'+this.pictures[count].path,
                        'thumb': '/'+this.pictures[count].path,
                        'caption': '/'+this.pictures[count].id,
                    });

                }
            }
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
