export default class AjaxRequest {
    private url
    private ajaxRequest

    constructor() {
        this.ajaxRequest=new XMLHttpRequest()
    }

    ajaxGet() {
        return new Promise(function (resolve, reject) {
            let request = new XMLHttpRequest()
            request.onload = function () {
                if (request.status === 200) {
                    resolve(request.response)
                } else {
                    reject(new Error(request.statusText))
                }
            }
            request.open('GET', url)
            request.send()
        })
    }
}