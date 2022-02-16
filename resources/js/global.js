let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

window.Post=(url, func = ()=>{}, parameters = {})=> {
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
            body: parameters
        });

        if (!res.ok) {
            throw new Error(`Не удалось получить ${url}, статус: ${res.status}`);
        }
        return await res.json();
    }
}
