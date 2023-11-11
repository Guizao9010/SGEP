const itemEdit = document.querySelectorAll(".edit-button");
const itemDel = document.querySelectorAll(".delete-button");
itemEdit.forEach(button => button.style.display = 'none');
itemDel.forEach(button => button.style.display = 'none');

function editButton() {
  itemEdit.forEach((button) => {
    if (button.style.display === "none") {
      button.style.display = "inline-block";
    } else {
      button.style.display = "none";
    }
  });
}

function deleteButton() {
  itemDel.forEach((button) => {
    if (button.style.display === "none") {
      button.style.display = "inline-block";
    } else {
      button.style.display = "none";
    }
  });
}