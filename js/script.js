

function closelogin() {
    document.querySelector('#login').style.display = 'none';
}

function auth() {
    document.querySelector('#login').style.display = 'block';
}

function reg() {
    document.querySelector('#login').style.display = 'none';
    document.querySelector('#register').style.display = 'block';
}

function login() {
    document.querySelector('#register').style.display = 'none';
    document.querySelector('#login').style.display = 'block';
}

function closeregister() {
    document.querySelector('#register').style.display = 'none';
}

function user_settings() {
    document.querySelector('.user-settings').style.display = 'block'
}

function admin_settings() {
    document.querySelector('.admin-settings__emp').style.display = 'block'
}


function userlist() {
    document.querySelector('.log-list').style.maxHeight = '0px';
    document.querySelector('.admin-list').style.maxHeight = '0px';
    setTimeout(function(){ 
    document.querySelector('.log-list').style.position = 'absolute';
    document.querySelector('.admin-list').style.position = 'absolute';
    document.querySelector('.user-list').style.position = 'relative';
    document.querySelector('.user-list').style.maxHeight = '600px';
    },500);
}

function adminlist() {
    document.querySelector('.user-list').style.maxHeight = '0px';
    document.querySelector('.log-list').style.maxHeight = '0px';
    setTimeout(function(){ 
    document.querySelector('.user-list').style.position = 'absolute';
    document.querySelector('.log-list').style.position = 'absolute';
    document.querySelector('.admin-list').style.position = 'relative';
    document.querySelector('.admin-list').style.maxHeight = '600px';
    },500);
}

function logs() {
    document.querySelector('.user-list').style.maxHeight = '0px';
    document.querySelector('.admin-list').style.maxHeight = '0px';
    setTimeout(function(){ 
    document.querySelector('.user-list').style.position = 'absolute';
    document.querySelector('.admin-list').style.position = 'absolute';
    document.querySelector('.log-list').style.position = 'relative';
    document.querySelector('.log-list').style.maxHeight = '600px';
},500);
}


function register() {

    let email = document.querySelector('input[name="email"]').value;
    let login = document.querySelector('input[name="reg-login"]').value;
    let password = document.querySelector('input[name="reg-password"]').value;
    let repeat_password = document.querySelector('input[name="repeat-password"]').value;

    let request = new XMLHttpRequest();
    let url = "register.php";

    let params = "email=" + email+ "&login=" + login + "&password=" + password + "&repeat_password=" + repeat_password;

    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     
    request.addEventListener("readystatechange", () => {
    
        if(request.readyState === 4 && request.status === 200) {       
            console.log(request.responseText);
            let data = request.responseText;
            if (data === '201') {
                location.reload()
                return;
            }
            document.querySelector('.error').innerHTML = data;
        }
    });
     
    request.send(params);
}

document.querySelector('#log').onclick = function logina() {

    let login = document.querySelector('input[name="login"]').value;
    let password = document.querySelector('input[name="password"]').value;
    
    let request = new XMLHttpRequest();
    let url = "login.php";

    let params = "login=" + login + "&password=" + password;

    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     
    request.addEventListener("readystatechange", () => {
    
        if(request.readyState === 4 && request.status === 200) {       
            console.log(request.responseText);
            let data = request.responseText;
            if (data === '200') {
                location.reload()
                console.log(data);
                return;
            }
            document.querySelector('.error').innerHTML = data;
        }
    });
     
    request.send(params);
}


document.querySelector('#trial').onclick = function trial() {
    console.log('q');
    let subscribe = 'trial';
    
    let request = new XMLHttpRequest();
    let url = "upload.php";

    let params = "subscribe=" + subscribe;

    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     
    request.addEventListener("readystatechange", () => {
    
        if(request.readyState === 4 && request.status === 200) {       
            console.log(request.responseText);
            let data = request.responseText;
            if (data === '200') {
                location.reload()
                console.log(data);
                return;
            }
            document.querySelector('.error').innerHTML = data;
        }
    });
     
    request.send(params);
}

