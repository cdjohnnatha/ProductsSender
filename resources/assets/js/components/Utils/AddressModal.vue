<template>
  <section>
    <div class="modal fade" id="basic_modal" tabindex="-1" role="dialog" aria-labelledby="basic_modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">

            <h4 class="modal-title" id="myModalLabel-2">Change your address just clicking</h4>
            <ul class="card-actions icons right-top">
              <li>
                <a href="javascript:void(0)" data-dismiss="modal" class="text-white" aria-label="Close">
                  <i class="zmdi zmdi-close"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="modal-body">
            <section v-for="address in addresses" >
              <a href="javascript:void(0)" class="btn btn-green btn-flat">
                <p>{{address.label}}</p>
                <p>{{address.formatted_address}}</p>
              </a>
            </section>
          </div>
          <!--<div class="modal-footer">-->
            <!--<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cancel</button>-->
            <!--<button type="button" class="btn btn-primary">Ok</button>-->
          <!--</div>-->
        </div>
        <!-- modal-content -->
      </div>
      <!-- modal-dialog -->
    </div>
  </section>
</template>


<script>
    export default {
        props: {
            addresses: Array,
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
            console.log(this.addresses);

        },

        methods: {

            addName() {
                if(this.additionals.length - 1 >= 0 && this.additionals[this.additionals.length - 1].name.length > 0) {
                    this.additionals.push({name: '', id: 0});
                    $('#submit-button').click();
                }
            },


        }

    }
</script>

<style lang="css">

</style>
