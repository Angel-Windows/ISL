const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
window.url_info = document.querySelector('meta[name="url_info"]').getAttribute('content');

window.PostForm = (form, func) => {
    const parameters = {}
    const temp = [...document.querySelectorAll('input, select')];
    temp.forEach((item) => {
        parameters[item.name] = item.value
    })
    Post(form.action, func, parameters);
}
window.Post = (url, func = () => {
}, parameters = {}) => {
    getResource(url, parameters)
        .then(data => {
            func(data)
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
