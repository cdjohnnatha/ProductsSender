<template>
<section>
    <section>
        <section class="col-sm-6" v-for="(additional, index) in additionals">
            <div class="input-group form-group col-sm-12">
                <input class="hidden" v-bind:value="additional.id" v-bind:name="'additional['+index+'][id]'">
                <input type="number" min="0.00" step="0.01" class="form-control" v-bind:name="'additional['+index+'][name]'"
                       v-bind:value="additional.name" v-model="additional.name" placeholder="Discount">
                <select name="services" id="services">

                </select>
                <button v-show="additional.name.length != 0" class="btn btn-primary btn-fab btn-fab-sm" @click="removeName(index)">
                    <i class="zmdi zmdi-delete"></i>
                </button>

                <button type="button" v-if="additionals.length == index + 1"
                      class="btn btn-primary btn-fab btn-fab-sm " @click="addName">
                    <i class="zmdi zmdi-plus"></i>
                </button>
            </div>
        </section>
    </section>
</section>
</template>

<script>
    export default {
        props: {
            editing: Array,
            user_id: 0
        },
        data(){
            return {
                additionals: [{
                    id: 0,
                    name: ''
                }]
            }
        },

        created() {
            if(this.editing == null || this.editing.length === 0){
                return this.additionals;
            }
            else{
                this.additionals = this.editing;
                this.additionals.push({name: '', id: 0});
                return this.additionals;
            }

        },

        methods: {

            addName() {
                if(this.additionals.length - 1 >= 0 && this.additionals[this.additionals.length - 1].name.length > 0) {
                    this.additionals.push({name: '', id: 0});
                    $('#submit-button').click();
                }
            },

            removeName(index){
                if(this.additionals[index].id !== 0) {
                    axios.post('/user/'+this.user_id+'/additional-names/' + this.additionals[index].id, {
                        '_method': 'delete'
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
                this.additionals.splice(index, 1);
            }

        }

    }
</script>

<style lang="css">

</style>
