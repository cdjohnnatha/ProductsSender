<template>
    <section>
        <select class="form-control" name="subscription_id" v-bind:value="set_subscription"
                v-model="setting" @change="setBenefits()">
            <option v-for="(item, index) in subscriptions" v-bind:value="index" >{{item.title}}</option>
        </select>
        <section class="row">
            <section v-for="benefit in subscriptions[setting].benefits" class="form-group col-sm-3">
                <div class="input-group">
                    <label class="control-label">{{benefit.message}}</label>
                    <div class="togglebutton m-b-15 ">
                        <label>
                            <input type="checkbox" class="toggle-info" checked>
                        </label>
                    </div>
                </div>
            </section>
        </section>
    </section>

</template>

<script>
    export default {
        props: ['set_subscription', 'subscriptions'],
        data() {
            return {
                setting: 0,
            }
        },

        methods: {
            setBenefits(){
                console.log(this.setting);
            }

        }
    }
</script>

<style lang="css">
</style>
