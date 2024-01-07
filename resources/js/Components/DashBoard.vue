<template>
    <div class="dashboard">
      <SideBar />
      <UserTable />
    </div>
  </template>
  
  <script>
  import SideBar from './SideBar.vue'
  import UserTable from './UserTable.vue'
  
  export default {
    name: 'DashBoard',
    components: {
        SideBar,
        UserTable
    },
  };
  </script>
  
  <style scoped>
  .dashboard {
    display: flex;
  }
  </style>
  