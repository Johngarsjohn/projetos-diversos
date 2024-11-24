document.addEventListener("DOMContentLoaded", function() {
    const imcForm = document.getElementById('imcForm');
    const resultDiv = document.getElementById('result');

    imcForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const weight = parseFloat(document.getElementById('weight').value);
        const height = parseFloat(document.getElementById('height').value);

        if (isNaN(weight) || isNaN(height) || weight <= 0 || height <= 0) {
            resultDiv.innerHTML = '<p>Preencha valores válidos para peso e altura.</p>';
            return;
        }

        const imc = calculateIMC(weight, height);
        const category = getIMCCategory(imc);

        resultDiv.innerHTML = `
            <p>Seu IMC é: ${imc.toFixed(2)}</p>
            <p>Categoria: ${category}</p>
        `;
    });

    function calculateIMC(weight, height) {
        return weight / (height * height);
    }

    function getIMCCategory(imc) {
        if (imc < 18.5) {
            return 'Abaixo do peso';
        } else if (imc < 24.9) {
            return 'Peso normal';
        } else if (imc < 29.9) {
            return 'Sobrepeso';
        } else if (imc < 34.9) {
            return 'Obesidade grau I';
        } else if (imc < 39.9) {
            return 'Obesidade grau II';
        } else {
            return 'Obesidade grau III';
        }
    }
});


