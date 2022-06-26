const popup_top = document.querySelector('.popup_top')
let timeout_popup;
window.calendar_filter = (url, id, elem) => {
    let table = document.querySelector('.transactions')
    if (!table) {
        table = document.querySelector('.calendar_new');
        table.classList.add('progress_reload')
        const filter_data = elem.querySelector('.img');
        const filter_name = filter_data.classList[1];
        const filter_item = table.querySelectorAll('.' + filter_name);
        filter_item.forEach((item) => {
            item.classList.toggle('no_display');
        })

    } else {

    }

    const func = (request) => {

        fill_transaction(request);
    }
    const parameters = {
        'id': id
    }
    Post(url, func, parameters);
    elem.classList.toggle('check');
    elem.classList.toggle('no_check');
    table.classList.remove('progress_reload')
}

function split_teg_ajax(tegs, modal_name) {
    const id = tegs[0].querySelector(`.${modal_name}`);
    let test;
    if (modal_name === 'created_at') {
        test = tegs[1][modal_name].replace(/[A-z]/g, ' ').substr(0, 19)
    }else if (modal_name === 'type') {
        test = data_type[tegs[1][modal_name]]
    }else if (modal_name === 'status') {
        test = data_status[tegs[1][modal_name]]
    } else {
        test = tegs[1][modal_name];
    }
    id.innerHTML = test;

    // id.innerHTML = tegs[1].(`.${modal_name}`).innerHTML;
}


function fill_transaction(request) {
    const transactions = document.querySelector('.transactions tbody');
    if (!transactions) {
        return false
    }
    const transactions_default = document.querySelector('.transactions thead .default_list');
    transactions.innerHTML = ""
    request['new_data'].data.forEach((item) => {
        const transactions_default_new = transactions_default.cloneNode(true)
        const tags = [transactions_default_new, item]
        split_teg_ajax(tags, 'id');
        split_teg_ajax(tags, 'student_name');
        split_teg_ajax(tags, 'professor_name');
        split_teg_ajax(tags, 'amount');
        split_teg_ajax(tags, 'type');
        split_teg_ajax(tags, 'status');
        split_teg_ajax(tags, 'created_at');
        split_teg_ajax(tags, 'balance');
        transactions_default_new.classList.remove("no_display")
        transactions.appendChild(transactions_default_new)
    })
}

window.add_lesson = (form) => {
    form.classList.add('progress_reload')
    const func = (request) => {
        form.classList.remove('progress_reload')
        calendar_add_item(request.data.item, request.data.filters);

    }
    PostForm(form, func);
}
window.info_events = (e, form_name) => {
    const form = document.getElementById(form_name)
    const id = document.querySelector(`.transaction_info .id`).innerHTML;
    const new_input = [
        {name: "event", value: e},
        {name: "id", value: id},
    ]
    create_html("input", new_input, form)
    const func = (res) => {
    }
    PostForm(form, func);
}
window.lesson_info_events = (e, form_name) => {
    const form = document.getElementById(form_name)
    const id = document.querySelector(".lesson_info .id").innerHTML;
    const new_input = [
        {name: "event", value: e},
        {name: "id", value: id},
    ]
    create_html("input", new_input, form)
    const func = (res) => {
        const calendar_item = document.querySelector('#id' + id)
        if (res.code === 1) {
            const balance = document.querySelector(".lesson_info .balance");
            switch (res.type) {
                case 1: {
                    fresh_buttons("success")
                    balance.innerHTML = Number(balance.innerHTML) - Number(balance.title);
                    calendar_item.className = "lesson_item background_calendar_success";
                    break;
                }
                case 2: {
                    fresh_buttons("closed")
                    calendar_item.className = "lesson_item background_calendar_closed";
                    break;
                }
                case 3: {
                    fresh_buttons("normal")
                    balance.innerHTML = Number(balance.innerHTML) + Number(balance.title);
                    calendar_item.className = "lesson_item background_calendar_transfer";
                    break;
                }
            }
            popup_top.classList.remove('error')
        } else {
            popup_top.classList.add('error')
        }
        popup_top.innerHTML = res.message;
        popup_top.classList.add("open")
        clearTimeout(timeout_popup);
        timeout_popup = setTimeout(() => {
            popup_top.classList.remove("open")
        }, 3000);
    }
    PostForm(form, func);
}
const fresh_buttons = (news) => {
    const button_fool = document.querySelectorAll(`.lesson_info .button`);
    if (news === "transfer") {
        news = "normal";
    }
    const button_new = document.querySelectorAll(`.lesson_info .${news}`);
    button_fool.forEach((item) => {
        item.classList.add('no_display')
    })
    button_new.forEach((item) => {
        item.classList.remove('no_display')
    })
}
window.change_menu_right = () => {
    let right_menu_active;
    const menu_right_fool = document.querySelectorAll(".menu_item")
    switch (localStorage.getItem("menu_right")) {
        case "1":
            right_menu_active = document.querySelectorAll(".content_info");
            break;
        case "2":
            right_menu_active = document.querySelectorAll(".add_lesson");
            break;
        case "3":
            right_menu_active = document.querySelectorAll(".lesson_info");
            break;
        case "4":
            right_menu_active = document.querySelectorAll(".transaction_info");
            break;
        default:
            console.warn("no active " + localStorage.getItem("menu_right"))
            return false;
    }

    if (right_menu_active[0].classList.contains('content_info') && !right_menu_active[0].classList.contains('no_display')) {
        [...menu_right_fool].forEach((item) => {
            item.classList.add("no_display")
        });
        return false;
    }
    [...menu_right_fool].forEach((item) => {
        item.classList.add("no_display")
    });
    [...right_menu_active].forEach((item) => {
        item.classList.remove("no_display")
    });
}

