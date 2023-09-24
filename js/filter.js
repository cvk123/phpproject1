const input = document.querySelector('.filter-input');
const allOneStudent = document.querySelectorAll('.table-row');
const allStudents = document.querySelector('.table');
const allOneStudentArray = Array.from(allOneStudent);

const studentObjects = allOneStudentArray.slice().map((oneStudent, index) => {
    return {
        id: index,
        studentName: oneStudent.querySelector(".table-cell").textContent.toLowerCase(),
        studentLink: oneStudent.querySelector("a").outerHTML
    }
})

input.addEventListener("input", () => {
    const inputText = input.value.toLowerCase();

    const filteredStudents = studentObjects.filter((student) => {
        return student.studentName.includes(inputText)
    })

    allStudents.innerHTML = "";

    filteredStudents.forEach((oneFilterStudent) => {
        const newDiv = document.createElement("div");
        newDiv.classList.add("table-row");

        const newH2 = document.createElement("div");
        newH2.classList.add("table-cell");
        newH2.innerHTML = oneFilterStudent.studentName;
        newDiv.appendChild(newH2);

        const newLink = document.createElement("div");
        newLink.classList.add("table-cell");
        newLink.innerHTML = oneFilterStudent.studentLink;
        newDiv.appendChild(newLink);

        allStudents.appendChild(newDiv);
    })
})













