import ajaxGet from './Ajax'



function post(url, callback, postData){
    xmlrequest.onreadystatechange=callback
    xmlrequest.open('POST', url, true)
    let data=new FormData()
    for (let datumKey in postData){
        data.append(datumKey, postData[datumKey])
    }
    xmlrequest.send()
}

let addTaskForm=document.getElementById('addTask')
addTaskForm.addEventListener('click', (e) => {
    e.preventDefault()
    let inputMessage=document.getElementById('message').value;
    post('/actions.php', function (){
        if(xmlrequest.readyState===4 && xmlrequest.status===200){

        }
    },{message: inputMessage})
});