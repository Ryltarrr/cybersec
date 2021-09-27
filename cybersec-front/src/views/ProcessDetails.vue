<template>
    <div class="home">
        <navbar/>

        <div class="container page">

            
            <h1> Détail du process : {{ process.name }} </h1>
            <p> Description : {{ process.description }} </p>

            <p> Etapes </p>
            <ol v-for="item in process.steps" :key="item.name">
                <li> {{ item.description }} </li>
            </ol>
            
            <router-link :to="{path: '/updateProcess/' + process.id}">
                <button class="btn btn-warning"> Modifier </button> 
            </router-link>
            <button class="btn btn-danger" v-on:click="deleteProcess(process.id)"> Supprimer </button> 

        </div>
    </div>
</template>


<script>
    import Navbar from '../components/Navbar.vue';
    import ProcessService from '../servicies/process.service';

    export default {
        components: {Navbar},

        data(){
            return {
                process : []
            }
        },
 
        async mounted(){
            this.process = await ProcessService.getSingleProcess(this.$route.params.id)
        },

        methods : {
            deleteProcess : function(id){
                ProcessService.deleteProcess(id)
            }
        }
    }
</script>


