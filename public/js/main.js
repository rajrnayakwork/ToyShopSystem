let count = 1;
function addSubCategory() {
    let div = document.createElement("div");
    // div.classList.add("row");
    div.setAttribute("id", count);
    div.setAttribute("class", "row m-1");
    div.innerHTML = `
            <div class="col-10">
                <input type="text" name="subCategoryName[]" class="form-control form-control-lg" id="colFormLabelLg">
            </div>
            <button type="button" class="btn btn-danger col-2" onclick="deleteSubCategory(${count})">Delete</button>
    `;
    document.getElementById("subCategory").appendChild(div);
    count++;
}

function deleteSubCategory(value) {
    const div = document.getElementById(value);
    div.remove();
}
