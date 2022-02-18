window.calendar_filter = (url, id, elem) => {
    const table = document.querySelector('.calendar_table')
    table.classList.add('progress_reload')
    const filter_data = elem.querySelector('.img');
    const filter_name = filter_data.classList[1];
    const filter_item = table.querySelectorAll('.'+filter_name);
    filter_item.forEach((item)=>{
        item.classList.toggle('no_display');
    })


    elem.classList.toggle('check');
    elem.classList.toggle('no_check');
    table.classList.remove('progress_reload')
    const func = (response) => {}
    const parameters = {
        'id': id
    }
    Post(url, func, parameters);
}


