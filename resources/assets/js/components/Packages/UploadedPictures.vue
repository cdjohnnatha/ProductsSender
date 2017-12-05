<template>
  <section>
      <div v-for="(picture, index) in jsonPictures" class="card image-over-card m-t-30" style="width: 20%;">
        <div class="card-image">
          <img v-bind:src="picture.path" itemprop="thumbnail" alt="Image description">
        </div>
        <div class="card-body" style="margin-left: 2em; padding-top:0; padding-bottom: 0;">
          <button class="btn btn-danger btn-flat" @click="removeImg(index)">Delete</button>
        </div>
      </div>
  </section>
</template>

<script>
    export default {
        props: {
            pictures: {
                default: Array
            }
        },
        data() {
            return {
                jsonPictures: ''
            }
        },

        created() {
          this.jsonPictures = JSON.parse(this.pictures);
        },


        methods: {

            removeImg(index) {
                axios.post('/admin/api/deleteFile/' + this.jsonPictures[index].id, { '_method': 'delete'}).catch(function (error) {
                    console.log(error);
                });

                if(this.jsonPictures.length - 1 > 0) {
                    this.jsonPictures.splice(index, 1);
                }
            },
        }


    }
</script>

<style lang="css">

</style>

