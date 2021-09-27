<template>
    <div class="home">
        <navbar/>

        <div class="container page">
            <h1> Vos process </h1>


            <table class="table table-sm table-hover userTableClass">
                <thead>
                    <tr>
                        <td> <b> Nom </b> </td>
                        <td> <b> Description </b> </td>
                        <td> <b> Nb Etapes </b> </td>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="item in processes" :key="item.name" v-on:click="seeDetails(item.id)">
                        <td> {{ item.name }}</td>
                        <td> {{ item.description }} </td>
                        <td> {{ item.steps.length }} </td>
                    </tr> 
                </tbody>
            </table>
            <router-link :to="{path: '/addProcess'}">
                <button class='btn btn-success'> Ajouter un process </button>
            </router-link>        
        </div>
    </div>

</template>



<script>
    import Navbar from '../components/Navbar.vue';
    import ProcessService from '../servicies/process.service';
    import router from '../router/index'

export default {
      components: {
    Navbar,
  },
    data () {
        return {
            processes : []
        }
    },

    async mounted(){
        this.processes = await ProcessService.getProcesses()
    },

    methods:{
        seeDetails : function(id){
            router.push({path:"process/" + id})
        }
    }
}
</script>
