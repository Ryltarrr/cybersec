
<template>
    <div class="home">
        <navbar/>

        <div class="container page">
            <h1> Vos modèles </h1>


            <table class="table table-sm table-hover userTableClass">
                <thead>
                    <tr>
                        <td> <b> Nom </b> </td>
                        <td> <b> Description </b> </td>
                        <td> <b> Type </b> </td>
                        <td> <b> Prix </b> </td> 
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="item in models" :key="item.name" v-on:click="seeDetails(item.id)">
                        <td> {{ item.name }}</td>
                        <td> {{ item.description }} </td>
                        <td> {{ item.range }} </td>
                        <td> {{ item.price }} € </td>
                    </tr> 
                </tbody>
            </table>
            <router-link :to="{path: '/addModel'}">
                <button class='btn btn-success'> Ajouter un modèle </button>
            </router-link>
        </div>
    </div>

</template>



<script>
    import Navbar from '../components/Navbar.vue';
    import ModelService from '../servicies/models.service';
    import router from '../router/index'
export default {
      components: {
    Navbar,
  },
    data () {
        return {
            models : []
        }
    },

    async mounted(){
        this.models = await ModelService.getModels()
    },

    methods:{
        seeDetails : function(id){
            console.log("Details of : " + id)
            router.push({path:"models/" + id})
        },
    }
}
</script>
