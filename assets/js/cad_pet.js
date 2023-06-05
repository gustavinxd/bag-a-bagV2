// var pesoInput = document.getElementById('peso');

// pesoInput.addEventListener('blur', function () {
//     var peso = pesoInput.value.trim();
//     var pesoDecimal = parseFloat(peso);

//     if (peso !== '') {
//         var pesoDecimal = parseFloat(peso);

//         if (pesoDecimal > 9 && pesoDecimal >=0) {
//             pesoInput.value = '9 kg';
//         } else {
//             pesoInput.value = peso + ' kg';
//         }
//     } else {
//         pesoInput.value = '';
//     }
// });

// var dataNascInput = document.getElementById('data_nasc_pet');
// dataNascInput.addEventListener('blur', function () {
//     var dataNasc = new Date(dataNascInput.value);
//     var hoje = new Date();

//     var limiteInferior = new Date();
//     limiteInferior.setFullYear(hoje.getFullYear() - 16);
//     limiteInferior.setMonth(hoje.getMonth() - 1);


//     var limiteSuperior = new Date();
//     limiteSuperior.setMonth(hoje.getMonth() - 4);
//     limiteInferior.setDate(hoje.getDate() - 1);

//     if (dataNasc > hoje || dataNasc < limiteInferior || dataNasc > limiteSuperior) {
//         alert('A idade do pet deve estar entre 4 meses e 16 anos para cadastro.');
//         dataNascInput.value = ''; // Limpa o campo de data de nascimento
//     }



// });

const input= document.querySelector('#image');

input.addEventListener("change", function(e){
    const tgt = e.target || window.event.srcElement;
    const files = tgt.files;
    const fr= new FileReader();
    fr.onload = function(){
        document.querySelector("#preview-image").src = fr.result

    }
    fr.readAsDataURL(files[0]);
})
