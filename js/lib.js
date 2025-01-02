// 此文件式关于本项目的一些常用方法，统一封装到此文件中，方便调用
// 如果添加了新的方法，请在此文件中添加注释说明并且在开发者文档中增加对应的说明，方便他人使用

//2024-12-29

// ----------------------------------

/* 主机地址 */
const $HOST = "http://127.0.0.1/php";
/* 请注意开发的时候修改为开发地址，部署服务使应当修改为服务器地址 */

// ----------------------------------


//检查登录状态以及验证token的是否有效
function checkLoginToken() {
    let token = getToken();
    if (token == null) {
        return false;
    }else{
        console.log("token: " + token);
        return true;
    }
}


function getToken() {
    return localStorage.getItem("token");
}