<template>
    <footer class="panel-footer">
        <div class="pull-right">
            <button class="btn btn-warning" type="button" @click="backSections"
                    v-show="backBtn">Back</button>
            <button v-bind:class="formBtnClass" v-bind:type="typeFormBtn"
                    @click="changeSections">{{buttonName}}</button>
        </div>
        <div class="clearfix"></div>
    </footer>
</template>

<script>
    export default {
        data() {
            return {
                actionChange: this.changeSections,
                buttonName: 'Next',
                userSection: true,
                addressSection: false,
                subscriptionSection: false,
                backBtn: false,
                typeFormBtn: 'button',
                formBtnClass: 'btn btn-info'
            }
        },

        created(){
            this.userSection = true;
            this.addressSection = false;
            this.subscriptionSection = false;
        },

        methods: {
            changeSections: function () {
                if (this.userSection) {
                    this.userSection = false;
                    this.addressSection = true;
                    this.backBtn = true;
                    $('#userInfo').addClass('hidden');
                    $('#addressSection').removeClass('hidden');
                    this.buttonName = 'Register';
                    $('#submitSection').removeClass('hidden');
                }
            },
            backSections: function() {
                if (this.addressSection) {
                    this.userSection = true;
                    this.addressSection = false;
                    this.backButton = false;
                    $('#userInfo').removeClass('hidden');
                    $('#addressSection').addClass('hidden');
                }
            }
        },
        computed:{

        }
    }
</script>

<style lang="css">
</style>
