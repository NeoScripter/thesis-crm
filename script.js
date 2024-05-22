/* document.addEventListener('DOMContentLoaded', () => {
    const userSwitchBtn = document.querySelector('.switch-user');
    const formWrapper = document.querySelector('.form-wrapper');
    const orderWrapper = document.querySelector('.order-wrapper');
    userSwitchBtn.addEventListener('click', () => {
        if (formWrapper.style.display === 'flex') {
            formWrapper.style.display = 'none';
            orderWrapper.style.display = 'flex';
            userSwitchBtn.textContent = 'Для клиентов';
        } else {
            formWrapper.style.display = 'flex';
            orderWrapper.style.display = 'none';
            userSwitchBtn.textContent = 'Для заказчиков';
        }
    });
}); */