window.menu_right_open = (e) => {
    target_menu_right(e)
}


window.lesson_info_open = (e) => {
    const url = url_info;

    const lesson_infos = document.querySelector('.lesson_info');
    lesson_infos.classList.add('progress_reload')

    const func = (response) => {
        fresh_buttons(e.className.replace(/lesson_item background_calendar_/g, ""))
        target_menu_right(3)
        const balance = lesson_infos.querySelector('.balance');
        const {price_lesson} = response.data;
        lesson_infos.querySelector('.id').innerHTML = response.data.id
        lesson_infos.querySelector('.name').innerHTML = response.data.name
        lesson_infos.querySelector('.date').innerHTML = response.data.date
        lesson_infos.querySelector('.time').innerHTML = response.data.time
        balance.innerHTML = response.data.balance;
        balance.title = price_lesson
        lesson_infos.classList.remove('progress_reload')
        localStorage.setItem('menu_right', 1);
    }
    const parameters = {
        'id': e.id.replace(/id/, "")
    }
    Post(url, func, parameters);
}
old_transaction_active = undefined;
window.transaction_info_open = (from) => {
    function change_modal(modal_name) {
        const id = transaction_info.querySelector(`.${modal_name}`);
        id.innerHTML = from.querySelector(`.${modal_name}`).innerHTML;
    }

    from.classList.add("active");
    if (old_transaction_active !== from && old_transaction_active) {
        old_transaction_active.classList.remove("active");
    }
    old_transaction_active = from;
    const transaction_info = document.querySelector('.transaction_info');
    target_menu_right(4)
    change_modal("id");
    change_modal("student_name");
    change_modal("type");
    change_modal("status");
    change_modal("balance");
    change_modal("amount");

    const func = (response) => {
        // const {price_lesson} = response.data;
        // lesson_infos.querySelector('.id').innerHTML = response.data.id
        // lesson_infos.querySelector('.name').innerHTML = response.data.name
        // lesson_infos.querySelector('.date').innerHTML = response.data.date
        // lesson_infos.querySelector('.time').innerHTML = response.data.time
        // balance.title = price_lesson
        // lesson_infos.classList.remove('progress_reload')
        // localStorage.setItem('menu_right', 1);
    }
    // const parameters = {
    //     'id': e.querySelector("input[name='id']").value
    // }
    // Post(url, func, parameters);
}

window.target_menu_right = (target) => {
    localStorage.setItem('menu_right', target);
    change_menu_right();
}

change_menu_right()
