<template>
    <li class="dropdown">
        <a href="#" class="btn-lg dropdown-toggle" data-toggle="dropdown"
           role="button" aria-expanded="false">
            <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
            <span class="badge" aria-hidden="true" id="badge">{{notifications}}</span>

        </a>

        <ul class="dropdown-menu" role="menu">
            <li class="dropdown-header">Notifications </li>
            <li v-for="notify in unread">
                <a v-bind:href="prefixUrl + 'packages/' + notify.id">
                    You have a new package name
                    <label>#{{notify.id}}</label>
                </a>
            </li>
            <li role="separator" class="divider"></li>
            <li><a href="" class="dropdown-header">Show all</a></li>
        </ul>
    </li>
</template>
<script>

    export default {
        props: {
            data_id: 0
        },

        data(){
            return {
                prefixUrl: '/home/' + this.data_id + '/' ,
                unread: [],
            }
        },
        mounted(){
            this.listen();
//            console.log("here are");
//
        },
        created() {
//            alert('testing');
//            axios.get(this.prefixUrl+'packages/unread').then( response => {
//                this.unread = response.data.unread;
//                console.log(this.unread);
//            });
        },

        computed:{
            notifications(){
                if(typeof this.unread === 'undefined' || this.unread === null || this.unread < 0){
                    return 0;
                }
                else{
                    return this.unread.length;
                }
            }
        },

        methods: {
            listen(){
                window.Echo.private('App.User.' + this.data_id)
                .listen('PackageNotification', (e) => {
                    console.log(e.package);
                    this.unread.push(e.package);
                });
            }

        }

    }
</script>

<style lang="css">
    #badge{
        font-size: 60%;
        position:absolute;
        top: .6em;
        right: .3em;
        z-index: 99;
    }

</style>
