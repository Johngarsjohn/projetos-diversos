document.addEventListener("DOMContentLoaded", function() {
    const contactsContainer = document.getElementById('contacts');
    const addContactBtn = document.getElementById('addContactBtn');
    const modal = document.getElementById('modal');
    const closeBtn = document.querySelector('.close');
    const contactForm = document.getElementById('contactForm');
    
    addContactBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });

    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });

    contactForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = document.getElementById('name').value;
        const phone = document.getElementById('phone').value;

        addContact(name, phone);
        modal.style.display = 'none';
        contactForm.reset();
    });

    function addContact(name, phone) {
        const contact = document.createElement('div');
        contact.classList.add('contact');
        contact.innerHTML = `
            <p><strong>Nome:</strong> ${name}</p>
            <p><strong>Telefone:</strong> ${phone}</p>
            <button class="deleteBtn">Excluir</button>
            <button class="editBtn">Editar</button>
        `;
        contactsContainer.appendChild(contact);

        const deleteBtns = document.querySelectorAll('.deleteBtn');
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                btn.parentElement.remove();
            });
        });

        const editBtns = document.querySelectorAll('.editBtn');
        editBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Implementar edição do contato
                // Aqui você pode abrir um modal com os campos preenchidos
                // e permitir que o usuário edite o contato
            });
        });
    }
});
