let url = 'http://localhost/cosmin/backend/connection.php';
let header = new Headers();
header.append('Content-type', 'application/json');
let request = new Request(url, {
    headers: header,
    method: 'GET',
});
fetch(request)
    .then((response) => response.json())
    .then((json) => {
        let count_sem_1 = 0;
        let count_sem_2 = 0;

        let table = document.getElementById("table");
        for (let element of json) {
            let row = table.insertRow();
            for (key in element) {
                let cell = row.insertCell();
                let text = document.createTextNode(element[key]);
                cell.appendChild(text);
                if (element[key] == "semafor1") {
                    count_sem_1++;
                }
                if (element[key] == "semafor2") {
                    count_sem_2++;
                }
            }
        }
        let notification = document.getElementById("notification");
        let text = document.createTextNode(`Semaforul 1 a fost verde de ${count_sem_1} ori, iar semaforul 2 a fost verde de ${count_sem_2} ori.`);
        notification.appendChild(text);

    })
    .catch(console.warn)