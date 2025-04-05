document.addEventListener('DOMContentLoaded', () => {
    const taskForm = document.getElementById('task-form');
    const taskInput = document.getElementById('task-input');
    const taskList = document.getElementById('task-list');

    let tasks = [];
    let isEditing = false;
    let editingId = null;

    taskForm.addEventListener('click', (e) => {
        const vti = taskInput.value.trim();
        if (vti !== '') {
            if (isEditing) {
                tasks = tasks.map(task =>
                    task.id === editingId ? { ...task, text: vti } : task
                );
                isEditing = false;
                editingId = null;
                taskForm.innerText = "Agregar";
            } else {
                const task = {
                    id: Date.now(),
                    text: vti,
                    complete: false
                };
                tasks.push(task);
            }
            renderTasks();
            taskInput.value = '';
        }
    });

    function renderTasks() {
        taskList.innerHTML = '';
        tasks.forEach(task => {
            const li = document.createElement('li');
            li.innerHTML =
                `<span>${task.text}</span>
                <div>
                    <button class="edit-btn" onclick="editTask(${task.id})">Editar</button>
                    <button class="delete-btn" onclick="deleteTask(${task.id})">Eliminar</button>
                    <button class="complete-btn ${task.complete ? 'completed' : ''}" onclick="completeTask(this, ${task.id})">${task.complete ? 'Completo' : 'Completar'}</button>
                </div>`;
            taskList.appendChild(li);
            if (task.complete) {
                li.style.backgroundColor = 'lightblue';
                const completeButton = li.querySelector('.complete-btn');
                const otherButtons = li.querySelectorAll('button:not(.complete-btn)');
                otherButtons.forEach(b => b.remove());
            }
        });
    }

    window.deleteTask = function (id) {
        tasks = tasks.filter(task => task.id !== id);
        renderTasks();
    }

    window.editTask = function (id) {
        const et = tasks.find(t => t.id === id);
        if (et) {
            taskInput.value = et.text;
            taskForm.innerText = "Guardar";
            isEditing = true;
            editingId = et.id;
        }
    }

    window.completeTask = function (btn, id) {
        const taskIndex = tasks.findIndex(task => task.id === id);
        if (taskIndex !== -1) {
            tasks[taskIndex].complete = true;
            renderTasks();
        }
    }

    renderTasks();
});