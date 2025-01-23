// 此文件式关于本项目的一些常用方法，统一封装到此文件中，方便调用
// 如果添加了新的方法，请在此文件中添加注释说明并且在开发者文档中增加对应的说明，方便他人使用

//2024-12-29

// ----------------------------------

/* 主机地址 */const $MAIN = "http://127.0.0.1";

const $HOST = $MAIN + "/php";
const $HOST_HOME = $MAIN + "/login.html"//登录页
const $HOST_SW = $MAIN + "/php/software";//软件相关api

/* 请注意开发的时候修改为开发地址，部署服务使应当修改为服务器地址 */

// ----------------------------------


//检查登录状态以及验证token的是否存在
function checkLoginToken() {
    let token = getToken();
    if (token == null) {
        return false;
    } else {
        console.log("token: " + token);
        return true;
    }
}

//检查token是否合法，如果合法则log，否则执行loginOut
function checkLoginTokenIsTrue() {
    let token = getToken();
    if (!token) {
        top.location.reload();//整个标签页刷新而不是单单iframe
        window.location.href = $HOST_HOME;//避免非iframe的访问
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", $HOST + "/checkToken.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let response = JSON.parse(xhr.responseText);
            if (response.code == 200) {
                console.log("token is true");
            }else{
                loginOut();
            }
        }
    }
    xhr.send("token=" + token);
}

//获取token，全局
function getToken() {
    return localStorage.getItem("token");
}

//退出登录
function loginOut() {

    localStorage.removeItem("token");
    top.location.reload();
}