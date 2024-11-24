document.addEventListener("DOMContentLoaded", function() {
    const todoForm = document.getElementById('todoForm');
    const taskInput = document.getElementById('taskInput');
    const taskList = document.getElementById('taskList');

    todoForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const taskText = taskInput.value.trim();

        if (taskText === '') {
            return;
        }

        addTask(taskText);
        taskInput.value = '';
    });

    function addTask(taskText) {
        const taskItem = document.createElement('li');
        taskItem.innerHTML = `
            <span>${taskText}</span>
            <button class="completeBtn">Concluir</button>
            <button class="deleteBtn">Excluir</button>
        `;
        taskList.appendChild(taskItem);

        const completeBtn = taskItem.querySelector('.completeBtn');
        completeBtn.addEventListener('click', function() {
            taskItem.classList.toggle('completed');
        });

        const deleteBtn = taskItem.querySelector('.deleteBtn');
        deleteBtn.addEventListener('click', function() {
            taskItem.remove();
        });
    }
});
