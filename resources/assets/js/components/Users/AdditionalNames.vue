<template>
<section>
    <section>
        <section class="col-sm-6" v-for="(additional, index) in additionals">
            <div class="input-group form-group">
                <input class="hidden" v-bind:value="additional.id" v-bind:name="'additional['+index+'][id]'">
                <input type="text" class="form-control" v-bind:name="'additional['+index+'][name]'"
                       v-bind:value="additional.name" v-model="additional.name" placeholder="Name">
                <span v-show="additional.name.length != 0" class="btn input-group-addon" @click="removeName(index)">
                    <span class="glyphicon glyphicon-trash"></span>
                </span>

                <span v-if="additionals.length == index + 1"
                      class="btn input-group-addon" @click="addName">
                    <span class="glyphicon glyphicon-plus"></span>
                </span>
            </div>
        </section>
        <button type="submit" class="hidden" id="submit-button"></button>
        <footer class="col-sm-12">
            <button type="submit" class="btn btn-info">
                <span class="glyphicon glyphicon-refresh">UPDATE</span>
            </button>
        </footer>
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
