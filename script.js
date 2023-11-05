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


const editorElement = document.getElementById('editor');
var editor = new Jodit(editorElement, {
    height: 500,
    maxheight: 500,
    allowResizeX: false,
    allowResizeY: false,
    scrollY: true,
});


document.getElementById("new-file-button").addEventListener("click", function () {

    var textbox = document.getElementById("file-name");
    textbox.style.display = "block";
});

const textField = document.getElementById("file-name");
const result = document.getElementById("result");

textField.addEventListener("blur", () => {
    const textValue = textField.value;
    data = "filename=" + textValue;
    if (textValue.trim() === "") {
        textField.style.display = "none";
    } else {
        var xhr = new XMLHttpRequest();
        var url = "em.php";
        xhr.open("POST", url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                result.innerHTML = this.responseText;
            }
        };
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(data);
        textField.style.display = "none";
    }
    window.location.reload();
});

const list = document.getElementById("myList");
const listItems = list.getElementsByTagName("li");

for (let i = 0; i < listItems.length; i++) {
    listItems[i].addEventListener("click", function () {
        for (let j = 0; j < listItems.length; j++) {
            listItems[j].classList.remove("active");
        }
        const itemId = listItems[i].id;
        var item = document.getElementById(itemId);
        item.classList.toggle("active");
        var xhr = new XMLHttpRequest();
        var url = "getcontent.php?fileid=" + itemId;
        xhr.open("GET", url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = xhr.responseText;
                editor.setEditorValue(response);
            }
        };
        xhr.send();
    });
}

var save = document.getElementById("save-button");

save.addEventListener("click", function () {
    var content = editor.getEditorValue();
    var active = document.getElementsByClassName("active");
    if (active.length > 0) {
        console.log(active[0].id);
        var activeid = active[0].id;
        var xhr = new XMLHttpRequest();
        var url = "save.php";
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("content=" + content + "&fileid=" + activeid);
    } else {
        alert("Please select a file to save");
    }

});