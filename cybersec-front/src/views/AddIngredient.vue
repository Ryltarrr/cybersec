
<template>
    <div class="home">
        <navbar/>

        <div class="container page">
            <h1> Ajouter un ingrédient </h1>

            <div>
                <v-form v-on:submit="submitForm" action="#" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom </label>
                        <input type="text" class="form-control" placeholder="Entrez le nom de l'ingrédient" v-model="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description </label>
                        <textarea class="form-control"  placeholder="Entrez la description de l'ingédient" v-model="description"></textarea>
                    </div>

                    <button v-on:click="submitForm" class="btn btn-primary" > Confirmer</button>
                </v-form>            
            </div>
        </div>
    </div>
</template>
    

<script>
    import Navbar from '../components/Navbar.vue'
    import IngredientService from '../servicies/ingredients.service'

    export default {
      components: { Navbar},
        data(){
            return {
                name:'',
                description : ''
            }
        },
        methods : {
            submitForm : function(){
                IngredientService.addIngredient(this.name,this.description)
            }
        }
    }


</script>
