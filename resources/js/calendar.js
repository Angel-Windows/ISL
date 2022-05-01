window.calendar_fill = ((data, data_status) => {

    data.forEach((item) => {
        console.log(data_status)
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
    calendar_new.querySelector(".student_name").innerHTML = item['first_name'] + " " + item['last_name']
    calendar_new.querySelector(".time_lesson").innerHTML = `${time[0]}:00 - ${Number(time[0]) + 1}:00`
    calendar_new.querySelector(".time_lesson").innerHTML = item['fool_time']
    if (data_status.length) {
        calendar_new.classList.add(data_status[item.status].class);
    } else {
        calendar_new.classList.add("background_calendar_normal");
    }
    calendar_item.appendChild(calendar_new)
})
