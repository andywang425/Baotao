$('input[type=submit]').on('click', () => {
    const username = $('#username').val();
    const password = $('#password').val();
    if (!username) {
        window.clearError();
        window.showError(`用户名不能为空`);
        return false;
    }
    if (!password) {
        window.clearError();
        window.showError(`密码不能为空`);
        return false;
    }
    return true;
});
