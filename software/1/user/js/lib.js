

//⚠️警告，再引入lib.js之前，请先引入服务器的公共lib.js文件，例如<script src="http://地址/js/lib.js"></script>

//此lib文件为插件专用的集成函数库

$APP_HOST_API = $HOST + "/software"; //公共插件api地址

//检查登录状态，如果失败直接跳转登录
function checkLoginForApp() {
    if (checkLoginToken()) {

        checkLoginTokenIsTrue();

    } else {
        window.location.href = $HOST_HOME;//$HOST_HOME未lib.js中定义，服务器地址
    }
}
