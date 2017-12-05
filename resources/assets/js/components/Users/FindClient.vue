<template>
  <section>
          <input type="number" class="form-control" id="find_suite" @keyup="findSuite" v-model="suite">
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
                label_info: 'label label-danger',
                suite: ''
            }
        },

        created() {
            if(this.editing == null || this.editing.length === 0){
                return this.name;
            }
            else{
                this.name = {'key':this.editing};
                this.suite = this.editing;
                this.findSuite(this.name);
            }

        },

        methods: {

            findSuite(id) {
                if(Number.isInteger(parseInt(id.key))) {
                  axios.get('/admin/api/findClient/' + id.key).then( response => {
                      if(response.data != "") {
                          this.name = response.data.name + ' ' + response.data.surname;
                          this.label_info = 'label label-success';
                          $('#package_client_id').val(response.data.id);
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
