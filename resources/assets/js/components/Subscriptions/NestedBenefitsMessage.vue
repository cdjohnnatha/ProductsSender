<template>
    <section class="form-group">
        <div class="input-group col-sm-1">
            <h4>Benefits</h4>
            <span class="input-group-btn" @click="addMessage">
              <button class="btn btn-info btn-fab animate-fab btn-fab-sm" type="button" id="addMessage">
                <span><i class="zmdi zmdi-plus"></i></span>
              </button>
            </span>
        </div>
          <div class="form-group col-sm-6 label-floating" v-for="(benefit, index) in benefits">
            <div class="input-group">
              <span class="input-group-addon"><i class="zmdi zmdi-check"></i></span>
              <label class="control-label">What is offered</label>
              <input v-bind:name="'benefits['+index+'][message]'" class="form-control" type="text"
                     v-model="benefit.message" v-bind:id="'input-message-' + index" required>
              <div v-bind:hidden="true">
                <input type="number" v-bind:name="'benefits['+index+'][id]'" v-bind:value="benefit.id">
              </div>

              <span class="input-group-btn" @click="removeMessage(index)">
                <button class="btn btn-warning btn-fab animate-fab btn-fab-sm" type="button">
                  <span class="input-group-addon"><i class="zmdi zmdi-minus"></i></span>
                </button>
              </span>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: {
            editing: Array
        },
        data(){
            return {
              benefits:[{'message': '', 'id': ''}],
              deleted: [{'message': '', 'id': ''}]
                }
            },

        created() {
            if(this.editing == null || this.editing.length == 0){
                return this.benefits;
            }
            else{
             return this.benefits = this.editing;
            }
        },



        methods: {
            addMessage: function(){
                console.log('pressed');
                if(this.benefits.length - 1 >= 0 && this.benefits[this.benefits.length - 1].message.length > 0) {
                    this.benefits.push({message: '', id: ''});
                }
            },
            removeMessage(index){
                if(this.editing != null) {
                    axios.post('/admin/benefits/' + this.benefits[index].id, {
                        '_method': 'delete'
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
              if(this.benefits.length - 1 > 0)
                this.benefits.splice(index, 1);

            },

        }

    }
</script>

<style lang="css">
</style>
