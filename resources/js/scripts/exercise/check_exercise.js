document.addEventListener("DOMContentLoaded", function () {
    const startBtn = document.querySelector("#question-0-vertical .btn-next");

    if (startBtn) {
        startBtn.addEventListener("click", function (e) {
            e.preventDefault();

            // Pegue o exercise_id do blade (ex: via data-attribute)
            const exerciseId = startBtn.getAttribute("data-exercise-id");

            fetch(`/exercise/check/${exerciseId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.allowed) {
                        // Se permitido, avança para o próximo step
                        const stepper = new window.Stepper(document.querySelector('.bs-stepper'));
                        stepper.next();
                    } else {
                        alert("Você não tem permissão para iniciar esta prova.");
                    }
                })
                .catch(err => {
                    console.error("Erro na verificação:", err);
                    alert("Erro ao verificar permissão.");
                });
        });
    }
});
