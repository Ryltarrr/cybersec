// import axios from 'axios'

// const endpoint = "https://10.117.129.2:8000/"

class ModelService{
    database = [{"id":1,"name":"Mod\u00e8le 1","description":"Premier mod\u00e8le","price":10000,"range":"Luxe","modelIngredients":[],"process":{"id":1,"name":"The Process","description":"Joel Embid tu coco","steps":[{"foo":"bar"}]}},{"id":2,"name":"name","description":"description","price":100,"range":"outdoor","modelIngredients":[],"process":{"id":1,"name":"The Process","description":"Joel Embid tu coco","steps":[{"foo":"bar"}]}},{"id":3,"name":"name","description":"description","price":100,"range":"outdoor","modelIngredients":[{"ingredient":{"id":2,"name":"name","description":"description"},"grammage":500}],"process":{"id":1,"name":"The Process","description":"Joel Embid tu coco","steps":[{"foo":"bar"}]}},{"id":4,"name":"name","description":"description","price":100,"range":"outdoor","modelIngredients":[{"ingredient":{"id":2,"name":"name","description":"description"},"grammage":500},{"ingredient":{"id":3,"name":"name","description":"description"},"grammage":800}],"process":{"id":1,"name":"The Process","description":"Joel Embid tu coco","steps":[{"foo":"bar"}]}},{"id":5,"name":"name","description":"description","price":100,"range":"outdoor","modelIngredients":[{"ingredient":{"id":2,"name":"name","description":"description"},"grammage":500},{"ingredient":{"id":3,"name":"name","description":"description"},"grammage":800}],"process":{"id":1,"name":"The Process","description":"Joel Embid tu coco","steps":[{"foo":"bar"}]}},{"id":6,"name":"name","description":"description","price":100,"range":"outdoor","modelIngredients":[{"ingredient":{"id":2,"name":"name","description":"description"},"grammage":500},{"ingredient":{"id":4,"name":"name","description":"description"},"grammage":1000}],"process":{"id":1,"name":"The Process","description":"Joel Embid tu coco","steps":[{"foo":"bar"}]}}]

    async getModels(){
        // const {data} = await axios.get(endpoint+"model");
        // console.log(data)
        const data = this.database
        return data
    }

    getSingleModel(id){
        const value = this.database.filter(object => object.id == id)[0]
        console.log(value)
        return this.database.filter(object => object.id == id)[0]
    }

    deleteModel(id){
        console.log(id)
    }

    addModel(name, description, range, price, processId, ingredientsIds){
        console.log(name)
        console.log(description)
        console.log(range)
        console.log(price)
        console.log(processId)
        console.log(ingredientsIds)
    }
    
    updateModel(id,name, description, range, price, processId, ingredientsIds){
        console.log(id)
        console.log(name)
        console.log(description)
        console.log(range)
        console.log(price)
        console.log(processId)
        console.log(ingredientsIds)
    }
}

export default new ModelService