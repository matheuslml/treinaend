document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".consult-form");
    const url = form.dataset.url;
    const reportDiv = document.querySelector(".consult-report");

    form.addEventListener("submit", async function (e) {
        e.preventDefault(); // Evita recarregar a página

        const code = document.querySelector("input[name='code']").value;
        const cpf = document.querySelector("input[name='cpf']").value;
        const course_id = document.querySelector("select[name='course_id']").value;

        reportDiv.innerHTML = "<p>Consultando dados...</p>";

        try {
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({ code, cpf, course_id })
            });

            if (!response.ok) {
                throw new Error("Erro na consulta");
            }

            const result = await response.json();
            const data = result.data;

            // Define cor e mensagem conforme qualification
            const isCompleted = data.qualification === "S";
            const bgColor = isCompleted ? "lightgreen" : "orange";
            const statusMsg = isCompleted
                ? "O Aluno Terminou o Curso" 
                : "O Aluno Não Completou o Curso";

            reportDiv.innerHTML = `
                <div class="report-card" style="background-color:${bgColor}; padding:15px; border-radius:8px;">
                    <h3>${statusMsg}</h3>
                    <p><strong>Nome:</strong> ${data.person?.full_name ?? "Não informado"}</p>
                    <p><strong>Código da Matrícula:</strong> ${data.code}</p>
                    <p><strong>Curso:</strong> ${data.course?.name ?? "Não informado"}</p>
                    ${data.person?.documents?.map(doc => `
                           <p><strong>CPF: </strong>${doc.number}</p>
                        `).join("") || "<p><strong>CPF: </strong>Nenhum documento encontrado</p>"}
                </div>
            `;
        } catch (error) {
            reportDiv.innerHTML = "<p style='color:red;'>Erro ao consultar os dados. Tente novamente.</p>";
            console.error(error);
        }
    });
});
