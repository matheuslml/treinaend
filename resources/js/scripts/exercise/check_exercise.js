document.addEventListener("DOMContentLoaded", async function () {
    // 🔄 Consulta no backend qual é a questão atual
    try {
        const response = await fetch("/student_current_question");
        const data = await response.json();

        if (data.current_question) {
            const btn = document.getElementById("btn-number-lesson-" + data.current_question);
            if (btn) {
                btn.removeAttribute("disabled");
                btn.click();
            }
        } else {
            // começa na primeira questão
            const firstBtn = document.getElementById("btn-number-lesson-1");
            if (firstBtn) {
                firstBtn.removeAttribute("disabled");
                firstBtn.click();
            }
        }
    } catch (error) {
        console.error("Erro ao buscar questão atual:", error);
    }

    // 🔄 Lógica de salvar cada questão
    const saveButtons = document.querySelectorAll(".btn-save");

    saveButtons.forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();

            const qIndex = parseInt(btn.getAttribute("data-question"));
            const answerSelect = document.getElementById("answer-" + qIndex);
            const questionInput = document.getElementById("question-" + qIndex);

            if (!answerSelect.value) {
                alert("Selecione uma opção antes de salvar.");
                return;
            }

            fetch("/student_save_lesson", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({
                    answer: answerSelect.value,
                    question: questionInput.value,
                })
            })
            .then(response => response.json())
            .then(data => {
                //console.log("Resposta salva:", data);
                alert("Questão " + qIndex + " salva com sucesso!");

                // 🔒 Bloqueia a questão atual
                const currentBtn = document.getElementById("btn-number-lesson-" + qIndex);
                if (currentBtn) {
                    currentBtn.setAttribute("disabled", "true");
                }

                // 🔓 Habilita e abre automaticamente a próxima questão
                const nextBtn = document.getElementById("btn-number-lesson-" + (qIndex + 1));
                if (nextBtn) {
                    nextBtn.removeAttribute("disabled");
                    nextBtn.click();
                } else {
                    // 🚀 Última  concluídaquestão → chama saveExam no backend
                    // 🚀 Última questão concluída → chama saveExam no backend
                    fetch("/save_exam")
                        .then(resp => resp.json())
                        .then(result => {
                            alert("Prova concluída com sucesso!");
                            //console.log("Resultado final:", result);

                            if (result.whatsapp_url) {
                                // Se veio a URL do WhatsApp, redireciona para lá
                                window.location.href = result.whatsapp_url;
                            } else if (result.discipline_id) {
                                // Caso contrário, continua para exercises_student_index
                                window.location.href = "/exercises_student_index/" + result.discipline_id;
                            }
                        })
                        .catch(err => {
                            console.error("Erro ao finalizar prova:", err);
                            alert("Erro ao finalizar a prova.");
                        });
                }
            })
            .catch(error => {
                console.error("Erro ao salvar:", error);
                alert("Erro ao salvar a questão.");
            });
        });
    });
});
