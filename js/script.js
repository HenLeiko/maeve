let loginlinkopen = document.querySelector('.form__link-login');
let login_open = document.querySelector('#auth');
let registerlinkopen = document.querySelector('.form__link-register');
let closelogin = document.querySelector('.close-login');
let closeregister = document.querySelector('.close-register');

closelogin.onclick = function () {
    document.querySelector('#login').style.display = 'none';
}

registerlinkopen.onclick = function () {
    document.querySelector('#login').style.display = 'none';
    document.querySelector('#register').style.display = 'block';
}

loginlinkopen.onclick = function () {
    document.querySelector('#register').style.display = 'none';
    document.querySelector('#login').style.display = 'block';
}

closeregister.onclick = function () {
    document.querySelector('#register').style.display = 'none';
}

login_open.onclick = function () {
    document.querySelector('#login').style.display = 'block';
}

function userlist() {
    document.querySelector('.admin-list').style.display = 'none';
    document.querySelector('.log-list').style.display = 'none';
    document.querySelector('.user-list').style.display = 'block';
}

function adminlist() {
    document.querySelector('.user-list').style.display = 'none';
    document.querySelector('.log-list').style.display = 'none';
    document.querySelector('.admin-list').style.display = 'block';
}

function log() {
    document.querySelector('.user-list').style.display = 'none';
    document.querySelector('.admin-list').style.display = 'none';
    document.querySelector('.log-list').style.display = 'block';
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
                return;
            }
            document.querySelector('.error').innerHTML = data;
        }
    });
     
    request.send(params);
}
