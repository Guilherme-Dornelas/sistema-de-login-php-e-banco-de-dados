document.addEventListener('DOMContentLoaded', function() {

   const getData = async() => {
    
        const response = await fetch('teste.php');
        const data = await response.json();
        
        let tbody = document.getElementById('tbody');
        tbody.innerHTML = '';

        data.forEach(item => {
            let element = document.createElement('tr');
            element.innerHTML = `
                <td>${item.name}</td>
                <td>${item.email}</td>
                <td>${item.birthdate}</td>
                <td>${item.created_at}</td>
            `;

            tbody.appendChild(element);
            
        });
        
        return console.log(data);
    }

    getData();

    fetch('page.php')
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                return response.text();
            }
        })
        .then(data => {
            if (data) {
                console.log(data);
                // document.getElementById('userName').textContent = data;
            } else {
                console.log('Usuário não está logado');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

const btnSair = document.getElementById('sair');
btnSair.addEventListener('click', function() {
    fetch('logout.php')
        .then(response => response.json())
        .then(data => {
            if (data.message === "Logout bem-sucedido") {
                window.location.href = 'login.html';
            } else {
                console.log('Erro ao fazer logout');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });  
        
     
});