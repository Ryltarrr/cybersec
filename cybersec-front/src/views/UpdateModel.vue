
<template>
    <div class="home">
        <navbar/>

        <div class="container page">
            <h1> Modifier un modèle </h1>

            <div>
                <v-form v-on:submit="submitForm" action="#" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom </label>
                        <input type="text" class="form-control" placeholder="Entrez le nom du modèle" v-model="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description </label>
                        <textarea class="form-control"  placeholder="Entrez la description du modèle" v-model="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Type </label>
                        <input type="text" class="form-control" placeholder="Entrez le nom du modèle" v-model="range">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Prix </label>
                        <input type="text" class="form-control" placeholder="Entrez le nom du modèle" v-model="price">
                    </div>

                    <h3> Process </h3>
                    Sélectionnez votre process
                    <div class="form-group">
                        <select v-model="process">
                            <option v-for="item in processesList" :key='item' :value='item.id'> {{ item.name }}</option>
                        </select>

                    </div>
                    
                    <h3> Ingrédients </h3>
                    <ol>
                        <li v-for="(item,index) in ingredients" :key="index">
                            <select name="ingredients" v-model="ingredients[index]">
                                <option v-for="item in ingredientList" :key='item' :value="item.id"> {{ item.name }}</option>
                            </select>
                        </li>
                    </ol>

                    <div>
                        <button v-on:click="addIngredient" class="btn btn-success"> Ajouter un ingrédient </button>
                        <button v-on:click="removeIngredient" class="btn btn-danger"> Supprimer un ingrédient </button>
                    </div>

                    <button v-on:click="submitForm" class="btn btn-primary"> Confirmer </button>
                </v-form>            
            </div>
        </div>
    </div>
</template>
    

<script>
    import Navbar from '../components/Navbar.vue'
    import ProcessService from '../servicies/process.service'
    import IngredientService from '../servicies/ingredients.service'
    import ModelService from '../servicies/models.service'

    export default {
      components: { Navbar},
        data(){
            return {
                name:'',
                description : '',
                range : "",
                price :"",
                processesList : [],
                process : "",
                ingredients : [],
                ingredientList : []
            }
        },

        async mounted(){
            console.log("coucou")
            this.processesList = await ProcessService.getProcesses()
            this.ingredientList = await IngredientService.getIngredients()

            const model = ModelService.getSingleModel(this.$route.params.id)
            this.id = model.id
            this.name = model.name
            this.description = model.description
            this.range = model.range
            this.price = model.price
            this.process = model.process.id
            this.ingredients = [""]
            this.ingredients = model.modelIngredients.map(elem => elem.ingredient.id)
        },

        methods : {
            submitForm : function(){
                ModelService.updateModel(this.id,this.name,this.description,this.range,this.price,this.process,this.ingredients)
            },

            addIngredient : function(){
                this.ingredients.push("")
            },

            removeIngredient : function(){
                this.ingredients.pop()
            },
        }
    }
</script>
