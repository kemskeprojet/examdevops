document.addEventListener('DOMContentLoaded', () => {
    fetchTasks();

    const taskFormElement = document.getElementById('taskFormElement');
    taskFormElement.addEventListener('submit', (event) => {
        event.preventDefault();
        const taskId = document.getElementById('taskId').value;
        const title = document.getElementById('title').value;
        const description = document.getElementById('description').value;
        const status = document.getElementById('status').value;
        
        const task = { title, description, status };
        
        if (taskId) {
            task.id = taskId;
            updateTask(task);
        } else {
            createTask(task);
        }
    });
});

function fetchTasks() {
    fetch('php/api.php')
        .then(response => response.json())
        .then(data => {
            const tasksDiv = document.getElementById('tasks');
            tasksDiv.innerHTML = '';
            data.forEach(task => {
                const taskElement = document.createElement('div');
                taskElement.className = 'task';
                taskElement.innerHTML = `
                    <h3>${task.title}</h3>
                    <p>${task.description}</p>
                    <p>Status: ${task.status}</p>
                    <button onclick="showForm('edit', ${task.id}, '${task.title}', '${task.description}', '${task.status}')">Edit</button>
                    <button onclick="deleteTask(${task.id})">Delete</button>
                `;
                tasksDiv.appendChild(taskElement);
            });
        })
        .catch(error => console.error('Error fetching tasks:', error));
}

function createTask(task) {
    fetch('http://localhost/examdevops/php/api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(task)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
        // Traitez la réponse comme nécessaire
    })
    .catch(error => {
        console.error('Error creating task:', error);
    });
}

function updateTask(task) {
    fetch('http://localhost/examdevops/php/api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(task)
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error('Error updating task:', data.error);
        } else {
            console.log(data.message);
            hideForm();
            fetchTasks();
        }
    })
    .catch(error => console.error('Error updating task:', error));
}

function deleteTask(id) {
    fetch('php/api.php', {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error('Error deleting task:', data.error);
        } else {
            console.log(data.message);
            fetchTasks();
        }
    })
    .catch(error => console.error('Error deleting task:', error));
}

function showForm(action, id = '', title = '', description = '', status = '') {
    const formTitle = document.getElementById('formTitle');
    const taskId = document.getElementById('taskId');
    const taskTitle = document.getElementById('title');
    const taskDescription = document.getElementById('description');
    const taskStatus = document.getElementById('status');
    const taskForm = document.getElementById('taskForm');

    if (action === 'create') {
        formTitle.textContent = 'Create Task';
        taskId.value = '';
        taskTitle.value = '';
        taskDescription.value = '';
        taskStatus.value = '';
    } else if (action === 'edit') {
        formTitle.textContent = 'Edit Task';
        taskId.value = id;
        taskTitle.value = title;
        taskDescription.value = description;
        taskStatus.value = status;
    }

    taskForm.style.display = 'block';
}

function hideForm() {
    const taskForm = document.getElementById('taskForm');
    taskForm.style.display = 'none';
}
