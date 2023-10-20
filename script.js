// Add this to your existing script.js

document.getElementById("create-note-button").addEventListener("click", function () {
    // Check if there are unsaved notes
    const unsavedNotes = document.querySelectorAll(".note-box:not(.saved)");

    if (unsavedNotes.length > 0) {
        const confirmSave = confirm("Do you want to save your unsaved notes before leaving?");

        if (confirmSave) {
            // You can add code here to save the notes
            alert("Notes saved!");
        }
    }
    // Navigate to the home page
    window.location.href = "home.html"; // Replace with your home page URL
});
const parentItems = document.querySelectorAll('.Foldername');
parentItems.forEach((parent) => {
    parent.addEventListener('click', function () {
        if (event.target.closest('.file') === null) {
            const subList = this.querySelector('.file');
            subList.style.display = subList.style.display === 'none' ? 'block' : 'none';
            this.classList.toggle('opened');
        }
    });
});


