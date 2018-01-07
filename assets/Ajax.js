export default class AjaxRequest {

    constructor() {
        this.ajaxRequest=new XMLHttpRequest()
    }

    ajaxGet(url) {
        return this.ajaxGetDelete('GET', url)
    }

    ajaxPost(url, postData){
        return this.ajaxPostPut('POST', url, postData)
    }

    ajaxPut(url, putData){
        return this.ajaxPostPut('PUT', url, putData)
    }

    ajaxDelete(url){
        return this.ajaxGetDelete('DELETE', url)
    }

    ajaxPostPut(method, url, dataToSend){
        return new Promise((resolve, reject) => {
            this.ajaxRequest.onload = () => resolve(this.ajaxRequest.response)
            this.ajaxRequest.onerror = () => reject(new Error(this.ajaxRequest.statusText))
            this.ajaxRequest.open(method, url)
            let data = new FormData()
            for (let [datumKey, datum] of Object.entries(dataToSend)) {
                data.append(datumKey, datum)
            }
            this.ajaxRequest.send(data)
        })
    }

    ajaxGetDelete(method, url){
        return new Promise((resolve, reject) => {
            this.ajaxRequest.onload = () => resolve(this.ajaxRequest.response)
            this.ajaxRequest.onerror = () => reject(new Error(this.ajaxRequest.statusText))
            this.ajaxRequest.open(method, url)
            this.ajaxRequest.send()
        })
    }
}