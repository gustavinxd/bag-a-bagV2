var pesoInput = document.getElementById('peso');
pesoInput.addEventListener('keypress', function (event) {
    var peso = pesoInput.value;

    if ((event.keyCode < 48 || event.keyCode > 57) && event.keyCode !== 46) {
        event.preventDefault();
    }

    if (!isNaN(peso)) {
        var pesoDecimal = parseFloat(peso);

        if (pesoDecimal > 9.00) {
            pesoInput.value = '9kg';
        }
    }
});

pesoInput.addEventListener('blur', function () {
    var peso = pesoInput.value;

    if (peso.trim() !== '') {
        var pesoDecimal = parseFloat(peso);

        if (pesoDecimal > 9) {
            pesoInput.value = '9kg';
        } else {
            pesoInput.value = pesoDecimal + 'kg';
        }
    } else {
        pesoInput.value = '';
    }
});

var dataNascInput = document.getElementById('data_nasc_pet');
dataNascInput.addEventListener('blur', function () {
    var dataNasc = new Date(dataNascInput.value);
    var hoje = new Date();

    var limiteInferior = new Date();
    limiteInferior.setFullYear(hoje.getFullYear() - 16);
    limiteInferior.setMonth(hoje.getMonth() - 1);


    var limiteSuperior = new Date();
    limiteSuperior.setMonth(hoje.getMonth() - 4);
    limiteInferior.setDate(hoje.getDate() - 1);

    if (dataNasc > hoje || dataNasc < limiteInferior || dataNasc > limiteSuperior) {
        alert('A idade do pet deve estar entre 4 meses e 16 anos para cadastro.');
        dataNascInput.value = ''; // Limpa o campo de data de nascimento
    }



});