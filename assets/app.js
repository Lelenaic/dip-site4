import AjaxRequest from './Ajax.js'

let ajax=new AjaxRequest(),
    tasksDiv=document.getElementById('tasks')


document.addEventListener('submit', (e) => {
    e.preventDefault()
    if(e.target && e.target.id==='addTask') {
        let inputEl = document.getElementById('message')

        ajax.ajaxPost('actions.php', {message: inputEl.value, action: 'add'}).then((data) => {
            ajax.ajaxGet('message.php?id=' + data).then((data) => tasksDiv.insertAdjacentHTML('beforeend', data))
            inputEl.value=""
        })
    }else if(e.target && e.target.id==='deleteTask') {
        if (!confirm('Êtes-vous sûr(e) ?')) return false;
        let taskIdToDelete = e.target.querySelector('#taskId').value
        let divToHide = document.getElementById('task' + taskIdToDelete);
        ajax.ajaxDelete('actions.php?id=' + taskIdToDelete).then(() => divToHide.style.display = 'none')
    }else if(e.target && e.target.id==='overTask') {
        let taskIdToFinish = e.target.querySelector('#taskId').value
        let divToStrike = document.getElementById('task' + taskIdToFinish);
        ajax.ajaxPut('actions.php?id='+taskIdToFinish, {}).then(() => {
            divToStrike.className+=' strike-text'
            e.target.style.display = 'none'
        })
    }
});