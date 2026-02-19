document.addEventListener("DOMContentLoaded", function () {
    const startBtn = document.getElementById("btn-start");
    const lessonBtn1 = document.getElementById("btn-number-lesson-1");
    const lessonBtn2 = document.getElementById("btn-number-lesson-2");
    const lessonBtn3 = document.getElementById("btn-number-lesson-3");
    const lessonBtn4 = document.getElementById("btn-number-lesson-4");
    const lessonBtn5 = document.getElementById("btn-number-lesson-5");
    const lessonBtn6 = document.getElementById("btn-number-lesson-6");
    const lessonBtn7 = document.getElementById("btn-number-lesson-7");
    const lessonBtn8 = document.getElementById("btn-number-lesson-8");
    const lessonBtn9 = document.getElementById("btn-number-lesson-9");
    const lessonBtn10 = document.getElementById("btn-number-lesson-10");
    const answer1 = document.getElementById("answer-1");
    const answer2 = document.getElementById("answer-2");
    const answer3 = document.getElementById("answer-3");
    const answer4 = document.getElementById("answer-4");
    const answer5 = document.getElementById("answer-5");
    const answer6 = document.getElementById("answer-6");
    const answer7 = document.getElementById("answer-7");
    const answer8 = document.getElementById("answer-8");
    const answer9 = document.getElementById("answer-9");
    const answer10 = document.getElementById("answer-10");
    const nextBtn1 = document.getElementById("btn-next-1");
    const nextBtn2 = document.getElementById("btn-next-2");
    const nextBtn3 = document.getElementById("btn-next-3");
    const nextBtn4 = document.getElementById("btn-next-4");
    const nextBtn5 = document.getElementById("btn-next-5");
    const nextBtn6 = document.getElementById("btn-next-6");
    const nextBtn7 = document.getElementById("btn-next-7");
    const nextBtn8 = document.getElementById("btn-next-8");
    const nextBtn9 = document.getElementById("btn-next-9");
    const btnSave = document.getElementById("btn-save");

    startBtn.addEventListener("click", function (e) {
        lessonBtn1.removeAttribute("disabled");
    });

    nextBtn1.addEventListener("click", function (e) {
        if (answer1.value !== "") {
            lessonBtn2.removeAttribute("disabled");
        } else {
            alert("Nenhuma opção foi selecionada.");
        }
    });

    nextBtn2.addEventListener("click", function (e) {
        if (answer2.value !== "") {
            lessonBtn3.removeAttribute("disabled");
        } else {
            alert("Nenhuma opção foi selecionada.");
        }
    });

    nextBtn3.addEventListener("click", function (e) {
        if (answer3.value !== "") {
            lessonBtn4.removeAttribute("disabled");
        } else {
            alert("Nenhuma opção foi selecionada.");
        }
    });

    nextBtn4.addEventListener("click", function (e) {
        if (answer4.value !== "") {
            lessonBtn5.removeAttribute("disabled");
        } else {
            alert("Nenhuma opção foi selecionada.");
        }
    });

    nextBtn5.addEventListener("click", function (e) {
        if (answer5.value !== "") {
            lessonBtn6.removeAttribute("disabled");
        } else {
            alert("Nenhuma opção foi selecionada.");
        }
    });

    nextBtn6.addEventListener("click", function (e) {
        if (answer6.value !== "") {
            lessonBtn7.removeAttribute("disabled");
        } else {
            alert("Nenhuma opção foi selecionada.");
        }
    });

    nextBtn7.addEventListener("click", function (e) {
        if (answer7.value !== "") {
            lessonBtn8.removeAttribute("disabled");
        } else {
            alert("Nenhuma opção foi selecionada.");
        }
    });

    nextBtn8.addEventListener("click", function (e) {
        if (answer8.value !== "") {
            lessonBtn9.removeAttribute("disabled");
        } else {
            alert("Nenhuma opção foi selecionada.");
        }
    });

    nextBtn9.addEventListener("click", function (e) {
        if (answer9.value !== "") {
            lessonBtn10.removeAttribute("disabled");
        } else {
            alert("Nenhuma opção foi selecionada.");
        }
    });
});


