<template>
  <section>
          <input type="number" class="form-control" @keyup="findSuite">
          <span style="font-size: 70%;" v-bind:class="label_info" v-model="name">{{ name }}</span>
  </section>
</template>

<script>
    export default {
        props: {
            editing: String
        },
        data(){
            return {
                name: "client not found",
                label_info: 'label label-danger'
            }
        },

        created() {
            if(this.editing == null || this.editing.length === 0){
                return this.name;
            }
            else{
                this.name = this.editing;
                return this.name;
            }

        },

        methods: {

            findSuite(id) {
                if(Number.isInteger(parseInt(id.key))) {
                  axios.get('/admin/api/findClient/' + id.key).then( response => {
                      console.log(response);
                      if(response.data != "") {
                          this.name = response.data.name + ' ' + response.data.surname;
                          this.label_info = 'label label-success';
                          $('#package_client_id').val(response.data.id);
                          console.log(response.data.id);
                      } else {
                          this.name = 'client not found';
                          this.label_info = 'label label-danger';
                          $('#package_client_id').val(null);
                      }
                  }).catch(function (error) {
                      console.log(error);
                  });
                }
            }
        }

    }
</script>

<style lang="css">

</style>
