<template>
  <section class="form-group">
    <div class="input-group">
      <input type="file" class="form-control" @change="prepareFiles"
             accept="image/*" id="file" multiple name="package_files[]">
      <span class="btn btn-danger input-group-addon" @click="removeFileList">
        <span class="glyphicon glyphicon-trash"></span>
      </span>
    </div>
    <ul>
        <li v-for="(file, key) in filesName">{{file}}</li>
    </ul>
  </section>
</template>

<script>
    export default {
        props: {
        },
        data(){
            return {
                filesName: [],

            }
        },


        methods: {
            prepareFiles: function(files) {
                var count;
                for(count = 0; count < files.target.files.length; count++){
                    this.filesName.push(files.target.files[count].name);
                }
            },

            removeFileList: function(index){
                this.filesName = [];
                $('#file').val('');
            },
        }

    }
</script>

<style lang="css">

</style>
