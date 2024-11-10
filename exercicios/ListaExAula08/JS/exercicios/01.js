var array = []

document.getElementById("adicionar").addEventListener("click", (e) => {
    e.preventDefault();
    if (array.length != 10) {
        const numero = document.getElementById("numero").value;
        const resultado = document.getElementById("resultado");

        array.push(parseFloat(numero));

        let i = 0;
        let soma = 0;
        array.forEach(valor => {
            soma += valor;
            if (i == 0) {
                resultado.innerHTML = valor;
            }
            else {
                resultado.innerHTML += " + " + valor;
            }
            i++;
            if (i == array.length) {
                resultado.innerHTML += " = " + soma;
            }

        });

    }
    else{
        alert("10 valores adicionados!")
    }


})