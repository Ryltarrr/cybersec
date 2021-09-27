const database = [
    {
       "id":1,
       "name":"process1",
       "description":"zazazdazd",
       "steps":[
          {
             "number":1,
             "description":"azeazeaz"
          }
       ]
    }
]


class ProcessService{

    getProcesses(){
        return database
    }

    getSingleProcess(id){
        console.log(database.filter(object => object.id == id)[0])
        return database.filter(object => object.id == id)[0]
    }

    addProcess(name, description, steps){
        console.log(name)
        console.log(description)
        console.log(steps)
    }

    deleteProcess(id){
        console.log(id)
    }

    updateProcess(id, name, description,steps){
        console.log(id)
        console.log(name)
        console.log(description)
        console.log(steps)
    }
}

export default new ProcessService