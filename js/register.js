$('input[type=submit]').on('click', () => {
    const username = $('#username').val();
    const password = $('#password').val();
    const confirm_password = $('#confirm_password').val();
    // VULN：用户名和密码只有前端校验，没有后端校验
    // 直接发HTTP包即可绕过前端的用户名和密码长度限制
    // 因为数据库的用户名字段有长度限制（16位），所以无法进行XSS注入
    if (username.length < 4 || username.length > 16) {
        window.clearError();
        window.showError(`用户名的长度需在4-16以内`);
        return false;
    }
    if (password.length < 6 || password.length > 16) {
        window.clearError();
        window.showError(`密码的长度需在4-16以内`);
        return false;
    }
    if (password != confirm_password) {
        window.clearError();
        window.showError(`两次密码输入不一致`);
        return false;
    }
    return true;
});
