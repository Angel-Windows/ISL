window.change_status_filter = (item) => {
    console.log(item)
}

window.calendar_filter = (url, id, elem) => {
    elem.querySelector('.img').classList.toggle('check');
    const func = (e) => {
        console.log(e)
    }
    const parameters = {
        'id': id
    }
    Post(url, func, parameters);
}


