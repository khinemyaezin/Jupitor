export default class Connection{
    _token;
    constructor() {
        this._token = $('meta[name="csrf-token"]').attr('content');
    }
    post(url,data){
        return new Promise( (res,rej)=>{
            this._request(url,'POST',data,
            function(response){
                res(response);
            },
            function(error){
                console.log( error );
                rej();
            });
        });
    }
    get(url,body=undefined){
        return new Promise( (res,rej)=>{
            this._request(url,'GET',body,
            function(response){
                res(response);
            },
            function(error){
                console.log( error );
                rej();
            });
        });
    }
    put(url,data){
        return new Promise( (res,rej)=>{
            this._request(url,'PUT',data,
            function(response){
                res(response);
            },
            function(error){
                console.log( error );
                rej();
            });
        });
       
    }
    delete(url){
        return new Promise( (res,rej)=>{
            this._request(url,'DELETE',{},
            function(response){
                res(response);
            },
            function(error){
                console.log( error );
                rej();
            });
        });
    }

    _request(url,method,reqData=undefined, callbackSuccess, callbackError){
        let param = {
            url: url,
            type: method,
            datatype: 'json',
            success: callbackSuccess,
            error: callbackError
        }
        if(reqData){
            reqData._token = this._token;
            param.data = reqData;
            
        }
        $.ajax(
            param
        ).fail(function(jqXHR, textStatus, error) {
            alert(jqXHR.responseText);
        });
    }
}