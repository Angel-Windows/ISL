let global_count = [];
for (let i = 0; i < 7; i++) {
    global_count.push([])
}

window.calendar_fill = ((data, data_status) => {
    data.forEach((item) => {
        calendar_item_fill(item, data_status)
    })
})

window.calendar_item_fill = ((item, data_status) => {
    const array_elem = [0, 1, 2, 3, 4, 5, 6, 0];
    const time = item.time_start.split(":");
    const fool_time = item.fool_time.split("-");
    const calendar_item = document.querySelector(`.d${fool_time[1]}-${fool_time[2]}.t${time[0]}`)
    const calendar_ = document.querySelector('#calendar_')
    const calendar_new = calendar_.cloneNode(true)
    if (data_status[item.status].display) {
        calendar_new.classList.remove('no_display')
    }
    calendar_new.id = "calendar_" + item['id']
    calendar_new.id = "calendar_" + item['id']
    calendar_new.querySelector("input[name=\"id\"]").value = item['id']
    calendar_new.querySelector(".student_name").innerHTML = item['name']
    // calendar_new.querySelector(".student_name").innerHTML = item['first_name'] + " " + item['last_name']
    calendar_new.querySelector(".time_lesson").innerHTML = `${time[0]}:00 - ${Number(time[0]) + 1}:00`
    calendar_new.querySelector(".time_lesson").innerHTML = item['fool_time']

    if (data_status.length) {
        calendar_new.classList.add(data_status[item.status].class);
    } else {
        calendar_new.classList.add("background_calendar_normal");
    }
    calendar_item.appendChild(calendar_new)
})
window.calendar_add_item = (item, data_status) => {
    const time = item.time_start.split(":");
    const array_elem = [7, 1, 2, 3, 4, 5, 6];
    const calendar = document.querySelector('.calendar_new');
    if (!calendar) {
        console.warn("Calendar is not defined")
        return null;
    }
    const calendar_day = calendar.querySelectorAll('.day')[array_elem[item.day_week]];
    const new_lesson_item = calendar.querySelector('.lesson_item').cloneNode(true);
    if (data_status) {
        if (!data_status[item.status].display) {
            new_lesson_item.classList.add('no_display')
        }
    }

    new_lesson_item.classList.add(data_status[item.status].class);
    new_lesson_item.style.top = (time[0] * 45) + 50 + "px";
    new_lesson_item.id = "id" + item.id;
    new_lesson_item.querySelector('.name').innerHTML = item['name'];
    // new_lesson_item.querySelector('.name').innerHTML = item['first_name'] + " " + item['last_name'];
    new_lesson_item.querySelector('.lessons_time').innerHTML = `${time[0]}:00 - ${Number(time[0]) + 1}:00`;
    new_lesson_item.addEventListener("click", function () {
        lesson_info_open(this);
    })
    if (global_count[item.day_week][time[0]]) {
        const default_element = global_count[item.day_week][time[0]].item.querySelector('.count');
        global_count[item.day_week][time[0]].count++;
        global_count[item.day_week][time[0]].list = new_lesson_item;
        default_element.innerHTML = global_count[item.day_week][time[0]].count;
        default_element.style.display = "block";
    } else {
        global_count[item.day_week][time[0]] = {
            item: new_lesson_item,
            count: 0,
            list: null
        }
        calendar_day.appendChild(new_lesson_item);
    }
}

window.calendar_fill_new = (data, data_status) => {
    document.querySelector('.calendar_new').scrollTo(0, 1000);
    data.forEach((item) => {
        calendar_add_item(item, data_status);
    })
    // global_count.forEach((items) => {
    //     items.forEach((item) => {
    //         item.item.addEventListener("click", function () {
    //             lesson_info_open(this);
    //         })
    //     })
    // })
}

