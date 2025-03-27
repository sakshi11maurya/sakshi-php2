const btns = document.querySelectorAll(".btn");
const form = document.querySelector("#myForm"); // Select the form

btns.forEach((btn) => {
    btn.addEventListener("click", () => {
        console.log("button was clicked");
        form.submit(); // Submit the form
    });
});


// const choices = document.querySelectorAll(".choice");


// choices.forEach((choice) => {
//     choice.addEventListener("click", () => {
//         const userChoice = choice.getAttribute("id");
//         playGame(userChoice);
//     });
// });

