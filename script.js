// Add this to your existing script.js

document.getElementById("create-note-button").addEventListener("click", function() {
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
    // Create a new note-taking box (div element)
    const noteBox = document.createElement("div");
    noteBox.className = "note-box";

    // Add a text area for the user to enter their note
    const noteTextArea = document.createElement("textarea");
    noteTextArea.placeholder = "Enter your note here...";
    noteBox.appendChild(noteTextArea);

    // Add a "Save" button
    const saveButton = document.createElement("button");
    saveButton.textContent = "Save";
    saveButton.className = "save-button";
    noteBox.appendChild(saveButton);

    // Append the note-taking box to the main content area
    document.querySelector("main").appendChild(noteBox);

    // Add functionality to the "Save" button (you can define the save action here)
    saveButton.addEventListener("click", function() {
        // You can add code here to save the note or perform other actions
        alert("Note saved!");
    });

