<template>
    <div class="home">
        <navbar/>

        <div class="container page">
            <h1> Détails de " {{model.name}} " </h1>
            <br>
            <p> Description : {{model.description}} </p>
            <p> Prix : {{model.price}} € </p>
            <p> Range : {{model.range}} </p>

            <h3> Ingrédients </h3>
            <ul v-for="item in model.modelIngredients" :key="item.name">
                <li> {{ item.ingredient.name }}  ( {{item.grammage}} g) </li>
            </ul>

            <h3> Process </h3>
            
            <p> Name : {{ model.process.name }} </p>
            <p> Description : {{ model.process.description }} </p>

            <p> Etapes </p>
            <ol v-for="item in model.process.steps" :key="item.name">
                <li> {{ item.foo }} </li>
            </ol>

                        
            <router-link :to="{path: '/updateModel/' + model.id}">
                <button class="btn btn-warning"> Modifier </button> 
            </router-link>

            <button class="btn btn-danger" v-on:click="deleteModel(model.id)"> Supprimer </button> 


        </div>

    </div>
</template>


<script>
    import Navbar from '../components/Navbar.vue';
    import ModelService from '../servicies/models.service';


    export default {
        components: {Navbar},

        data(){
            return {
                model : []
            }
        },
 
        async mounted(){
            this.model = await ModelService.getSingleModel(this.$route.params.id)
        },

        methods : {
            deleteModel : function(id){
                ModelService.deleteModel(id)
            }
        }
    }

</script>


