<template>
  <section class="container col-sm-offset-1">
    <div class="row col-sm-11 col-sm-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Users</div>
        <div class="panel-body">
          <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Subscription</th>
                <th>Phone</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.surname }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.subscription.name }}</td>
                <td>{{ user.phone }}</td>
                <td>
                  <a class="edit-modal btn btn-warning"
                     v-bind:href="prefixUrl + user.id + '/edit' ">
                    <span class="glyphicon glyphicon-edit"></span>
                    Edit
                  </a>
                  <button class="edit-modal btn btn-error"  @click="deleteUser(user.id)">
                    <span class="glyphicon glyphicon-trash"></span>
                    Delete
                  </button>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
    export default {
        data() {
            return {
                users:[],
                prefixUrl: '/users/'
            }
        },
        created() {
            axios.get(this.prefixUrl + 'all').then( response => {
                console.log(response);
              this.users = response.data.users;
            });
        },
        methods: {
            deleteUser: function (id) {
                axios.delete(this.prefixUrl + id).then(response => {
                    if (response.status === 200)
                        location.href = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>

<style lang="css">
</style>
