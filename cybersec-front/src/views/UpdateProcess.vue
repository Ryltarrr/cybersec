
<template>
    <div class="home">
        <navbar/>

        <div class="container page">
            <h1> Modifier un process </h1>

            <div>
                <v-form v-on:submit="submitForm" action="#" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom </label>
                        <input type="text" class="form-control" placeholder="Entrez le nom du process" v-model="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Description </label>
                        <textarea class="form-control"  placeholder="Entrez la description du process" v-model="description"></textarea>
                    </div>

                    <h3> Etapes </h3>
                    <ol>
                        <li v-for="(item,index) in steps" :key="index"><input type="text" class="form-control" v-model="steps[index]"></li>
                    </ol>

                    <div>
                        <button v-on:click="addStep" class="btn btn-success"> Ajouter une étape </button>
                        <button v-on:click="removeStep" class="btn btn-danger"> Supprimer une étape </button>

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

    export default {
      components: { Navbar},
        data(){
            return {
                id : '',
                name:'',
                description : '',
                steps : ["","",""]
            }
        },

        mounted(){
            const process = ProcessService.getSingleProcess(this.$route.params.id)
            this.id = process.id
            this.name = process.name
            this.description = process.description
            const steps = process.steps.map(item => item.description)
            this.steps = steps
        },

        methods : {
            submitForm : function(){
                ProcessService.updateProcess(this.id,this.name,this.description,this.steps)
            },

            addStep : function(){
                this.steps.push("")
            },

            removeStep : function(){
                this.steps.pop()
            }
        }
    }
</script>
