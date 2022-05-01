const popup_top = document.querySelector('.popup_top')
let timeout_popup;
window.calendar_filter = (url, id, elem) => {
    const table = document.querySelector('.calendar_table')
    table.classList.add('progress_reload')
    const filter_data = elem.querySelector('.img');
    const filter_name = filter_data.classList[1];
    const filter_item = table.querySelectorAll('.' + filter_name);
    filter_item.forEach((item) => {
        item.classList.toggle('no_display');
    })
    elem.classList.toggle('check');
    elem.classList.toggle('no_check');
    table.classList.remove('progress_reload')
    const func = () => {
    }
    const parameters = {
        'id': id
    }
    Post(url, func, parameters);
}

window.add_lesson = (form) => {
    form.classList.add('progress_reload')


    const func = () => {
        form.classList.remove('progress_reload')
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
        const calendar_item = document.querySelector('#calendar_' + id)
        if (res.code === 1) {
            switch (res.type) {
                case 1: {
                    fresh_buttons("success")
                    calendar_item.className = "item background_calendar_success";
                    break;
                }
                case 3: {
                    fresh_buttons("normal")
                    calendar_item.className = "item background_calendar_transfer";
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
            right_menu_active = document.querySelectorAll(".info");
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
            console.log("no active " + localStorage.getItem("menu_right"))
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
    const url = e.querySelector("input[name='url']").value
    const lesson_infos = document.querySelector('.lesson_info');
    lesson_infos.classList.add('progress_reload')
    const func = (response) => {
        fresh_buttons(e.className.replace(/item background_calendar_/g, ""))
        target_menu_right(3)
        const balance = lesson_infos.querySelector('.balance');
        const {price_lesson} = response.data;
        lesson_infos.querySelector('.id').innerHTML = response.data.id
        lesson_infos.querySelector('.name').innerHTML = response.data.name
        lesson_infos.querySelector('.date').innerHTML = response.data.date
        lesson_infos.querySelector('.time').innerHTML = response.data.time
        console.log(response.data)
        balance.innerHTML = response.data.balance;
        balance.title = price_lesson
        lesson_infos.classList.remove('progress_reload')
        localStorage.setItem('menu_right', 1);
    }
    const parameters = {
        'id': e.querySelector("input[name='id']").value
    }
    Post(url, func, parameters);
}

window.transaction_info_open = (from) => {
    const transaction_info = document.querySelector('.transaction_info');
    target_menu_right(4)
    const balance = transaction_info.querySelector('.balance');
    balance.innerHTML = from.querySelector('.amount').innerHTML;
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
