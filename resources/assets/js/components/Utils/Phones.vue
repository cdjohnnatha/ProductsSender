<template>
    <section class="col-sm-12">
        <header class="form-group">
          <span class="btn" @click="addPhones" id="addPhones">
            <i class="zmdi zmdi-plus"></i>
            Telefones
          </span>
        </header>
        <div class="form-group col-sm-3" v-for="(phone, index) in phones">
          <div class="input-group">
            <input v-bind:name="'phones['+index+'][number]'" class="form-control" type="text"
                   v-model="phone.number" v-bind:id="'input-number-' + index" required>
            <div v-bind:hidden="true">
              <input type="number" v-bind:name="'phones['+index+'][id]'" v-bind:value="phone.id">
            </div>
            <span class="btn input-group-addon" @click="removeNumber(index)">
              <i class="zmdi zmdi-minus"></i>
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
              phones:[{'number': '', 'id': ''}],
                }
            },

        created() {
            console.log(this.editing);
            if(this.editing == null || this.editing.length == 0){
                return this.phones;
            }
            else{

             return this.phones = this.editing;
            }
        },



        methods: {
            addPhones: function(){
                if(this.phones.length - 1 >= 0 && this.phones[this.phones.length - 1].number.length > 0) {
                    this.phones.push({number: '', id: ''});
                }
            },
            removeNumber(index){
                if(this.editing != null) {
                    axios.post('/admin/phones/' + this.phones[index].id, {
                        '_method': 'delete'
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
              if(this.phones.length - 1 > 0)
                this.phones.splice(index, 1);

            },

        }

    }
</script>

<style lang="css">
</style>
