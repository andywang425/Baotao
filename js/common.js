window.showError = (msg) => {
    const error_msg = $(`
    <div class="error_msg">
        <img src="img/error.svg" id="icon">
            <span id="msg">
             ${msg}
            </span>
    </div>
    `);
    $('.error_msgs').append(error_msg);
}

window.clearError = () => {
    $('.error_msgs').html('');
}
