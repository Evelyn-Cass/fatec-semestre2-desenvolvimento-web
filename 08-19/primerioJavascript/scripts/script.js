function juntarNome(){
    let nome = document.getElementById('nome').value;
    let sobrenome = document.getElementById("sobrenome").value;
    document.getElementById('nomeCompleto').innerHTML = nome + ' ' + sobrenome;
    document.getElementById("container").style.display = "flex";
}

function limpar(){
    // document.getElementById('nomeCompleto').innerHTML = '';
    // document.getElementById('nome').value = '';
    // document.getElementById('sobrenome').value = '';
    document.getElementById("nomes").reset();
    document.getElementById('nome').focus();
    document.getElementById("container").style.display = "none";
}