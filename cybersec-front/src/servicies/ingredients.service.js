import axios from "axios"

const endpoint = "https://10.117.129.2:8000/"

class IngredientService{
    database = [
        {id: 1, name:"Frisbee 1", description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores nesciunt voluptas qui cupiditate exercitationem. Eligendi tempora eaque omnis maiores obcaecati, quis at error exercitationem atque sint in sequi ipsa ab?"},
        {id: 2, name:"Frisbee 2", description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores nesciunt voluptas qui cupiditate exercitationem. Eligendi tempora eaque omnis maiores obcaecati, quis at error exercitationem atque sint in sequi ipsa ab?"},
        {id: 3, name:"Frisbee 3", description: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores nesciunt voluptas qui cupiditate exercitationem. Eligendi tempora eaque omnis maiores obcaecati, quis at error exercitationem atque sint in sequi ipsa ab?"},
    ]
    async getIngredients(){
         //const {data} = await axios.get(endpoint+"ingredient");
        //console.log(data)
        //return data;
        return this.database
        // axios.get(endpoint + '/getIngredients')
        //     .then( (res) => {return res.data})
    }

    getSingleIngredient(id){
        const value = this.database.filter(object => object.id == id)[0]
        console.log(value)
        return this.database.filter(object => object.id == id)[0]
    }

    getIngredientTest(id){
        axios.get(endpoint + '/getIngredients' + id)
            .then( (res) => {return res.data})
    }

    addIngredient(name,description){
        console.log("Ingredient : " + name  + ' ' + description)
    }


    deleteIngredient(id){
        console.log("Delete ingredient : " + id)
    }

    updateIngredient(id,name,description){
        console.log(id)
        console.log(name)
        console.log(description)
    }
}

export default new IngredientService