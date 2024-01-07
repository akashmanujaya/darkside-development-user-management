<template>
    <div class="user-table">
      <h2>Registered Users</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Salary</th>
            <th>Country</th>
            <th>City</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.salary }}</td>
            <td>{{ user.country }}</td>
            <td>{{ user.city }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    name: 'UserTable',
    data() {
      return {
        // Dummy data for the table
        users: [
          { id: 1, name: 'Dakota Rice', salary: '$36,738', country: 'Niger', city: 'Oud-Turnhout' },
          // Add more dummy user data here
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  .user-table {
    margin-left: 260px; /* Adjust based on sidebar width */
  }
  table {
    width: 100%;
    border-collapse: collapse;
  }
  table, th, td {
    border: 1px solid #ddd;
  }
  th, td {
    padding: 8px;
    text-align: left;
  }
  th {
    background-color: #f2f2f2;
  }
  </style>
  