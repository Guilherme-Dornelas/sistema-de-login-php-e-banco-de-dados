document.getElementById('form').addEventListener('submit', (e) => {
    e.preventDefault();

    let nome = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let senha = document.getElementById('password').value;
    let birth = document.getElementById('birthdate').value;
    
    fetch('http://localhost/teste/index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({name: nome, email: email, password: senha, birthdate: birth}),
    })
    .then(response => response.json())
    .then(data => {
        if (data) {
            console.log('Cadastrado com sucesso');
            window.location.href = 'login.html';
        } else {
            console.log('Erro ao cadastrar:', data.message);
        }
    })
    .catch(error => console.error('Erro ao cadastrar:', error));
});
