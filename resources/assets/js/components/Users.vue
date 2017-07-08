<template>
  <section class="container col-sm-10 col-sm-offset-1">
    <div>
      <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Plan</th>
            <th>Phone</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr >
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.surname }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.plan }}</td>
            <td>{{ user.phone }}</td>
            <td>
              <button class="edit-modal btn btn-warning"  @click.prevent="editUser(user)">
                <span class="glyphicon glyphicon-edit"></span>
                Edit
              </button>
              <button class="edit-modal btn btn-error"  @click.prevent="deleteUser(user)">
                <span class="glyphicon glyphicon-trash"></span>
                Delete
              </button>
            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </section>
</template>

<script>
    export default {
        data() {
            return {
                user:{
                        id: 1,
                        name: 'Claudio',
                        surname: 'Djohnnatha',
                        email: 'claudio@example.com',
                        plan: 'free',
                        phone: '83998000802'
                }
            }
        },

        methods:{
            showUsers() {
              axios.get('user/').then(function (response){
                 console.log(response);
              });
            }


        }
    }
</script>

<style lang="css">
</style>
