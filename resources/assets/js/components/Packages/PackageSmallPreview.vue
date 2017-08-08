<template>
    <section id="picture-wall">
        <div class="smallPictures col-sm-2">
            <img v-lazy="images[0].src" class="pictures" @click="openGallery(0)">
        </div>
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
            pictures: Object,
        },

        data(){
            return {
                images: ''
            }
        },
        components: {
            Lightbox,
        },


        created() {
             this.images = [{
                 'src': '/' + this.pictures.path,
                 'thumb': '/' + this.pictures.path,
                 'caption': '/' + this.pictures.id,
             }];
        },
        methods: {
            openGallery(index) {
                this.$refs.lightbox.showImage(index);
            },

        }


    }
</script>

<style lang="css">

    /*ul{*/
        /*list-style-type : none;*/
        /*padding-left: 0;*/
    /*}*/

    /*div {*/
        /*position: relative;*/
        /*overflow: hidden;*/
        /*cursor: pointer;*/
    /*}*/

    .smallPictures img{
        width: 100%;
    }


    .smallPictures{
        width: 8.2em;
        height: 5em;
        padding-right: .5em;
        padding-left: 1px;
        margin-bottom: 1em;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }


    .vue-lb-container{
        z-index: 3;
    }

</style>
