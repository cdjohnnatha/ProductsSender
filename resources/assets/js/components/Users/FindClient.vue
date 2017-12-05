<template>
  <section>
          <input type="number" name="package[client_id]" class="form-control" @keyup="findSuite">
  </section>
</template>

<script>
    export default {
        props: {
            editing: String
        },
        data(){
            return {
                name: ""
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
