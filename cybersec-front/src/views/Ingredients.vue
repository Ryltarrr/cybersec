
<template>
    <div class="home">
        <navbar/>

        <div class="container page">
            <h1> Vos ingrédients </h1>


            <table class="table table-sm table-hover userTableClass">
                <thead>
                    <tr>
                        <td> <b> Nom </b> </td>
                        <td> <b> Description </b> </td>
                        <td> <b> Actions </b> </td>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="item in ingredients" :key="item.name">
                        <td> {{ item.name }}</td>
                        <td> {{ item.description }} </td>
                        <td>
                            <router-link :to="{path: '/updateIngredient/' + item.id}">
                                <button class="btn btn-warning" v-on:click="modifyIngredient(item.id)"> Modify </button>
                            </router-link>
                            <button class="btn btn-danger" v-on:click="deleteIngredient(item.id)"> Supprimer </button> 
                        </td>

                    </tr> 
                </tbody>



            </table>
            <router-link :to="{path: '/addIngredient'}">
                <button class='btn btn-success'> Ajouter un ingrédient </button>
            </router-link>
        </div>
    </div>

</template>



<script>
    import Navbar from '../components/Navbar.vue'
    // import Ingredient from '../models/ingredient'
    import IngredientService from '../servicies/ingredients.service'

export default {
      components: {
    Navbar,
  },
    data () {
        return {
            ingredients : [],
        }
    },
    methods:{
        deleteIngredient : function(id){
            IngredientService.deleteIngredient(id)
        }
    },
    
    async mounted(){
        this.ingredients = await IngredientService.getIngredients()
    }
}
</script>
