const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
window.url_info = document.querySelector('meta[name="url_info"]').getAttribute('content');
const popup_top = document.querySelector('.popup_top')
let timeout_popup;
window.PostForm = (form, func) => {
    const parameters = {}
    const temp = [...form.querySelectorAll('input, select')];
    const temp_checkbox = [...form.querySelectorAll('input[type="checkbox"]')];
    temp.forEach((item) => {
        parameters[item.name] = item.value
    });

    temp_checkbox.forEach((item) => {
        parameters[item.name] = item.checked
    })
    Post(form.action, func, parameters);
}

function openPopupAlert(res) {
    if (!res.message) {
        return false;
    }
    if (res.code === 1) {
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

window.Post = (url, func = () => {
}, parameters = {}) => {
    getResource(url, parameters)
        .then(data => {
            openPopupAlert(data)
            if (data.code === 1){
                func(data)
            }
        })
        .catch(error => console.error(error));

    async function getResource(url, parameters) {
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": token
            },
            // body: parameters
            body: JSON.stringify(parameters)
        });

        if (!res.ok) {
            throw new Error(`Не удалось получить ${url}, статус: ${res.status}`);
        }
        // return await res;
        return await res.json();
    }
}
window.create_html = (tag_name, values = {}, parent) => {
    values.forEach((item) => {
        const elem = document.createElement(tag_name);
        if (tag_name === 'input') {
            elem.type = "hidden"
            elem.name = item.name
            elem.value = item.value
        }
        parent.appendChild(elem)
    })
}
