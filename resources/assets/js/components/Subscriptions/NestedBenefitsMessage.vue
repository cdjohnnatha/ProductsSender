<template>
    <section>
        <div class="col-sm-12">
            <h4>Benefits
                <button class="btn" @click="addMessage" type="button" id="addMessage">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </h4>
        </div>
          <div class="form-group col-sm-6" v-for="(benefit, index) in benefits">
            <div class="input-group col-sm-12">
              <input v-bind:name="'benefits['+index+'][message]'" class="form-control" type="text"
                     v-model="benefit.message" v-bind:id="'input-message-' + index" required>
              <div v-bind:hidden="true">
                <input type="number" v-bind:name="'benefits['+index+'][id]'" v-bind:value="benefit.id">
              </div>
              <span class="btn input-group-addon" @click="removeMessage(index)">
                <span class="glyphicon glyphicon-minus"></span>
              </span>

            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: {
            editing: []
        },
        data(){
            return {
              benefits:[{'message': '', 'id': ''}],
              deleted: [{'message': '', 'id': ''}]
                }
            },

        created() {
            console.log(this.editing);
            if(this.editing == null){
                return this.benefits;
            }
            else{
             return this.benefits = this.editing;
            }
        },



        methods: {
            addMessage: function(){
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
