<?php


function criarFormularioo($i) {
    date_default_timezone_set('America/Sao_Paulo');
    date_default_timezone_get();

    

    $newDate = date('Y-m-d', strtotime(' - 4 months'));
    $form_content = "";

    $form_content .= "
        <div class='row'>
            <div class='col-6'>
                <label for='peso<?php echo $i ?>' class='required' style='color: #5c9f24'>Peso máximo do Pet: <span id='peso-maximo'>9 kg</span></label>
                <input type='number' name='peso<?php echo $i ?>' max='9' class='form-control required' style='background-color: #FFF; border-color: black' id='peso'>
                <p>(1 kg incluído no transporte)</p>
            </div>
    
            <div class='col-6'>
                <label for='data_nasc_pet" . $i . "' class='required' style='color: #5c9f24'>Data de Nascimento</label>
                <input type='date' name='data_nasc_pet" . $i . "' id='data_nasc_pet' class='form-control' max='$newDate' style='background-color: #FFF; border-color: black'>
            </div>
        </div>
        <div class='row'>
            <div class='col-6'>
                <label for='img" . $i . "' class='required' style='color: #5c9f24'>Carterinha de Vacinação</label>
                <input type='file' class='form-control' maxlength='2' name='image" . $i . "' id='image' style='background-color: #FFF; border-color: black'>
            </div>
            <div class='col-1'>
                <img class='img-fluid' src='' alt='' id='preview-image'>
            </div>
                
        </div>
        
        ";
        


    // $form_content .= "
    //     <div class='row'>
    //         <div class='full-box'>
    //             <button type='submit' id='cadastrar' class='btn btn-success'>Cadastrar</button>
    //         </div>
    //     </div>";

    // $form_content .= "
    //     <script>
    //         var pesoInput = document.getElementById('peso');
    //         pesoInput.addEventListener('keypress', function(event) {
    //             var peso = pesoInput.value;
                
    //             if ((event.keyCode < 48 || event.keyCode > 57) && event.keyCode !== 46) {
    //                 event.preventDefault();
    //             }
                
    //             if (!isNaN(peso)) {
    //                 var pesoDecimal = parseFloat(peso);
                    
    //                 if (pesoDecimal > 9.00) {
    //                     pesoInput.value = '9kg';
    //                 }
    //             }
    //         });

    //         pesoInput.addEventListener('blur', function() {
    //             var peso = pesoInput.value;

    //             if (peso.trim() !== '') {
    //                 var pesoDecimal = parseFloat(peso);

    //                 if (pesoDecimal > 9) {
    //                     pesoInput.value = '9kg';
    //                 } else {
    //                     pesoInput.value = pesoDecimal + 'kg';
    //                 }
    //             } else {
    //                 pesoInput.value = '';
    //             }
    //         });

    //         var dataNascInput = document.getElementById('data_nasc_pet');
    //         dataNascInput.addEventListener('blur', function() {
    //             var dataNasc = new Date(dataNascInput.value);
    //             var hoje = new Date();
            
    //             var limiteInferior = new Date();
    //             limiteInferior.setFullYear(hoje.getFullYear() - 16);
    //             limiteInferior.setMonth(hoje.getMonth() - 1);
               
            
    //             var limiteSuperior = new Date();
    //             limiteSuperior.setMonth(hoje.getMonth() - 4);
    //             limiteInferior.setDate(hoje.getDate() - 1);
            
    //             if (dataNasc > hoje || dataNasc < limiteInferior || dataNasc > limiteSuperior) {
    //                 alert('A idade do pet deve estar entre 4 meses e 16 anos para cadastro.');
    //                 dataNascInput.value = ''; // Limpa o campo de data de nascimento
    //             }

            
            
    //         });
            
            
    //     </script>";

    return $form_content;



    
}

?>