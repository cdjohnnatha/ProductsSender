<!--<template>-->
    <!--<section class="col-sm-12 form-group">-->
        <!--<div class="col-sm-12">-->
            <!--<label>Upload Pictures</label>-->
            <!--<input type="file" class="form-control" multiple @change="prepareFiles"-->
                   <!--accept="image/*">-->
            <!--<ul>-->
                <!--<li v-for="(file, key) in filesName" @click="removeFileList(key)">{{file}}-->
                    <!--<span class="glyphicon glyphicon-remove remove-file"></span>-->
                <!--</li>-->
            <!--</ul>-->
        <!--</div>-->
    <!--</section>-->
    <!--<section class="col-sm-12">-->
        <!--<div class="col-sm-12">-->
            <!--<label>Quote</label>-->
            <!--<textarea class="form-control" v-model="objectPackage.note"></textarea>-->
        <!--</div>-->
    <!--</section>-->
<!--</template>-->

<!--<script>-->
    <!--export default {-->
        <!--props: {-->
            <!--data_id: 0,-->
            <!--user_id: 0-->
        <!--},-->
        <!--data(){-->
            <!--return {-->
                <!--urlForm: '/admin/packages/register',-->
                <!--disabled: false,-->
                <!--buttonName: 'Register',-->
                <!--submitAction: this.submitForm,-->
                <!--timeout: '',-->
                <!--user: 'not found',-->
                <!--filesName: [],-->
                <!--objectPackage:{-->
                    <!--id: '',-->
                    <!--name: '',-->
                    <!--width: '',-->
                    <!--height: '',-->
                    <!--depth: '',-->
                    <!--unit_measure: 'cm',-->
                    <!--weight_measure: 'kg',-->
                    <!--note: ' ',-->
                    <!--status_id: '',-->
                    <!--object_owner: '',-->
                    <!--warehouse_id: '',-->
                    <!--pictures: []-->
                <!--},-->

            <!--}-->
        <!--},-->

        <!--created() {-->
<!--//            if(this.data_id !== 0) {-->
<!--//                let url = window.location.href;-->
<!--//                if (url.indexOf('edit') !== -1 && url.indexOf('admin') !== -1) {-->
<!--//                    this.changeForEdit();-->
<!--//-->
<!--//                    axios.get('/admin/packages/' + this.data_id + '/show').then(response => {-->
<!--//                        this.objectPackage = response.data.package;-->
<!--//                        this.objectPackage.object_owner = this.objectPackage.user.id;-->
<!--//                        this.findUser();-->
<!--//                        for(var index in this.objectPackage.pictures){-->
<!--//                            this.filesName.push(this.objectPackage.pictures[index].name);-->
<!--//                        }-->
<!--//-->
<!--//                    }).catch(function (error) {-->
<!--//                        console.log(error);-->
<!--//                    });-->
<!--//                }-->
<!--//            }-->

        <!--},-->

        <!--methods: {-->

            <!--prepareFiles: function(files) {-->
                <!--var count;-->
                <!--for(count = 0; count < files.target.files.length; count++){-->
                    <!--var fileReader = new FileReader();-->
                    <!--this.filesName.push(files.target.files[count].name);-->
                    <!--fileReader.readAsDataURL(files.target.files[count]);-->
                    <!--fileReader.onload = (e) => {-->
                        <!--this.objectPackage.pictures.push(e.target.result);-->
                    <!--}-->
                <!--}-->
            <!--},-->

            <!--removeFileList: function(index){-->
                <!--this.filesName.splice(index, 1);-->
                <!--if(typeof(this.objectPackage.pictures[index]) === 'object'){-->
                    <!--axios.delete('/admin/packages/' + this.objectPackage.id + '/file/' +-->
                        <!--this.objectPackage.pictures[index].id +'/delete' ).then(response => {-->
                        <!--console.log('ok');-->
                    <!--}).catch(error => {-->
                        <!--this.user = 'not found ';-->
                        <!--console.log(error);-->
                    <!--});-->
                    <!--this.objectPackage.pictures.splice(index, 1);-->
                <!--}-->

            <!--},-->





        <!--}-->

    <!--}-->
<!--</script>-->

<!--<style lang="css">-->

    <!--.remove-file{-->
        <!--color:red;-->
        <!--cursor: pointer;-->
    <!--}-->
<!--</style>-->
