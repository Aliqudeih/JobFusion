document.addEventListener('DOMContentLoaded', function () {
    // Grab the edit and save buttons
    const editButton = document.getElementById('edit-btn');
    const saveButton = document.getElementById('save-btn');

    // Grab the editable sections
    const editableSections = document.querySelectorAll('[contenteditable="false"]');

    // Function to enable editing
    function enableEditing() {
        editableSections.forEach(section => {
            section.setAttribute('contenteditable', 'true');
            section.style.backgroundColor = '#ffffff'; 
            section.style.border = '1px solid #ccc';  
        });
        editButton.style.display = 'none';
        saveButton.style.display = 'inline-block';
    }

    function saveChanges() {
        editableSections.forEach(section => {
            section.setAttribute('contenteditable', 'false');
            section.style.backgroundColor = '#f5f5f5'; 
            section.style.border = 'none'; 

            localStorage.setItem(section.className, section.innerHTML);
        });
        editButton.style.display = 'inline-block';
        saveButton.style.display = 'none';
    }

    editButton.addEventListener('click', enableEditing);
    saveButton.addEventListener('click', saveChanges);

    editableSections.forEach(section => {
        const savedContent = localStorage.getItem(section.className);
        if (savedContent) {
            section.innerHTML = savedContent;
        }
    });
});
