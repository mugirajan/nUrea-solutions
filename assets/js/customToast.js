function customToast(msg,type) {
    var tst = {
        message: msg,
        position: 'south',
        timeout: 3000,
        type: type,
    };
    nativeToast(tst);
}